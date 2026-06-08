<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas_model extends CI_Model {

    public function create()
    {
        $data = [
            'nama_fakultas' => $this->input->post('nama_fakultas'),
            'singkatan'     => $this->input->post('singkatan')
        ];
        $this->db->insert('fakultas', $data);
    }

    public function read($limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get('fakultas')->result();
    }

    public function read_by($id)
    {
        return $this->db->get_where('fakultas', ['fakultas_id' => $id])->row();
    }

    public function read_all()
    {
        return $this->db->get('fakultas')->result();
    }


    public function update($id)
    {
        $data = [
            'nama_fakultas' => $this->input->post('nama_fakultas'),
            'singkatan'     => $this->input->post('singkatan')
        ];
        $this->db->where('fakultas_id', $id);
        $this->db->update('fakultas', $data);
    }

    public function delete($id)
    {
        $this->db->where('fakultas_id', $id);
        $this->db->delete('fakultas');
    }
}
