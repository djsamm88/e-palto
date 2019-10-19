<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Akses Group Pengguna</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Akses Group Pengguna</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/a_v_user/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index2" name="form2">
					<input type="hidden" name="page">
					<input type="hidden" name="sidx">
					<input type="hidden" name="sord">
					<input type="hidden" name="limit">
					<input type="hidden" name="id">
					<input type="hidden" name="description">
					<input type="hidden" name="realName">
					<input type="hidden" name="field3">
					<input type="hidden" name="field4">
					<input type="hidden" name="field5">
					<input type="hidden" name="field6">
					<input type="hidden" name="field7">
					<input type="hidden" name="field8">
					<input type="hidden" name="field9">
				</form>
				<form id="index1" name="form1">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">no</th>
									<th class="text-center">pilih</th>
									<th>id</th>
									<th>description</th>
								</tr>
							</thead>
							<tbody id="view_data">

							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	var main = "<?php echo base_url(); ?>apps/a_c_user/group_views";

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
	
</script>