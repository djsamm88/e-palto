<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title><?php echo config_item('app_client1'); ?> | <?php echo config_item('app_name'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="//www.pakpakbharatkab.go.id/favicon.ico" />
	<link href="<?php echo config_item('asset_url'); ?>assets/apps/login/semantic.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo config_item('asset_url'); ?>assets/apps/login/login.css" rel="stylesheet" type="text/css">
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/login/jquery-2.1.4.min.js" lang="javascript"></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/apps/login/semantic.min.js" lang="javascript"></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/jquery/jquery-3.3.1.min.js" ></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/popper.js-1.14.3 2/dist/umd/popper.js"></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/bootstrap/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/fontawesome-free-5.1.1-web/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/pace/pace.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/pace/css/flash.css">
	<script type="text/javascript" src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/pace/js/pace.js"></script>
</head>
<style type="text/css">
.box_shadow {
	width: 100px;
	height: 100px;
	margin: 100px;
	box-shadow:
	-52px -52px 0px 0px #f65314,
	52px -52px 0px 0px #7cbb00,
	-52px 52px 0px 0px #00a1f1,
	52px 52px 0px 0px #ffbb00;
}
</style>
<body>
	<div class="ui page grid">
		<div class="sixteen wide mobile two wide tablet two wide computer column"></div>
		<div class="sixteen wide mobile twelve wide tablet twelve wide computer column">
			<div class="ui segment">
				<div class="ui stackable two column grid">
					<div class="grecen center aligned column" style="background-color: #28a745">
						<h2 class="ui blue inverted center aligned icon header">
							<img src="<?php echo config_item('asset_url'); ?>assets/img/stir.png" class="ui image">
							<div class="content">
								<?php echo config_item('app_client1'); ?>
								<div class="sub header" style="color: #fff;">
									(<?php echo config_item('app_name'); ?>)<br>
									<strong><?php echo config_item('app_client2'); ?></strong>
								</div>
							</div>
						</h2>
					</div>
					<div class="column">
						<a class="ui red right ribbon label">
							<h3>Login User</h3>
						</a>
						<div class="ui basic segment">
							<form action="<?php echo base_url()?>apps/login/proses" method="POST" id="login_user" class="ui form">
								<div class="field">
									<label>userName</label>
									<div class="ui icon input">
										<input type="userName" name="userName" placeholder="userName" autocomplete="off" required="required" value="">
										
									</div>
								</div>
								<div class="field">
									<label>Password</label>
									<div class="ui icon input">
										<input type="password" name="userPassword" placeholder="Password" autocomplete="off" required="required" value="">
										
									</div>
								</div>
								<div class="inline field">
									<?php 
									if(!empty($error)){
										echo '<div class="alert alert-danger">'.$error.'</div>';
									}
									?>
								</div>
								<div class="ui one column grid">
									<div class="right aligned column">
										<button type="submit" class="ui green small icon labeled button">Login</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="ui secondary right aligned segment">
				<div align="left">
					<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tentang">Tentang</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#panduan">Panduan</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#faq">FAQ</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#kontak">Kontak</a>
				</div>
				<strong>© 2018 - Diskominfo</strong><br><small>Dinas Komunikasi dan Informatika Kab. Pakpak Bharat</small>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="tentang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tentang Aplikasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					SIMPEMDES adalah
				</div>
				<div class="modal-footer">
					&nbsp;
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="panduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Panduan Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Untuk memulai aplikasi:<br>
				</div>
				<div class="modal-footer">
					&nbsp;
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="kontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Kontak</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<i class="fa fa-phone"> </i> (0627) 743047<br>
					<i class="fa fa-envelope"> </i> diskominfo@pakpakbharatkab.go.id<br>
					<i class="fa fa-globe"></i> <a href="http://diskominfo.pakpakbharatkab.go.id/" target="_blank">diskominfo.pakpakbharatkab.go.id</a><br>
					<i class="fa fa-twitter"></i> <a href="https://twitter.com/diskominfo_pb" target="_blank"> twitter/diskominfo_pb</a><br>
					<i class="fa fa-facebook"></i><a href="https://www.facebook.com/diskominfo.pakpakbharat/" target="_blank"> facebook.com/diskominfo.pakpakbharat/</a>
				</div>
				<div class="modal-footer">
					&nbsp;
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">FAQ (Frequently Asked Questions)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!--       =============   Membuat Collapse ========== -->
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Bagaimana jika saya tidak bisa login?
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									Silahkan menghubungi user pada kontak yang disediakan
								</div>
							</div>
						</div>
						<!--       =============  Akhir Membuat Collapse ========== -->
					</div>
					<div class="modal-footer">
						&nbsp;
					</div>
				</div>
			</div>
		</div>



		<!-- jQuery 2.2.3 -->
		<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo config_item('asset_url'); ?>assets/apps/plugins/iCheck/icheck.min.js"></script>
	</body>
	</html>