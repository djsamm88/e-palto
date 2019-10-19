<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Keuangan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Laporan Keuangan</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index2" name="form2" method="POST" action="csd.php">
					<input type="hidden" name="page">
					<input type="hidden" name="sidx">
					<input type="hidden" name="sord">
					<input type="hidden" name="limit">
					<div class="table-responsive">
						<table class="table table-condensed" >
							<thead>
								<tr>
									<th width="20%">item</th>
									<th>value</th>
								</tr>
							</thead>

							<tr>
								<td>Tgl Keberangkatan</td>
								<td>
									<table>
										<tr>
											<td>
												<input type="text" name="tgl_awal" value="<?php echo $tanggal_awal ?>" class="tanggal form-control span1 input-sm" readonly="1" id="tgl_awal" style="font-size: 12px"> s/d
											</td>
											<td>
												<input type="text" name="tgl_akhir" value="<?php echo $tanggal_akhir ?>" class="tanggal form-control span1 input-sm" readonly="1" id="tgl_akhir"
												style="font-size: 12px"
												>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<a href="javascript:eksekusi_get('<?php echo base_url();?>apps/c_lap_tiket/lap_tiket_range')" class="btn btn-primary btn-sm">Reset</a>
					<input type="submit" class="btn btn-info btn-sm" value="Tampilkan">
					<input type="button" class="btn btn-info btn-sm" value="download excel" onclick="download_xl()">
				</form>
				
				


				<div class="line-h"></div>
				<form id="index1" name="form1" method="POST" action="#">
					<div class="table-responsive">
						<table class="table table-striped" id="tbl_laporan">
							<thead>
								<tr>
									
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
									foreach ($laporan as $key) 
									{
										$no++;
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
								?>
							</tbody>
						</table>
					</div>


				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	var main = "<?php echo base_url(); ?>apps/c_lap_keuangan/lap_keuangan_range";
	$("#index2").on("submit",function(){

		var tgl_awal = $("#tgl_awal").val();
		var tgl_akhir = $("#tgl_akhir").val();
		eksekusi_get(main+"?tanggal_awal="+tgl_awal+"&tanggal_akhir="+tgl_akhir);

		console.log(main+"?tanggal_awal="+tgl_awal+"&tanggal_akhir="+tgl_akhir);
		return false;
	})

	var main_xl = "<?php echo base_url(); ?>apps/c_lap_keuangan/lap_keuangan_range_xl";
	function download_xl()
	{
		var tgl_awal = $("#tgl_awal").val();
		var tgl_akhir = $("#tgl_akhir").val();
		
		window.opener=self;
		window.open(main_xl+"?tanggal_awal="+tgl_awal+"&tanggal_akhir="+tgl_akhir,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1024,height=512,left=50,top=50");

	}

	$("#tbl_laporan").DataTable({
		        "order": [[ 0, "desc" ]],
		        "pageLength": 50

	});


	function print_tiket(url_print)
	{
		
		var url_print = "<?php echo base_url(); ?>apps/c_lap_keuangan/cetak/?"+url_print;
		window.opener=self;
		window.open(url_print,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=324,height=512,left=50,top=50");

		return false;
	}

</script>
