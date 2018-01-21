<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right">
            </ul>
            <div class="clearfix"></div>
          </div>


          <div class="x_content">
            <!-- untuk form mencari berita -->


            <div class="panel">
        <div class="panel-heading">
          <?php

          $label_berita='';
          if($tone_berita==1){
            $label_berita='<span class="label label-success"><i class="fa fa-hand-o-up"></i>&nbsp;Positif</span>';
          }else if($tone_berita==0){
            $label_berita='<span class="label label-warning"><i class="fa fa-hand-o-right"></i>&nbsp;Netral</span>';
          }else if($tone_berita==-1){
            $label_berita='<span class="label label-danger"><i class="fa fa-hand-o-down"></i>&nbsp;Negatif</span>';
          }


          ?>
          <h4 class="panel-title"><?php echo $judul_berita."&nbsp;".$label_berita;?></h4>

          <h5>--<i><?= $nama_sub_topik;?></i>--</h5>
          <p><?php echo "$wartawan | $nama_media | $tgl_berita, $jam_berita";?></p>
          <hr>

          <p><?php echo $isi_berita."&nbsp;";?></p>
        </div><!-- panel-heading -->
        <div class="panel-body">
          <style>  img {
    border: 1px solid #ddd; /* Gray border */
    border-radius: 4px;  /* Rounded border */
    padding: 5px; /* Some padding */
    width: 150px; /* Set a small width */
}

/* Add a hover effect (blue shadow) */
img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
          <a href="<?php echo base_url().'assets/img_berita/'.$gambar;?>" target="_blank">
  <img src="<?php echo base_url().'assets/img_berita/'.$gambar;?>" alt="Berita">
</a>
        <p class="lead">
          <blockquote>
            <i class="fa fa-quote-left"></i>
            <small><?="$narasumber1 <br> $narasumber2 <br> $narasumber3 <br> $narasumber4 in "?><cite title="Source Title"><?=$judul_berita;?></cite></small>
          </blockquote>
        </p>
      </div>
      <center><button onclick="myFunction()">Print this page</button></center>
    </div><!-- panel -->

  </div><!-- contentpanel -->


  <script>
  function myFunction() {
      window.print();
  }
  </script>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
