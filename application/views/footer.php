<!-- footer content -->
<footer>
  <div class="pull-right">
    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?=base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?=base_url();?>assets/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?=base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?=base_url();?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?=base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?=base_url();?>assets/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?=base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
<script src="<?=base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?=base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>
<script src="<?=base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?=base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?=base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?=base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?=base_url();?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?=base_url();?>assets/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?=base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?=base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?=base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?=base_url();?>assets/vendors/moment/min/moment.min.js"></script>
<script src="<?=base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?=base_url();?>assets/build/js/custom.min.js"></script>

<!-- jQuery Tags Input -->
<script src="<?=base_url();?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="<?=base_url();?>assets/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url();?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="<?=base_url();?>assets/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="<?=base_url();?>assets/vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="<?=base_url();?>assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="<?=base_url();?>assets/vendors/starrr/dist/starrr.js"></script>
<!-- Custom Theme Scripts -->
<!-- <script src="base_url();?>assets/build/js/custom.min.js"></script> -->
<script src="<?=base_url();?>assets/lib/select2/select2.js"></script>
<script src="<?=base_url();?>assets/lib/jquery-autosize/autosize.js"></script>

<!-- Datatables -->
<script src="<?=base_url();?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?=base_url();?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=base_url();?>assets/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?=base_url();?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>


<script>

$(function(){
  $('.select_search').select2();
  $("#cmb_sub_topik").change(function(){
    var id_sub_topik = $(this).val();

    $.ajax({
      type: "POST",
      dataType: "html",
      url: "<?=site_url('Berita/get_topik');?>",
      data: "id_sub_topik="+id_sub_topik,
      success: function(data){
        // alert("hello wordl");
        if(data==''){
          $("select#cmb_topik").html('<option value="">Topik</option>');

        }else{

          $("select#cmb_topik").html('<option value="" disabled>Topik</option>'+data);
        }

      }

    });
  });
  enable_cb();
  $(".halaman").show();
  $("#trigger").click(enable_cb);
  function enable_cb() {
    if (this.checked) {
      $("input.sumber").prop("disabled",false);
      $("input.sumber").prop("required", true);
      $("input.halaman").prop("required",false);
    } else {
      $("input.sumber").prop("disabled", true);
      $("input.sumber").prop("required", false);
    }
    $(".halaman").toggle();
  }

  // Textarea Auto Resize
  autosize($('#autosize'));

  $('.confirmation').on('click', function () {
    return confirm('Are you sure?');
  });

  $('#auto_number').keyup(function(event) {

       // skip for arrow keys
       if(event.which >= 37 && event.which <= 40) return;

       // format number
       $(this).val(function(index, value) {
         return value
         .replace(/\D/g, "")
         .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
         ;
       });
     });
     $('#auto_number2').keyup(function(event) {

          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40) return;

          // format number
          $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            ;
          });
        });

});
</script>

</body>
</html>
