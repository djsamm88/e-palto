<ul class="nav nav-tabs">
	<?php 
	$arrayGroup =  $this->m_parameter->getParameter('rute.tujuan');
	foreach ($arrayGroup as $rowGroup) {
		?>
		<li class="nav-item"><a class="nav-link <?php if($tab==$rowGroup['id']){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_master_tarif/?tujuan_id=<?php echo $rowGroup['id'];?>')"><?php echo $rowGroup['id']." - ".$rowGroup['description']; ?></a></li>
		<?php
	}
	?>
</ul>
