<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita extends CI_Controller {


  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('login')){
      redirect('Login');
    }
    $this->load->model('Berita_m');
    $this->load->model('Media_m');
    $this->load->model('Narasumber_m');
  }
  public function index($id_topik){
    //menu topik
    $data['topik'] = $this->Berita_m->get_topik();
    $this->form_validation->set_rules('tgl', 'Tanggal Berita', 'required');
    if ($this->form_validation->run()) {
      $tgl = $this->input->post('tgl');
      $tgl_awal = date('Y-m-d',strtotime(substr($tgl,0,10)));
      $tgl_akhir = date('Y-m-d',strtotime(substr($tgl,-10)));
      $data['isi_berita'] = $this->Berita_m->get_isi_berita_bytopik($id_topik,$tgl_awal,$tgl_akhir);
      $this->load->view('header', $data);
      $this->load->view('berita/tabel_berita',$data);
      $this->load->view('footer');
    } else {
      $tgl_awal = date('Y-m-d');
      $tgl_akhir = date('Y-m-d');
      $data['isi_berita'] = $this->Berita_m->get_isi_berita_bytopik($id_topik,$tgl_awal,$tgl_akhir);
      $this->load->view('header', $data);
      $this->load->view('berita/tabel_berita',$data);
      $this->load->view('footer');
    }

  }

  public function post(){
    $data['topik'] = $this->Berita_m->get_topik();

    //untuk option sub_topik
    $data['sub_opt'][''] = "Pilih Sub Topik";
    $subtopik = $this->Berita_m->get_sub_topik();
    foreach($subtopik as $row){
      $data['sub_opt'][$row->id_sub_topik] = $row->nama_sub_topik;
    }
    //untuk option Media
    $data['med_opt'][''] = "Pilih Sumber Media";
    $media = $this->Media_m->get_media();
    foreach($media as $row){
      $data['med_opt'][$row->id_media] = $row->nama_media;
    }
    //untuk optino narasumber
    $data['narsum_opt'][''] = "Pilih Narasumber";
    $narsum = $this->Narasumber_m->get_narasumber();
    foreach($narsum as $row){
      $data['narsum_opt'][$row->id_narasumber] = $row->nama_narasumber;
    }
    $this->load->view('header', $data);
    $this->load->view('berita/post_berita', $data);
    $this->load->view('footer');
  }

  public function posting(){
    $this->form_validation->set_rules('id_sub_topik','Sub Topik','required');
    $this->form_validation->set_rules('id_topik','Topik','required');
    $this->form_validation->set_rules('judul_berita','Judul Berita','required');
    $this->form_validation->set_rules('id_media','Sumber Media','required');
    $this->form_validation->set_rules('id_narasumber','Narasumber','required');
    $this->form_validation->set_rules('tgl_berita','Tanggal Berita','required');
    $this->form_validation->set_rules('wartawan','Wartawan','required');
    // $this->form_validation->set_rules('halaman','Halaman','required');
    // $this->form_validation->set_rules('link_berita','Link Berita','required');
    $this->form_validation->set_rules('ad_value','Ad Value','required');
    $this->form_validation->set_rules('news_value','News Value','required');
    $this->form_validation->set_rules('isi_berita','Isi Berita','required');
    if ($this->form_validation->run()) {
      $query=$this->Berita_m->get_last_isi_berita()->row();
      if($jml = $query->id_isi_berita)
      $jml++;
      $temp = explode(".", $_FILES["gambar"]["name"]);
      $extension = end($temp);
      $filename = $jml.".".$extension;
      // $nama_file = $_FILES['gambar']['name'];
      // $file_tmp = $_FILES['gambar']['tmp_name'];
      // $target = "assets/img_berita/".$filename;
      // move_uploaded_file($file_tmp,$target);
      $config['upload_path']          = 'assets/img_berita/';
      $config['allowed_types']        = 'bmp|jpg|png|jpeg|pdf';
      $config['max_size']             = 2048;
      $config['file_name']            = $filename;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->load->library('upload', $config);
      if ( ! $this->upload->do_upload('gambar'))
      {
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('msg_gmbr',$error);

        // $this->load->view('upload_form', $error);
      }
      else
      {
        $input['gambar'] = $filename;
        $input['id_sub_topik'] = $this->input->post('id_sub_topik');
        $input['id_topik'] = $this->input->post('id_topik');
        $input['judul_berita'] = $this->input->post('judul_berita');
        $input['id_media'] = $this->input->post('id_media');
        $input['id_narasumber'] = $this->input->post('id_narasumber');
        $input['id_narasumber2'] = $this->input->post('id_narasumber2');
        $input['id_narasumber3'] = $this->input->post('id_narasumber3');
        $input['id_narasumber4'] = $this->input->post('id_narasumber4');
        $input['tgl_berita'] = date('Y-m-d',strtotime($this->input->post('tgl_berita')));
        $input['wartawan'] = $this->input->post('wartawan');
        $input['halaman'] = $this->input->post('halaman');
        $input['link_berita'] = $this->input->post('link_berita');
        $input['ad_value'] = $this->input->post('ad_value');
        $input['news_value'] = $this->input->post('news_value');
        $input['isi_berita'] = nl2br($this->input->post('isi_berita'));
        $input['tgl_post'] = date('Y-m-d H:i:s',strtotime('+7 hours'));
        $input['kutipan'] = $this->separate_quote($input['isi_berita']);
        $input['tone_berita'] = $this->calculate_tone($input['isi_berita']);
        $this->Berita_m->insert_berita($input);
        $this->session->set_flashdata('message','Post Berita Berhasil!');
        $data = array('upload_data' => $this->upload->data());
        // $this->load->view('upload_success', $data);
      }

      redirect('Berita/post/');
    } else {
      redirect('Berita/post/');
      // echo "gagal";
    }

  }

  public function edit($id_isi_berita){
    //untuk menu topik
    $data['topik'] = $this->Berita_m->get_topik();

    //untuk option sub_topik
    $data['sub_opt'][''] = "Pilih Sub Topik";
    $subtopik = $this->Berita_m->get_sub_topik();
    foreach($subtopik as $row){
      $data['sub_opt'][$row->id_sub_topik] = $row->nama_sub_topik;
    }
    //untuk option Topik
    $data['topik_opt'][''] = "Pilih Topik";
    $topik = $this->Berita_m->get_topik();
    foreach($topik as $row){
      $data['topik_opt'][$row->id_topik] = $row->nama_topik;
    }
    //untuk option Media
    $data['med_opt'][''] = "Pilih Sumber Media";
    $media = $this->Media_m->get_media();
    foreach($media as $row){
      $data['med_opt'][$row->id_media] = $row->nama_media;
    }
    //untuk optino narasumber
    $data['narsum_opt'][''] = "Pilih Narasumber";
    $narsum = $this->Narasumber_m->get_narasumber();
    foreach($narsum as $row){
      $data['narsum_opt'][$row->id_narasumber] = $row->nama_narasumber;
    }

    //mengambil data di database
    $query = $this->Berita_m->get_isi_berita_by_id($id_isi_berita);
    foreach($query as $data_edit){

      $data['id_isi_berita'] = $data_edit->id_isi_berita;
      $data['id_sub_topik'] = $data_edit->id_sub_topik;
      $data['id_topik'] = $data_edit->id_topik;
      $data['judul_berita'] = $data_edit->judul_berita;
      $data['id_media'] = $data_edit->id_media;
      $data['id_narasumber'] = $data_edit->id_narasumber;
      $data['id_narasumber2'] = $data_edit->id_narasumber2;
      $data['id_narasumber3'] = $data_edit->id_narasumber3;
      $data['id_narasumber4'] = $data_edit->id_narasumber4;
      $data['tgl_berita'] = date('m/d/Y',strtotime($data_edit->tgl_berita));
      $data['tgl_post'] = $data_edit->tgl_post;
      $data['wartawan'] = $data_edit->wartawan;
      $data['link_berita'] = $data_edit->link_berita;
      $data['halaman'] = $data_edit->halaman;
      $data['ad_value'] = $data_edit->ad_value;
      $data['news_value'] = $data_edit->news_value;
      $data['isi_berita'] = $data_edit->isi_berita;
      $data['gambar'] = $data_edit->gambar;
    }
    $this->load->view('header',$data);
    $this->load->view('berita/edit_berita');
    $this->load->view('footer');
  }

  public function editing($id_isi_berita){
    $this->form_validation->set_rules('id_sub_topik','Sub Topik','required');
    $this->form_validation->set_rules('id_topik','Topik','required');
    $this->form_validation->set_rules('judul_berita','Judul Berita','required');
    $this->form_validation->set_rules('id_media','Sumber Media','required');
    $this->form_validation->set_rules('id_narasumber','Narasumber','required');
    $this->form_validation->set_rules('tgl_berita','Tanggal Berita','required');
    $this->form_validation->set_rules('wartawan','Wartawan','required');
    // $this->form_validation->set_rules('halaman','Halaman','required');
    // $this->form_validation->set_rules('link_berita','Link Berita','required');
    $this->form_validation->set_rules('ad_value','Ad Value','required');
    $this->form_validation->set_rules('news_value','News Value','required');
    $this->form_validation->set_rules('isi_berita','Isi Berita','required');
    if ($this->form_validation->run()) {
      $query=$this->Berita_m->get_last_isi_berita()->row();


      if($_FILES['gambar']['name']!=''){
        $filename = $this->input->post('gambar_old');
        $target = "assets/img_berita/".$filename;
        $file_tmp = $_FILES['gambar']['tmp_name'];
        unlink($target);
        move_uploaded_file($file_tmp,$target);
        $input['gambar'] = $filename;
      }



      $input['id_sub_topik'] = $this->input->post('id_sub_topik');
      $input['id_topik'] = $this->input->post('id_topik');
      $input['judul_berita'] = $this->input->post('judul_berita');
      $input['id_media'] = $this->input->post('id_media');
      $input['id_narasumber'] = $this->input->post('id_narasumber');
      $input['id_narasumber2'] = $this->input->post('id_narasumber2');
      $input['id_narasumber3'] = $this->input->post('id_narasumber3');
      $input['id_narasumber4'] = $this->input->post('id_narasumber4');
      $input['tgl_berita'] = date('Y-m-d',strtotime($this->input->post('tgl_berita')));
      $input['wartawan'] = $this->input->post('wartawan');
      $input['halaman'] = $this->input->post('halaman');
      $input['link_berita'] = $this->input->post('link_berita');
      $input['ad_value'] = $this->input->post('ad_value');
      $input['news_value'] = $this->input->post('news_value');
      $input['isi_berita'] = nl2br($this->input->post('isi_berita'));
      $input['tgl_post'] = date('Y-m-d H:i:s');
      $input['kutipan'] = $this->separate_quote($input['isi_berita']);
      // $input['tone_berita'] = $this->calculate_tone($input['isi_berita']);
      $this->Berita_m->update_berita($id_isi_berita,$input);
      $this->session->set_flashdata('message','Edit Berita Berhasil!');

      // $this->load->view('upload_success', $data);


      redirect('Berita/index/'.$input['id_topik']);
    } else {
      redirect('Berita/edit/');
      // echo "gagal";
    }
  }

  public function detail($id_isi_berita){
    $query = $this->Berita_m->get_isi_berita_by_id($id_isi_berita);
    foreach($query as $row){
      $data['id_isi_berita'] = $row->id_isi_berita;
      $data['id_sub_topik'] = $row->id_sub_topik;
      //ambil nama sub topik
      $q_sub_topik = $this->Berita_m->get_sub_topik_byid($data['id_sub_topik']);
      $res = $q_sub_topik->row();
      $data['nama_sub_topik'] = $res->nama_sub_topik;

      $data['id_topik'] = $row->id_topik;
      $data['judul_berita'] = $row->judul_berita;
      $data['id_media'] = $row->id_media;
      //ambil nama media
      $q_media = $this->Media_m->get_media_byid($data['id_media']);
      $res = $q_media->row();
      $data['nama_media'] = $res->nama_media;
      $narasumber1=$row->id_narasumber;
      $narasumber2=$row->id_narasumber2;
      $narasumber3=$row->id_narasumber3;
      $narasumber4=$row->id_narasumber4;
      $data['narasumber1']='';
      $data['narasumber2']='';
      $data['narasumber3']='';
      $data['narasumber4']='';
      $query = $this->Narasumber_m->get_narasumber_byid($narasumber1)->row();
      $data['narasumber1'] = $query->nama_narasumber;
      if($narasumber2){
        $query2 = $this->M_narasumber->get_narasumber_byid($narasumber2)->row();
        $data['narasumber2'] = $query2->nama_narasumber;
      }
      if($narasumber3){
        $query3 = $this->M_narasumber->get_narasumber_byid($narasumber3)->row();
        $data['narasumber3'] = $query3->nama_narasumber;
      }
      if($narasumber4){
        $query4 = $this->M_narasumber->get_narasumber_byid($narasumber4)->row();
        $data['narasumber4'] = $query4->nama_narasumber;
      }
      $data['tgl_berita'] = date('D, dS F Y',strtotime($row->tgl_berita));
      $data['tgl_post'] = $row->tgl_post;

      //jam berita
      $data['jam_berita'] = date('H:i',strtotime($row->tgl_post));
      $data['wartawan'] = $row->wartawan;
      $data['link_berita'] = $row->link_berita;
      $data['halaman'] = $row->halaman;
      $data['ad_value'] = $row->ad_value;
      $data['news_value'] = $row->news_value;
      $data['isi_berita'] = $row->isi_berita;
      $data['tone_berita'] = $row->tone_berita;
      $data['gambar'] = $row->gambar;
    }
    $this->load->view('header_detail',$data);
    $this->load->view('berita/detail_berita');
    // $this->load->view('footer');
  }

  public function calculate_tone($string){
    // $this->check_login();
    $data['string'] = $string;
    $tone =  $this->load->view('tone/examples/tone', $data,TRUE);
    // error_reporting(0);
    // echo $tone."haha";
    // echo $string;
    // $tone = $this->load->view('tone/examples/tone',$data,TRUE);
    $sentiment=0;


    if($tone == "pos"){
      $sentiment = 1;
    }else if($tone == "neg"){
      $sentiment = -1;
    }else if($tone == "neu"){
      $sentiment = 0;
    }
    // echo $sentiment;
    // echo $sentiment;
    return $sentiment;
  }

  public function separate_quote($data){
    // $this->check_login();
    preg_match_all('/"([^"]+)"/', $data, $m);
    $quote="";
    foreach($m[1] as $words){
      $quote=$quote.",".$words;
    }
    return $quote;
  }

  public function tabel_berita($id_topik){

  }

  public function get_topik(){
    $id_sub_topik = $this->input->post('id_sub_topik');
    $data['topik'] = $this->Berita_m->get_topik_where(null,$id_sub_topik);
    foreach($data['topik'] as $topik){
      echo "<option value='$topik->id_topik'>$topik->nama_topik</option>";
    }
  }

  public function hapus($id_isi_berita){
    $this->db->where('id_isi_berita',$id_isi_berita);
    $this->db->delete('isi_berita');
    $this->session->set_flashdata('msg_hps','Berita Berhasil Dihapus!');
    redirect('Berita/index/'.$id_isi_berita);
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lBerita.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Berita/:application/controllers/${1/(.+)/lBerita.php/}} */
