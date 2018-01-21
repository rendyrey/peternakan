<div class="right_col" role="main" style="min-height: 3541px;">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Berita</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br>
            <form id="post_berita" action="<?=site_url('Berita/editing/'.$id_isi_berita);?>" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left">
              <?php
              if($this->session->flashdata('message')){
                ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong><?=$this->session->flashdata('message');?></strong>
                </div>
              <?php } ?>
              <?php
              if($this->session->flashdata('msg_gmbr')){
                ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong><?=$this->session->flashdata('msg_gmbr');?> <= 2MB</strong>
                </div>
              <?php } ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Topik
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_sub_topik', $sub_opt,$id_sub_topik,'id="cmb_sub_topik" class="form-control col-md-7 col-xs-12 select_search" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topik
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_topik',$topik_opt,$id_topik,'id="cmb_topik" class="form-control col-md-7 col-xs-12 select_search"');?>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Judul Berita</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name"> -->
                  <?=form_input('judul_berita',$judul_berita,'placeholder="Judul Berita" class="form-control col-md-7 col-xs-12" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber Media
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_media',$med_opt,$id_media,'class="form-control col-md-7 col-xs-12 select_search" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narasumber 1
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_narasumber',$narsum_opt,$id_narasumber,'class="form-control col-md-7 col-xs-12 select_search" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narasumber 2
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_narasumber2',$narsum_opt,$id_narasumber2,'class="form-control col-md-7 col-xs-12 select_search" ');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narasumber 3
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_narasumber3',$narsum_opt,$id_narasumber3,'class="form-control col-md-7 col-xs-12 select_search" ');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narasumber 4
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_dropdown('id_narasumber4',$narsum_opt,$id_narasumber4,'class="form-control col-md-7 col-xs-12 select_search" ');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gambar
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_upload('gambar','','class="form-control col-md-7 col-xs-12"');?>
                  <input type="hidden" name="gambar_old" value="<?=$gambar;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal Berita
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_input('tgl_berita',$tgl_berita,'class="form-control has-feedback-left" id="single_cal1" aria-describedby="inputSuccess2Status" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Wartawan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_input('wartawan',$wartawan,'class="form-control col-md-7 col-xs-12" placeholder="Wartawan" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber Online?
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <?=form_checkbox('','',FALSE,'class="" id="trigger"');?>
                  <!-- <input type="checkbox" class="flat" > -->
                </div>
              </div>
              <div class="halaman form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Halaman
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_input('halaman',$halaman,'class="halaman form-control col-md-7 col-xs-12" placeholder="Halaman" required');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Link Berita
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                  <?=form_input('link_berita',$link_berita,'class="sumber form-control col-md-7 col-xs-12" placeholder="Link Berita"');?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Value</label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Ad Value"> -->
                  <?=form_input('ad_value',$ad_value,'class="form-control has-feedback-left" placeholder="Ad value"');?>
                  <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">News Value</label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <?=form_input('news_value',$news_value,'class="form-control has-feedback-left" placeholder="News value"');?>
                  <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Isi Berita</label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea id="autosize" required class="form-control" name="isi_berita"><?=strip_tags($isi_berita);?></textarea>
                </div>
              </div>



              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="reset" form="post_berita" class="btn btn-primary">Reset</button>
                  <button type="submit" form="post_berita" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
