<nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<span class="nav-link" style="color: #fff;">
				<?php echo $_SESSION['arrayLogin']['kecamatan_str']; ?>
				-
				<?php echo $_SESSION['arrayLogin']['desa_str']; ?>
			</span>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a  href="<?php echo base_url();?>apps/logout" class="nav-link">
				<i class="fa fa-sign-out"></i> Logout
			</a>
		</li>
	</ul>
</nav>
