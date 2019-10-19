<?php
	$tot=0;
	foreach ($sql1->result() as $obj1){	
		if($offset==""){$offset=0;}
		$offset++;
		$tot++;
		$pClass = "";

		$jlhAnggota1 = $this->m_kecamatan->getJlhAnggota($obj1->kecamatan_id,$obj1->desa_id,1);
		$jlhAnggotaN1 = $this->m_kecamatan->getNotJlhAnggota($obj1->kecamatan_id,$obj1->desa_id,1);

		$totalJlhAnggota1 += $jlhAnggota1;
		$totalJlhAnggotaN1 += $jlhAnggotaN1;

		if($obj1->desa_id=="000"){
			?>
				<tr>
					<td class="text-center"><?php echo $offset;?></td>
					<td class="<?php echo $pClass; ?>"><b><?php echo $obj1->kecamatan_id;?></b></td>
					<td class="<?php echo $pClass; ?>"><b><?php echo $obj1->nama;?></b></td>
					<td class="<?php echo $pClass; ?>"><b><?php echo $obj1->pimpinan;?></b></td>
				</tr>
			<?php
		}
		else{
			?>
				<tr>
					<td class="text-center"><?php echo $offset;?></td>
					<td class="<?php echo $pClass; ?>"><?php echo $obj1->kecamatan_id;?>.<?php echo $obj1->desa_id;?></td>
					<td class="<?php echo $pClass; ?>"><?php echo $obj1->nama;?></td>
					<td class="<?php echo $pClass; ?>"><?php echo $obj1->pimpinan;?></td>
				</tr>
			<?php
		}
	}
?>
<!--<tr style="background: #ccc; color: #333; font-size: 14px;">
	<th colspan="3">Total</th>
	<th class="text-right"><?php echo pasang_titik($totalJlhAnggota1); ?></th>
	<th class="text-right"><?php echo pasang_titik($totalJlhAnggotaN1); ?></th>
</tr>-->
