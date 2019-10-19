	<?php
		$userID="";
		$userName="";
		$realName="";
		$userDescription="";
		$userGroup="";
		$kecamatan_id="";
		foreach ($sql1->result() as $obj1){	
			$userID = $obj1->userID;
			$userName = $obj1->userName;
			$realName = $obj1->realName;
			$userDescription = $obj1->userDescription;
			$userGroup = $obj1->userGroup;
			$kecamatan_id = $obj1->kecamatan_id;
			$created_by = $obj1->created_by;
			$created_on = $obj1->created_on;
			$updated_by = $obj1->updated_by;
			$updated_on = $obj1->updated_on;
		}
	?>

	<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th colspan="2">Data User</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="span3">userID</td><td><?php echo $userID; ?></td>
				</tr>
				<tr>
					<td>userName</td><td><?php echo $userName; ?></td>
				</tr>
				<tr>
					<td>realName</td><td><?php echo $realName; ?></td>
				</tr>
				<tr>
					<td>userDescription</td><td><?php echo $userDescription; ?></td>
				</tr>
				<tr>
					<td>userGroup</td><td><?php echo $userGroup; ?></td>
				</tr>
				<tr>
					<td>kecamatan_id</td><td><?php echo $kecamatan_id; ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th colspan="2">Data User</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td>Created By</td><td><?php echo $nama_lengkap2." ".$group2; ?></td>
				</tr>
				<tr>
					<td>Created On</td><td><?php echo $created_on; ?></td>
				</tr>
				<tr>
					<td>Updated By</td><td><?php echo $nama_lengkap3." ".$group3; ?></td>
				</tr>
				<tr>
					<td>Updated On</td><td><?php echo $updated_on; ?></td>
				</tr>
			</tfoot>
		</tbody>
	</table>
</div>