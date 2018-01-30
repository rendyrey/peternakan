<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends CI_Controller {


  public function __construct(){
    parent::__construct();
    $this->load->model('Berita_m');
    $this->load->model('Media_m');
  }

  public function index()
  {
    $data['topik'] = $this->Berita_m->get_topik();
    $tgl_awal = date('Y-m-d');
    $tgl_akhir = date('Y-m-d');
    $tgl = $this->input->post('tgl');
    $tgl_awal = date('Y-m-d',strtotime(substr($tgl,0,10)));
    $tgl_akhir = date('Y-m-d',strtotime(substr($tgl,-10)));
    $query = $this->Media_m->get_media_title($tgl_awal,$tgl_akhir);
    $data['jml_categories'] = $query->num_rows();
    $data['nama_grafik'] = "Grafik Media";
    $data['nama_sub_grafik'] = "Persebaran Media";
    $data['data_grafik'] = "Media";
    foreach($query->result() as $row){
      $data['categories'][] = $row->nama_media;
      $data['jml'][] = $row->jml;
    }
    $this->load->view('header', $data);
    $this->load->view('media/media_title');
    $this->load->view('footer');
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lMedia.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Media/:application/controllers/${1/(.+)/lMedia.php/}} */
