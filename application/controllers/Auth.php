<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function login()
{
    if ($this->input->post('login') && $this->validation('login')) {
        $login = $this->Auth_model->getuser($this->input->post('username'));

        if ($login != NULL) {
            if (password_verify($this->input->post('password'), $login->password)) {

                $data = [
                    'user_id'  => $login->user_id,
                    'username' => $login->username,
                    'usertype' => $login->role,
                    'fullname' => $login->fullname,
                    'photo'    => $login->photo ?? 'default.png'
                ];

                
                if ($login->role == 'mahasiswa') {
                    $this->load->model('Mahasiswa_model');
                    $mahasiswa = $this->Mahasiswa_model->get_by_user($login->user_id);
                    if ($mahasiswa) {
                        $data['mhs_id'] = $mahasiswa->mhs_id;
                    }
                }

                
                if ($login->role == 'dosen') {
                    $this->load->model('Dosen_model');
                    $dosen = $this->Dosen_model->get_by_user($login->user_id);
                    if ($dosen) {
                        $data['dosen_id'] = $dosen->dosen_id;
                    }
                }

                $this->session->set_userdata($data);
                redirect('welcome');
            }
        }

        $this->session->set_flashdata('msg', '<p style="color:red">Invalid Username or Password</p>');
    }
    
    $this->load->view('auth/form_login');
}



    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function changepass()
    {
        if (!$this->session->userdata('username')) redirect('auth/login');
        if ($this->input->post('change') && $this->validation('change')) {
            $user = $this->Auth_model->getuser($this->session->userdata('username'));
            if (password_verify($this->input->post('oldpassword'), $user->password)) {
                if ($this->Auth_model->changepass())
                    $this->session->set_flashdata('msg', '<p style="color:green">Password successfully changed!</p>');
                else
                    $this->session->set_flashdata('msg', '<p style="color:red">Change password failed!</p>');
            } else {
                $this->session->set_flashdata('msg', '<p style="color:red">Wrong old password!</p>');
            }
        }
        $this->load->view('auth/change_password');
    }

    public function changephoto()
    {
        if (!$this->session->userdata('username')) redirect('auth/login');
        $data['error'] = "";
        if ($this->input->post('upload')) {
            if ($this->upload()) {
                $filename = $this->upload->data('file_name');
                $this->Auth_model->changephoto($filename);
                $this->session->set_userdata('photo', $filename);
                $this->session->set_flashdata('msg', '<p style="color:green">Photo Successfully Changed!</p>');
            } else {
                $data['error'] = $this->upload->display_errors();
            }
        }
        $this->load->view('auth/form_photo', $data);
    }

    private function upload()
    {
        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;

        $this->load->library('upload', $config);
        return $this->upload->do_upload('photo');
    }

    private function validation($type)
    {
        $this->load->library('form_validation');
        if ($type == 'login') {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
        } else {
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        }
        return $this->form_validation->run();
    }
}
