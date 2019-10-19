<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url();?>apps/home" class="brand-link bg-success">
		<img src="<?php echo config_item('asset_url'); ?>assets/apps/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<span class="brand-text font-weight-light"><b><?php echo config_item('app_client1'); ?></b></span>
	</a>
	<style type="text/css">
	#style-1::-webkit-scrollbar {
		width: 10px;
		background-color: #F5F5F5;
	}
	#style-1::-webkit-scrollbar-thumb {
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #999;
	}
	#style-1::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		border-radius: 10px;
		background-color: #F5F5F5;
	}
</style>
<!-- Sidebar -->
<div class="sidebar force-overflow" id="style-1">
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img style="margin-top: 23px;" src="<?php echo config_item('asset_url'); ?>assets/apps/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
		</div>
		<div class="info" style="margin: 0 5px;padding: 0 5px;">
			<a href="#" class="d-block" style="margin: 0;padding: 0">
				[<?php echo $_SESSION['arrayLogin']['userID']; ?>]
				[<?php echo $_SESSION['arrayLogin']['userName']; ?>]
			</a>
			<span style="color: #eee;"><?php echo $_SESSION['arrayLogin']['realName']; ?></span><br>
			<span style="color: #eee;"><?php echo $_SESSION['arrayLogin']['userGroupStr'] ?></span>
		</div>
	</div>
	<!-- Sidebar Menu -->
	<nav class="mt-2" id="cssmenu">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<?php
			$arr_menu = config_item('arr_menu');
			$i=0;
			foreach ($arr_menu as $key_menu => $value_menu) {
				$i++;
				$arr_menu1 = explode("|",$arr_menu[$i][1]);
				?>
				<li class="nav-item has-treeview menu-open" id="MENU1-<?php echo $arr_menu1[1];?>">
					<a href="#" class="nav-link active" id="<?php echo $arr_menu1[1];?>">
						<i class="nav-icon fa fa-hand-o-right"></i>
						<p>
							<?php echo $arr_menu1[1];?>
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" id="MENU2-<?php echo $arr_menu1[1];?>">
						<?php
						for ($j=1; $j <count($arr_menu[$i]) ; $j++) { 
							$arr_key_menu1 = explode("|", $arr_menu[$i][$j+1]);
							if($_SESSION['arrList'][$arr_key_menu1[0]]['view']==1){
								?>
								<li class="nav-item">
									<a href="javascript:eksekusi_get('<?php echo base_url();?><?php echo $arr_key_menu1[1]; ?>')" class="nav-link">
										<i class="fa fa-arrow-circle-right nav-icon"></i>
										<p><?php echo $arr_key_menu1[2]; ?></p>
									</a>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</li>
				<?php
			}
			?>	
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="page_content">