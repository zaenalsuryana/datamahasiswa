<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) redirect('auth/login');
        $this->load->model('Prodi_model');
        $this->load->model('Fakultas_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('prodi/index');
        $config['total_rows'] = $this->db->count_all('prodi');
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['prodi'] = $this->Prodi_model->read($limit, $start);
        $this->load->view('prodi/prodi_list', $data);
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $this->Prodi_model->create();
            $this->session->set_flashdata('msg', 'Data Prodi berhasil ditambahkan!');
            redirect('prodi');
        }
        $data['fakultas'] = $this->Fakultas_model->read_all();
        $this->load->view('prodi/prodi_form', $data);
    }

    public function edit($id)
    {
       if ($this->input->method() === 'post') {
            $this->Prodi_model->update($id);
            $this->session->set_flashdata('msg', 'Data Prodi berhasil diupdate!');
            redirect('prodi');
        }
        $data['prodi'] = $this->Prodi_model->read_by($id);
        $data['fakultas'] = $this->Fakultas_model->read_all();
        $this->load->view('prodi/prodi_form', $data);
    }

    public function delete($id)
    {
        $this->Prodi_model->delete($id);
        $this->session->set_flashdata('msg', 'Data Prodi berhasil dihapus!');
        redirect('prodi');
    }
}
