<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_m extends CI_Model {

  function get_media(){
    $this->db->order_by('nama_media', 'asc');
    return $this->db->get('media')->result();

  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMedia_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Media_m/:application/models/${1/(.+)/lMedia_m.php/}} */
