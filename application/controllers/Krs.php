<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('auth/login');
        }

        $this->load->model('Krs_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Jadwal_model'); 
        $this->load->library('pagination');
    }

    public function index()
    {
        $usertype = $this->session->userdata('usertype');

        if ($usertype == 'admin') {
            $data['mahasiswa'] = $this->Mahasiswa_model->read_all();
            $mhs_id = $this->input->get('mhs_id');
            $data['selected_mhs'] = $mhs_id;
            $data['krs'] = $mhs_id ? $this->Krs_model->read_by_mhs($mhs_id) : [];

            if ($mhs_id) {
                $data['mahasiswa_detail'] = $this->Mahasiswa_model->read_by($mhs_id);
                if (!$data['mahasiswa_detail']) {
                    show_error("Mahasiswa tidak ditemukan.");
                }
                $this->load->view('krs/krs_list_admin', $data);
            } else {
                $this->load->view('krs/krs_admin', $data);
            }

        } elseif ($usertype == 'mahasiswa') {
            $mhs_id = $this->session->userdata('mhs_id');
            $mahasiswa = $this->Mahasiswa_model->read_by($mhs_id);

            $semester = $this->input->get('filter_semester') ?: $mahasiswa->semester;
            $tahun_ajaran = $this->input->get('filter_tahun');

            if (!$tahun_ajaran) {
                $pengampu = $this->Jadwal_model->get_last_pengampu($mahasiswa->prodi_id, $semester);
                $tahun_ajaran = $pengampu ? $pengampu->tahun_ajaran : date('Y') . '/' . (date('Y') + 1);
            }

            $data['mahasiswa'] = $mahasiswa;
            $data['semester'] = $semester;
            $data['tahun_ajaran'] = $tahun_ajaran;
            $data['krs'] = $this->Krs_model->read_by_mhs($mhs_id, $tahun_ajaran, $semester);

            // ✅ Tambahkan pengecekan status disetujui
            $krs_disetujui = false;
            foreach ($data['krs'] as $k) {
                if ($k->status === 'disetujui') {
                    $krs_disetujui = true;
                    break;
                }
            }
            $data['krs_disetujui'] = $krs_disetujui;

            $this->load->view('krs/krs_list_mhs', $data);

        } elseif ($usertype == 'dosen') {
            $dosen_id = $this->session->userdata('dosen_id');
            $data['krs'] = $this->Krs_model->read_pengajuan_by_dosen($dosen_id);
            $this->load->helper('nilai');
            $this->load->view('krs/krs_list_dosen', $data);

        } else {
            show_error('Role tidak dikenali.');
        }
    }

    public function add($mhs_id = null)
    {
        $usertype = $this->session->userdata('usertype');

        if ($usertype == 'admin' && $mhs_id) {
            $mahasiswa = $this->Mahasiswa_model->read_by($mhs_id);
        } elseif ($usertype == 'mahasiswa') {
            $mhs_id = $this->session->userdata('mhs_id');
            $mahasiswa = $this->Mahasiswa_model->read_by($mhs_id);
        } else {
            show_error('Akses ditolak!');
        }

        if (!$mahasiswa) {
            show_error('Data mahasiswa tidak ditemukan.');
        }

        $prodi_id = $mahasiswa->prodi_id;
        $semester = $mahasiswa->semester;

        $pengampu = $this->Jadwal_model->get_last_pengampu($prodi_id, $semester);
        $tahun_ajaran = $pengampu ? $pengampu->tahun_ajaran : date('Y') . '/' . (date('Y') + 1);

        $data['mahasiswa'] = $mahasiswa;
        $data['semester'] = $semester;
        $data['tahun_ajaran'] = $tahun_ajaran;
        $data['matakuliah'] = $this->Jadwal_model->get_jadwal_by_prodi($prodi_id);
        $data['krs_terpilih'] = $this->Krs_model->read_by_mhs_semester($mhs_id, $tahun_ajaran, $semester);

        $status_krs = $this->Krs_model->cek_status_detail($mhs_id, $tahun_ajaran, $semester);
        if ($status_krs && $status_krs->status == 'disetujui' && $usertype != 'admin') {
            $this->session->set_flashdata('msg', '<p style="color:green;">KRS semester ini sudah disetujui, tidak bisa diedit.</p>');
            redirect('krs');
        }

        if ($this->input->post('submit')) {
            $matkul_dipilih = $this->input->post('jadwal_id');

            if (!empty($matkul_dipilih)) {
                $this->Krs_model->hapus_krs($mhs_id, $tahun_ajaran, $semester);
                foreach ($matkul_dipilih as $jadwal_id) {
                    $this->Krs_model->create($mhs_id, $jadwal_id, $semester, $tahun_ajaran);
                }
                $pesan = ($usertype == 'mahasiswa') ? 'KRS berhasil diajukan ke admin!' : 'KRS berhasil disimpan!';
                $this->session->set_flashdata('msg', $pesan);
            } else {
                $this->session->set_flashdata('msg', '<p style="color:red;">Pilih minimal 1 matakuliah!</p>');
            }

            redirect('krs');
        }

        $this->load->view('krs/krs_form_mhs', $data);
    }

    public function input_nilai($krs_id)
    {
        if ($this->session->userdata('usertype') != 'dosen') {
            show_error('Akses ditolak!');
        }

        $data['krs'] = $this->Krs_model->read_detail($krs_id);
        if (!$data['krs']) {
            show_error('Data KRS tidak ditemukan.');
        }

        if ($this->input->post('submit') || $this->input->post('nilai')) {
            $nilai = $this->input->post('nilai');
            $this->Krs_model->update_nilai($krs_id, $nilai);
            $this->session->set_flashdata('msg', 'Nilai berhasil disimpan.');
            redirect('krs');
        }

        $this->load->view('krs/krs_input_nilai', $data);
    }

    public function approve_all()
    {
        if ($this->session->userdata('usertype') != 'admin') {
            show_error('Akses ditolak!');
        }

        $mhs_id = $this->input->post('mhs_id');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $semester = $this->input->post('semester');

        if (!$mhs_id || !$tahun_ajaran || !$semester) {
            show_error("Data tidak lengkap.");
        }

        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        $this->db->set('status', 'disetujui');
        $this->db->set('alasan_penolakan', NULL);
        $this->db->update('krs');

        $this->session->set_flashdata('msg', 'Semua KRS mahasiswa ini telah disetujui.');
        redirect('krs?mhs_id=' . $mhs_id);
    }

    public function reject_all()
    {
        if ($this->session->userdata('usertype') != 'admin') {
            show_error('Akses ditolak!');
        }

        $mhs_id = $this->input->post('mhs_id');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $semester = $this->input->post('semester');
        $alasan = $this->input->post('alasan_penolakan');

        if (!$mhs_id || !$tahun_ajaran || !$semester || !$alasan) {
            $this->session->set_flashdata('msg', '<p style="color:red;">Data tidak lengkap atau alasan kosong.</p>');
            redirect('krs?mhs_id=' . $mhs_id);
        }

        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        $this->db->set('status', 'ditolak');
        $this->db->set('alasan_penolakan', $alasan);
        $this->db->update('krs');

        $this->session->set_flashdata('msg', 'Semua KRS mahasiswa ini telah ditolak.');
        redirect('krs?mhs_id=' . $mhs_id);
    }

    public function reject($krs_id)
    {
        if ($this->session->userdata('usertype') != 'admin') {
            show_error('Akses ditolak!');
        }

        $data['krs'] = $this->Krs_model->read_detail($krs_id);
        if (!$data['krs']) {
            show_error('Data KRS tidak ditemukan.');
        }

        if ($this->input->post('submit')) {
            $alasan = $this->input->post('alasan_penolakan');
            $this->Krs_model->reject($krs_id, $alasan);
            $this->session->set_flashdata('msg', 'KRS ditolak.');
            redirect('krs');
        }

        $this->load->view('krs/krs_form_tolak', $data);
    }
}
