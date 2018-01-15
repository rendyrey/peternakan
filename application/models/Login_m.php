<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_m extends CI_Model {

  function check_user($user,$pass){
    $this->db->where('username', $user);
    $this->db->where('password', $pass);
    $query=$this->db->get('admin');

		if($query->num_rows()>0){
			return TRUE;
		}
		else{
			return FALSE;
		}
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lLogin_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Login_m/:application/models/${1/(.+)/lLogin_m.php/}} */
