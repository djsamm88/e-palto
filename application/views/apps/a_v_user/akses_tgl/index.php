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
					<input type="hidden" name="userID">
					<input type="hidden" name="userName">
					<input type="hidden" name="realName">
				</form>
				<form id="index1" name="form1">
					<div class="table-responsive">
						<table class="table table-condensed table-striped table-bordered">
							<thead>
								<tr>
									<th>no</th>
									<th>userID</th>
									<th>userName</th>
									<th>realName</th>
									<th>userGroup</th>
									<th>cabang_id</th>
									<th class="text-center">pilih</th>
								</tr>
							</thead>
							<tbody id="view_data">

							</tbody>
						</table>
					</div>
					<div class="row">
						<?php $this->load->view('apps/a_v_user/akses_tgl/tombol'); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

	var main = "<?php echo base_url(); ?>apps/a_c_user/akses_tgl_views";

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

	function akses_tgl_update_confirm() {
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_user/";
			var form_op = "akses_tgl_update";
			var string = $("#index1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method+"akses_tgl");
			});
		}
	}
</script>