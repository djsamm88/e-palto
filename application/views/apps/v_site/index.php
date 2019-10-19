<?php $this->load->view('apps/v_site/function'); ?>
<?php $this->load->view('apps/v_site/tab'); ?>
<form id="index2" name="form2">
	<input type="hidden" name="page">
	<input type="hidden" name="sidx">
	<input type="hidden" name="sord">
	<input type="hidden" name="limit">
	<input type="hidden" name="id_site">
	<input type="hidden" name="site_group">
	<input type="hidden" name="judul">
	<input type="hidden" name="created_on">
	<input type="hidden" name="isi">
</form>
<form id="index1" name="form1">
	<div class="table-head"><i class="glyphicon glyphicon-list-alt"></i> tabel daftar produk</div>
	<div class="table-responsive">
		<table class="table table-condensed table-striped table-bordered">
			<thead>
					<tr>
						<th class="span1"><p class="text-center">no</p></th>
						<th class="span1">edit</th>
						<th style="cursor:pointer;" class="sidx" id="judul">judul<span id="judul_sort" class="sort"></span></th>
						<th style="cursor:pointer;" class="sidx span2" id="created_on">tanggal<span id="created_on_sort" class="sort"></span></th>
						<th class="span1">pilih</th>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="text" name="judul" class="form-control input-sm cari"></td>
						<td><input type="text" name="created_on" class="form-control input-sm cari"></td>
						<td>
							<p class="text-center">
								<input type="checkbox" name="btncheck" value="checkall" id="checkall">
							</p>
						</td>
					</tr>
				</thead>
				<tbody id="site_data">
					
				</tbody>
		</table>
	</div>
	<div class="row">
		<?php $this->load->view('apps/v_site/tombol'); ?>
	</div>
</form>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal Label" aria-hidden="true">
	<div class="modal-dialog modval-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
