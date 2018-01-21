<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tabel Berita</h2>
            <ul class="nav navbar-right">
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <?php
          if($this->session->flashdata('msg_hps')){

            ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><?=$this->session->flashdata('msg_hps');?></strong>
            </div>
          <?php } ?>

          <div class="x_content">
            <!-- untuk form mencari berita -->
            <form action="" method="post" id="grafik">
              <?php
              // if(isset($_GET['tgl'])){
              //   echo $_GET['tgl'];
              //   echo "<br>";
              //   $tgl = substr($_GET['tgl'],0,10);
              //   $tgl_akhir = substr($_GET['tgl'],-10);
              //   echo date('Y-m-d',strtotime($tgl));
              //   echo date('Y-m-d',strtotime($tgl_akhir));
              // }
              ?>
              <div class="col-md-4">
                <div class="col-md-3">
                  Range Berita:
                </div>
                <div class="col-md-6">
                  <input id="reportrange_right" name="tgl" class="pull-left form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc width:auto;">
                  <br>
                  &nbsp;
                </div>

                <div class="col-md-3">
                </div>
                <div class="row" >

                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success" form="grafik">Submit</button>
                  </div>
                </div>
              </div>

              <!-- <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b> -->



            </form>

            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Ringkasan</th>
                  <th>Media</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
                <?php
                $i=0;
                foreach($isi_berita as $row){
                  //untuk isi berita
                  $string = strip_tags($row->isi_berita);
                  if (strlen($string) > 350) {
                    // truncate string
                    $stringCut = substr($string, 0, 350);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
                  }
                  //--untuk isi berita

                  //untuk tone Berita
                  $label_berita='';
               if($row->tone_berita==1){
                 $label_berita='<span class="label label-success"><i class="fa fa-hand-o-up"></i>&nbsp;Positif</span>';
               }else if($row->tone_berita==0){
                 $label_berita='<span class="label label-warning"><i class="fa fa-hand-o-right"></i>&nbsp;Netral</span>';
               }else if($row->tone_berita==-1){
                 $label_berita='<span class="label label-danger"><i class="fa fa-hand-o-down"></i>&nbsp;Negatif</span>';
               }

                  $date_post = strtotime($row->tgl_post);
                  $date_news = strtotime($row->tgl_berita);
                  $i++;
                  echo "<tr>";
                  echo "<td>$i</td>";
                  echo "<td><i class='fa fa-clock-o'></i>&nbsp;".date('D, d F Y, ',$date_news).date('H:i',$date_post);
                  echo "<br>";
                  echo "<h4>$row->judul_berita</h4>";
                  echo "<span class='label label-info'>$row->nama_sub_topik</span>";
                  echo "<br>";
                  echo "$string <br> $label_berita";
                  ?>
                  <right>
                 <a href="<?php echo site_url('Berita/detail/').$row->id_isi_berita;?>"
                   target="popup"
                   onclick="window.open('<?=site_url('Berita/detail/').$row->id_isi_berita;?>','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;">
                   <button type="button" class="btn btn-default btn-xs">Detail Berita</button>
                 </a>
               </right>

                <?php
                  echo "</td>";
                  echo "<td><a href='$row->link_berita'><i class='fa fa-newspaper-o'></i>&nbsp;$row->nama_media</a>";
                  echo "<br><i class='fa fa-calculator'></i>&nbsp;Value";
                  echo "<br><i class='fa fa-caret-right'></i>&nbsp;Ad:&nbsp;Rp".number_format($row->ad_value);
                  echo "<br><i class='fa fa-caret-right'></i>&nbsp;News:&nbsp;Rp".number_format($row->news_value);
                  echo "<br><i class='fa fa-camera'></i>&nbsp;$row->wartawan";
                  echo "</td>";
                  echo "<td>";
                  echo "<a href='".site_url('Berita/hapus/')."$row->id_isi_berita' class='confirmation'><i class='fa fa-close'>&nbsp;Hapus Berita</i></a><br><br>";
                  echo "<a href='".site_url('Berita/edit/')."$row->id_isi_berita'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;Edit Berita</i></a>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
