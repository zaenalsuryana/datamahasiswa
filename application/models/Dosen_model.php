<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

    public function create()
    {
        $data = [
            'user_id'  => $this->input->post('user_id'),
            'prodi_id' => $this->input->post('prodi_id'),
            'nama'     => $this->input->post('nama'),
            'email'    => $this->input->post('email'),
            'nip'      => $this->input->post('nip')
        ];
        $this->db->insert('dosen', $data);
    }

        public function read($limit, $start)
    {
        $this->db->select('d.*, p.nama_prodi, f.nama_fakultas');
        $this->db->from('dosen d');
        $this->db->join('prodi p', 'p.prodi_id = d.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function read_all()
    {
        $this->db->select('d.*, p.nama_prodi, f.nama_fakultas');
        $this->db->from('dosen d');
        $this->db->join('prodi p', 'p.prodi_id = d.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        return $this->db->get()->result();
    }

    public function read_by($id)
    {
        $this->db->select('d.*, p.nama_prodi, f.nama_fakultas');
        $this->db->from('dosen d');
        $this->db->join('prodi p', 'p.prodi_id = d.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->where('d.dosen_id', $id);
        return $this->db->get()->row();
    }
    
public function get_by_user($user_id)
{
    return $this->db->get_where('dosen', ['user_id' => $user_id])->row();
}



    public function update($id)
    {
        $data = [
            'user_id'  => $this->input->post('user_id'),
            'prodi_id' => $this->input->post('prodi_id'),
            'nama'     => $this->input->post('nama'),
            'email'    => $this->input->post('email'),
            'nip'      => $this->input->post('nip')
        ];
        $this->db->where('dosen_id', $id);
        $this->db->update('dosen', $data);
    }

    public function delete($id)
    {
        $this->db->where('dosen_id', $id);
        $this->db->delete('dosen');
    }
}
