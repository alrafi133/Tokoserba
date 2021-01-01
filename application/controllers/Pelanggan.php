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
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_pelanggan.email]', 'trim|required|min_length[5]|max_length[40]',
    array('required' => '%s Harus Di isi',
          'is_unique' => '%s Email Sudah Terdaftar')
    );
    $this->form_validation->set_rules('password', 'Password', 'required', 'trim|required|min_length[5]|max_length[40]',
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
        'email' => htmlspecialchars($this->input->post('email')),
        'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'foto' => 'User.png',
        'role_id' => 2
      );
      $this->m_pelanggan->register($data);
      $this->session->set_flashdata('pesan', 'Selamat Register Anda Berhasil, Silahkan Login Kembali');
      redirect('pelanggan/register');
    }
  }

  public function login()
  {
    $this->form_validation->set_rules('email', 'Email','required',  array(
      'required' => '%s Harus Di isi'
    ));
    $this->form_validation->set_rules('password', 'Password', 'required', array(
      'required' => '%s Harus Di isi'
    ));

    if ($this->form_validation->run() == TRUE) {
      $email = htmlspecialchars($this->input->post('email'));
      $password = $this->input->post('password');
      $this->pelanggan_login->login($email, $password);
      // $auth = $this->m_pelanggan->cek_login();
      $this->_login();
    }

    $data = array(
      'title' => 'Login Pelanggan',
      'isi' => 'login_pelanggan'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('tbl_pelanggan',['email'=>$email])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $data = [
          'email' => $user['email'],
          'role_id' => $user['role_id'],
          'nama_pelanggan' => $user['nama_pelanggan'],
          'foto' => $user['foto']
        ];
        $this->session->set_userdata($data);
        redirect('home');
      }else {
        $this->session->set_flashdata('error', 'Password Anda Salah');
        redirect('pelanggan/login');
      }

    }else {
      $this->session->set_flashdata('error', 'Email Tidak Terdaftar');
      redirect('pelanggan/login');
    }
  }

  public function logout()
  {
    $this->pelanggan_login->logout();
  }

}
