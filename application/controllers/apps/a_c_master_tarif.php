<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_c_master_tarif extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(2,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_master_tarif';

			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');
			
			$tujuan_id = $this->input->get('tujuan_id') ? $this->input->get('tujuan_id') : '1';

			$data["tujuan_id"] = $tujuan_id;
			$data["tab"] =  $tujuan_id;



			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_master_tarif/index',$data);
			}
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'id';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$tujuan_id = $this->input->post('tujuan_id') ? $this->input->post('tujuan_id') : '1';

			$edit_tarif = $this->m_master_tarif->edit_tarif($tujuan_id);
			$data["edit_tarif"] =  $edit_tarif;
			$data["tujuan_id"] =  $tujuan_id;

			$data['access_edit'] = $this->cekAccess('edit');
			
			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			$data["sql1"] = $this->m_master_tarif->views($sidx,$sord,$data_set);
			$this->load->view("apps/a_v_master_tarif/data",$data);
		}
	}

	

	function update(){
		if($this->cekAccess('edit')){
			$tujuan_id = $this->input->post("tujuan_id");

			$jenis_penumpang = $this->input->post("jenis_penumpang");
			$tiket_jenis = $this->input->post("tiket_jenis");
			$nominal = $this->input->post("nominal");

			$ket_log ="Update Tarif Berhasil<br>";

			$this->m_master_tarif->delete($tujuan_id);

			for ($i=0; $i <count($nominal) ; $i++) { 
				$data2 = array(
					'tujuan_id' => $tujuan_id,
					'jenis_penumpang' => $jenis_penumpang[$i],
					'tiket_jenis' => $tiket_jenis[$i],
					'nominal' => buang_titik($nominal[$i]),
					'dt_created' => time(),
					'created_by' => $_SESSION['arrayLogin']['userID']
				);
				$this->m_master_tarif->insert($data2);
			}

			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);	
			$data_set = array(
				'tipe' => 'success',
				'msg' => $ket_log,
			);
			echo json_encode($data_set);
		}
	}
}