<form name="form1" id="form1" action="#" method="POST">
	<div class="table-head"><i class="glyphicon glyphicon-list-alt"></i> form edit password</div>
	<div class="table-responsive">
		<table class="table table-line">
			<thead>
				<tr>
					<th colspan="2">Edit Password</th>
				</tr>
			</thead>
			<tr>
				<td class="span3">Username</td>
				<td><?php echo $_SESSION['arrayLogin']['userName'] ?></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td><?php echo $_SESSION['arrayLogin']['realName'] ?></td>
			</tr>
			<tr>
				<td>Password Lama</td>
				<td><input type="password" name="pass_lama" class="form-default span4" id="pass_lama"></td>
			</tr>
			<tr>
				<td>Password Baru</td>
				<td><input type="password" name="pass_baru" class="form-default span4" id="pass_baru"></td>
			</tr>
			<tr>
				<td>Ulang Password Baru</td>
				<td><input type="password" name="ulang_pass_baru" class="form-default span4" id="ulang_pass_baru"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button class="btn btn-primary btn-sm">Update</button> 
				</td>
			</tr>
		</table>
	</div>
</form>
<script language="JavaScript">
	$("#form1").submit(function(){
		var pass_lama = $("#pass_lama").val();
		var pass_baru = $("#pass_baru").val();
		var ulang_pass_baru = $("#ulang_pass_baru").val();

		if(pass_lama==""){
			$("#pass_lama").focus();
			return false;
		}
		if(pass_baru==""){
			$("#pass_baru").focus();
			return false;
		}
		if(ulang_pass_baru==""){
			$("#ulang_pass_baru").focus();
			return false;
		}
		if(confirm('Apakah Anda Yakin Mengubah Password ??')){
			var method = "<?php echo base_url();?>apps/c_edit_password/";
			var form_op = "update";
			var string = $("#form1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});
</script>