<?php
$tot=0;
foreach ($sql1->result() as $obj1){	
	if($offset==""){$offset=0;}
	$offset++;
	$tot++;
	?>
	<tr>
		<td><?php echo $offset; ?></td>
		<td class="text-center">
			<?php 
			if($access_edit==1){
				?>
				<a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_user/group_edit?groupID=<?php echo $obj1->id ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a>
				<?php
			}
			?>
		</td>
		<td><?php echo $obj1->id; ?></td>
		<td><?php echo $obj1->description; ?></td>
	</tr>
	<?php
}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">