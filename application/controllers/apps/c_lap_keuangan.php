<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_lap_keuangan extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(8,$action);
	}



	function lap_keuangan_range_xl()
	{
		

		if(isset($_GET["tanggal_awal"]) && isset($_GET["tanggal_akhir"]))
		{
			$tanggal_awal = ($this->input->get("tanggal_awal"));
			$tanggal_akhir = ($this->input->get("tanggal_akhir"));
		}else{
			$tanggal_awal = (date('d-m-Y'));
			$tanggal_akhir = (date('d-m-Y'));
			
		}

		$filename = "laporan_tiket_".$tanggal_awal."_sd_".$tanggal_akhir."target.xls";
		//header('Content-type: application/ms-excel');
		//header('Content-Disposition: attachment; filename='.$filename);
		
		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		$data['laporan'] = $this->m_lap_tiket->m_lap_keuangan_range(ymd2($tanggal_awal),ymd2($tanggal_akhir));


		$this->load->view("apps/v_lap_tiket/laporan_keuangan_range_xl",$data);
	}

	function lap_keuangan_range()
	{
		
		if(isset($_GET["tanggal_awal"]) && isset($_GET["tanggal_akhir"]))
		{
			$tanggal_awal = ($this->input->get("tanggal_awal"));
			$tanggal_akhir = ($this->input->get("tanggal_akhir"));
		}else{
			$tanggal_awal = (date('d-m-Y'));
			$tanggal_akhir = (date('d-m-Y'));
			
		}
		
		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		$data['laporan'] = $this->m_lap_tiket->m_lap_keuangan_range(ymd2($tanggal_awal),ymd2($tanggal_akhir));


		$this->load->view("apps/v_lap_tiket/lap_keuangan_range",$data);
	}

	function cetak ()
	{
		$tiket_nobat = $this->input->get('tiket_nobat');		
		$no_keberangkatan = $this->input->get('no_keberangkatan');

		$data['penumpang'] = $this->m_lap_tiket->m_lap_keuangan_cetak($tiket_nobat);
		$data['no_keberangkatan'] = $no_keberangkatan;

		$this->load->view("apps/v_lap_tiket/struk",$data);
	}

}