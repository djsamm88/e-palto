<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Buat Keberangkatan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Buat Keberangkatan</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_buat_tiket/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form class="form-inline" name="form1" id="form1" method="POST" action="#">
					<select name="nakhoda_id" class="form-control mb-2 mr-sm-2" required="1">
						<option value="">Pilih Nakhoda</option>
						<?php
						$arrayGroup =  $this->m_parameter->getParameter('daftar.nakhoda');
						foreach ($arrayGroup as $rowGroup) {
							?>
							<option value="<?php echo $rowGroup['id']; ?>"><?php echo $rowGroup['id']; ?> - <?php echo $rowGroup['description']; ?></option>
							<?php
						}
						?>
					</select>
					<div class="input-group mb-2 mr-sm-2">
						<input name="keterangan" type="text" class="form-control" placeholder="Keterangan">
					</div>
					<button type="submit" class="btn btn-primary mb-2">Buat Keberangkatan Baru</button>
				</form>
				<div class="line-h"></div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center">No Keberangkatan</th>
								<th class="text-center">Nakhoda</th>
								<th class="text-center">Waktu</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($data_keberangkatan->result() as $key => $value) {
								?>
								<tr>
									<td class="text-center"><?php echo $value->no_tiket_grp;?></td>
									<td class="text-center"><?php echo $value->nama_nakhoda;?></td>
									<td class="text-center"><?php echo dmyTime($value->dt_created);?></td>
									<td class="text-center">
										<a href="javascript:input_penumpang('<?php echo $value->id_tiket_grp;?>','<?php echo $value->no_tiket_grp;?>');" class="btn btn-sm btn-warning">Buat Tiket / Masukkan Penumpang</a>
										<a href="javascript:lihat_group('<?php echo $value->id_tiket_grp;?>')" class="btn btn-sm btn-info">Lihat Daftar Penumpang</a>
										<a href="javascript:selesai('<?php echo $value->id_tiket_grp;?>');" class="btn btn-sm btn-success">Selesai/Berangkat</a>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</section>


<script type="text/javascript">


	$("#form1").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method="<?php echo base_url();?>apps/c_buat_tiket/";
			var form_op = "baru";
			var string = $("#form1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});

	
	function selesai(id_tiket_grp) {
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/c_buat_tiket/";
			var form_op = "selesai/?id_tiket_grp="+id_tiket_grp;
			var string = "";
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
	}

	function input_penumpang(id_tiket_grp,no_tiket_grp) {
		var method = "<?php echo base_url(); ?>apps/c_buat_tiket/form/?id_tiket_grp="+id_tiket_grp+"&no_tiket_grp="+no_tiket_grp;
		eksekusi_get(method);
	}


	function lihat_group(id_tiket_grp){
		var url_print = "<?php echo base_url(); ?>apps/c_lap_tiket/lap_tiket_by_trip/?id_tiket_grp="+id_tiket_grp;
		window.opener=self;
		window.open(url_print,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1024,height=512,left=50,top=50");
	}
	
	
</script>