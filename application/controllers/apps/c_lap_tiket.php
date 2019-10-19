<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_lap_tiket extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(8,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_laporan';

			$data["tab"] = "tab1";
			$data["tanggal"] = date("d-m-Y");
			$lap_tiket = $this->input->get("lap_tiket") ? $this->input->get("lap_tiket") : 'lap_tiket1';
			if($lap_tiket==""){
				$data["laporan_str"] = "Agenda Rapat";
			}else if($lap_tiket=="lap_tiket1"){
				$data["laporan_str"] = "Agenda Rapat";
			}
			
			if(empty($lap_tiket)){
				$this->load->view('apps/v_lap_tiket/index',$data);
			}
			else{
				$this->load->view('apps/v_lap_tiket/'.$lap_tiket,$data);
			}
		}
	}

	function lap_tiket1_data(){
		if($_SESSION['arrayLogin']['userGroup']!=1){
			$kecamatan_id = $_SESSION['arrayLogin']['kecamatan_id'];
			$desa_id = $_SESSION['arrayLogin']['desa_id'];
		}

		$row = $this->input->get("row") ? $this->input->get("row") : '';
		$page = $this->input->post("page") ? $this->input->post("page") : 1;
		$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');
		if($page<=0){
			$offset=0;
		}
		else{
			$offset=($page-1) * $limit;
		}
		$tanggal_awal = ymd1($this->input->post("tanggal_awal"));
		$tanggal_akhir = ymd1($this->input->post("tanggal_akhir"));
		if($row==1){
			$tot_hal = $this->m_lap_tiket->lap_tiket1_data($kecamatan_id,$desa_id,$tanggal_awal,$tanggal_akhir,'','');
			$jlh = $tot_hal->num_rows();
			echo ceil($jlh/$limit);
		}else{
			$data["offset"] = $offset;
			$data["sql1"] = $this->m_lap_tiket->lap_tiket1_data($kecamatan_id,$desa_id,$tanggal_awal,$tanggal_akhir,$limit,$offset);
			$this->load->view("apps/v_lap_tiket/lap_tiket1_data",$data);
		}

	}


	function lap_tiket_range_xl()
	{
		
		

		if(isset($_GET["tanggal_awal"]) && isset($_GET["tanggal_akhir"]))
		{
			$tanggal_awal = ($this->input->get("tanggal_awal"));
			$tanggal_akhir = ($this->input->get("tanggal_akhir"));
		}else{
			$tanggal_awal = (date('d-m-Y'));
			$tanggal_akhir = (date('d-m-Y'));
			
		}

		$filename = "laporan_manifest_".$tanggal_awal."_sd_".$tanggal_akhir."target.xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		
		$data['tanggal_awal'] = $tanggal_awal;
		$data['tanggal_akhir'] = $tanggal_akhir;

		$data['laporan'] = $this->m_lap_tiket->m_lap_tiket_range(ymd2($tanggal_awal),ymd2($tanggal_akhir));


		$this->load->view("apps/v_lap_tiket/lap_tiket_range_xl",$data);
	}

	function lap_tiket_range()
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

		$data['laporan'] = $this->m_lap_tiket->m_lap_tiket_range(ymd2($tanggal_awal),ymd2($tanggal_akhir));


		$this->load->view("apps/v_lap_tiket/lap_tiket_range",$data);
	}
	
	function cetak ()
	{
		$tiket_nobat = $this->input->get('tiket_nobat');		
		$no_keberangkatan = $this->input->get('no_keberangkatan');

		$data['penumpang'] = $this->m_lap_tiket->m_lap_tiket_cetak($tiket_nobat);
		$data['no_keberangkatan'] = $no_keberangkatan;

		$this->load->view("apps/v_lap_tiket/struk",$data);
	}

	function lap_tiket_by_trip()
	{
		
		$id_tiket_grp = ($this->input->get("id_tiket_grp"));
		
		$data['laporan'] = $this->m_lap_tiket->m_lap_tiket_by_trip($id_tiket_grp);


		$this->load->view("apps/v_lap_tiket/lap_tiket_by_trip",$data);
	}

}