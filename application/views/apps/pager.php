<ul class="pagination pagination-sm justify-content-center">
	<li class="page-item">
		<a class="page-link" href="javascript:func_refresh()"><i class="fa fa-refresh"></i></a>
	</li>
	<li class="page-item">
		<a class="page-link" href="javascript:func_first()"><i class="fa fa-fast-backward"></i></a>
	</li>
	<li class="page-item">
		<a class="page-link" href="javascript:func_previous()"><i class="fa fa-backward"></i></a>
	</li>
	<li class="page-item">
		<input type="text" onkeyup="func_page()" name="page" id="page" value="1" class="form-control form-control-sm" style="width: 50px;">
	</li>
	<li class="page-item">
		<a class="page-link" href="#">Of</a>
	</li>
	<li class="page-item">
		<input type="text" name="total_row" id="total_row" class="form-control form-control-sm" readonly="1" style="width: 50px;background-color: #ddd;">
	</li>
	<li class="page-item">
		<a class="page-link" href="javascript:func_next()"><i class="fa fa-forward"></i></a>
	</li>
	<li class="page-item">
		<a class="page-link" href="javascript:func_last()"><i class="fa fa-fast-forward"></i></a>
	</li>
	<li class="page-item">
		<select onchange="func_limit()" class="limit form-control form-control-sm" name="limit">
			<option <?php if(config_item('displayperpage')==1){ echo "selected='1'"; } ?>>1</option>
			<option <?php if(config_item('displayperpage')==10){ echo "selected='1'"; } ?>>10</option>
			<option <?php if(config_item('displayperpage')==25){ echo "selected='1'"; } ?>>25</option>
			<option <?php if(config_item('displayperpage')==50){ echo "selected='1'"; } ?>>50</option>
			<option <?php if(config_item('displayperpage')==100){ echo "selected='1'"; } ?>>100</option>
			<option <?php if(config_item('displayperpage')==200){ echo "selected='1'"; } ?>>200</option>
			<option <?php if(config_item('displayperpage')==300){ echo "selected='1'"; } ?>>300</option>
			<option <?php if(config_item('displayperpage')==400){ echo "selected='1'"; } ?>>400</option>
			<option <?php if(config_item('displayperpage')==500){ echo "selected='1'"; } ?>>500</option>
		</select>
	</li>
</ul>

<script type="text/javascript">

	var arrow_up = "<span class='fa fa-arrow-up'></span>";
	var arrow_down = "<span class='fa fa-arrow-down'></span>";

	function func_sidx(field) {
		$("#view_data").html(loading_tabel);
		$(".sort").html(arrow);
		var field = field;
		document.form2.sidx.value=field;
		if(document.form2.sord.value=="" || document.form2.sord.value=="desc"){
			document.form2.sord.value="asc";
			$("#"+field+"_sort").html(arrow_up);
		}
		else{
			document.form2.sord.value="desc";
			$("#"+field+"_sort").html(arrow_down);
		}
		func_view();
	}

	function func_view(){
		Pace.restart();
		//alert('s');
		$("#view_data").html(loading_tabel);
		$("#total_row").val("load...");
		var string = $("#index2").serialize();
		$.ajax({
			type	: 'POST',
			url		: main,
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_data").html(data);
			}
		});
		$.ajax({
			type	: 'POST',
			url		: row,
			data	: string,
			cache	: false,
			success	: function(data){
				$("#total_row").val(data);
			}
		});
	}

	
	function func_first() {
		var page = $("#page").val();
		if(page!=1){
			$("#view_data").html(loading_tabel);
			document.form2.page.value=1;
			$("#page").val(1);
			func_view();
		}
	}
	function func_next() {
		var page = parseInt($("#page").val());
		var tot = parseInt($("#total_row").val());
		if(page<tot){
			$("#view_data").html(loading_tabel);
			page = parseInt(page)+1;
			$("#page").val(page);
			document.form2.page.value=page;
			func_view();
		}
	}
	function func_previous() {
		var page = $("#page").val();
		if(page>1){
			$("#view_data").html(loading_tabel);
			page = parseInt(page)-1;
			$("#page").val(page);
			document.form2.page.value=page;
			func_view();
		}
	}
	function func_last() {
		var tot = $("#total_row").val();
		var page = $("#page").val();
		if(page!=tot){
			$("#view_data").html(loading_tabel);
			$("#page").val(tot);
			document.form2.page.value=tot;
			func_view();
		}
	}
	
	function func_limit() {
		document.form1.page.value=1;
		document.form2.page.value=1;
		document.form2.limit.value=document.form1.limit.value;
		func_view();
	}

	function func_page() {
		delay(function(){
			document.form2.page.value=document.form1.page.value;
			func_view();
		}, 600 );
	}

	function func_checkall() {
		var cbtotal = document.form1.cbtotal.value;
		if (cbtotal==1){
			if(document.form1.btncheck.checked == true){
				document.form1.pilih.checked = true;
			}
			else{
				document.form1.pilih.checked = false;
			}
		}
		else{
			for(var i=0;i<document.form1.pilih.length;i++){
				if(document.form1.btncheck.checked == true){
					document.form1.pilih[i].checked = true;
				}
				else{
					document.form1.pilih[i].checked = false;
				}
			}
		}
	}
</script>