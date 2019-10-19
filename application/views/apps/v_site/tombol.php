<div class="col-md-3">
	<p class="text-left">
		<?php 
			if($access_add==1){
				?>
					<a href="#Tambah" id="add" class="btn btn-info btn-sm">Tambah</a>
				<?php
			}
		?>
	</p>
</div>
<div class="col-md-6">
	<p class="text-center">
		<?php $this->load->view('apps/pager'); ?>
	</p>
</div>
<div class="col-md-3">
	<p class="text-right">
		<?php 
			if($access_delete==1){
				?>
					<a href="#Hapus" id="del" class="btn btn-danger btn-sm">Hapus</a>
				<?php
			}
		?>
	</p>
</div>