<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_model extends CI_Model {

    public function create()
    {
        $data = [
            'kode_mk'  => $this->input->post('kode_mk', TRUE),
            'nama_mk'  => $this->input->post('nama_mk', TRUE),
            'sks'      => $this->input->post('sks', TRUE),
            'semester' => $this->input->post('semester', TRUE),
            'prodi_id' => $this->input->post('prodi_id', TRUE)
        ];
        $this->db->insert('matakuliah', $data);
    }

    public function read($limit, $start, $prodi_id = null, $semester = null)
    {
        $this->db->select('matakuliah.mk_id, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, matakuliah.semester, 
                           matakuliah.prodi_id, prodi.nama_prodi, fakultas.nama_fakultas');
        $this->db->from('matakuliah');
        $this->db->join('prodi', 'prodi.prodi_id = matakuliah.prodi_id', 'left');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');

        if ($prodi_id) {
            $this->db->where('matakuliah.prodi_id', $prodi_id);
        }

        if ($semester) {
            $this->db->where('matakuliah.semester', $semester);
        }

        $this->db->order_by('mk_id', 'DESC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result();
    }

    public function read_all()
    {
        $this->db->select('matakuliah.mk_id, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, matakuliah.semester, 
                           matakuliah.prodi_id, prodi.nama_prodi, fakultas.nama_fakultas');
        $this->db->from('matakuliah');
        $this->db->join('prodi', 'prodi.prodi_id = matakuliah.prodi_id', 'left');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        $this->db->order_by('matakuliah.nama_mk', 'ASC');

        return $this->db->get()->result();
    }

    public function read_by($id)
    {
        $this->db->select('matakuliah.*, prodi.nama_prodi, fakultas.nama_fakultas');
        $this->db->from('matakuliah');
        $this->db->join('prodi', 'prodi.prodi_id = matakuliah.prodi_id', 'left');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        $this->db->where('matakuliah.mk_id', $id);

        return $this->db->get()->row();
    }

    public function count_all($prodi_id = null, $semester = null)
    {
        if ($prodi_id) {
            $this->db->where('prodi_id', $prodi_id);
        }
        if ($semester) {
            $this->db->where('semester', $semester);
        }

        return $this->db->count_all_results('matakuliah');
    }

    public function update($id)
    {
        $data = [
            'kode_mk'  => $this->input->post('kode_mk', TRUE),
            'nama_mk'  => $this->input->post('nama_mk', TRUE),
            'sks'      => $this->input->post('sks', TRUE),
            'semester' => $this->input->post('semester', TRUE),
            'prodi_id' => $this->input->post('prodi_id', TRUE)
        ];
        $this->db->where('mk_id', $id);
        $this->db->update('matakuliah', $data);
    }

    public function delete($id)
    {
        $this->db->where('mk_id', $id);
        $this->db->delete('matakuliah');
    }
}
