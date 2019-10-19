<div class="well-mn">
	<div class="border-box">
		<div class="panel2 panel2">
			<div class="panel-heading panel2-heading"><?php echo @$breadcrumb ?></div>
		</div>
		<hr>
		<div class="panel-body">
			<form name="form1" action="<?php echo base_url(); ?>app/c_edit_password/update" method="POST" onSubmit="return checksubmit1()">
				<div class="table-head">edit password</div>
				<div class="table-responsive">
				<table class="table table-condensed table-striped table-line">
					<tr>
						<th colspan="2">Edit Password</th>
					</tr>
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
			            <td><input type="password" name="pass_lama" id="pass_lama"></td>
			        </tr>
			         <tr>
			            <td>Password Baru</td>
			            <td><input type="password" name="pass_baru" id="pass_baru"></td>
			        </tr>
			        <tr>
			            <td>Ulang Password Baru</td>
			            <td><input type="password" name="ulang_pass_baru" id="ulang_pass_baru"></td>
			        </tr>
			        <tr>
			        	<td colspan="2">
			        		<button class="btn btn-warning">Update</button> 
			        		<span class="text-warning"><?php echo $keterangan ?></span>
			        	</td>
			        </tr>
			    </table>
			    </div>
			</form>
			<br>
			<form name="form2" action="<?php echo base_url(); ?>app/c_edit_password/update_theme" method="POST" onSubmit="return checksubmit2()">
				<div class="table-head">edit theme</div>
				<div class="table-responsive">
				<table class="table table-condensed table-striped table-line">
					<tr>
						<th colspan="6">Edit Theme</th>
					</tr>
					<tr>
						<td colspan="6">
							<input type="radio" name="theme" value="default" <?php if($theme=='default'){echo "checked";} ?>> default
						</td>
					</tr>
						<?php
							$i=0;
							foreach ($sql2->result() as $row3){	
								if($i%6==0){
									?><tr><?php
								}
								?>
									<td>
										<input type="radio" name="theme" value="<?php echo $row3->keterangan;?>" <?php if($theme==$row3->keterangan){echo "checked";} ?>>
										<?php echo $row3->keterangan;?>
									</td>
								<?php
								$i++;
							}
						?>
					</tr>
			        <tr>
			        	<td colspan="6">
			        		<button class="btn btn-warning">Update</button> 
			        	</td>
			        </tr>
				</table>
				</div>
			</form>
		</div>
	</div>
</div><hr>

<script language="JavaScript">
	function checksubmit1(){
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
			document.form1.submit();
		}
		else{
			return false;
		}
	}

	function checksubmit2(){
		document.form2.submit();
	}
</script>