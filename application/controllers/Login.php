<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Login_m');
  }
  public function index()
  {
    if($this->session->userdata('login')){
      redirect('Dashboard');
    }
    $this->load->view('login');
  }

  public function login(){
    if($this->session->userdata('login')){
      redirect('Dashboard');
    }else{
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      if ($this->form_validation->run()) {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('password'));
        if($this->Login_m->check_user($user,$pass)){
          $data=array(
            'username'=>$user,
            'login'=>TRUE,
            'user'=>'administrator'
          );
          $this->session->set_userdata($data);
          redirect('Dashboard');
        }else{
          $this->session->set_flashdata('message', 'Maaf username/password salah');
          $data['message'] = $this->session->flashdata('message');
          $this->load->view('login', $data);
        }
      } else {
        $this->load->view('login');
      }
    }
  }
  public function logout(){
      //$this->session->unset_userdata();
    $this->session->sess_destroy();
    redirect('Login','refresh');
  }

}




/* End of file ${TM_FILENAME:${1/(.+)/lLogin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Login/:application/controllers/${1/(.+)/lLogin.php/}} */
