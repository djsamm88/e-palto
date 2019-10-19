<?php
foreach ($sql1->result() as $obj1) {
	if($offset==""){$offset=0;}
	$offset++;

	$b = $this->m_parameter->getParameterArray($obj1->id_jenis_tiket,'jenis.tiket');
	echo "<tr>";
	echo "<td class='text-center'>".$offset."</td>";
	?>
	<td class="text-center">
		<a href="<?php echo base_url(); ?>apps/c_lap_tiket/downlod_tiket_pdf?id_tiket=<?php echo $obj1->id_tiket ?>&id_jenis_tiket=<?php echo $obj1->id_jenis_tiket ?>&description=<?php echo $b['description'] ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download tiket</a>
	</td>
	<?php
	echo "<td>[".$obj1->id_jenis_tiket."]".$b['description']."</td>";
	echo "<td>".$obj1->pem_Nama."</td>";
	echo "</tr>";
}
?>