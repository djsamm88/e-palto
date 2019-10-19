<?php
$tot=0;
foreach ($sql1->result() as $obj1){	
	if($offset==""){$offset=0;}
	$offset++;
	$tot++;
	$getparameter1 = $this->m_parameter->getParameterArray($obj1->userGroup,'user.group');
	?>
	<tr>
		<td><?php echo $offset; ?></td>
		<td><?php echo "[".$obj1->userID."]"; ?></td>
		<td><?php echo $obj1->userName; ?></td>
		<td><?php echo $obj1->realName; ?></td>
		<td><?php echo $getparameter1['description']; ?></td>
		<td><?php echo $obj1->cabang_id; ?></td>
		<td class="text-center">
			<?php 
			if($access_edit){
				?>
				<input type='hidden' value='0' name='pilih[<?php echo $obj1->userID;?>]'>
				<input type="checkbox" id="pilih" name="pilih[<?php echo $obj1->userID;?>]" value="1" <?php if($obj1->accessDate==1){ echo "checked"; } ?>>
				<?php
			}
			?>
		</td>
	</tr>
	<?php
}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">