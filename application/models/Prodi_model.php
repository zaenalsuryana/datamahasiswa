<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {

    public function create()
    {
        $data = [
            'kode_prodi'  => $this->input->post('kode_prodi', TRUE),
            'nama_prodi'  => $this->input->post('nama_prodi', TRUE),
            'jenjang'     => $this->input->post('jenjang', TRUE),
            'fakultas_id' => $this->input->post('fakultas_id', TRUE),
            'akreditasi'  => $this->input->post('akreditasi', TRUE)
        ];
        $this->db->insert('prodi', $data);
    }

    public function read($limit, $start)
    {
        $this->db->select('prodi.*, fakultas.nama_fakultas');
        $this->db->from('prodi');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        $this->db->limit($limit, $start);
        $this->db->order_by('prodi.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function read_by($id)
    {
        return $this->db->get_where('prodi', ['prodi_id' => $id])->row();
    }

    public function read_all()
    {
        $this->db->select('prodi.*, fakultas.nama_fakultas');
        $this->db->from('prodi');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        return $this->db->get()->result();
    }

    public function update($id)
    {
        $data = [
            'kode_prodi'  => $this->input->post('kode_prodi', TRUE),
            'nama_prodi'  => $this->input->post('nama_prodi', TRUE),
            'jenjang'     => $this->input->post('jenjang', TRUE),
            'fakultas_id' => $this->input->post('fakultas_id', TRUE),
            'akreditasi'  => $this->input->post('akreditasi', TRUE)
        ];
        $this->db->where('prodi_id', $id);
        $this->db->update('prodi', $data);
    }

    public function delete($id)
    {
        $this->db->where('prodi_id', $id);
        $this->db->delete('prodi');
    }
}
