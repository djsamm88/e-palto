	<?php
		$id_site="";
		$site_group="";
		$judul="";
		$isi="";
		$created_by="";
		$created_on="";
		$updated_by="";
		$updated_on="";
		$nama_lengkap2="";
		$group2="";
		$nama_lengkap3="";
		$group3="";
		foreach ($sql->result() as $row) {
			$id_site = $row->id_site;
			$site_group = $row->site_group;
			$judul = $row->judul;
			$isi = $row->isi;
			$created_by = $row->created_by;
			$created_on = $row->created_on;
			$updated_by = $row->updated_by;
			$updated_on = $row->updated_on;
		}
		foreach ($sql2->result() as $row2) {
			$nama_lengkap2=$row2->nama_lengkap;
			$group2="[".$row2->nama_group."]";
		}
		foreach ($sql3->result() as $row3) {
			$nama_lengkap3=$row3->nama_lengkap;
			$group3="[".$row3->nama_group."]";
		}
	?>

	<div class="table-responsive">
		<table class="table table-condensed table-striped table-line">
			<thead>
				<tr>
					<th colspan="2">Data site</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="span3">id_site</td><td><?php echo $id_site; ?></td>
				</tr>
				<tr>
					<td>site_group</td><td><?php echo $site_group; ?></td>
				</tr>
				<tr>
					<td>judul</td><td><?php echo $judul; ?></td>
				</tr>
				<tr>
					<td>isi</td><td><?php echo $isi; ?></td>
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