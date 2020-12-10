<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_user'));
  }

  function index()
  {
    $data = array(
      'title' => 'User',
      'user' => $this->m_user->get_all_data(),
      'isi' => 'user'
    );
    $this->load->view('layout/wrapper_backend', $data, FALSE);
  }

  public function add()
  {
    $data = array(
      'nama_user' => $this->input->post('nama_user'),
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'level_user' => $this->input->post('level_user')
    );
    $this->m_user->add($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil di tambahkan');
    redirect('user');
  }

  public function edit($id_user)
  {
    $data = array(
      'id_user' => $id_user,
      'nama_user' => $this->input->post('nama_user'),
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'level_user' => $this->input->post('level_user')
    );
    $this->m_user->edit($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil di Edit');
    redirect('user');
  }

  public function delete($id_user)
  {
    $data = array('id_user' => $id_user);
    $this->m_user->delete($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
    redirect('user');
  }

}
