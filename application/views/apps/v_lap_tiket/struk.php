<style>
html,body{
	margin:0px;
	padding:0px;
}
body,table{
	    text-transform: uppercase;
		font-size:8px;
		font-family:verdana;
}

font-size:10px;
</style>

<body onload='window.print();window.close()'>
<center>
	<?php echo config_item('app_name')?>
	<br>
	<?php echo config_item('app_client2')?>
	<br>
	<?php echo $_SESSION['arrayLogin']['kecamatan_str']; ?>
				-
	<?php echo $_SESSION['arrayLogin']['desa_str']; ?>,
	<?php echo config_item('app_client3')?>
	
</center>

<hr style="border-top: dotted 1px;" />

<table>
<tr>
	<td>Tanggal</td>
	<td>: <?php echo ymd1($penumpang[0]->tanggal)?></td>	
</tr>
<tr>
	<td>No.Keberangkatan</td>
	<td>: <?php echo $no_keberangkatan?></td>	
</tr>
<tr>
	<td>Tujuan</td>
	<td>: <?php echo $penumpang[0]->tujuan?></td>	
</tr>

<tr>
	<td>Nakhoda</td>
	<td>: <?php echo $penumpang[0]->nama_nakhoda?></td>	
</tr>

</table>
<hr style="border-top: dotted 1px;" />
<center>Manifest</center>
<table>
<tr>
	<td>No.ID </td>
	<td>Desc </td>
	<td>Jenis </td>
</tr>
<?php 
	$tot = 0;
	foreach ($penumpang as $key ) 
	{
		$tot+=$key->nominal;
		echo "
				<tr>
					<td>$key->nomor_id</td>
					<td>$key->tiket_nama</td>
					<td><small>".substr($key->jenis_detail,0,20)."</small></td>
				</tr>
		";
	}
	
	echo "
		<tr>
			<td colspan=2><center>Total</center></td>
			<td><b>Rp. ".pasang_titik($tot)."</b></td>
		</tr>
	";
?>
</table>
<hr style="border-top: dotted 1px;" />
<center>
	HAVE A NICE TRIP!
</center>
</body>


<?php 
//var_dump($penumpang);
?>