<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/menu_horizontal1/css/demo.css">
<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/menu_horizontal1/css/menu.css">
<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/bootstrap/css/msg.css">
<div class="msg1">
	<h2 class="msg1color <?php echo $color; ?>">I N F O R M A S I !!!</h2>
	<p class="caption"><?php echo $caption; ?></p>
	<p class="info txt-<?php echo $color; ?>"><?php echo $info; ?> !!!</p>
	<p class="tombol"><a class="btn btn-<?php echo $color; ?>" href="javascript:eksekusi_get('<?php echo base_url(); ?><?php echo $url; ?>')">Lanjut</a></p>
	<h5 class="msg1color <?php echo $color; ?>">&nbsp;</h5>
</div>