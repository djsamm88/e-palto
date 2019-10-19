<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
	<strong>Copyright &copy; 2018-<?php echo date("Y");?> <a href="https://diskominfo.pakpakbharatkab.go.id/" target="_blank">Diskominfo Pakpak Bharat</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.0
	</div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/ckeditor/ckeditor.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo config_item('asset_url'); ?>assets/jquery/jqueryui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo config_item('asset_url'); ?>assets/jquery/raphael.js"></script>
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/daterangepicker/daterangepicker.js"></script>
		 datepicker 
		<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/datepicker/bootstrap-datepicker.js"></script>
	-->
	<!-- jquery-ui -->
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jquery-ui/1103/jquery-ui.css"/>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/dist/js/adminlte.js"></script>

	<script src="<?php echo config_item('asset_url'); ?>assets/apps/dist/js/demo.js"></script>

	<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jquery.price_format/jquery.price_format.2.0.js"></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/back-to-top/back-to-top.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/pace/css/flash.css">
	<script type="text/javascript" src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/pace/js/pace.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/notify/notify.min.css">
	<script type="text/javascript" src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/notify/notify.min.js"></script>

	<script type="text/javascript" src="<?php echo config_item('asset_url'); ?>assets/DataTables/datatables.js"></script>
	


	<?php  $this->load->view('apps/funtionjs'); ?>

	<script type="text/javascript">
		$(document).ready(function($){
			/*$('#cssmenu > ul > li > a').click(function() {
				$('#cssmenu > ul > li').removeClass('menu-open');
				$('#cssmenu > ul > li > ul').css('display','none');
				var ID = $(this).attr("id");
				$('#MENU2-'+ID).fadeIn("slow");//'display','block');
				$('#MENU1-'+ID).addClass('menu-open');
				console.log(ID);
			});*/

			$('#cssmenu > ul > li > ul > li > a').click(function() {
				$('#cssmenu > ul > li > ul > li > a').removeClass('active');
				$(this).addClass('active');
			});
		});
	</script>
</body>
</html>
