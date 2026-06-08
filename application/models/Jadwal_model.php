<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function create()
    {
        $data = [
            'pengampu_id' => $this->input->post('pengampu_id', TRUE),
            'hari'        => $this->input->post('hari', TRUE),
            'jam_mulai'   => $this->input->post('jam_mulai', TRUE),
            'jam_selesai' => $this->input->post('jam_selesai', TRUE),
            'ruang'       => $this->input->post('ruang', TRUE)
        ];
        $this->db->insert('penjadwalan', $data);
    }

    public function read($limit, $start)
    {
        $this->db->select('penjadwalan.*, 
                           matakuliah.nama_mk, 
                           dosen.nama AS nama_dosen,
                           pengampu.semester, 
                           pengampu.tahun_ajaran, 
                           prodi.nama_prodi, 
                           fakultas.nama_fakultas');
        $this->db->from('penjadwalan');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->join('prodi', 'prodi.prodi_id = pengampu.prodi_id', 'left');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        $this->db->order_by('penjadwalan.jadwal_id', 'DESC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result();
    }

    public function get_last_pengampu($prodi_id, $semester)
{
    $this->db->select('tahun_ajaran');
    $this->db->from('pengampu');
    $this->db->where('prodi_id', $prodi_id);
    $this->db->where('semester', $semester);
    $this->db->order_by('tahun_ajaran', 'DESC');
    $this->db->limit(1);

    return $this->db->get()->row();
}


    public function read_by($id)
    {
        $this->db->select('penjadwalan.*, 
                           matakuliah.nama_mk, 
                           dosen.nama AS nama_dosen,
                           pengampu.semester, 
                           pengampu.tahun_ajaran, 
                           prodi.nama_prodi, 
                           fakultas.nama_fakultas');
        $this->db->from('penjadwalan');
        $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
        $this->db->join('prodi', 'prodi.prodi_id = pengampu.prodi_id', 'left');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        $this->db->where('penjadwalan.jadwal_id', $id);

        return $this->db->get()->row();
    }
    public function get_detail($id)
{
    $this->db->select('penjadwalan.*, 
                       pengampu.prodi_id, 
                       pengampu.tahun_ajaran, 
                       pengampu.semester, 
                       pengampu.mk_id, 
                       matakuliah.nama_mk, 
                       pengampu.dosen_id, 
                       dosen.nama AS nama_dosen');
    $this->db->from('penjadwalan');
    $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
    $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
    $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id');
    $this->db->where('penjadwalan.jadwal_id', $id);
    return $this->db->get()->row();
}


public function get_jadwal_by_prodi($prodi_id)
{
    $this->db->select('penjadwalan.*, 
                       matakuliah.kode_mk, 
                       matakuliah.nama_mk, 
                       matakuliah.sks, 
                       dosen.nama AS nama_dosen,
                       pengampu.semester');
    $this->db->from('penjadwalan');
    $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id');
    $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
    $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id');
    $this->db->where('pengampu.prodi_id', $prodi_id);
    
    return $this->db->get()->result();
}

public function get_jadwal_by_dosen($dosen_id)
{
    $this->db->select('penjadwalan.*, matakuliah.nama_mk, matakuliah.kode_mk, dosen.nama AS nama_dosen');
    $this->db->from('penjadwalan');
    $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
    $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
    $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
    $this->db->where('pengampu.dosen_id', $dosen_id);
    return $this->db->get()->result();
}

public function filter_jadwal($tahun_ajaran, $semester, $prodi_id)
{
    $this->db->select('penjadwalan.*, matakuliah.nama_mk, matakuliah.kode_mk, matakuliah.sks, dosen.nama AS nama_dosen');
    $this->db->from('penjadwalan');
    $this->db->join('pengampu', 'pengampu.pengampu_id = penjadwalan.pengampu_id', 'left');
    $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id', 'left');
    $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id', 'left');
    $this->db->where('pengampu.tahun_ajaran', $tahun_ajaran);
    $this->db->where('pengampu.semester', $semester);
    $this->db->where('pengampu.prodi_id', $prodi_id);

    return $this->db->get()->result();
}





    public function update($id)
{
    $data = [
        'pengampu_id' => $this->input->post('pengampu_id', TRUE),
        'hari'        => $this->input->post('hari', TRUE),
        'jam_mulai'   => $this->input->post('jam_mulai', TRUE),
        'jam_selesai' => $this->input->post('jam_selesai', TRUE),
        'ruang'       => $this->input->post('ruang', TRUE)
    ];
    $this->db->where('jadwal_id', $id);
    $this->db->update('penjadwalan', $data);
}


    public function delete($id)
    {
        $this->db->where('jadwal_id', $id);
        $this->db->delete('penjadwalan');
    }
}
