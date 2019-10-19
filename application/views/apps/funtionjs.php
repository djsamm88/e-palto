<script language="JavaScript">

	var loading = "<p class='text-center'><img style='padding:25px;' src='<?php echo config_item('asset_url'); ?>assets/apps/dist/gif/loading-lg.gif'></p>";
	var loading_tabel = "<tr><td colspan='20' style='background-color:#fff;'><img style='padding:25px 0;' src='<?php echo config_item('asset_url'); ?>assets/apps/dist/gif/loading-text.gif'></td></tr>";
	
	
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	function loadDesa(){
		$(".desa_id").html("<option value=''>Loading...</option>");
		var kecamatan_id = $(".kecamatan_id").val();
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_auto_complete/loadDesa/?kecamatan_id="+kecamatan_id,
			cache	: false,
			success	: function(data){
				$(".desa_id").html(data);
			}
		});
	}

	function loadDesa2(){
		$("#pem_Desa").html("<option value=''>Loading...</option>");
		var pem_Kecamatan = $("#pem_Kecamatan").val();
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_auto_complete/loadDesa/?kecamatan_id="+pem_Kecamatan,
			cache	: false,
			success	: function(data){
				$("#pem_Desa").html(data);
			}
		});
	}

	function titik(v){
		$(v).priceFormat({
			limit: 15,
			centsLimit: 0,
			allowNegative: true,
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: '.'
		});
	}


	function eksekusi_post_data(method,data) {
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.post(url1,data,function(e){
			$("#page_content").html(e);
			func_all();
		});
	}

	function eksekusi_post_notif(method,data,callback){
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "POST",
			data: data,
			success: function(e){
				var json = $.parseJSON(e);
				notify(json.tipe,json.msg);
				callback();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_data(method,data) {
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			data: data,
			success: function(e){
				$("#page_content").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_notif(method,data,callback){
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			data: data,
			success: function(e){
				var json = $.parseJSON(e);
				notify(json.tipe,json.msg);
				callback();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get(method){
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$("#page_content").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_sub(method){
		Pace.restart();
		eksekusi_loading2();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$("#page_content-2").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_modal(method){
		$('.modal').modal('show');
		$(".modal-body").html('Loading...');
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$(".modal-body").html(e);
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_url(method){
		Pace.restart();
		window.location=method;
	}

	function eksekusi_loading(){
		$("html,body").animate({scrollTop: 0}, 500);
		$("#page_content").html('<p class="text-left"><img style="margin:20px;" src="<?php echo config_item('asset_url'); ?>assets/apps/dist/gif/load-v2.gif"></p>');
	}

	function eksekusi_loading2(){
		$("#page_content-2").html('<p class="text-left"><img style="margin:20px;" src="<?php echo config_item('asset_url'); ?>assets/apps/dist/gif/load-v2.gif"></p>');
	}

	function notify(tipe,msg) {
		$.notify({
			title: '<strong>Information</strong>',
			icon: 'glyphicon glyphicon-bullhorn',
			message: '<p class="text-center">'+msg+'</p>'
		},{
			type: tipe,
			animate: {
				enter: 'animated fadeInUp',
				exit: 'animated fadeOutRight'
			},
			placement: {
				from: "bottom",
				align: "right"
			},
			offset: 10,
			spacing: 10,
			z_index: 1031,
			//timer:6000,
		});
	}

	function getErrorMessage(jqXHR, exception) {
		var msg = '';
		if (jqXHR.status === 0) {
			msg = 'Not connect.\n Verify Network.';
		} else if (jqXHR.status == 404) {
			msg = 'Requested page not found. [404]';
		} else if (jqXHR.status == 500) {
			msg = 'Internal Server Error [500].';
		} else if (exception === 'parsererror') {
			msg = 'Requested JSON parse failed.';
		} else if (exception === 'timeout') {
			msg = 'Time out error.';
		} else if (exception === 'abort') {
			msg = 'Ajax request aborted.';
		} else {
			msg = 'Uncaught Error.\n' + jqXHR.responseText;
		}
		$("#page_content").html(msg);
	}

	function func_all() {
		$(document).ready(function($){

			titik(".titik_js");

			var cekChangeDate = "<?php echo $_SESSION['arrayLogin']['accessDate']; ?>";
			if (cekChangeDate==1) {
				var minD = "<?php echo minDateTrx();?>";
				var maxD = "<?php echo maxDateTrx();?>";
				$(".tanggalMinMax, .tanggalMinMax1, .tanggalMinMax2, .tanggalMinMax3, .tanggalMinMax4").datepicker({
					showOn: "button",
					buttonImage: "<?php echo config_item('asset_url'); ?>assets/apps/dist/img/calender.png",
					buttonImageOnly: true,
					buttonText: "Calender",
					showButtonPanel: true,
					minDate: minD, maxDate: maxD,
					changeMonth: true,
					changeYear: true,
					dateFormat:'dd-mm-yy'
				});
			}

			$(".tgl").datepicker({
				buttonText: "Calender",
				showButtonPanel: true,
				minDate: "-100Y", maxDate: "0",
				changeMonth: true,
				changeYear: true,
				dateFormat:'dd-mm-yy'
			});

			$(".tanggal").datepicker({
				showOn: "button",
				buttonImage: "<?php echo config_item('asset_url'); ?>assets/apps/dist/img/calender.png",
				buttonImageOnly: true,
				buttonText: "Calender",
				showButtonPanel: true,
				minDate: "-100Y", maxDate: "0",
				changeMonth: true,
				changeYear: true,
				dateFormat:'dd-mm-yy'
			});

			$(".bulan_tahun").datepicker({
				showOn: "button",
				buttonImage: "<?php echo config_item('asset_url'); ?>assets/apps/dist/img/calender.png",
				buttonImageOnly: true,
				buttonText: "Calender",
				showButtonPanel: true,
				minDate: "-100Y", maxDate: "0",
				changeMonth: true,
				changeYear: true,
				dateFormat:'mm-yy'
			});

			$('#id_anggota_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/anggotaAutocomplete",{term: request.term,status_anggota: $('#status_anggota').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_anggota").val(ui.item.id_anggota);
				}
			});

			$('#norek_tabungan_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/tabunganAutocomplete",{term: request.term,status_tabungan: $('#status_tabungan').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_anggota").val(ui.item.id_anggota);
					$("#norek_tabungan").val(ui.item.norek_tabungan);
				}
			});

			$('#norek_deposito_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/depositoAutocomplete",{term: request.term,status_deposito: $('#status_deposito').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_anggota").val(ui.item.id_anggota);
					$("#norek_deposito").val(ui.item.norek_deposito);
				}
			});

			$('#norek_kredit_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/kreditAutocomplete",{term: request.term,status_kredit: $('#status_kredit').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_anggota").val(ui.item.id_anggota);
					$("#norek_kredit").val(ui.item.norek_kredit);
				}
			});

			$('#id_akun_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/akunAutocomplete",{term: request.term,status_user: $('#status_akun').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_akun").val(ui.item.id_akun);
				}
			});

			$('#id_kasir_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/userAutocomplete",{term: request.term,status_user: $('#status_user').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_kasir").val(ui.item.id_user);
				}
			});
		});
	}
</script>