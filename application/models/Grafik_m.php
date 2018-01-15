<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_m extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_sub_topik($tgl_awal=null,$tgl_akhir=null){
    $this->db->select('*,count(isi_berita.id_sub_topik) as jml');
    $this->db->from('isi_berita,sub_topik');
    $this->db->where('isi_berita.id_sub_topik = sub_topik.id_sub_topik');
    if($tgl_awal && $tgl_akhir){
      $this->db->where('tgl_berita >=', $tgl_awal);
      $this->db->where('tgl_berita <=', $tgl_akhir);
    }
    $this->db->group_by('isi_berita.id_sub_topik');
    $this->db->order_by('jml','desc');
    return $this->db->get();
  }

  public function get_topik($tgl_awal=null,$tgl_akhir=null){
    $this->db->select('*,count(isi_berita.id_topik) as jml');
    $this->db->from('isi_berita,topik');
    $this->db->where('isi_berita.id_topik = topik.id_topik');
    if($tgl_awal && $tgl_akhir){
      $this->db->where('tgl_berita >=', $tgl_awal);
      $this->db->where('tgl_berita <=', $tgl_akhir);
    }
    $this->db->group_by('isi_berita.id_topik');
    $this->db->order_by('jml','desc');
    return $this->db->get();
  }

  public function get_media($tgl_awal=null,$tgl_akhir=null){
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

  public function get_narasumber($tgl_awal=null,$tgl_akhir=null){
    $this->db->select('*,count(isi_berita.id_narasumber) as jml');
    $this->db->from('isi_berita,narasumber');
    $this->db->where('isi_berita.id_narasumber = narasumber.id_narasumber');
    if($tgl_awal && $tgl_akhir){
      $this->db->where('tgl_berita >=', $tgl_awal);
      $this->db->where('tgl_berita <=', $tgl_akhir);
    }
    $this->db->group_by('isi_berita.id_narasumber');
    $this->db->order_by('jml','desc');
    return $this->db->get();
  }



}
