<div class="col-md-3">
	<p class="text-left">
		
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
			if($access_edit){
				?>
					<a href="javascript:akses_tgl_update_confirm()" class="btn btn-warning btn-sm">udpate akses tanggal</a>
				<?php
			}
		?>
	</p>
</div>