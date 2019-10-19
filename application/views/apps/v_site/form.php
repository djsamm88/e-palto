<?php $this->load->view('apps/v_site/function'); ?>
<?php $this->load->view('apps/v_site/tab'); ?>
<script src="<?php echo base_url(); ?>assets/apps/ckeditor/ckeditor.js"></script>
<?php
	$id_site="";
	$judul="";
	$gambar="";
	$isi="";

	if($form=="edit"){
		foreach ($sql1->result() as $row1) {
			$id_site=$row1->id_site;
			$site_group=$row1->site_group;
			$judul=$row1->judul;
			$gambar=$row1->gambar;
			$isi=$row1->isi;
		}
	}
?>
	
<script type="text/javascript">
	function popupAnggota(){
		window.opener=self;
		window.open("<?php echo base_url(); ?>apps/c_images","","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=800,height=480,left=50,top=50");
	}

	function refreshFromPopup(id_selected){
        document.form3.gambar.value=id_selected;
    }
</script>
	<div class="table-head"><i class="glyphicon glyphicon-list-alt"></i> tabel daftar produk</div>
<form id="site_form" name="form3" method="POST">
				<input type="hidden" name="op" value="<?php echo $op; ?>">
	<table class="table table-condensed table-striped table-line">
	<tr>
		<td>id_site</td>
		<td><input type="text" class="form-control" name="id_site" value="<?php echo $id_site; ?>" readonly></td>
	</tr>
	<tr>
		<td>site_group</td>
		<td><input type="text" class="form-control" name="site_group" value="<?php echo $site_group; ?>" readonly></td>
	</tr>
	<tr>
		<td>judul</td>
		<td><input type="text" class="form-control" name="judul" value="<?php echo $judul; ?>"></td>
	</tr>
	<!--<tr>
		<td>Gambar</td>
		<td>
			<input class="input-xxlarge" type="text" name="gambar" value="<?php echo $gambar; ?>" placeholder="URL">
			<a href="javascript:popupAnggota()" class="btn btn-success">Browse</a>
		</td>
	</tr>-->
	<tr>
		<td>isi</td>
		<td><textarea class="form-control" style="width:100%" name="isi" rows="10"><?php echo $isi; ?></textarea></td>
	</tr>
	</table>
	<?php 
						if($access_add==1){
							?>
								<button class="btn btn-primary" id="save">Simpan</button>
							<?php
						}
					?>
</form>

<script>
	CKEDITOR.replace( 'isi',{
		toolbar: 'Basic',
		filebrowserBrowseUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserUploadUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/filemanager/dialog.php?type=1&editor=ckeditor&fldr='

		//filebrowserBrowseUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/ckfinder.html',
		//filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/ckfinder.html?type=Images',
		//filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/ckfinder.html?type=Flash',
		//filebrowserUploadUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		//filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		//filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/apps/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	});
</script>