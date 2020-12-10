<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login {

  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
    $this->ci->load->model(array('m_auth'));
  }

  public function login($username, $password)
  {
    $cek = $this->ci->m_auth->login_user($username, $password);

    if ($cek) {
      $nama_user = $cek->nama_user;
      $username = $cek->username;
      $level_user = $cek->level_user;
      //Session Baru
      $this->ci->session->set_userdata('username', $username);
      $this->ci->session->set_userdata('nama_user', $nama_user);
      $this->ci->session->set_userdata('level_user', $level_user);
      redirect('admin');
    }else {
      //Jika Salah
      $this->ci->session->set_flashdata('error', 'Username Atau Password Salah');
      redirect('auth/login_user');
    }
  }

  public function proteksi_halaman()
  {
    if ($this->ci->session->userdata('username') == '') {
      $this->ci->session->set_flashdata('error', 'Anda Harus Login Dahulu');
      redirect('auth/login_user');
    }
  }

  public function logout()
  {
    $this->ci->session->unset_userdata('username');
    $this->ci->session->unset_userdata('nama_user');
    $this->ci->session->unset_userdata('level_user');
    $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout');
    redirect('auth/login_user');
  }

}
