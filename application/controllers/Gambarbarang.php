<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarbarang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_gambarbarang'));
    $this->load->model(array('m_barang'));
  }

  function index()
  {
    $data = array(
      'title' => 'Foto Barang',
      'gambarbarang' => $this->m_gambarbarang->get_all_data(),
      'isi' => 'gambarbarang/v_index'
    );
    $this->load->view('layout/wrapper_backend', $data, FALSE);
  }

  public function add($id_barang)
  {
    $this->form_validation->set_rules('ket', 'Keterangan Foto', 'trim|required|min_length[5]|max_length[40]',
    array('required' => '%s Harus Di isi')
    );

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path'] = './assets/gambar/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2000';
      $this->upload->initialize($config);
      $field_name = "gambar";
      if (!$this->upload->do_upload($field_name)) {
        $data = array(
          'title' => 'Add Foto Barang',
          'error_upload' => $this->upload->display_errors(),
          'barang' => $this->m_barang->get_data($id_barang),
          'gambarbarang' => $this->m_gambarbarang->get_gambar($id_barang),
          'isi' => 'gambarbarang/v_add'
        );
        $this->load->view('layout/wrapper_backend', $data, FALSE);
      }else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
        $this->load->library('image_lib' , $config);

        $data = array('id_barang' => $id_barang,
                      'ket' => $this->input->post('ket'),
                      'gambar' =>$upload_data['uploads']['file_name']
                      );
        $this->m_gambarbarang->add($data);
        $this->session->set_flashdata('pesan', 'Foto Barang Berhasil di tambahkan');
        redirect('gambarbarang/add/'.$id_barang);
      }
    }
    $data = array(
      'title' => 'Add Foto Barang',
      'barang' => $this->m_barang->get_data($id_barang),
      'gambarbarang' => $this->m_gambarbarang->get_gambar($id_barang),
      'isi' => 'gambarbarang/v_add'
    );
    $this->load->view('layout/wrapper_backend', $data, FALSE);
  }

  public function delete($id_barang, $id_gambar)
  {
    //Hapus gambar
    $gambar = $this->m_gambarbarang->get_data($id_gambar);
    if ($barang->gambar != "") {
      unlink('./assets/gambar/'.$gambar->gambar);
    }
    //end hapus gambar
    $data = array('id_gambar' => $id_gambar);
    $this->m_gambarbarang->delete($data);
    $this->session->set_flashdata('pesan', 'Foto Berhasil di Hapus');
    redirect('gambarbarang/addd/'.$id_barang);
  }

}
