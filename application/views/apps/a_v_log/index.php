<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Log Aktifitas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Log Aktifitas</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/a_v_log/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index2" name="form2">
					<input type="hidden" name="page">
					<input type="hidden" name="sidx">
					<input type="hidden" name="sord">
					<input type="hidden" name="limit">
					<input type="hidden" name="id_log">
					<input type="hidden" name="log_kode">
					<input type="hidden" name="nama">
					<input type="hidden" name="log_group">
					<input type="hidden" name="saldo_normal">
					<input type="hidden" name="field5">
					<input type="hidden" name="field6">
					<input type="hidden" name="field7">
					<input type="hidden" name="field8">
					<input type="hidden" name="field9">
				</form>
				<form id="index1" name="form1">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Aksi</th>
									<th>id_username</th>
									<th>ip</th>
									<th>waktu</th>
									<th>url</th>
									<th>aksi</th>
									<th>keterangan</th>
								</tr>
							</thead>
							<tbody id="view_data">

							</tbody>
						</table>
					</div>
					<div class="row">
						<?php $this->load->view('apps/a_v_log/tombol'); ?>
					</div>
				</form>

				<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal Label" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Detail Log Aktifitas</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove"></span></button>
							</div>
							<div class="modal-body">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove"></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	
	var main = "<?php echo base_url(); ?>apps/a_c_log/views";
	var row = "<?php echo base_url(); ?>apps/a_c_log/rows";
	

	func_view();

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