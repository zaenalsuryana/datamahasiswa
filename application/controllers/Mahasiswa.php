<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('username')) redirect('auth/login');

        $this->load->model('Mahasiswa_model');
        $this->load->model('Prodi_model');
        $this->load->model('Users_model'); 
    }

    public function index()
    {
        $data['mahasiswa'] = $this->Mahasiswa_model->read_all();
        $this->load->view('mahasiswa/mahasiswa_list', $data);
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            
            $user_id = $this->input->post('user_id');

            // Cek user ada atau tidak
            $user = $this->Users_model->read_by($user_id);
            if (!$user) {
                $this->session->set_flashdata('msg', '<p style="color:red">User tidak ditemukan!</p>');
                redirect('mahasiswa/add');
            }

            // Cek apakah user sudah dipakai sebagai mahasiswa
            if ($this->Mahasiswa_model->get_by_user($user_id)) {
                $this->session->set_flashdata('msg', '<p style="color:red">User ini sudah terdaftar sebagai mahasiswa!</p>');
                redirect('mahasiswa/add');
            }

            // Data mahasiswa baru otomatis status aktif
            $this->Mahasiswa_model->create([
                'user_id'   => $user_id,
                'prodi_id'  => $this->input->post('prodi_id'),
                'nama'      => $this->input->post('nama'),
                'npm'       => $this->input->post('npm'),
                'kelas'     => $this->input->post('kelas'),
                'angkatan'  => $this->input->post('angkatan'),
                'semester'  => $this->input->post('semester'),
                'alamat'    => $this->input->post('alamat'),
                'status'    => 'aktif'
            ]);

            $this->session->set_flashdata('msg', '<p style="color:green">Data mahasiswa berhasil ditambahkan!</p>');
            redirect('mahasiswa');
        }

        $data['users'] = $this->Users_model->read_mahasiswa_only();
        $data['prodi'] = $this->Prodi_model->read_all();
        
        $this->load->view('mahasiswa/mahasiswa_form', $data);
    }

    public function edit($id)
    {
        $data['mhs'] = $this->Mahasiswa_model->read_by($id);

        if (!$data['mhs']) show_404();

        if ($this->input->method() === 'post') {
            $this->Mahasiswa_model->update($id, [
                'user_id'   => $this->input->post('user_id'),
                'prodi_id'  => $this->input->post('prodi_id'),
                'nama'      => $this->input->post('nama'),
                'npm'       => $this->input->post('npm'),
                'kelas'     => $this->input->post('kelas'),
                'angkatan'  => $this->input->post('angkatan'),
                'semester'  => $this->input->post('semester'),
                'alamat'    => $this->input->post('alamat'),
                'status'    => $this->input->post('status')
            ]);
            
            $this->session->set_flashdata('msg', '<p style="color:green">Data mahasiswa berhasil diperbarui!</p>');
            redirect('mahasiswa');
        }

        $data['users'] = $this->Users_model->read_mahasiswa_only();
        $data['prodi'] = $this->Prodi_model->read_all();

        $this->load->view('mahasiswa/mahasiswa_form', $data);
    }

    public function delete($id)
    {
        $this->Mahasiswa_model->delete($id);
        $this->session->set_flashdata('msg', '<p style="color:green">Data mahasiswa berhasil dihapus!</p>');
        redirect('mahasiswa');
    }
}
