<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Berita_m');
    $this->load->model('Media_m');
    $this->load->model('Narasumber_m');
    $this->load->model('Grafik_m');
  }

  function index()
  {
    //untuk menu topik
    $data['topik'] = $this->Berita_m->get_topik();
    $query = $this->Grafik_m->get_sub_topik(date('Y-m-d'),date('Y-m-d'));
    $data['jml_categories'] = $query->num_rows();
    $data['nama_grafik'] = "Grafik Sub Topik";
    $data['nama_sub_grafik'] = "Persebaran Sub Topik Peternakan";
    $data['data_grafik'] = "Sub Topik";
    foreach($query->result() as $row){
      $data['categories'][] = $row->nama_sub_topik;
      $data['jml'][] = $row->jml;
    }

    $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
    $this->form_validation->set_rules('data_grafik', 'Grafik', 'required');
    if ($this->form_validation->run()) {
      // echo "hi"
      $data['jml_categories'] = 0;
      $tgl = $this->input->post('tgl');
      $nama_grafik = $this->input->post('data_grafik');
      $tgl_awal = date('Y-m-d',strtotime(substr($tgl,0,10)));
      $tgl_akhir = date('Y-m-d',strtotime(substr($tgl,-10)));
      // echo $tgl_awal."-".$tgl_akhir;
      if($nama_grafik == "sub_topik"){
        $query = $this->Grafik_m->get_sub_topik($tgl_awal,$tgl_akhir);
        $data['jml_categories'] = $query->num_rows();
        $data['nama_grafik'] = "Grafik Sub Topik";
        $data['nama_sub_grafik'] = "Persebaran Sub Topik Peternakan";
        $data['data_grafik'] = "Sub Topik";
        $i=0;
        foreach($query->result() as $row){
          $data['categories'][$i] = $row->alias;
          $data['jml'][$i] = $row->jml;
          $i++;
        }
      }else if($nama_grafik == "topik"){
        $query = $this->Grafik_m->get_topik($tgl_awal,$tgl_akhir);
        $data['jml_categories'] = $query->num_rows();
        $data['nama_grafik'] = "Grafik Topik";
        $data['nama_sub_grafik'] = "Persebaran Topik Peternakan";
        $data['data_grafik'] = "Topik";
        $i=0;
        foreach($query->result() as $row){
          $data['categories'][$i] = $row->nama_topik;
          $data['jml'][$i] = $row->jml;
          $i++;
        }
      }else if($nama_grafik == "media"){
        $query = $this->Grafik_m->get_media($tgl_awal,$tgl_akhir);
        $data['jml_categories'] = $query->num_rows();
        $data['nama_grafik'] = "Grafik Sumber Media";
        $data['nama_sub_grafik'] = "Persebaran Sumber Media Peternakan";
        $data['data_grafik'] = "Sumber Media";
        $i=0;
        foreach($query->result() as $row){
          $data['categories'][$i] = $row->nama_media;
          $data['jml'][$i] = $row->jml;
          $i++;
        }
      }else if($nama_grafik == "narasumber_internal"){
        $query = $this->Grafik_m->get_narasumber_int($tgl_awal,$tgl_akhir);
        $data['jml_categories'] = $query->num_rows();
        $data['nama_grafik'] = "Grafik Sumber Media";
        $data['nama_sub_grafik'] = "Persebaran Sumber Media Peternakan";
        $data['data_grafik'] = "Sumber Media";
        $i=0;
        foreach($query->result() as $row){
          $data['categories'][$i] = $row->alias;
          $data['jml'][$i] = $row->jml;
          $i++;
        }
      }else if($nama_grafik == "narasumber_eksternal"){
        $query = $this->Grafik_m->get_narasumber_eks($tgl_awal,$tgl_akhir);
        $data['jml_categories'] = $query->num_rows();
        $data['nama_grafik'] = "Grafik Sumber Media";
        $data['nama_sub_grafik'] = "Persebaran Sumber Media Peternakan";
        $data['data_grafik'] = "Sumber Media";
        $i=0;
        foreach($query->result() as $row){
          $data['categories'][$i] = $row->alias;
          $data['jml'][$i] = $row->jml;
          $i++;
        }
      }
      $this->load->view('header',$data);
      $this->load->view('grafik/grafik_berita', $data);
      $this->load->view('footer');
    } else {
      // $data['jml_categories'] = 0;
      $this->load->view('header',$data);
      $this->load->view('grafik/grafik_berita', $data);
      $this->load->view('footer');
    }
    }

  }
