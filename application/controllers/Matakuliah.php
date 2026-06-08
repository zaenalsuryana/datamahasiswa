<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) redirect('auth/login');
        
        $this->load->model('Matakuliah_model');
        $this->load->model('Prodi_model');
        $this->load->model('Fakultas_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        // Ambil filter dari URL
        $prodi_id = $this->input->get('prodi_id');
        $semester = $this->input->get('semester');

        // Build base_url supaya pagination tetap membawa filter
        $base_url = site_url('matakuliah/index');
        $query_params = [];

        if ($prodi_id) $query_params['prodi_id'] = $prodi_id;
        if ($semester) $query_params['semester'] = $semester;

        if (!empty($query_params)) {
            $base_url .= '?' . http_build_query($query_params);
        }

        // Konfigurasi Pagination
        $config['base_url'] = $base_url;
        $config['total_rows'] = $this->Matakuliah_model->count_all($prodi_id, $semester);
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['matakuliah'] = $this->Matakuliah_model->read($limit, $start, $prodi_id, $semester);
        $data['prodi'] = $this->Prodi_model->read_all();
        
        // Kirim data fakultas untuk filter prodi
        $data['fakultas'] = $this->Fakultas_model->read_all();

        // Kirim filter terpilih ke view
        $data['selected_prodi'] = $prodi_id;
        $data['selected_semester'] = $semester;

        $this->load->view('matakuliah/mk_list', $data);
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $this->Matakuliah_model->create();
            $this->session->set_flashdata('msg','<p style="color:green">Mata Kuliah berhasil ditambahkan!</p>');
            redirect('matakuliah');
        }

        $data['prodi'] = $this->Prodi_model->read_all();
        $data['fakultas'] = $this->Fakultas_model->read_all();
        $this->load->view('matakuliah/mk_form', $data);
    }

    public function edit($id)
    {
        if ($this->input->method() === 'post') {
            $this->Matakuliah_model->update($id);
            $this->session->set_flashdata('msg','<p style="color:green">Mata Kuliah berhasil diupdate!</p>');
            redirect('matakuliah');
        }

        $data['mk'] = $this->Matakuliah_model->read_by($id);
        $data['prodi'] = $this->Prodi_model->read_all();
        $data['fakultas'] = $this->Fakultas_model->read_all();
        $this->load->view('matakuliah/mk_form', $data);
    }

    public function delete($id)
    {
        $this->Matakuliah_model->delete($id);
        $this->session->set_flashdata('msg','<p style="color:green">Mata Kuliah berhasil dihapus!</p>');
        redirect('matakuliah');
    }
}
