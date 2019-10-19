<?php 
$type = $_SESSION['arrMsg']['type'];
$color = $_SESSION['arrMsg']['color'];
$caption = $_SESSION['arrMsg']['caption'];
$title = $_SESSION['arrMsg']['title'];
$message = $_SESSION['arrMsg']['message'];
$info = $_SESSION['arrMsg']['info'];
$url = $_SESSION['arrMsg']['url'];
?>


<h3 class="text-center"><?php echo config_item('app_name'); ?></h3>
<h5 class="text-center"><b><?php echo config_item('app_client1'); ?></b></h5>
<h4 class="text-center"><?php echo config_item('app_client2'); ?></h4>


<div class="row justify-content-md-center">
	<div class="col-4">
		<div class="card text-center <?php echo $color; ?>">
			<div class="card-header">
				<h3 class="card-title">I N F O R M A S I !!!</h3>
			</div>
			<div class="card-body">
				<h5><?php echo $caption; ?></h5>
				<p><?php echo $message; ?></p>
				<p><?php echo $info; ?> !!!</p>
				<a class="btn btn-info" href="<?php echo base_url(); ?><?php echo $url; ?>">Lanjut</a>
			</div>
			<div class="card-footer <?php echo $color; ?>">
			</div>
		</div>
	</div>
</div>

