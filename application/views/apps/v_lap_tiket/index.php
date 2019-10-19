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
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Uraian</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tr class="border-bottom">
							<td width="30">1</td>
							<td>Laporan tiket</td>
							<td width="50">
								<a href="javascript:lap_tiket('lap_tiket1');" class="btn btn-sm btn-info">Pilih</a>
							</td>
						</tr>
						<tr class="border-bottom">
							<td>1</td>
							<td>Laporan</td>
							<td>
								<a href="javascript:lap_tiket('lap_tiket1');" class="btn btn-sm btn-info">Pilih</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function lap_tiket(lap_tiket_link){
		eksekusi_get('<?php echo base_url() ?>apps/c_lap_tiket/?lap_tiket='+lap_tiket_link);
	}
</script>