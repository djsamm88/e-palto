<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php 
$total_penum_orang = 0;
$total_penum_kendaraan = 0;
$total_penum_paket = 0;
$total_nominal = 0;
foreach ($laporan as $key) 
{
	
	$total_penum_orang += $key->penum_orang;
	$total_penum_kendaraan += $key->penum_kendaraan;
	$total_penum_paket += $key->penum_paket;
	$total_nominal += $key->nominal;

	
}
			
?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-6">
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?php echo $total_penum_orang?></h3>
						<p>Penumpang Orang Bulan ini</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="" onclick="eksekusi_get('<?php echo base_url()?>apps/c_lap_tiket/lap_tiket_range'); return false;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?php echo $total_penum_kendaraan?></h3>
						<p>Penumpang Kendaraan Bulan ini</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="" onclick="eksekusi_get('<?php echo base_url()?>apps/c_lap_tiket/lap_tiket_range'); return false;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php echo $total_penum_paket?></h3>
						<p>Penumpang Paket Bulan ini</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="" onclick="eksekusi_get('<?php echo base_url()?>apps/c_lap_tiket/lap_tiket_range'); return false;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-danger">
					<div class="inner">
						<h3><?php echo pasang_titik($total_nominal)?></h3>
						<p>Keuangan Bulan ini</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="" onclick="eksekusi_get('<?php echo base_url()?>apps/c_lap_keuangan/lap_keuangan_range/?tanggal_awal=<?php echo '01'.date('-m-Y')?>&tanggal_akhir=<?php echo date('d-m-Y')?>'); return false;" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="card card-info card-outline">
			<div class="card-header">
				<h3 class="card-title">Selamat datang di Aplikasi e-PALTO.</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				e-PALTO atau Elektronik Tiket Kapal Danau Toba adalah aplikasi yang bertujuan untuk memanagemen semua administrasi perkapalan.
				<br>
				e-PALTO diprogram dan dirancang khusus tenaga ahli programmer yang perduli dengan kekondusifan para pelaku angkutan di danau toba.
				<br>
				Penggunaan e-PALTO sangat sederhana dan disesuaikan dengan kondisi angkutan danau toba sehingga tidak menggangu percepatan pelayanan kepada penumpang kapal.

				<br>
				<br>
				<br>
				<center>" UTAMAKAN KESELAMATAN PENUMPANG "</center>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal Label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail berita</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove"></span></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>
</div>