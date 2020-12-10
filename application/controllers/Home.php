<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_home'));
  }

  function index()
  {
    $data = array(
      'title' => 'Home',
      'barang' => $this->m_home->get_all_data(),
      'isi' => 'home'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

  public function kategori($id_kategori)
  {
    $kategori = $this->m_home->kategori($id_kategori);
    $data = array(
      'title' => 'Kategori Barang : '.$kategori->nama_kategori,
      'barang' => $this->m_home->get_all_data_barang($id_kategori),
      'isi' => 'kategori_barang'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

  public function detail_barang($id_barang)
  {
    $data = array(
      'title' => 'Detail Barang',
      'gambar' => $this->m_home->gambar_barang($id_barang),
      'barang' => $this->m_home->detail_barang($id_barang),
      'isi' => 'detail_barang'
    );
    $this->load->view('layout/wrapper_frontend', $data, FALSE);
  }

}
