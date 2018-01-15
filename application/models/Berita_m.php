<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_m extends CI_Model {


  function get_topik(){
    return $this->db->get('topik')->result();
  }

  function get_sub_topik(){
    $this->db->select('id_sub_topik,nama_sub_topik');
    $this->db->order_by('nama_sub_topik', 'asc');
    return $this->db->get('sub_topik')->result();
  }

  function get_topik_where($id_topik=null,$id_sub_topik=null){
    $this->db->from('topik,sub_topik');
    $this->db->where('topik.id_topik = sub_topik.id_topik');
    if($id_topik!=null) $this->db->where('id_topik',$id_topik);
    if($id_sub_topik!=null) $this->db->where('id_sub_topik',$id_sub_topik);
    return $this->db->get()->result();
  }

  function get_isi_berita_bytopik($id_topik){
    $this->db->from('isi_berita,topik,sub_topik,media,narasumber');
    $this->db->where('isi_berita.id_topik = topik.id_topik');
    $this->db->where('isi_berita.id_sub_topik = sub_topik.id_sub_topik');
    $this->db->where('isi_berita.id_media = media.id_media');
    $this->db->where('isi_berita.id_narasumber = narasumber.id_narasumber');
    $this->db->where('isi_berita.id_topik',$id_topik);
    return $this->db->get()->result();
  }

  function get_last_isi_berita(){
    $this->db->select('id_isi_berita');
    $this->db->order_by('id_isi_berita','desc');
    return $this->db->get('isi_berita',1);
  }

  function insert_berita($data){
    return $this->db->insert('isi_berita',$data);
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lBerita_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Berita_m/:application/models/${1/(.+)/lBerita_m.php/}} */
