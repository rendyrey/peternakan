<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Berita Hari ini</span>
      <div class="count"><?=$jml_berita_today;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top green"><i class="fa fa-arrow-circle-up"></i> Berita Positif</span>
      <div class="count green"><?=$jml_pos;?></div>
      <span class="count_bottom"><i class="green"><?=$persen_pos."%";?> Hari ini</i></span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top red"><i class="fa fa-arrow-circle-down"></i> Berita Negatif</span>
      <div class="count red"><?=$jml_neg;?></div>
      <span class="count_bottom"><i class="red"><?=$persen_neg."%";?> Hari ini</i></span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top blue"><i class="fa fa-arrow-circle-right"></i> Berita Netral</span>
      <div class="count blue"><?=$jml_neu;?></div>
      <span class="count_bottom"><i class="blue"><?=$persen_neu."%";?> Hari ini</i></span>
    </div>


  </div>
  <!-- /top tiles -->


  <br />
  <div class="row tile_count">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-align-left"></i> Berita Hari Ini<small><?=date('D, d M Y');?></small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content" style="height:300px;overflow:auto">

          <!-- start accordion -->
          <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            if($jml_berita_today!=0){
              for($i=0;$i<$jml_berita_today;$i++){
                $j = $i+1;
                ?>
                <div class="panel">
                  <a class="panel-heading collapsed" role="tab" id="" data-toggle="collapse" data-parent="#accordion" href="#<?="collaps".$id_isi_berita[$i];?>" aria-expanded="false" aria-controls="collapseTwo">
                    <h4 class="panel-title"><?="#$j ";?><?=$judul_berita[$i];?>  <?=$tone_berita[$i];?></h4>
                  </a>
                  <div id="<?="collaps".$id_isi_berita[$i];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                      <p><strong><?=$nama_sub_topik[$i]."<br><i>".$tgl_berita[$i]." ".$jam_berita[$i]."</i>";?></strong>
                      </p>
                      <?=$isi_berita[$i];?>
                      <right>
                 <a href="<?=site_url('Berita/detail/'.$id_isi_berita[$i]);?>" target="popup" onclick="window.open('<?=site_url('Berita/detail/'.$id_isi_berita[$i]);?>','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;">
                   <button type="button" class="btn btn-default btn-xs">Detail Berita</button>
                 </a>
               </right>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>

          </div>
          <!-- end of accordion -->


        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-align-left"></i> Trending Berita Hari Ini<small><?=date('D, d M Y');?></small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content" style="height:300px;overflow:auto">

          <!-- start accordion -->
          <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            if($jml_trend!=0){
              for($i=0;$i<$jml_trend;$i++){
                $j = $i+1;
                ?>
                <div class="panel">
                  <a href="<?=site_url('Berita/trend_table/'.$id_sub[$i]);?>" class="panel-heading" role="tab" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwo">
                    <h4 class="panel-title"><?="#$j ";?><?=$trend_sub_topik[$i];?> </h4>
                  </a>

                </div>
                <?php
              }
            }
            ?>

          </div>
          <!-- end of accordion -->


        </div>
      </div>
    </div>
  </div> <!-- row tile_count -->




</div>
<!-- /page content -->
