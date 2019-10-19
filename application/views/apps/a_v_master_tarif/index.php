<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Master Tarif</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Master tarif</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/a_v_master_tarif/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index1" name="form1">
					<input type="hidden" name="tujuan_id" value="<?php echo $tujuan_id;?>">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Group</th>
									<th>No</th>
									<th>Jenis</th>
									<th>Tarif</th>
								</tr>
							</thead>
							<tbody id="view_data">

							</tbody>
						</table>
					</div>
					<button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	var main = "<?php echo base_url(); ?>apps/a_c_master_tarif/views";

	func_view();

	function func_view(){
		Pace.restart();
		$("#view_data").html(loading_tabel);
		var string = $("#index1").serialize();
		$.ajax({
			type	: 'POST',
			url		: main,
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_data").html(data);
			}
		});
	}

	$("#index1").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_master_tarif/";
			var form_op = "update";
			var string = $("#index1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});

</script>