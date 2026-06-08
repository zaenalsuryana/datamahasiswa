<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function create()
    {
        $data = array(
            'username'  => $this->input->post('username'),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'      => $this->input->post('role'),
            'fullname'  => $this->input->post('fullname')
        );
        $this->db->insert('users', $data);
    }

    public function read($limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get('users')->result();
    }

    public function read_by($id)
    {
        return $this->db->get_where('users', ['user_id' => $id])->row();
    }

    // ✅ Untuk dropdown pilihan user yang belum menjadi mahasiswa
    public function read_mahasiswa_only()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('role', 'mahasiswa');
        $this->db->where('user_id NOT IN (SELECT user_id FROM mahasiswa)', NULL, FALSE);
        return $this->db->get()->result();
    }

    // ✅ Untuk dropdown pilihan user yang belum menjadi dosen
    public function read_dosen_only()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('role', 'dosen');
        $this->db->where('user_id NOT IN (SELECT user_id FROM dosen)', NULL, FALSE);
        return $this->db->get()->result();
    }
    public function get_by_userid($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('users')->row();
    }
    
    public function read_dosen_only_or_selected($selected_user_id = null)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('role', 'dosen');

        if ($selected_user_id) {
            $this->db->where("(user_id NOT IN (SELECT user_id FROM dosen WHERE user_id != $selected_user_id) OR user_id = $selected_user_id)", null, false);
        } else {
            $this->db->where("user_id NOT IN (SELECT user_id FROM dosen)", null, false);
        }

        return $this->db->get()->result();
    }



    public function update($id)
    {
        $data = array(
            'username'  => $this->input->post('username'),
            'role'      => $this->input->post('role'),
            'fullname'  => $this->input->post('fullname')
        );

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
    }

    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }
}
