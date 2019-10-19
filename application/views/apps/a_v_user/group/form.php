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
				<form id="form3" name="form3" method="POST" action="#">
					<div class="table-responsive">
						<table class="table">
							<thead class="thead2">
								<tr>
									<th rowspan="2">ID</th>
									<th rowspan="2">Menu</th>
									<th rowspan="2" class="text-center">All</th>
									<th class="text-center">View</th>
									<th class="text-center">Add</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
								<tr>
									<th class="text-center">
										<input type="checkbox" id="btn_checkall_view" value="checkall_view" onclick="func_checkall2('view')">
									</th>
									<th class="text-center">
										<input type="checkbox" id="btn_checkall_add" value="checkall_add" onclick="func_checkall2('add')">
									</th>
									<th class="text-center">
										<input type="checkbox" id="btn_checkall_edit" value="checkall_edit" onclick="func_checkall2('edit')">
									</th>
									<th class="text-center">
										<input type="checkbox" id="btn_checkall_delete" value="checkall_delete" onclick="func_checkall2('delete')">
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$arr_menu = config_item('arr_menu');
								$i=0;
								$no=0;
								foreach ($arr_menu as $key_menu => $value_menu) {
									$i++;
									$arr_menu1 = explode("|",$arr_menu[$i][1]);
									?>
									<tr>
										<td><b><?php echo $arr_menu1[0];?></b></td>
										<td colspan="6"><b><?php echo $arr_menu1[1];?></b></td>
									</tr>
									<?php
									for ($j=1; $j <count($arr_menu[$i]) ; $j++) { 
										$no++;
										$arr_key_menu1 = explode("|", $arr_menu[$i][$j+1]);
										$arrayGroup = $this->m_akses_group->getfunctionID($groupID);
										if($arrayGroup[$arr_key_menu1[0]]['view']==1){$view="checked";}else{$view="";}
										if($arrayGroup[$arr_key_menu1[0]]['add']==1){$add="checked";}else{$add="";}
										if($arrayGroup[$arr_key_menu1[0]]['edit']==1){$edit="checked";}else{$edit="";}
										if($arrayGroup[$arr_key_menu1[0]]['delete']==1){$delete="checked";}else{$delete="";}
										?>
										<tr>
											<td><?php echo $arr_key_menu1[0];?></td>
											<td><span>&nbsp;&nbsp;<i class="glyphicon glyphicon-hand-right"></i> <?php echo $arr_key_menu1[2]; ?></span></td>
											<td class="text-center">
												<input type="checkbox" onclick="btn_checkall(<?php echo $no;?>)" id="pilih_all<?php echo $no;?>" name="pilih_all<?php echo $no;?>" value="" <?php echo $all;?>>
											</td>
											<td class="text-center">
												<input type="hidden" id="functionID<?php echo $no;?>" name="functionID<?php echo $no;?>" value="<?php echo $arr_key_menu1[0];?>">
												<input type="checkbox" id="pilih_view<?php echo $no;?>" name="pilih_view<?php echo $no;?>" value="<?php echo $arr_key_menu1[0];?>" <?php echo $view;?>>
											</td>
											<td class="text-center">
												<input type="checkbox" id="pilih_add<?php echo $no;?>" name="pilih_add<?php echo $no;?>" value="<?php echo $arr_key_menu1[0];?>" <?php echo $add;?>>
											</td>
											<td class="text-center">
												<input type="checkbox" id="pilih_edit<?php echo $no;?>" name="pilih_edit<?php echo $no;?>" value="<?php echo $arr_key_menu1[0];?>" <?php echo $edit;?>>
											</td>
											<td class="text-center">
												<input type="checkbox" id="pilih_delete<?php echo $no;?>" name="pilih_delete<?php echo $no;?>" value="<?php echo $arr_key_menu1[0];?>" <?php echo $delete;?>>
											</td>
										</tr>
										<?php
									}
									?>												
									<?php
								}
								?>
							</tbody>
						</table>
						<input type="hidden" name="cbTotal2" value="<?php echo $no+1;?>">
						<input type="hidden" name="cbTotal" value="<?php echo $no;?>">
						<input type="hidden" name="groupID" value="<?php echo $groupID; ?>">
					</div>
					<button class="btn btn-primary btn-block">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$("#form3").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_user/";
			var form_op = "group_update";
			var string = $("#form3").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method+"group");
			});
		}
		return false;
	});

	function func_checkall2(op) {
		var cbTotal2 = document.form3.cbTotal2.value;
		for(var i=0;i<cbTotal2;i++){
			if($("#btn_checkall_"+op).is(':checked')){
				$('#pilih_'+op+i).prop('checked', true);
			}
			else{
				$('#pilih_'+op+i).prop('checked', false);
			}
		}
	}

	function btn_checkall(x){
		if(document.getElementById('pilih_all'+x).checked){
			$('#pilih_add'+x).prop('checked', true);
			$('#pilih_edit'+x).prop('checked', true);
			$('#pilih_delete'+x).prop('checked', true);
			$('#pilih_view'+x).prop('checked', true);
			$('#pilih_cetak'+x).prop('checked', true);
		}
		else{
			$('#pilih_add'+x).prop('checked', false);
			$('#pilih_edit'+x).prop('checked', false);
			$('#pilih_delete'+x).prop('checked', false);
			$('#pilih_view'+x).prop('checked', false);
			$('#pilih_cetak'+x).prop('checked', false);
		}
	}
</script>