 <div class="row">
 	<?php
 	$tot=0;
 	foreach ($sql1->result() as $obj1){	
 		if($offset==""){$offset=0;}
 		$offset++;
 		$tot++;
 		?>
 		<div class="col-md-3 col-sm-6 col-12">
 			<div class="info-box">
 				<span class="info-box-icon bg-warning"><i class="fa fa-files-o"></i></span>
 				<div class="info-box-content">
 					<span class="info-box-text"><?php echo str_replace("tiket Keterangan","S.Ket.",$obj1->description); ?></span>
 					<a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_buat_tiket/form?id=<?php echo $obj1->id ?>')" class="btn btn-info btn-sm btn-block" style="padding: 0;margin: 1px;"><i class="fa fa-edit"></i>Buat tiket</a>
 					<a href="<?php echo base_url(); ?>apps/c_lap_tiket/format_tiket_pdf?id=<?php echo $obj1->id ?>&description=<?php echo $obj1->description ?>" target="_blank" class="btn btn-success btn-sm btn-block" style="padding: 0;margin: 1px;"><i class="fa fa-eye"></i>Lihat Format</a>
 				</div>
 			</div>
 		</div>
 		<?php
 	}
 	?>
 </div>   
