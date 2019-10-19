<script language="JavaScript">
	(function($){

		var delay = (function(){
			var timer = 0;
			return function(callback, ms){
				clearTimeout (timer);
				timer = setTimeout(callback, ms);
			};
		})();

		var main = "<?php echo base_url(); ?>apps/c_site/views/?group=<?php echo $this->input->get('group') ? $this->input->get('group') : 'berita'; ?>";
		var row = "<?php echo base_url(); ?>apps/c_site/rows/?group=<?php echo $this->input->get('group') ? $this->input->get('group') : 'berita'; ?>";
		
		var arrow = "<span class='glyphicon glyphicon-resize-vertical'></span>";
		var arrow_up = "<span class='glyphicon glyphicon-arrow-up'></span>";
		var arrow_down = "<span class='glyphicon glyphicon-arrow-down'></span>";

		$(document).on('keyup',".page",function() {
			delay(function(){
				document.form2.page.value=document.form1.page.value;
				view();
		    }, 600 );
		});

		$(document).on('keyup',".cari",function() {
			delay(function(){
				document.form2.id_site.value=document.form1.id_site.value;
				document.form2.site_group.value=document.form1.site_group.value;
				document.form2.judul.value=document.form1.judul.value;
				document.form2.created_on.value=document.form1.created_on.value;
				document.form2.isi.value=document.form1.isi.value;
				view();
		    }, 600 );
		});

		$(document).on('change',".limit",function() {
			document.form1.page.value=1;
			document.form2.page.value=1;
			document.form2.limit.value=document.form1.limit.value;
			view();
		});

		function refresh(){
			$("#site_data").html(loading);
			$(".sort").html(arrow);
			$(".page").val(1);
			$.ajax({
				url		: main,
				cache	: false,
				success	: function(data){
					$("#site_data").html(data);
				}
			});
			$.ajax({
				url		: row,
				cache	: false,
				success	: function(data){
					$("#total_row").val(data);
				}
			});
		}

		function view(){
			$("#site_data").html(loading);
			var string = $("#index2").serialize();
			$.ajax({
				type	: 'POST',
				url		: main,
				data	: string,
				cache	: false,
				success	: function(data){
					$("#site_data").html(data);
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
		
		$(document).ready(function(e) {
			$("#site_data").html(loading);
			$(".sort").html(arrow);
			$.ajax({
				url		: main,
				cache	: false,
				success	: function(data){
					$("#site_data").html(data);
				}
			});
			$.ajax({
				url		: row,
				cache	: false,
				success	: function(data){
					$("#total_row").val(data);
				}
			});
		});

		$(document).on('click',".refresh",function() {
			$("#site_data").html(loading);
			refresh();
		});

		$(document).on('click',"#add",function() {
			/*$('.modal').modal('show');
			$('.modal-title').html(title_form);
			$(".modal-body").html(loading);
			$('.modal-footer').html(footer_form_add);
			$.ajax({
				url:"<?php echo base_url(); ?>apps/c_site/add/?group=<?php echo $this->input->get('group') ? $this->input->get('group') : 'berita'; ?>",
				success:function(data){
					$(".modal-body").html(data);
				}
			});*/

			window.location="<?php echo base_url(); ?>apps/c_site/add/?group=<?php echo $this->input->get('group') ? $this->input->get('group') : 'berita'; ?>";

		});
		
		$(document).on('click',"#save",function() {
			var a = document.form3.judul.value;
			
			if(a==""){
				document.form3.judul.focus(); return false;
			}
			//tinyMCE.triggerSave();
			/*var string = $("#site_form").serialize();
			$(".modal-body").html(loading);
			$('.modal-footer').html("");
			$.ajax({
				type	: 'POST',
				url		: "<?php echo base_url(); ?>apps/c_site/insert",
				data	: string,
				cache	: false,
				success	: function(data){
					$('.modal').modal('hide');
					refresh();
				}
			});*/

			var op = document.form3.op.value;
			if(op=="add"){
				document.form3.action="<?php echo base_url(); ?>apps/c_site/insert";
				document.form3.submit();
			}
			else{
				document.form3.action="<?php echo base_url(); ?>apps/c_site/update";
				document.form3.submit();
			}
		});

		$(document).on('click',"#ok",function() {
			var string = $("#index1").serialize();
			$(".modal-body").html(loading);
			$('.modal-footer').html("");
			$.ajax({
				type	: 'POST',
				url		: "<?php echo base_url(); ?>apps/c_site/delete",
				data	: string,
				cache	: false,
				success	: function(data){
					document.form1.btncheck.checked = false;
					$('.modal').modal('hide');
					refresh();
				}
			});
		});

		$(document).on('click',"#del",function() {
			var id_site="";
			var no=0;
			var cbtotal = document.form1.cbtotal.value;
			if (cbtotal==1){
				if(document.form1.pilih.checked == true){
					no=1;
					id_site = id_site+document.form1.pilih.value;
				}
			}
			else{
				for(var i=0;i<cbtotal;i++){
					if(document.form1.pilih[i].checked == true){
						no=no+1;
						id_site = id_site+document.form1.pilih[i].value;
					}
				}
			}

			if(no==0){
				$('.modal').modal('show');
				$('.modal-title').html(title_konfirmasi1);
				$('.modal-body').html(body_konfirmasi1b);
				$('.modal-footer').html(footer_konfirmasi1);
				return false;
			}
			else{
				$('.modal').modal('show');
				$('.modal-title').html(title_konfirmasi2);
				$('.modal-body').html(body_konfirmasi2);
				$('.modal-footer').html(footer_konfirmasi2);
				return false;
			}
			
		});

		$(document).on('click',"#edit",function() {
			var id_site="";
			var no=0;
			var cbtotal = document.form1.cbtotal.value;
			if (cbtotal==1){
				if(document.form1.pilih.checked == true){
					no=1;
					id_site = id_site+document.form1.pilih.value;
				}
			}
			else{
				for(var i=0;i<cbtotal;i++){
					if(document.form1.pilih[i].checked == true){
						no=no+1;
						id_site = id_site+document.form1.pilih[i].value;
					}
				}
			}

			if(no==1){
				/*$('.modal').modal('show');
				$('.modal-title').html(title_form);
				$('.modal-body').html(loading);
				$('.modal-footer').html(footer_form_update);
				$.ajax({
					url:"<?php echo base_url(); ?>apps/c_site/edit/"+id_site,
					success:function(data){
						$(".modal-body").html(data);
					}
				});*/
				window.location="<?php echo base_url(); ?>apps/c_site/edit/"+id_site;
			}
			else{
				$('.modal').modal('show');
				$('.modal-title').html(title_konfirmasi1);
				$('.modal-body').html(body_konfirmasi1a);
				$('.modal-footer').html(footer_konfirmasi1);
			}
			
		});

		$(document).on('click',"#update",function() {
			var a = document.form3.judul.value;
			
			if(a==""){
				document.form3.judul.focus(); return false;
			}
			//tinyMCE.triggerSave();
			var string = $("#site_form").serialize();
			$(".modal-body").html(loading);
			$('.modal-footer').html("");
			$.ajax({
				type	: 'POST',
				url		: "<?php echo base_url(); ?>apps/c_site/update",
				data	: string,
				cache	: false,
				success	: function(data){
					$('.modal').modal('hide');
					refresh();
				}
			});
		});

		$(document).on('click',"#detail",function() {
			var id_site="";
			var no=0;
			var cbtotal = document.form1.cbtotal.value;
			if (cbtotal==1){
				if(document.form1.pilih.checked == true){
					no=1;
					id_site = id_site+document.form1.pilih.value;
				}
			}
			else{
				for(var i=0;i<cbtotal;i++){
					if(document.form1.pilih[i].checked == true){
						no=no+1;
						id_site = id_site+document.form1.pilih[i].value;
					}
				}
			}

			if(no==1){
				$('.modal').modal('show');
				$('.modal-title').html(title_detail);
				$('.modal-body').html(loading);
				$('.modal-footer').html(footer_detail);
				$.ajax({
					url:"<?php echo base_url(); ?>apps/c_site/detail/"+id_site,
					success:function(data){
						$(".modal-body").html(data);
					}
				});
			}
			else{
				$('.modal').modal('show');
				$('.modal-title').html(title_konfirmasi1);
				$('.modal-body').html(body_konfirmasi1a);
				$('.modal-footer').html(footer_konfirmasi1);
			}
		});

		$(document).on('click',"#checkall",function() {
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
		});

		$(document).on('click',".sidx",function() {
			$("#site_data").html(loading);
			$(".sort").html(arrow);
			var field = this.id;
			document.form2.sidx.value=field;
			if(document.form2.sord.value=="" || document.form2.sord.value=="desc"){
				document.form2.sord.value="asc";
				$("#"+field+"_sort").html(arrow_up);
			}
			else{
				document.form2.sord.value="desc";
				$("#"+field+"_sort").html(arrow_down);
			}
			view();
		});

		$(document).on('click',".first",function() {
			var page = $(".page").val();
			if(page!=1){
				$("#site_data").html(loading);
				document.form2.page.value=1;
				$(".page").val(1);
				view();
			}
		});

		$(document).on('click',".next",function() {
			var page = parseInt($(".page").val());
			var tot = parseInt($("#total_row").val());
			if(page<tot){
				$("#site_data").html(loading);
				page = parseInt(page)+1;
				$(".page").val(page);
				document.form2.page.value=page;
				view();
			}
		});

		$(document).on('click',".previous",function() {
			var page = $(".page").val();
			if(page>1){
				$("#site_data").html(loading);
				page = parseInt(page)-1;
				$(".page").val(page);
				document.form2.page.value=page;
				view();
			}
		});

		$(document).on('click',".last",function() {
			var tot = $("#total_row").val();
			var page = $(".page").val();
			if(page!=tot){
				$("#site_data").html(loading);
				$(".page").val(tot);
				document.form2.page.value=tot;
				view();
			}
		});

	})
	(jQuery);


	function edit(id_site,site_group){
			window.location="<?php echo base_url(); ?>apps/c_site/edit/?id_site="+id_site+"&group="+site_group;
		}

</script>