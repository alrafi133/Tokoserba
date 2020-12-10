<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function login_user()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[40]', array(
      'required' => '%s Harus Di isi'
    ));
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]', array(
      'required' => '%s Harus Di isi'
    ));

    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $this->user_login->login($username, $password);
    }
    $data = array(
      'title' => 'Login'
    );
    $this->load->view('login_user', $data, FALSE);
  }

  public function logout_user()
  {
    $this->user_login->logout();
  }

}
