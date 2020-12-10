<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_pelanggan'));
    $this->load->model(array('m_auth'));
  }

  function register()
  {
    $this->form_validation->set_rules('nama_pelanggan', 'Nama Anda', 'required',
    array('required' => '%s Harus Di isi')
    );
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_pelanggan.email]',
    array('required' => '%s Harus Di isi',
          'is_unique' => '%s Email Sudah Terdaftar')
    );
    $this->form_validation->set_rules('password', 'Password', 'required',
    array('required' => '%s Harus Di isi')
    );
    $this->form_validation->set_rules('ulangi_password', 'Ulangi Passowrd', 'required|matches[password]',
    array('required' => '%s Harus Di isi',
          'matches' => '%s Password Tidak Sama')
    );

    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Register Pelanggan',
        'isi' => 'register'
      );
        $this->load->view('layout/wrapper_frontend', $data, FALSE);
    }else {
      $data = array(
        'nama_pelanggan' => $this->input->post('nama_pelanggan'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password')
      );
      $this->m_pelanggan->register($data);
      $this->session->set_flashdata('pesan', 'Selamat Register Anda Berhasil, Silahkan Login Kembali');
      redirect('pelanggan/register');
    }
  }

  public function login()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[40]', array(
      'required' => '%s Harus Di isi'
    ));
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]', array(
      'required' => '%s Harus Di isi'
    ));

    if ($this->form_validation->run() == TRUE) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $this->pelanggan_login->login($email, $password);
    }

    $data = array(
      'title' => 'Login Pelanggan',
      'isi' => 'login_pelanggan'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

  public function logout()
  {
    $this->pelanggan_login->logout();
  }

  public function akun()
  {
    //Proteksi Halaman
    $this->pelanggan_login->proteksi_halaman();

    $data = array(
      'title' => 'Akun Saya',
      'isi' => 'akun'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

}
