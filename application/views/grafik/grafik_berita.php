<div class="right_col" role="main">
         <div class="">
           <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Grafik Berita</h2>
                   <ul class="nav navbar-right">
                     <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>


                   </ul>

                   <div class="clearfix"></div>
                 </div>

                 <div class="x_content">
                   <script src = "https://code.highcharts.com/highcharts.js"></script>
                   <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                        <select class="form-control select_search" name="data_grafik" required>
                          <option value="">Pilih Data</option>
                          <option value="sub_topik">Sub Topik</option>
                          <option value="topik">Topik</option>
                          <option value="media">Sumber Media</option>
                          <option value="narasumber_internal">Narasumber Internal </option>
                          <option value="narasumber_eksternal">Narasumber Eksternal</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-success" form="grafik">Submit</button>
                      </div>
                    </div>
                   </div>

                       <!-- <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b> -->



                 </form>

                   <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>



                   		<script type="text/javascript">

                   Highcharts.chart('container', {
                       chart: {
                           type: 'bar'
                       },
                       title: {
                           text: '<?=$nama_grafik;?>'
                       },
                       subtitle: {
                           text: '<?=$nama_sub_grafik;?>'
                       },
                       xAxis: {
                           categories: [
                              <?php
                                for($i=0;$i<$jml_categories;$i++){
                                  echo "'$categories[$i]'";
                                  if($i<$jml_categories-1){
                                    echo ",";
                                  }
                                }
                              ?>
                                      ],
                           title: {
                               text: null
                           }
                       },
                       yAxis: {
                           min: 0,
                           allowDecimals: false,
                           title: {
                               text: 'Jumlah <?=$data_grafik;?>',
                               align: 'high'
                           },
                           labels: {
                               overflow: 'justify'
                           }
                       },

                       tooltip: {
                           valueSuffix: ' berita'
                       },
                       plotOptions: {
                           bar: {
                               dataLabels: {
                                   enabled: true
                               }
                           }
                       },

                       credits: {
                           enabled: false
                       },
                       series: [{
                            name: 'Jumlah',
                            data: [
                             <?php
                               for($i=0;$i<$jml_categories;$i++){
                                 echo $jml[$i];
                                 if($i<$jml_categories-1){
                                   echo ",";
                                 }
                               }
                             ?>
                           ]
                       }]
                   });
                   		</script>
                 </div>
               </div>
             </div>


           </div>
         </div>
       </div>
