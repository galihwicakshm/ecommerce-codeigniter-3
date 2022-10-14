<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');
        $this->load->model('m_auth');
    }

    public function index($offset = 0)
    {
        $data = array(
            'title' => 'User Pelanggan',
            'pelanggan' => $this->m_pelanggan->get_data(),
            'isi' => 'v_akun_saya',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function register()
    {
        $this->form_validation->set_rules(
            'nama_pelanggan',
            'Nama Pelanggan',
            'required',
            array('required' => '%s Harus diisi !')
        );
        $this->form_validation->set_rules(
            'email',
            'E-mail',
            'required|is_unique[tabel_pelanggan.email]',
            array('required' => '%s Harus diisi !', 'is_unique' => '%s ini sudah terdaftar !')
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            array('required' => '%s Harus diisi !')
        );
        $this->form_validation->set_rules(
            'ulangi_password',
            'Password',
            'required|matches[password]',
            array(
                'required' => '%s Harus diisi !',
                'matches' => '%s tidak sama !'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Daftar Akun',
                'isi' => 'v_register_pelanggan_temp',
            );
            $this->load->view('v_register_pelanggan_temp', $data, FALSE);
        } else {
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );
            $this->m_pelanggan->register($data);
            $this->session->set_flashdata('pesan', 'Selamat akun anda berhasil dibuat');
            redirect('pelanggan/register');
        }
    }
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => '%s Harus diisi!'
        ));

        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus diisi!'
        ));


        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email, $password);
        }
        $data = array(
            'title' => 'Login Pelanggan',
            'isi' => 'v_login_pelanggan_temp',
        );
        $this->load->view('v_login_pelanggan_temp', $data);
    }

    public function logout()
    {
        session_destroy();
        $this->pelanggan_login->logout();
    }
}
