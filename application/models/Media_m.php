<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_m extends CI_Model {

  function get_media(){
    $this->db->order_by('nama_media', 'asc');
    return $this->db->get('media')->result();

  }

  function get_media_byid($id){
    $this->db->where('id_media', $id);
    return $this->db->get('media',1);
  }

  public function get_media_title($tgl_awal=null,$tgl_akhir=null){
    $this->db->select('*,count(isi_berita.id_media) as jml');
    $this->db->from('isi_berita,media');
    $this->db->where('isi_berita.id_media = media.id_media');
    if($tgl_awal && $tgl_akhir){
      $this->db->where('tgl_berita >=', $tgl_awal);
      $this->db->where('tgl_berita <=', $tgl_akhir);
    }
    $this->db->group_by('isi_berita.id_media');
    $this->db->order_by('jml','desc');
    return $this->db->get();
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMedia_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Media_m/:application/models/${1/(.+)/lMedia_m.php/}} */
