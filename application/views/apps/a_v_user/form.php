<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Daftar Pengguna</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Daftar Pengguna</li>
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
				<?php 
				$userID="";
				$userName="";
				$realName="";
				$userGroup="";
				$kecamatan_id="";
				$desa_id="";
				$userDescription="";
				if($form_op=="update"){
					foreach ($sql1->result() as $row1) {
						$userID=$row1->userID;
						$userName=$row1->userName;
						$realName=$row1->realName;
						$userGroup=$row1->userGroup;
						$userStatus=$row1->userStatus;
						$kecamatan_id=$row1->kecamatan_id;
						$desa_id=$row1->desa_id;
						$userDescription=$row1->userDescription;
					}
				}
				?>
				<form id="form3" name="form3" method="POST" action="#">
					<input type="hidden" name="userID" value="<?php echo $userID; ?>" readonly>
					<table class="table table-condensed">
						<tr>
							<td>userName</td>
							<td colspan="2"><input type="text" name="userName" value="<?php echo $userName; ?>" class="form-control" <?php if($form_op=="update"){ echo "readonly='1'"; }?> required="1"></td>
						</tr>
						<tr>
							<td>realName</td>
							<td colspan="2"><input type="text" name="realName" value="<?php echo $realName; ?>" class="form-control"></td>
						</tr>
						<tr>
							<td>userGroup</td>
							<td colspan="2">
								<select name="userGroup"  class="form-control">
									<option value=""></option>
									<?php
									$arrayGroup =  $this->m_parameter->getParameter('user.group');
									foreach ($arrayGroup as $rowGroup) {
										?><option <?php echo cek_select_option($rowGroup['id'],$userGroup); ?> value="<?php echo $rowGroup['id']; ?>"><?php echo $rowGroup['id']." - ".$rowGroup['description']; ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>kecamatan_id</td>
							<td colspan="2">
								<select name="kecamatan_id"  class="form-control kecamatan_id" onchange="loadDesa()">
									<option value=""></option>
									<?php
									$arrkecamatan = $this->m_kecamatan->getkecamatan();
									foreach ($arrkecamatan as $valkecamatan) {
										?><option <?php echo cek_select_option($valkecamatan['kecamatan_id'],$kecamatan_id); ?> value="<?php echo $valkecamatan['kecamatan_id']; ?>"><?php echo "[".$valkecamatan['kecamatan_id']."] - ".$valkecamatan['nama']; ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>desa_id</td>
							<td colspan="2">
								<select name="desa_id"  class="form-control desa_id">
									<option value=""></option>
									<?php
									if($form_op=="update"){
										$arrdesa = $this->m_kecamatan->getdesa2($kecamatan_id);
										foreach ($arrdesa as $valdesa) {
											?><option <?php echo cek_select_option($valdesa['desa_id'],$desa_id); ?> value="<?php echo $valdesa['desa_id']; ?>"><?php echo "[".$valdesa['desa_id']."] - ".$valdesa['nama']; ?></option><?php
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>userDescription</td>
							<td colspan="2"><input type="text" name="userDescription" value="<?php echo $userDescription; ?>"  class="form-control"></td>
						</tr>
						<tr>
							<td>userStatus</td>
							<td colspan="2">
								<select name="userStatus"  class="form-control">
									<option value=""></option>
									<?php
									$arrayStatus =  $this->m_parameter->getParameter('user.status');
									foreach ($arrayStatus as $rowStatus) {
										?><option <?php echo cek_select_option($rowStatus['id'],$userStatus); ?> value="<?php echo $rowStatus['id']; ?>"><?php echo $rowStatus['id']." - ".$rowStatus['description']; ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary btn-block">
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$("#form3").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_user/";
			var form_op = "<?php echo $form_op; ?>";
			var string = $("#form3").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});
</script>