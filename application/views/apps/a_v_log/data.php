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
			<a href="javascript:eksekusi_modal('<?php echo base_url(); ?>apps/a_c_log/detail/<?php echo $obj1->logID ?>')" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> lihat</a>
		</td>
		<td><?php echo $obj1->userName;?></td>
		<td><?php echo $obj1->accessIP;?></td>
		<td><?php echo dmyTime($obj1->accessTime);?></td>
		<td><?php echo $obj1->accessUrl;?></td>
		<td><?php echo $obj1->accessAction;?></td>
		<td><?php echo substr(buang_tag_html($obj1->accessDescription),0,30);?> ...</td>
	</tr>
	<?php
}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">