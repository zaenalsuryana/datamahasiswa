<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (! $this->session->userdata('username')) redirect('auth/login');
        
        $this->load->model('Dosen_model');
        $this->load->model('Prodi_model');  // Load model prodi sekali saja di constructor
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('dosen/index');
        $config['total_rows'] = $this->db->count_all('dosen');
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['dosen'] = $this->Dosen_model->read($limit, $start);

        $this->load->view('dosen/dosen_list', $data);
    }

    public function add()
    {
        $this->load->model('Users_model');
        $data['prodi'] = $this->Prodi_model->read_all();
        $data['users'] = $this->Users_model->read_dosen_only();
        $data['dosen'] = null;

        if ($this->input->post('submit')) {
            $user_id = $this->input->post('user_id');

        
            $user = $this->Users_model->read_by($user_id);
            if (!$user || $user->role !== 'dosen') {
                $this->session->set_flashdata('msg', '<p style="color:red">User tidak valid atau bukan dosen!</p>');
                redirect('dosen/add');
            }

            
            if ($this->Dosen_model->get_by_user($user_id)) {
                $this->session->set_flashdata('msg', '<p style="color:red">User ini sudah digunakan oleh dosen lain!</p>');
                redirect('dosen/add');
            }

            $this->Dosen_model->create();
            $this->session->set_flashdata('msg', '<p style="color:green">Dosen berhasil ditambahkan!</p>');
            redirect('dosen');
        }

        $this->load->view('dosen/dosen_form', $data);
    }


    public function edit($id)
    {
        $this->load->model('Users_model');
        $data['dosen'] = $this->Dosen_model->read_by($id);
        $data['prodi'] = $this->Prodi_model->read_all();
        $data['users'] = $this->Users_model->read_dosen_only_or_selected($data['dosen']->user_id);

        if ($this->input->post('submit')) {
            $this->Dosen_model->update($id);
            $this->session->set_flashdata('msg','<p style="color:green"> Dosen berhasil diupdate!</p>');
            redirect('dosen');
        }

        $this->load->view('dosen/dosen_form', $data);
    }

    public function delete($id)
    {
        $this->Dosen_model->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg','<p style="color:green"> Dosen berhasil dihapus!</p>');
        } else {
            $this->session->set_flashdata('msg','<p style="color:red"> Dosen gagal dihapus!</p>');
        }
        redirect('dosen');
    }
}
