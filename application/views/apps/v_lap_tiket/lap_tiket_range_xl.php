<style>
html,body{
	margin:0px;
	padding:0px;
}
body,table{
	    text-transform: uppercase;
		font-size:10px;
		font-family:verdana;
}

#tbl_laporan_2 {
    border-collapse: collapse;
}

.atas{
	font-weight: bold;
}
</style>
<table>
	<tr>
		<td>Laporan Manifest <?php echo $this->input->get('tanggal_awal')?> sd <?php echo $this->input->get('tanggal_akhir')?></td>
	</tr>
</table>


<table class="table table-striped" id="tbl_laporan_2">
	<thead>
		<tr class="atas">
			<td>id_tiket_grp</td>
			<td>Tanggal</td>	
			<td>Trip</td>
			<td>Tujuan</td>
			<td>Nakhoda</td>									

			<td>ID</td>
			<td>Desc</td>
			<td>Kode Penumpang</td>
			<td>Detail Penumpang</td>
			
			
		</tr>
	</thead>
	<tbody id="view_data">
		<?php 
			foreach ($laporan as $key) 
			{
				$url_print = "tiket_nobat=$key->tiket_nobat&no_keberangkatan=$key->no_tiket_grp";
				echo "
						<tr>
							<td>$key->id_tiket_grp</td>
							<td>".ymd1($key->tanggal)."</td>										
							<td>$key->no_tiket_grp</td>
							<td>$key->tujuan</td>
							<td>".strtoupper($key->nama_nakhoda)."</td>							
							<td>".strtoupper($key->nomor_id)."</td>
							<td>".strtoupper($key->tiket_nama)."</td>
							<td>$key->jenis_penumpang</td>
							<td>$key->jenis_detail</td>
							
						</tr>
				";
			}
		?>
	</tbody>
</table>