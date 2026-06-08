<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('usertype') != 'admin') redirect('welcome');
        $this->load->model('Users_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('users/index');
        $config['total_rows'] = $this->db->count_all('users');
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['users'] = $this->Users_model->read($limit, $start);
        $this->load->view('users/user_list', $data);
    }

 public function add()
{
    if ($this->input->post('submit')) {
        $this->Users_model->create();
        $user_id = $this->db->insert_id();

        if ($this->db->affected_rows() > 0) {
            $role = $this->input->post('role', TRUE);

            $this->session->set_flashdata('msg', '<p style="color:green">User berhasil ditambahkan!</p>');

            if ($role == 'dosen') {
                redirect('dosen/add?user_id=' . $user_id);
            } elseif ($role == 'mahasiswa') {
                redirect('mahasiswa/add?user_id=' . $user_id);
            } else {
                redirect('users');
            }
        } else {
            $this->session->set_flashdata('msg', '<p style="color:red">User gagal ditambahkan!</p>');
            redirect('users');
        }
    }
    $this->load->view('users/user_form');
}





    public function edit($id)
    {
        if($this->input->post('submit')) {
            $this->Users_model->update($id);
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('msg','<p style="color:green">User berhasil diupdate!</p>');
            } else {
                $this->session->set_flashdata('msg','<p style="color:red">User gagal diupdate!</p>');
            }
            redirect('users');
        }
        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users/user_form', $data);
    }

    public function delete($id)
    {
        $this->Users_model->delete($id);
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg','<p style="color:green">User berhasil dihapus!</p>');
        } else {
            $this->session->set_flashdata('msg','<p style="color:red">User gagal dihapus!</p>');
        }
        redirect('users');
    }
}
