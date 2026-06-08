<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth/login');
        }

        $this->load->model('Jadwal_model');
        $this->load->model('Krs_model');
        $this->load->model('Dosen_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Matakuliah_model'); // opsional jika ingin tampilkan nama matkul
    }

    public function index()
    {
        $usertype = $this->session->userdata('usertype');
        $semester = $this->input->get('semester');
        $tahun_ajaran = $this->input->get('tahun_ajaran');
        $nama_mhs = $this->input->get('nama_mhs');
        $mata_kuliah = $this->input->get('mata_kuliah');

        if ($usertype == 'admin') {
            $data['nilai'] = $this->Krs_model->get_all_nilai_filtered($nama_mhs, $mata_kuliah, $semester, $tahun_ajaran);
        } elseif ($usertype == 'dosen') {
            $user_id = $this->session->userdata('user_id');
            $dosen = $this->Dosen_model->get_by_user($user_id);
            if (!$dosen) {
                show_error("Data dosen tidak ditemukan.");
                return;
            }
            $data['nilai'] = $this->Krs_model->get_nilai_by_dosen_filtered($dosen->dosen_id, $mata_kuliah, $semester, $tahun_ajaran);
        } elseif ($usertype == 'mahasiswa') {
            $user_id = $this->session->userdata('user_id');
            $mhs = $this->Mahasiswa_model->get_by_user($user_id);
            if (!$mhs) {
                show_error("Data mahasiswa tidak ditemukan.");
                return;
            }
            $data['nilai'] = $this->Krs_model->get_nilai_by_mahasiswa($mhs->mhs_id);
        } else {
            show_error("Akses ditolak.");
            return;
        }

        // Perbaikan disini: gunakan fungsi yang benar untuk ambil daftar tahun ajaran
       // Ambil daftar filter sesuai role
    if ($usertype == 'admin') {
        $data['semester_list'] = $this->Krs_model->get_all_semester();
        $data['tahun_ajaran_list'] = $this->Krs_model->get_distinct_tahun_ajaran();
    } elseif ($usertype == 'dosen') {
        $data['semester_list'] = $this->Krs_model->get_semester_by_dosen($dosen->dosen_id);
        $data['tahun_ajaran_list'] = $this->Krs_model->get_tahun_ajaran_by_dosen($dosen->dosen_id);
    } elseif ($usertype == 'mahasiswa') {
        $data['semester_list'] = $this->Krs_model->get_semester_by_mhs($mhs->mhs_id);
        $data['tahun_ajaran_list'] = $this->Krs_model->get_tahun_ajaran_by_mhs($mhs->mhs_id);
    }


        // Untuk tetap menampilkan nilai filter saat reload
        $data['selected_semester'] = $semester;
        $data['selected_tahun_ajaran'] = $tahun_ajaran;
        $data['selected_nama_mhs'] = $nama_mhs;
        $data['selected_mata_kuliah'] = $mata_kuliah;

        $this->load->view('nilai/nilai_report', $data);
    }

    public function input($jadwal_id)
    {
        $usertype = $this->session->userdata('usertype');

        if ($usertype !== 'dosen') {
            show_error("Akses ditolak.");
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $dosen = $this->Dosen_model->get_by_user($user_id);

        if (!$dosen) {
            show_error("Data dosen tidak ditemukan.");
            return;
        }

        $jadwal = $this->Jadwal_model->read_by($jadwal_id);
        if ($jadwal->dosen_id != $dosen->dosen_id) {
            show_error("Anda tidak berhak mengakses data ini.");
            return;
        }

        $data['jadwal'] = $jadwal;
        $data['krs'] = $this->Krs_model->get_krs_by_jadwal($jadwal_id);
        $this->load->view('nilai/nilai_input', $data);
    }

    public function simpan()
    {
        $usertype = $this->session->userdata('usertype');
        if ($usertype !== 'dosen') {
            show_error("Akses ditolak.");
            return;
        }

        $nilai = $this->input->post('nilai');
        if ($nilai && is_array($nilai)) {
            foreach ($nilai as $krs_id => $nilai_mhs) {
                $this->Krs_model->update_nilai($krs_id, $nilai_mhs);
            }
            $this->session->set_flashdata('msg', '<p style="color:green">Nilai berhasil disimpan!</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style="color:red">Data nilai tidak valid!</p>');
        }

        redirect('nilai');
    }
}
