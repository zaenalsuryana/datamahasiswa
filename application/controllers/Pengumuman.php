<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Cek apakah user sudah login
        if (!$this->session->userdata('username')) {
            redirect('auth/login');
        }

        $this->load->model('Pengumuman_model');
        $this->load->helper('text'); // Agar fungsi word_limiter tidak error
    }

    public function index()
    {
        $this->load->library('pagination');

        // Konfigurasi pagination
        $config['base_url'] = site_url('pengumuman/index');
        $config['total_rows'] = $this->db->count_all('pengumuman');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['i'] = $start + 1;
        $data['pengumuman'] = $this->Pengumuman_model->read($config['per_page'], $start);

        $this->load->view('pengumuman/pengumuman_list', $data);
    }

    public function add()
    {
        // Hanya admin yang boleh menambahkan
        if ($this->session->userdata('usertype') !== 'admin') {
            show_error('Akses ditolak. Hanya admin yang dapat menambahkan pengumuman.', 403);
        }

        if ($this->input->post('submit')) {
            $this->Pengumuman_model->create();
            $this->session->set_flashdata('msg', htmlspecialchars('Pengumuman berhasil ditambahkan!'));
            redirect('pengumuman');
        }

        $this->load->view('pengumuman/pengumuman_form');
    }

    public function edit($id = null)
    {
        // Hanya admin yang boleh mengedit
        if ($this->session->userdata('usertype') !== 'admin') {
            show_error('Akses ditolak. Hanya admin yang dapat mengedit pengumuman.', 403);
        }

        if (!$id || !$this->Pengumuman_model->read_by($id)) {
            show_404();
        }

        if ($this->input->post('submit')) {
            $this->Pengumuman_model->update($id);
            $this->session->set_flashdata('msg', htmlspecialchars('Pengumuman berhasil diupdate!'));
            redirect('pengumuman');
        }

        $data['pengumuman'] = $this->Pengumuman_model->read_by($id);
        $this->load->view('pengumuman/pengumuman_form', $data);
    }

    public function delete($id = null)
    {
        // Hanya admin yang boleh menghapus
        if ($this->session->userdata('usertype') !== 'admin') {
            show_error('Akses ditolak. Hanya admin yang dapat menghapus pengumuman.', 403);
        }

        if (!$id || !$this->Pengumuman_model->read_by($id)) {
            show_404();
        }

        $this->Pengumuman_model->delete($id);
        $this->session->set_flashdata('msg', htmlspecialchars('Pengumuman berhasil dihapus!'));
        redirect('pengumuman');
    }
}
