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
    $data['isi_berita'] = $this->Berita_m->get_isi_berita_bytopik($id_topik);
    $this->load->view('header', $data);
    $this->load->view('berita/tabel_berita',$data);
    $this->load->view('footer');
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
      $jml = $query->id_isi_berita;
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
        $input['tgl_berita'] = date('Y-m-d',strtotime($this->input->post('tgl_berita')));
        $input['wartawan'] = $this->input->post('wartawan');
        $input['halaman'] = $this->input->post('halaman');
        $input['link_berita'] = $this->input->post('link_berita');
        $input['ad_value'] = $this->input->post('ad_value');
        $input['news_value'] = $this->input->post('news_value');
        $input['isi_berita'] = $this->input->post('isi_berita');
        $input['tgl_post'] = date('Y-m-d H:i:s');
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
