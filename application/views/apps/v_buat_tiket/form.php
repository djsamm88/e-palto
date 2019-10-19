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
				<h4>No Keberangkatan '<b><?php echo $no_tiket_grp;?></b>'</h4>
				<?php $this->load->view('apps/v_buat_tiket/tab2'); ?>
				<div class="line-h"></div>
				<form id="index1" name="form1" method="POST">
					<input type="hidden" name="id_tiket_grp" value="<?php echo $id_tiket_grp;?>">
					<input type="hidden" name="no_tiket_grp" value="<?php echo $no_tiket_grp;?>">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>Group</th>
									<th>Jenis</th>
									<th>Tarif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<?php
							$i=0;
							$jenis_penumpang_arr = jenis_penumpang();
							foreach ($jenis_penumpang_arr as $key => $value) {
								$arrayGroup =  $this->m_parameter->getParameter($key);
								?>
								<tr>
									<td colspan="4"><b><?php echo $value; ?></b></td>
								</tr>
								<?php
								foreach ($arrayGroup as $rowGroup) {
									$i++;
									$nominal = pasang_titik($edit_tarif[$tujuan_id.$key.$rowGroup['id']]);
									if($key=="penum.kendaraan"){
										$plac1 = "No Polisi";
										$plac2 = "Jenis";
									}else if($key=="penum.orang"){
										$plac1 = "NIK";
										$plac2 = "Nama";
									}else if($key=="penum.paket"){
										$plac1 = "Nama Paket";
										$plac2 = "Keterangan";
									}
									?>
									<tbody id="form_tambahan<?php echo $i;?>">
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo selengkapnya($rowGroup['description']); ?></td>
											<td>
												<input type="hidden" name="coba[<?php echo $i;?>][tujuan_id]" value="<?php echo $tujuan_id ?>">
												<input type="hidden" name="coba[<?php echo $i;?>][jenis_penumpang]" value="<?php echo $key ?>">
												<input type="hidden" name="coba[<?php echo $i;?>][jenis_penumpang_id]" value="<?php echo $rowGroup['id'] ?>">
												<input type="text" name="coba[<?php echo $i;?>][tarif]" value="<?php echo $nominal ?>" class="text-right titik_js" style="max-width: 100px;">
											</td>
											<td>
												<input type="text" name="coba[<?php echo $i;?>][penumpang][nik][]" placeholder="<?php echo $plac1;?>" style="width: 30%;">
												<input type="text" name="coba[<?php echo $i;?>][penumpang][nama][]" placeholder="<?php echo $plac2;?>" style="width: 55%;">
												<a href="javascript:add_isian('<?php echo $i;?>','<?php echo $plac1;?>','<?php echo $plac2;?>')" class="btn btn-info btn-sm" style="margin-top:-5px;"><i class="fa fa-plus"></i></a>
											</td>
										</tr>
									</tbody>
									<?php
								}
							}
							?>

						</table>
					</div>
					<button type="submit" class="btn btn-info btn-block">Cetak</button>
				</form>
			</div>
		</div>
	</div>
</div>
</section>

<script type="text/javascript">
	function add_isian(i,plac1,plac2){
		var method = "<?php echo base_url(); ?>apps/c_buat_tiket/form_tambahan/?i="+i+"&plac1="+plac1+"&plac2="+plac2;
		$.ajax({
			url: method,
			type: "GET",
			success: function(e){
				$("#form_tambahan"+i).append(e);
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});

	}

	$("#index1").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method="<?php echo base_url();?>apps/c_buat_tiket/";
			var form_op = "simpan";
			var string = $("#index1").serialize();
			eksekusi_post_data(method+form_op,string);
		}
		return false;
	});

</script>
</script>