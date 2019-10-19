<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan tiket</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Laporan tiket</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_lap_tiket/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index2" name="form2" method="POST" action="csd.php">
					<input type="hidden" name="page">
					<input type="hidden" name="sidx">
					<input type="hidden" name="sord">
					<input type="hidden" name="limit">
					<div class="table-responsive">
						<table class="table table-condensed">
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
												<input type="text" name="tgl_awal" value="<?php echo $tanggal ?>" class="tanggal form-control span1 input-sm" readonly="1"> s/d
											</td>
											<td>
												<input type="text" name="tgl_akhir" value="<?php echo $tanggal ?>" class="tanggal form-control span1 input-sm" readonly="1">
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<a href="javascript:eksekusi_get('<?php echo base_url();?>apps/c_lap_tiket/?lap_tiket=lap_tiket1')" class="btn btn-primary btn-sm">Reset</a>
					<input type="submit" class="btn btn-info btn-sm" value="Tampilkan">
				</form>
				<div class="line-h"></div>
				<form id="index1" name="form1" method="POST" action="#">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Aksi</th>
									<th>id_jenis_tiket</th>
									<th>pem_Nama</th>
								</tr>
							</thead>
							<tbody id="view_data">

							</tbody>
						</table>
					</div>

					<p class="text-center"><?php $this->load->view('apps/pager'); ?></p>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

	var main = "<?php echo base_url(); ?>apps/c_lap_tiket/lap_tiket1_data";
	var row = "<?php echo base_url(); ?>apps/c_lap_tiket/lap_tiket1_data/?row=1";

	$("#index2").submit(function(){
		func_refresh();
		return false;
	});

	function func_refresh(){
		document.form2.page.value="";
		document.form2.sidx.value="";
		document.form2.sord.value="";
		document.form2.limit.value="";
		document.form1.limit.value="<?php echo config_item('displayperpage') ?>";
		$("#page").val(1);
		func_view();
	}
</script>