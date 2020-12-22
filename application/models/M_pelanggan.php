<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function register($data)
  {
    $this->db->insert('tbl_pelanggan', $data);
  }

  public function cekData($where = null)
  {
    return $this->db->get_where('tbl_pelanggan', $where);
  }

}
