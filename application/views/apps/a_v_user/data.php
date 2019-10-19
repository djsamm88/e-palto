<?php
$tot=0;
foreach ($sql1->result() as $obj1){	
	if($offset==""){$offset=0;}
	$offset++;
	$tot++;
	$getparameter1 = $this->m_parameter->getParameterArray($obj1->userGroup,'user.group');
	$getparameter2 = $this->m_parameter->getParameterArray($obj1->userStatus,'user.status');
	$statusLogin = $this->m_user->cek_logon($obj1->userID);
	?>
	<tr>
		<td><?php echo $offset; ?></td>
		<td class="text-center">
			<div class="btn-group">
				<?php 
				if($access_view==1){
					?>
					<a href="javascript:eksekusi_modal('<?php echo base_url(); ?>apps/a_c_user/detail/<?php echo $obj1->userID ?>')" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Lihat</a>
					<?php
				}
				if($access_edit==1){
					?>
					<a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_user/edit/<?php echo $obj1->userID ?>')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a>
					<?php
				}
				?>
			</div>
		</td>
		<td><?php echo "[".$obj1->userID."]"; ?></td>
		<td><?php echo $obj1->userName; ?></td>
		<td><?php echo $obj1->realName; ?></td>
		<td><?php echo $getparameter1['description']; ?></td>
		<td><?php echo $obj1->kecamatan_id; ?></td>
		<td class="text-center">
			<?php
			if($obj1->userStatus==1){
				echo "<label class='label label-success label-sm'>".$getparameter2['description']."</label>";
			}
			else if($obj1->userStatus==2){
				echo "<label class='label label-default label-sm'>".$getparameter2['description']."</label>";
			}
			else{
				echo "<label class='label label-danger label-sm'>".$getparameter2['description']."</label>";
			}
			?>
		</td>
		<td class="text-center">
			<?php
			if($statusLogin=="Log Off"){
				echo "<label class='label label-default'>Log Off</label>";
			}
			else{
				echo "<label class='label label-success'>Log On</label>";
			}
			?>
		</td>
		<td class="text-center">
			<?php 
			if($access_view==1){
				?>
				<input type="checkbox" id="pilih" name="pilih[]" value="<?php echo $obj1->userID;?>">
				<?php
			}
			?>
		</td>
	</tr>
	<?php
}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">