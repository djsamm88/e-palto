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

#tbl_laporan_1 {
    border-collapse: collapse;
}

.atas{
	font-weight: bold;
}
</style>
<table>
	<tr>
		<td><b>Laporan Manifest Trip <?php echo $laporan[0]->no_tiket_grp?> Tanggal <?php echo ymd1($laporan[0]->tanggal)?></b></td>
	</tr>
	<tr>
		<td>Nakhoda oleh <?php echo $laporan[0]->nama_nakhoda?></td>
	</tr>
</table>


<table class="table table-striped" id="tbl_laporan_1" border="1px">
	<thead>
		<tr class="atas">
						
			<td>No.</td>
			<td>Tujuan</td>
			<td>ID</td>
			<td>Desc</td>
			<td>Kode Penumpang</td>
			<td>Detail Penumpang</td>
			<td>Nominal</td>
			
			
		</tr>
	</thead>
	<tbody id="view_data">
		<?php 
			$no=0;
			$total=0;
			foreach ($laporan as $key) 
			{
				
				$no++;

				$total+=$key->nominal;
				$url_print = "tiket_nobat=$key->tiket_nobat&no_keberangkatan=$key->no_tiket_grp";
				echo "
						<tr>							
							<td>$no</td>														
							<td>".strtoupper($key->tujuan)."</td>														
							<td>".strtoupper($key->nomor_id)."</td>
							<td>".strtoupper($key->tiket_nama)."</td>
							<td>$key->jenis_penumpang</td>
							<td>$key->jenis_detail</td>
							<td align=right>".pasang_titik($key->nominal)."</td>
							
						</tr>
				";
			}

			echo "
				<tr>
					<td colspan=6><center>Total</center></td><td align=right><b>".pasang_titik($total)."</b></td>
				</tr>
			";
		?>
	</tbody>
</table>



