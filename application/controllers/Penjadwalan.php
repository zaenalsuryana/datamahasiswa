<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjadwalan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) redirect('auth/login');

        $this->load->model('Jadwal_model');
        $this->load->model('Pengampu_model');
        $this->load->model('Prodi_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('penjadwalan/index');
        $config['total_rows'] = $this->db->count_all('penjadwalan');
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $limit = $config['per_page'];
        $start = $this->uri->segment(3) ?? 0;

        $data['i'] = $start + 1;
        $data['jadwal'] = $this->Jadwal_model->read($limit, $start);

        $this->load->view('penjadwalan/jadwal_list', $data);
    }

    // AJAX: Ambil pengampu berdasarkan filter tahun ajaran, semester, prodi
    public function get_pengampu()
    {
        $tahun_ajaran = $this->input->post('tahun_ajaran', TRUE);
        $semester = $this->input->post('semester', TRUE);
        $prodi_id = $this->input->post('prodi_id', TRUE);


        $result = $this->Pengampu_model->filter_pengampu($tahun_ajaran, $semester, $prodi_id);

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'pengampu_id' => $row->pengampu_id,
                'nama_mk'     => $row->nama_mk,
                'nama_dosen'  => $row->nama_dosen
            ];
        }

        echo json_encode($data);
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $this->Jadwal_model->create();
            $this->session->set_flashdata('msg', '<p style="color:green">Jadwal berhasil ditambahkan!</p>');
            redirect('penjadwalan');
        }

        $data['prodi'] = $this->Prodi_model->read_all();
        $this->load->view('penjadwalan/jadwal_form', $data);
    }

    public function edit($id)
    {
        if ($this->input->method() === 'post') {
            $this->Jadwal_model->update($id);
            $this->session->set_flashdata('msg', '<p style="color:green">Jadwal berhasil diupdate!</p>');
            redirect('penjadwalan');
        }

        $data['prodi'] = $this->Prodi_model->read_all();
        $data['pengampu'] = $this->Pengampu_model->get_all_pengampu();
        $data['jadwal'] = $this->Jadwal_model->get_detail($id);

        if (!$data['jadwal']) {
            show_404();
        }

        $this->load->view('penjadwalan/jadwal_form', $data);
    }

    public function delete($id)
    {
        $this->Jadwal_model->delete($id);
        $this->session->set_flashdata('msg', '<p style="color:green">Jadwal berhasil dihapus!</p>');
        redirect('penjadwalan');
    }
}
