<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth/login');
        }
        $this->load->model('Users_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $usertype = $this->session->userdata('usertype');
        $user_id  = $this->session->userdata('user_id');

        if ($usertype == 'admin') {
            $data['profil'] = $this->Users_model->get_by_userid($user_id);
            $data['role'] = 'admin';
        } elseif ($usertype == 'mahasiswa') {
            $data['profil'] = $this->Mahasiswa_model->get_by_user($user_id);
            $data['role'] = 'mahasiswa';
        } elseif ($usertype == 'dosen') {
            $data['profil'] = $this->Dosen_model->get_by_user($user_id);
            $data['role'] = 'dosen';
        }

        $this->load->view('profile/profile_view', $data);
    }
}
