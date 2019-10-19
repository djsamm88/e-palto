<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Daftar Kecamatan-Desa</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Daftar Kecamatan-Desa</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/a_v_kecamatan/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<?php
				$kecamatan_idGet = $_GET['kecamatan_idGet'];
				$kecamatan_id = $_GET['kecamatan_id'];
				$desa_id = $_GET['desa_id'];
				$op = $_GET['op'];
				?>
				<form id="form3" name="form3" method="GET" action="#">
					<div class="table-responsive">
						<table class="table table-condensed">
							<tr>
								<td>Pilih kecamatan</td>
								<td>
									<select name="kecamatan_idGet" class="form-control span4">
										<option value="0000000">Pilih</option>
										<?php
										$arrkecamatan = $this->m_kecamatan->getkecamatan();
										foreach ($arrkecamatan as $val1) {
											$x = cek_select_option($val1['kecamatan_id'],$kecamatan_idGet);
											echo "<option ".$x." value='".$val1['kecamatan_id']."'>".$val1['kecamatan_id']." - ".$val1['nama']."</option>";
										}
										?>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<button class="btn btn-primary btn-sm">tampilkan</button>
				</form>
				<?php if($kecamatan_idGet!=""){ ?>
				<div class="line-h"></div>
				<div class="table-responsive">

					<table class="table table-condensed">
						<thead>
							<tr>
								<th class="span1">No</th>
								<th class="span2">Kode Kec/Des</th>
								<th>Nama Kec/Des</th>
								<th>Camat/Kep.Des</th>
								<th class="span2 text-center">AKSI</th>
							</tr>
						</thead>
						<?php
						if($kecamatan_idGet=="0000000"){
							$arrkecamatan2 = $this->m_kecamatan->getkecamatan();
							$kategori = "kecamatan";
							$kecamatan_id_r = "";
							$desa_id_r = "readonly";
						}
						else if($kecamatan_idGet!="0000000"){
							$arrkecamatan2 = $this->m_kecamatan->getdesa2($kecamatan_idGet);
							$kategori = "desa";
							$kecamatan_id_r = "readonly";
							$desa_id_r = "";
						}
						$no=0;
						foreach ($arrkecamatan2 as $val2) {
							$no++;
							echo "<tr>";
							echo "<td>".$no."</td>";
							echo "<td>".$val2['kecamatan_id'].".".$val2['desa_id']."</td>";
							echo "<td>".$val2['nama']."</td>";
							echo "<td>".$val2['pimpinan']."</td>";
							echo "<td class='w2-btn text-center'>";
							?>
							<div class="btn-group">
								<a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_kecamatan/edit/?kecamatan_idGet=<?php echo $kecamatan_idGet; ?>&kecamatan_id=<?php echo $val2['kecamatan_id']; ?>&op=edit&desa_id=<?php echo $val2['desa_id']; ?>')" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Ubah</a>
								<a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_kecamatan/edit/?kecamatan_idGet=<?php echo $kecamatan_idGet; ?>&kecamatan_id=<?php echo $val2['kecamatan_id']; ?>&op=hapus&desa_id=<?php echo $val2['desa_id']; ?>')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Hapus</a>
							</div>
							<?php
							echo "</td>";
							echo "</tr>";
						}
						?>
					</table>
				</div>
				<?php
				if($op=="edit" || $op=="hapus"){
					$arrkecamatan3 = $this->m_kecamatan->detail($kecamatan_id,$desa_id);
					$kecamatan_id = $arrkecamatan3['kecamatan_id'];
					$desa_id = $arrkecamatan3['desa_id'];
					$nama = $arrkecamatan3['nama'];
					$pimpinan = $arrkecamatan3['pimpinan'];
				}else{
					if($kecamatan_idGet=="0000000"){
						$desa_id = "000";
					}else if($kecamatan_idGet!="0000000"){
						$kecamatan_id = $kecamatan_idGet;
					}

				}
				?>
				<div class="line-h"></div>
				<form id="form4" name="form4" method="POST" action="#">
					<input type="hidden" name="kecamatan_idGet" value="<?php echo $kecamatan_idGet; ?>">
					<input type="hidden" name="kecamatan_idLama" value="<?php echo $kecamatan_id; ?>">
					<input type="hidden" name="desa_idLama" value="<?php echo $desa_id; ?>">
					<input type="hidden" name="op" value="<?php echo $op; ?>">
					<input type="hidden" name="kategori" value="<?php echo $kategori; ?>">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th class="span3">Item</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Kode Kecamatan</td>
									<td><input type="text" name="kecamatan_id" value="<?php echo $kecamatan_id; ?>" class="form-control span3" required="1" minlength="7" maxlength="7" <?php echo $kecamatan_id_r; ?>></td>
								</tr>
								<tr>
									<td>Kode desa</td>
									<td><input type="text" name="desa_id" value="<?php echo $desa_id; ?>" class="form-control span3" required="1" minlength="3" maxlength="3" <?php echo $desa_id_r; ?>></td>
								</tr>
								<tr>
									<td>Nama Kec/Des</td>
									<td><input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control span4" required="1"></td>
								</tr>
								<tr>
									<td>Camat/Kep.Des</td>
									<td><input type="text" name="pimpinan" value="<?php echo $pimpinan; ?>" class="form-control span4" required="1"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<button class="btn btn-block btn-<?php if($op==""){ echo "primary"; } else if($op=="edit"){ echo "warning"; } else { echo "danger"; } ?>"><?php if($op=="edit"){ echo "ubah"; }else if($op=="hapus"){echo "hapus";} else{echo "tambah";} ?> data</button>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$("#form3").submit(function(){
		var method = "<?php echo base_url(); ?>apps/a_c_kecamatan/";
		var form_op = "edit";
		var string = $("#form3").serialize();
		eksekusi_get_data(method+form_op,string);
		return false;
	});

	$("#form4").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_kecamatan/";
			var form_op = "update";
			var string = $("#form4").serialize();
			var string2 = $("#form3").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get_data(method+"edit",string2);
			});
		}
		return false;
	});
</script>