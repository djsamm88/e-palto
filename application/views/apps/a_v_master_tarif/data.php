<?php

$jenis_penumpang_arr = jenis_penumpang();

foreach ($jenis_penumpang_arr as $key => $value) {
	$arrayGroup =  $this->m_parameter->getParameter($key);
	?>
	<tr>
		<td colspan="4"><b><?php echo $value; ?></b></td>
	</tr>
	<?php
	foreach ($arrayGroup as $rowGroup) {
		$nominal = pasang_titik($edit_tarif[$tujuan_id.$key.$rowGroup['id']]);
		?>
		<tr>
			<td></td>
			<td><?php echo $rowGroup['id']; ?></td>
			<td><?php echo $rowGroup['description']; ?></td>
			<td>
				<input type="hidden" name="jenis_penumpang[]" value="<?php echo $key;?>">
				<input type="hidden" name="tiket_jenis[]" value="<?php echo $rowGroup['id'];?>">
				<input type="text" name="nominal[]" value="<?php echo $nominal; ?>" class="form-control text-right titik_js">
			</td>
		</tr>
		<?php
	}
}

?>

<script type="text/javascript">
	$('.titik_js').on('keyup', function(){
		titik(".titik_js");
	});
</script>