<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_m extends CI_Model {

  function get_netral_today(){
    if(date('H:i') < "02:30"){
      $this->db->where('tgl_post >=',date('Y-m-d H:i',strtotime("yesterday 17:00")));
      //$this->db->where('tgl_berita',date('Y-m-d'));
    }else{
      $this->db->where('tgl_berita',date('Y-m-d'));
    }
    $this->db->where('tone_berita','0');
    return $this->db->get('isi_berita');
  }

  function get_positif_today(){

    if(date('H:i') < "02:30"){
      $this->db->where('tgl_post >=',date('Y-m-d H:i',strtotime("yesterday 17:00")));
      //$this->db->where('tgl_berita',date('Y-m-d'));
    }else{
      $this->db->where('tgl_berita',date('Y-m-d'));
    }
    $this->db->where('tone_berita','1');
    return $this->db->get('isi_berita');
  }

  function get_negatif_today(){

    if(date('H:i') < "02:30"){
      $this->db->where('tgl_post >=',date('Y-m-d H:i',strtotime("yesterday 17:00")));
      //$this->db->where('tgl_berita',date('Y-m-d'));
    }else{
      $this->db->where('tgl_berita',date('Y-m-d'));
    }
    $this->db->where('tone_berita','-1');
    return $this->db->get('isi_berita');
  }
  function get_berita_hari_ini(){
    if(date('H:i') < "02:30"){
     		$this->db->where('tgl_post >=',date('Y-m-d H:i',strtotime("yesterday 17:00")));
     		//$this->db->where('tgl_berita',date('Y-m-d'));
     		}else{
     		$this->db->where('tgl_berita',date('Y-m-d'));
     		}
    $this->db->order_by('tgl_post', 'desc');
    return $this->db->get('isi_berita');
  }

  function get_trending_today(){
    $this->db->select('nama_sub_topik,sub_topik.id_topik as id_topik,isi_berita.id_sub_topik as id_sub,count(isi_berita.id_sub_topik) as total');
		$this->db->from('isi_berita,sub_topik');
		// $this->db->where('tgl_berita',date('Y-m-d'));
		$this->db->where('isi_berita.id_sub_topik=sub_topik.id_sub_topik');
    if(date('H:i') < "02:30"){
     		$this->db->where('tgl_post >=',date('Y-m-d H:i',strtotime("yesterday 17:00")));
     		//$this->db->where('tgl_berita',date('Y-m-d'));
     		}else{
     		$this->db->where('tgl_berita',date('Y-m-d'));
     		}
		$this->db->group_by('isi_berita.id_sub_topik');
		$this->db->order_by('total', 'desc');
		return $this->db->get();
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lDashboard_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Dashboard_m/:application/models/${1/(.+)/lDashboard_m.php/}} */
