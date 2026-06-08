<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengampu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) redirect('auth/login');
        $this->load->model('Pengampu_model');
        $this->load->model('Dosen_model');
        $this->load->model('Matakuliah_model');
        $this->load->model('Prodi_model');
    }

    public function index()
    {
        $data['pengampu'] = $this->Pengampu_model->read_all();
        $this->load->view('pengampu/pengampu_list', $data);
    }

    public function get_matkul_dosen()
{
    $prodi_id = $this->input->post('prodi_id');

    $matakuliah = $this->Pengampu_model->get_matkul_by_prodi($prodi_id);
    $dosen = $this->Pengampu_model->get_dosen_by_prodi($prodi_id);

    echo json_encode(['matakuliah' => $matakuliah, 'dosen' => $dosen]);
}


    public function add()
    {
        if($this->input->post('submit')) {
            $this->Pengampu_model->create();
            $this->session->set_flashdata('msg','<p style="color:green">Data Pengampu berhasil ditambahkan!</p>');
            redirect('pengampu');
        }

        $data['dosen'] = $this->Dosen_model->read_all();
        $data['matakuliah'] = $this->Matakuliah_model->read_all();
        $data['prodi'] = $this->Prodi_model->read_all();
        $this->load->view('pengampu/pengampu_form', $data);
        
    }

    public function delete($id)
    {
        $this->Pengampu_model->delete($id);
        $this->session->set_flashdata('msg','<p style="color:green">Data Pengampu berhasil dihapus!</p>');
        redirect('pengampu');
    }
}
