<h6><b><?php echo $name; ?></b></h6>
<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th class="text-center span1">no</th>
				<th>groups</th>
				<th>nama</th>
				<th>id</th>
				<th>description</th>
				<th>notes</th>
				<th>notes2</th>
				<th class="text-center span2">pilih</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=0;
			foreach ($sql1->result() as $obj1){	
				$no++;
				$groups = $obj1->groups;
				$name = $obj1->name;
				?>
				<tr>
					<td class="text-center"><?php echo $no; ?></td>
					<td><?php echo $obj1->groups;?></td>
					<td><?php echo $obj1->name;?></td>
					<td><?php echo $obj1->id;?></td>
					<td><?php echo selengkapnya($obj1->description);?></td>
					<td><?php echo selengkapnya($obj1->notes);?></td>
					<td><?php echo selengkapnya($obj1->notes2);?></td>
					<td class="text-center">
						<input type="hidden" id="form2_id<?php echo $no; ?>" value="<?php echo $obj1->id; ?>">
						<input type="hidden" id="form2_description<?php echo $no; ?>" value="<?php echo buangbr($obj1->description); ?>">
						<input type="hidden" id="form2_notes<?php echo $no; ?>" value="<?php echo buangbr($obj1->notes); ?>">
						<input type="hidden" id="form2_notes2<?php echo $no; ?>" value="<?php echo buangbr($obj1->notes2); ?>">
						<a href="#pilih" onclick="pilih2('<?php echo $no; ?>','<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','ubah')" class="btn btn-sm btn-warning">ubah</a>
						<a href="#pilih" onclick="pilih2('<?php echo $no; ?>','<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','hapus')" class="btn btn-sm btn-danger">hapus</a>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>

<form id="form_parameter" name="form_parameter" action="#" onSubmit="return validasi_form()">
	<input type="hidden" name="groups" value="<?php echo $groups; ?>">
	<input type="hidden" name="name" value="<?php echo $name; ?>">
	<input type="hidden" name="op" value="<?php echo $op; ?>">
	<input type="hidden" name="idLama" value="<?php echo $idLama; ?>">
	<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th class="span3">Item</th>
					<th>Value</th>
				</tr>
			</thead>
			<tr>
				<td>ID</td>
				<td>
					<input type="text" name="id" class="form-control input-sm">
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea rows="4" name="description" class="form-control input-sm"></textarea>
				</td>
			</tr>
			<tr>
				<td>Notes</td>
				<td>
					<textarea rows="4" name="notes" class="form-control input-sm"></textarea>
				</td>
			</tr>
			<tr>
				<td>Notes2</td>
				<td>
					<textarea rows="4" name="notes2" class="form-control input-sm"></textarea>
				</td>
			</tr>
		</table>
	</div>
	<button class="btn btn-block btn-warning"><span class="btn-keterangan"></span> data</button>
</form>