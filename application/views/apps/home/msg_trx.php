<?php 
$type = $arrMsg['type'];
$color = $arrMsg['color'];
$caption = $arrMsg['caption'];
$title = $arrMsg['title'];
$message = $arrMsg['message'];
$data_foot = $arrMsg['data_foot'];
$info = $arrMsg['info'];
$url = $arrMsg['url'];
$url_print = $arrMsg['url_print'];
?>
<br>
<br>
<br>
<script type="text/javascript">
	function cetakSlip(url_print){
		var url_print = "<?php echo base_url(); ?>apps/c_lap_tiket/cetak/?"+url_print;
		window.opener=self;
		window.open(url_print,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=324,height=512,left=50,top=50");
	}
	
	
</script>
<div class="row justify-content-md-center">
	<div class="col-4">
		<div class="card <?php echo $color; ?>">
			<div class="card-header">
				<h3 class="card-title text-center">I N F O R M A S I !!!</h3>
			</div>
			<div class="card-body">
				<div class="msg1">
					<p class="caption text-center"><?php echo $caption; ?></p>
					<div class="title">
						<table class="table table-condensed" style="border:none">
							<?php
							$title = explode("|",$title);
							foreach ($title as $keytitle => $valuetitle) {
								$valuetitle = explode(",",$valuetitle);
								echo "<tr>";
								echo "<td style='border:none; padding:0; width:40%'>".$valuetitle[0]."</td>";
								echo "<td style='border:none; padding:0'> : ".$valuetitle[1]."</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
					<div class="message">
						<table class="table table-condensed">
							<tr>
								<th>NIK</th>
								<th>Nama</th>
							</tr>
							<?php
							$message1 = explode("|",$message);
							foreach ($message1 as $keymessage1 => $valuemessage1) {
								$valuemessage2 = explode(",",$valuemessage1);
								echo "<tr>";
								echo "<td class='text-left'>".$valuemessage2[0]."</td>";
								echo "<td class='text-left'>".$valuemessage2[1]."</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
					<h5 class="text-right"><b>Total : Rp.<?php echo $data_foot; ?></b></h5>
					<p class="info txt-<?php echo $color; ?> text-center"><?php echo $info; ?> !!!</p>

					<div class="text-center">
						<div class="btn-group btn-group-justified">
							<?php
							if(!empty($url_print)){
								?>
								<a href="#" onclick="cetakSlip('<?php echo $url_print; ?>');return false;" class="btn btn-warning">cetak tiket</a>
								<script>
								cetakSlip('<?php echo $url_print; ?>');
								</script>
								<?php
							}
							?>
							<a class="btn btn-primary" href="javascript:eksekusi_get('<?php echo base_url(); ?><?php echo $url; ?>')">Lanjut</a>
						</div>
					</div>
					<h5 class="msg1color <?php echo $color; ?>">&nbsp;</h5>
				</div>

			</div>
			<div class="card-footer <?php echo $color; ?>">
			</div>
		</div>
	</div>
</div>
