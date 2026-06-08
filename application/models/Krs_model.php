<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs_model extends CI_Model {

    public function create($mhs_id, $jadwal_id, $semester, $tahun_ajaran)
    {
        $data = [
            'mhs_id'           => $mhs_id,
            'jadwal_id'        => $jadwal_id,
            'semester'         => $semester,
            'tahun_ajaran'     => $tahun_ajaran,
            'status'           => 'diajukan',
            'alasan_penolakan' => NULL
        ];
        return $this->db->insert('krs', $data);
    }

    public function read_all_admin($mhs_id = null)
    {
        $this->db->select('krs.*, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen, mahasiswa.nama AS nama_mhs, penjadwalan.hari, penjadwalan.jam_mulai, penjadwalan.jam_selesai, penjadwalan.ruang');
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id', 'left');

        if ($mhs_id) {
            $this->db->where('krs.mhs_id', $mhs_id);
        }

        $this->db->order_by('krs.krs_id', 'DESC');
        return $this->db->get()->result();
    }

    public function read_by_mhs($mhs_id, $tahun_ajaran = null, $semester = null)
    {
        $this->db->select('krs.*, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen, penjadwalan.hari, penjadwalan.jam_mulai, penjadwalan.jam_selesai, penjadwalan.ruang');
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->where('krs.mhs_id', $mhs_id);

        if ($tahun_ajaran !== null) {
            $this->db->where('krs.tahun_ajaran', $tahun_ajaran);
        }

        if ($semester !== null) {
            $this->db->where('krs.semester', $semester);
        }

        return $this->db->get()->result();
    }

    public function read_by_mhs_semester($mhs_id, $tahun_ajaran, $semester)
    {
        $this->db->select('jadwal_id');
        $this->db->from('krs');
        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        return $this->db->get()->result();
    }

    public function read_pengajuan_by_dosen($dosen_id)
    {
        $this->db->select('krs.*, matakuliah.nama_mk, matakuliah.kode_mk, mahasiswa.npm, mahasiswa.nama AS nama_mhs, penjadwalan.hari, penjadwalan.jam_mulai, penjadwalan.jam_selesai, penjadwalan.ruang, dosen.nama AS nama_dosen, krs.nilai');
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id', 'left');
        $this->db->where('pengampu.dosen_id', $dosen_id);
        $this->db->order_by('krs.mhs_id', 'ASC');
        return $this->db->get()->result();
    }

    public function cek_status($mhs_id, $tahun_ajaran, $semester)
    {
        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        return $this->db->get('krs')->num_rows() > 0;
    }

    public function cek_status_detail($mhs_id, $tahun_ajaran, $semester)
    {
        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        return $this->db->get('krs')->row();
    }

    public function hapus_krs($mhs_id, $tahun_ajaran, $semester)
    {
        $this->db->where('mhs_id', $mhs_id);
        $this->db->where('tahun_ajaran', $tahun_ajaran);
        $this->db->where('semester', $semester);
        return $this->db->delete('krs');
    }

    public function read_detail($krs_id)
    {
        $this->db->select('krs.*, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen, mahasiswa.nama AS nama_mhs, penjadwalan.hari, penjadwalan.jam_mulai, penjadwalan.jam_selesai, penjadwalan.ruang, krs.alasan_penolakan, krs.nilai');
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id', 'left');
        $this->db->where('krs.krs_id', $krs_id);
        return $this->db->get()->row();
    }

    public function approve($krs_id)
    {
        $this->db->set('status', 'disetujui');
        $this->db->set('alasan_penolakan', NULL);
        $this->db->where('krs_id', $krs_id);
        return $this->db->update('krs');
    }

    public function reject($krs_id, $catatan = null)
    {
        $this->db->set('status', 'ditolak');
        $this->db->set('alasan_penolakan', $catatan);
        $this->db->where('krs_id', $krs_id);
        return $this->db->update('krs');
    }

    public function delete($id)
    {
        $this->db->where('krs_id', $id);
        return $this->db->delete('krs');
    }

    public function get_krs_by_jadwal($jadwal_id)
    {
        $this->db->select('krs.*, mahasiswa.nama, mahasiswa.npm, krs.nilai');
        $this->db->from('krs');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id');
        $this->db->where('krs.jadwal_id', $jadwal_id);
        return $this->db->get()->result();
    }

    public function get_all_nilai_filtered($nama_mhs = null, $mata_kuliah = null, $semester = null, $tahun_ajaran = null)
    {
        $this->db->select('krs.*, mahasiswa.nama AS nama_mhs, mahasiswa.npm, matakuliah.nama_mk');
        $this->db->from('krs');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');

        if ($nama_mhs) $this->db->like('mahasiswa.nama', $nama_mhs);
        if ($mata_kuliah) $this->db->like('matakuliah.nama_mk', $mata_kuliah);
        if ($semester) $this->db->where('krs.semester', $semester);
        if ($tahun_ajaran) $this->db->where('krs.tahun_ajaran', $tahun_ajaran);

        return $this->db->get()->result();
    }

    public function get_nilai_by_dosen_filtered($dosen_id, $mata_kuliah = null, $semester = null, $tahun_ajaran = null)
    {
        $this->db->select('krs.*, mahasiswa.nama AS nama_mhs, mahasiswa.npm, matakuliah.nama_mk');
        $this->db->from('krs');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
        $this->db->where('pengampu.dosen_id', $dosen_id);

        if ($mata_kuliah) $this->db->like('matakuliah.nama_mk', $mata_kuliah);
        if ($semester) $this->db->where('krs.semester', $semester);
        if ($tahun_ajaran) $this->db->where('krs.tahun_ajaran', $tahun_ajaran);

        return $this->db->get()->result();
    }

    public function get_semester_by_mhs($mhs_id)
    {
        $this->db->select('DISTINCT(semester)', false);
        $this->db->from('krs');
        $this->db->where('mhs_id', $mhs_id);
        $this->db->order_by('semester', 'ASC');
        return $this->db->get()->result();
    }

    public function get_tahun_ajaran_by_mhs($mhs_id)
    {
        $this->db->select('DISTINCT(tahun_ajaran)', false);
        $this->db->from('krs');
        $this->db->where('mhs_id', $mhs_id);
        $this->db->order_by('tahun_ajaran', 'DESC');
        return $this->db->get()->result();
    }

    public function get_semester_by_dosen($dosen_id)
    {
        $this->db->select('DISTINCT(krs.semester)', false);
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
        $this->db->where('pengampu.dosen_id', $dosen_id);
        $this->db->order_by('krs.semester', 'ASC');
        return $this->db->get()->result();
    }

    public function get_tahun_ajaran_by_dosen($dosen_id)
    {
        $this->db->select('DISTINCT(krs.tahun_ajaran)', false);
        $this->db->from('krs');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
        $this->db->where('pengampu.dosen_id', $dosen_id);
        $this->db->order_by('krs.tahun_ajaran', 'DESC');
        return $this->db->get()->result();
    }

    public function update_nilai($krs_id, $nilai)
    {
        $this->db->where('krs_id', $krs_id);
        return $this->db->update('krs', ['nilai' => $nilai]);
    }

    public function get_all_nilai()
    {
        $this->db->select('krs.*, mahasiswa.nama AS nama_mhs, mahasiswa.npm, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen');
        $this->db->from('krs');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id', 'left');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        return $this->db->get()->result();
    }

    public function get_all_semester()
    {
        $this->db->select('DISTINCT(semester)', false);
        $this->db->from('krs');
        $this->db->order_by('semester', 'ASC');
        return $this->db->get()->result();
    }

    public function get_nilai_by_mahasiswa($mhs_id)
    {
        $this->db->select('krs.*, mahasiswa.nama AS nama_mhs, mahasiswa.npm, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen');
        $this->db->from('krs');
        $this->db->join('mahasiswa', 'mahasiswa.mhs_id = krs.mhs_id', 'left');
        $this->db->join('penjadwalan', 'penjadwalan.jadwal_id = krs.jadwal_id', 'left');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->where('krs.mhs_id', $mhs_id);
        return $this->db->get()->result();
    }

    
    public function get_distinct_tahun_ajaran()
    {
        $this->db->select('DISTINCT(tahun_ajaran)', false);
        $this->db->from('krs');
        $this->db->order_by('tahun_ajaran', 'DESC');
        return $this->db->get()->result();
    }
}
