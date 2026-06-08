<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) redirect('auth/login');
        $this->load->model('Fakultas_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('fakultas/index');
        $config['total_rows'] = $this->db->count_all('fakultas');
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['fakultas'] = $this->Fakultas_model->read($limit, $start);
        $this->load->view('fakultas/fakultas_list', $data);
    }

    public function add()
    {
        if($this->input->post('submit')) {
            $this->Fakultas_model->create();
            $this->session->set_flashdata('msg', '<p style="color:green">Data fakultas berhasil ditambahkan!</p>');
            redirect('fakultas');
        }
        $this->load->view('fakultas/fakultas_form');
    }

    public function edit($id)
    {
        if($this->input->post('submit')) {
            $this->Fakultas_model->update($id);
            $this->session->set_flashdata('msg', '<p style="color:green">Data fakultas berhasil diupdate!</p>');
            redirect('fakultas');
        }
        $data['fakultas'] = $this->Fakultas_model->read_by($id);
        $this->load->view('fakultas/fakultas_form', $data);
    }

    public function delete($id)
    {
        $this->Fakultas_model->delete($id);
        $this->session->set_flashdata('msg', '<p style="color:green">Data fakultas berhasil dihapus!</p>');
        redirect('fakultas');
    }
}
