<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect('Login');
		}
		$this->load->model('Berita_m');
		$this->load->model('Dashboard_m');
	}
	public function index()
	{
		//untuk menu berita
		$data['topik'] = $this->Berita_m->get_topik();

		//untuk berita hari ini
		$berita_today = $this->Dashboard_m->get_berita_hari_ini();
		$data['jml_berita_today'] = $berita_today->num_rows();
		foreach($berita_today->result() as $row){
			$data['judul_berita'][] = $row->judul_berita;
			$data['id_isi_berita'][] = $row->id_isi_berita;

			$tone_berita = $row->tone_berita;
			if($tone_berita==1){
				$data['tone_berita'][] = "<span class='label label-success'><i class='fa fa-hand-o-up'></i>&nbsp;Positif</span>";
			}else if($tone_berita == -1){
				$data['tone_berita'][] = "<span class='label label-danger'><i class='fa fa-hand-o-down'></i>&nbsp;Negatif</span>";
			}else if($tone_berita == 0){
				$data['tone_berita'][] = "<span class='label label-warning'><i class='fa fa-hand-o-right'></i>&nbsp;Netral</span>";
			}
			$data['tgl_berita'][] = date('D, d M Y',strtotime($row->tgl_berita));
			$data['jam_berita'][] = date('H:i',strtotime($row->tgl_post));
			$id_sub_topik = $row->id_sub_topik;
			$q_sub_topik = $this->Berita_m->get_sub_topik_byid($id_sub_topik)->row();
			$data['nama_sub_topik'][] = $q_sub_topik->nama_sub_topik;

			//untuk isi berita
			$string = strip_tags($row->isi_berita);
			if (strlen($string) > 250) {
				// truncate string
				$stringCut = substr($string, 0, 250);
				// make sure it ends in a word so assassinate doesn't become ass...
				$string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
			}
			$data['isi_berita'][] = $string;
			$data['link_berita'][] = $row->link_berita;

		}

		//untuk tone berita hari ini
		$positif_today = $this->Dashboard_m->get_positif_today();
		$data['jml_pos'] = $positif_today->num_rows();
		$negatif_today = $this->Dashboard_m->get_negatif_today();
		$data['jml_neg'] = $negatif_today->num_rows();
		$netral_today = $this->Dashboard_m->get_netral_today();
		$data['jml_neu'] = $netral_today->num_rows();
		$total = $data['jml_pos']+$data['jml_neg']+$data['jml_neu'];
		if($total!=0){
				$data['persen_neg'] = ($data['jml_neg']/$total)*100;
				$data['persen_pos'] = ($data['jml_pos']/$total)*100;
				$data['persen_neu'] = ($data['jml_neu']/$total)*100;
			}else{
				$data['persen_neg'] = 0;
				$data['persen_pos'] = 0;
				$data['persen_neu'] = 0;
			}

		//untuk trending berita hari ini
		$q_trend = $this->Dashboard_m->get_trending_today();
		$data['jml_trend'] = $q_trend->num_rows();
		foreach($q_trend->result() as $row){
			$data['trend_sub_topik'][] = $row->nama_sub_topik;
			$data['id_topik'][] = $row->id_topik;
			$data['id_sub'][] =  $row->id_sub;
		}
		$this->load->view('header',$data);
		$this->load->view('dashboard/main');
		$this->load->view('footer');
	}
}
