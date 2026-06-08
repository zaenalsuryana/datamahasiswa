<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function getuser($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

    public function changepass()
    {
        $this->db->set('password', password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT));
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->update('users');
    }

    public function changephoto($photo)
    {
        $old = $this->session->userdata('photo');
        if ($old && $old != 'default.png')
            unlink('./uploads/users/' . $old);

        $this->db->set('photo', $photo);
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->update('users');
    }
}
