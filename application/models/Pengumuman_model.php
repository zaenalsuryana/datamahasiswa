<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {

    public function create()
    {
        $data = [
            'judul'   => $this->input->post('judul', TRUE),
            'isi'     => $this->input->post('isi', TRUE),
            'tanggal' => $this->input->post('tanggal', TRUE)
        ];
        $this->db->insert('pengumuman', $data);
    }

    public function read($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('pengumuman')->result();
    }

    public function read_by($id)
    {
        return $this->db->get_where('pengumuman', ['pengumuman_id' => $id])->row();
    }

    public function update($id)
    {
        $data = [
            'judul'   => $this->input->post('judul', TRUE),
            'isi'     => $this->input->post('isi', TRUE),
            'tanggal' => $this->input->post('tanggal', TRUE)
        ];
        $this->db->where('pengumuman_id', $id);
        $this->db->update('pengumuman', $data);
    }

    public function delete($id)
    {
        $this->db->where('pengumuman_id', $id);
        $this->db->delete('pengumuman');
    }
}
