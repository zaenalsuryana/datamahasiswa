<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    // Simpan data mahasiswa baru
    public function create()
    {
        $data = [
            'user_id'   => $this->input->post('user_id', TRUE),
            'prodi_id'  => $this->input->post('prodi_id', TRUE),
            'nama'      => $this->input->post('nama', TRUE),
            'npm'       => $this->input->post('npm', TRUE),
            'kelas'     => $this->input->post('kelas', TRUE),
            'semester'  => $this->input->post('semester', TRUE),
            'angkatan'  => $this->input->post('angkatan', TRUE),
            'alamat'    => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'telepon'   => $this->input->post('telepon', TRUE),
            'status'    => 'aktif'
        ];
        $this->db->insert('mahasiswa', $data);
    }

    // Ambil semua data mahasiswa (digunakan untuk admin/tabel daftar)
    public function read_all()
    {
        $this->db->select('m.*, p.nama_prodi AS prodi, f.nama_fakultas AS fakultas, u.username');
        $this->db->from('mahasiswa m');
        $this->db->join('prodi p', 'p.prodi_id = m.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->join('users u', 'u.user_id = m.user_id', 'left');
        return $this->db->get()->result();
    }

    // Ambil satu data mahasiswa berdasarkan ID mahasiswa
    public function read_by($id)
    {
        $this->db->select('m.*, p.nama_prodi AS prodi, f.nama_fakultas AS fakultas, u.username');
        $this->db->from('mahasiswa m');
        $this->db->join('prodi p', 'p.prodi_id = m.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->join('users u', 'u.user_id = m.user_id', 'left');
        $this->db->where('m.mhs_id', $id);
        return $this->db->get()->row();
    }

    // Ambil data mahasiswa berdasarkan user_id (paling direkomendasikan untuk profil login)
    public function get_by_user($user_id)
    {
        $this->db->select('m.*, p.nama_prodi AS prodi, f.nama_fakultas AS fakultas, u.username');
        $this->db->from('mahasiswa m');
        $this->db->join('users u', 'u.user_id = m.user_id', 'left');
        $this->db->join('prodi p', 'p.prodi_id = m.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->where('m.user_id', $user_id);
        return $this->db->get()->row();
    }

    // Alternatif: Ambil data berdasarkan username (opsional jika user_id tidak tersedia)
    public function get_by_username($username)
    {
        $this->db->select('m.*, p.nama_prodi AS prodi, f.nama_fakultas AS fakultas, u.username');
        $this->db->from('mahasiswa m');
        $this->db->join('users u', 'u.user_id = m.user_id', 'left');
        $this->db->join('prodi p', 'p.prodi_id = m.prodi_id', 'left');
        $this->db->join('fakultas f', 'f.fakultas_id = p.fakultas_id', 'left');
        $this->db->where('u.username', $username);
        return $this->db->get()->row();
    }

    // Update data mahasiswa
    public function update($id)
    {
        $data = [
            'prodi_id'  => $this->input->post('prodi_id', TRUE),
            'nama'      => $this->input->post('nama', TRUE),
            'npm'       => $this->input->post('npm', TRUE),
            'kelas'     => $this->input->post('kelas', TRUE),
            'semester'  => $this->input->post('semester', TRUE),
            'angkatan'  => $this->input->post('angkatan', TRUE),
            'alamat'    => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'telepon'   => $this->input->post('telepon', TRUE),
            'status'    => $this->input->post('status', TRUE)
        ];

        // Jika user_id dikirim dari form, update juga
        if ($this->input->post('user_id')) {
            $data['user_id'] = $this->input->post('user_id', TRUE);
        }

        $this->db->where('mhs_id', $id);
        $this->db->update('mahasiswa', $data);
    }

    // Hapus data mahasiswa
    public function delete($id)
    {
        $this->db->where('mhs_id', $id);
        $this->db->delete('mahasiswa');
    }
}
