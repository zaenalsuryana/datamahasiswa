<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengampu_model extends CI_Model {

    public function create()
    {
        $semester = $this->input->post('semester', TRUE);
        $periode = ($semester % 2 == 1) ? 'Ganjil' : 'Genap';

        $data = [
            'dosen_id'      => $this->input->post('dosen_id', TRUE),
            'mk_id'         => $this->input->post('mk_id', TRUE),
            'tahun_ajaran'  => $this->input->post('tahun_ajaran', TRUE),
            'semester'      => $semester,
            'prodi_id'      => $this->input->post('prodi_id', TRUE),
            'periode'       => $periode
        ];
        $this->db->insert('pengampu', $data);
    }

    public function read_all()
    {
        $this->db->select('pengampu.*, dosen.nama AS nama_dosen, matakuliah.nama_mk AS nama_mk');
        $this->db->from('pengampu');
        $this->db->join('dosen', 'pengampu.dosen_id = dosen.dosen_id');
        $this->db->join('matakuliah', 'pengampu.mk_id = matakuliah.mk_id');
        $this->db->order_by('pengampu.pengampu_id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_all_pengampu()
    {
        $this->db->select('pengampu.pengampu_id, matakuliah.nama_mk, dosen.nama AS nama_dosen');
        $this->db->from('pengampu');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id');
        return $this->db->get()->result();
    }

    public function filter_pengampu($tahun_ajaran, $semester, $prodi_id)
{
    $this->db->select('pengampu.pengampu_id, matakuliah.nama_mk, dosen.nama AS nama_dosen');
    $this->db->from('pengampu');
    $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
    $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id');
    $this->db->where('pengampu.tahun_ajaran', $tahun_ajaran);
    $this->db->where('pengampu.semester', $semester);
    $this->db->where('pengampu.prodi_id', $prodi_id);

    return $this->db->get()->result();
}


    public function filter($tahun_ajaran, $semester, $prodi_id)
    {
        return $this->filter_pengampu($tahun_ajaran, $semester, $prodi_id);
    }

    public function get_matkul_by_prodi($prodi_id)
    {
        $this->db->where('prodi_id', $prodi_id);
        return $this->db->get('matakuliah')->result();
    }

    public function get_dosen_by_prodi($prodi_id)
    {
        $this->db->where('prodi_id', $prodi_id);
        return $this->db->get('dosen')->result();
    }

    public function get_pengampu_by_semester($tahun_ajaran, $semester)
    {
        $this->db->select('pengampu.*, matakuliah.nama_mk, dosen.nama AS nama_dosen');
        $this->db->from('pengampu');
        $this->db->join('matakuliah', 'matakuliah.mk_id = pengampu.mk_id');
        $this->db->join('dosen', 'dosen.dosen_id = pengampu.dosen_id');
        $this->db->where('pengampu.tahun_ajaran', $tahun_ajaran);
        $this->db->where('pengampu.semester', $semester);
        return $this->db->get()->result();
    }

    public function delete($id)
    {
        $this->db->where('pengampu_id', $id);
        $this->db->delete('pengampu');
    }
}
