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
		<td>Laporan keuangan <?php echo $this->input->get('tanggal_awal')?> sd <?php echo $this->input->get('tanggal_akhir')?></td>
	</tr>
</table>


<table border=1 id="tbl_laporan_2">
	<thead>
		<tr class="atas">
			<td>No</td>
			<td align=right>Tanggal</td>
			<td align=right>Penumpang Orang</td>
			<td align=right>Penumpang Kendaraan</td>
			<td align=right>Penumpang Paket</td>
			<td align=right>Nominal</td>
			
			
		</tr>
	</thead>
	<tbody id="view_data">
		<?php 
			$no=0;
			$total_penum_orang = 0;
			$total_penum_kendaraan = 0;
			$total_penum_paket = 0;
			$total_nominal = 0;
			foreach ($laporan as $key) 
			{
				$no++;

				$total_penum_orang += $key->penum_orang;
				$total_penum_kendaraan += $key->penum_kendaraan;
				$total_penum_paket += $key->penum_paket;
				$total_nominal += $key->nominal;

				echo "
						<tr>
							<td>$no</td>
							<td align=right>".ymd1($key->tanggal)."</td>
							<td align=right>$key->penum_orang</td>
							<td align=right>$key->penum_kendaraan</td>
							<td align=right>$key->penum_paket</td>
							<td align=right>".pasang_titik($key->nominal)."</td>
							
						</tr>
				";
			}
			echo "
					<tr>
						<td colspan=2><b><center>Total</center></b></td>
						<td align=right>$total_penum_orang</td>
						<td align=right>$total_penum_kendaraan</td>
						<td align=right>$total_penum_paket</td>
						<td align=right><b>".pasang_titik($total_nominal)."</b></td>

					</tr>
			";
		?>
	</tbody>
</table>