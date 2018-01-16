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
                         echo "$row->isi_berita";
                         echo "</td>";
                         echo "<td><a href='$row->link_berita'><i class='fa fa-newspaper-o'></i>&nbsp;$row->nama_media</a>";
                         echo "<br><i class='fa fa-calculator'></i>&nbsp;Value";
                         echo "<br><i class='fa fa-caret-right'></i>&nbsp;Ad:&nbsp;Rp.$row->ad_value";
                         echo "<br><i class='fa fa-caret-right'></i>&nbsp;News:&nbsp;Rp.$row->news_value";
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
