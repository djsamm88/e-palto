<ul class="nav nav-tabs">
	<?php 
	$arrayGroup =  $this->m_parameter->getParameter('rute.tujuan');
	foreach ($arrayGroup as $rowGroup) {
		?>
		<li class="nav-item"><a class="nav-link <?php if($tujuan_id==$rowGroup['id']){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_buat_tiket/form/?tujuan_id=<?php echo $rowGroup['id'];?>&id_tiket_grp=<?php echo $id_tiket_grp;?>&no_tiket_grp=<?php echo $no_tiket_grp;?>')"><?php echo $rowGroup['id']." - ".$rowGroup['description']; ?></a></li>
		<?php
	}
	?>
</ul>
