<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Narasumber_m extends CI_Model {

  function get_narasumber(){
    $this->db->order_by('nama_narasumber', 'asc');
    return $this->db->get('narasumber')->result();
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lNarasumber_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Narasumber_m/:application/models/${1/(.+)/lNarasumber_m.php/}} */
