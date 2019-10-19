<?php
	$tot=0;
	foreach ($sql1->result() as $obj1){	
		if($offset==""){$offset=0;}
		$offset++;
		$tot++;
	   ?>
			<tr>
				<td><p class="text-center"><?php echo $offset; ?></p></td>
				<td>
					<?php 
						if($access_edit==1){
							?>
								<a href="#edit" onclick="edit('<?php echo $obj1->id_site ?>','<?php echo $site_group;?>')" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
							<?php
						}
					?>
					
				</td>
				<td><?php echo $obj1->judul;?></td>
				<td><?php echo $obj1->created_on;?></td>
				<td>
					<?php 
						if($access_view==1 || $access_update==1 || $access_delete==1){
							?>
							<p class="text-center">
								<input type="checkbox" id="pilih" name="pilih[]" value="<?php echo $obj1->id_site;?>">
							</p>
							<?php
						}
					?>
				</td>
			</tr>
		<?php
	}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">