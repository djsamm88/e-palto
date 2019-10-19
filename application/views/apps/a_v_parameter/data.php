<?php
	$tot=0;
	foreach ($sql1->result() as $obj1){	
		if($offset==""){$offset=0;}
		$offset++;
		$tot++;
	   ?>
			<tr>
				<td class="text-center"><?php echo $offset; ?></td>
				<td><?php echo $obj1->groups;?></td>
				<td><?php echo $obj1->name;?></td>
				<td class="text-center">
					<a href="#pilih" onclick="pilih('<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','tambah')" class="btn btn-sm btn-info">pilih</a>
				</td>
			</tr>
		<?php
	}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">