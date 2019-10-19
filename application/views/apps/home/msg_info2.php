<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/menu_horizontal1/css/demo.css">
<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/menu_horizontal1/css/menu.css">
<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/bootstrap/css/msg.css">
<?php 
	$type = $_SESSION['arrMsg']['msg']['type'];
	$color = $_SESSION['arrMsg']['msg']['color'];
	$caption = $_SESSION['arrMsg']['msg']['caption'];
	$title = $_SESSION['arrMsg']['msg']['title'];
	$message = $_SESSION['arrMsg']['msg']['message'];
	$info = $_SESSION['arrMsg']['msg']['info'];
	$url = $_SESSION['arrMsg']['msg']['url'];
?>
<div class="msg1">
	<h2 class="msg1color <?php echo $color; ?>">I N F O R M A S I !!!</h2>
	<p class="caption"><?php echo $caption; ?></p>
	<div class="title">
		<table class="table table-condensed" style="border:none">
			<?php
				$title = explode("|",$title);
				foreach ($title as $keytitle => $valuetitle) {
					echo "<tr>";
					echo "<td style='border:none; padding:1px; text-align:left'>".$valuetitle."</td>";
					echo "</tr>";
				}
			?>
		</table>
	</div>
	<p class="info txt-<?php echo $color; ?>"><?php echo $info; ?> !!!</p>
	<p class="tombol"><a class="btn btn-<?php echo $color; ?>" href="<?php echo base_url(); ?><?php echo $url; ?>">Lanjut</a></p>
	<h5 class="msg1color <?php echo $color; ?>">&nbsp;</h5>
</div>