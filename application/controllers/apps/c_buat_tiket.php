<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_buat_tiket extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(5,$action);
	}


	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_buat_tiket';

			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');

			$data["tab"] = "tab1";
			$data["data_keberangkatan"] = $this->m_tiket->views_tiket_grp();
			
			if($this->cekAccess('view')){
				$this->load->view('apps/v_buat_tiket/index',$data);
			}
		}
	}


	function baru(){

		$no_tiket_grp = $this->m_tiket->no_tiket_grp(date("Y-m-d"));
		$nakhoda_id = $this->input->post("nakhoda_id");
		$keterangan = $this->input->post("keterangan");

		$data2 = array(
			'no_tiket_grp' => $no_tiket_grp,
			'tanggal' => date("Y-m-d"),
			'nakhoda_id' => $nakhoda_id,
			'keterangan' => $keterangan,
			'status' => 0,
			'dt_created' => time(),
			'created_by' => $_SESSION['arrayLogin']['userID']
		);
		$this->m_tiket->insert_tiket_grp($data2);
		
		$ket_log = "Membuat keberangkatan baru";

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

	function selesai(){

		$id_tiket_grp = $this->input->get("id_tiket_grp");

		$data2 = array(
			'status' => 1,
			'dt_updated' => time(),
			'updated_by' => $_SESSION['arrayLogin']['userID']
		);
		$this->m_tiket->update_tiket_grp($id_tiket_grp,$data2);
		
		$ket_log = "Keberangkatan selesai";

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

	function form(){
		if($this->cekAccess('edit')){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_buat_tiket';

			$tujuan_id = $this->input->get('tujuan_id') ? $this->input->get('tujuan_id') : '1';

			$data["tab"] = "tab1";
			$id_tiket_grp = $this->input->get('id_tiket_grp');
			$no_tiket_grp = $this->input->get('no_tiket_grp');
			$data["id_tiket_grp"] = $id_tiket_grp;
			$data["no_tiket_grp"] = $no_tiket_grp;

			$edit_tarif = $this->m_master_tarif->edit_tarif($tujuan_id);


			$data["edit_tarif"] =  $edit_tarif;
			$data["tujuan_id"] =  $tujuan_id;


			$this->load->view('apps/v_buat_tiket/form',$data);
		}
	}

	function form_tambahan(){
		$data["tab"] = "tab1";
		$i = $this->input->get('i');
		$plac1 = $this->input->get('plac1');
		$plac2 = $this->input->get('plac2');
		$data["i"] = $i;
		$data["plac1"] = $plac1;
		$data["plac2"] = $plac2;
		$this->load->view('apps/v_buat_tiket/form_tambahan',$data);
	}

	function simpan()
	{
		if($this->cekAccess('edit')){
			$id_tiket_grp = $this->input->post("id_tiket_grp");
			$no_tiket_grp = $this->input->post("no_tiket_grp");
			$coba = $this->input->post("coba");

			$ket_log ="Berhasil<br>";
			$ket="";

			$tiket_nobat = $this->m_tiket->tiket_nobat();

			$tot_nominal=0;
			foreach ($coba as $key => $value) 
			{
				$tujuan_id = $value['tujuan_id'];
				$jenis_penumpang = $value['jenis_penumpang'];
				$jenis_penumpang_id = $value['jenis_penumpang_id'];
				$tarif = buang_titik($value['tarif']);
				$i=0;
				foreach ($value['penumpang']['nik'] as $key2 => $value2) {
					if($value2!="" AND $value['penumpang']['nama'][$i]!=""){
						$data = array(
							'id_tiket_grp' => $id_tiket_grp,
							'tujuan_id' => $tujuan_id,
							'jenis_penumpang' => $jenis_penumpang,
							'jenis_penumpang_id' => $jenis_penumpang_id,
							'tiket_nobat' => $tiket_nobat,
							'tiket_nik' => $value2,
							'tiket_nama' => $value['penumpang']['nama'][$i],
							'nominal' => $tarif
						);
						$this->m_tiket->insert($data);
						$tot_nominal += $tarif;
						$ket.=$value2.",".$value['penumpang']['nama'][$i]."|";
					}
					$i++;
				}
			}

			$msg['type'] = "msg_trx";
			$msg['color'] = "card-success";
			$msg['caption'] = "Create Tiket";
			
			$msg_title  = "Tanggal,".date("d-m-Y")."|";
			$msg_title .= "No.Keberangkatan,".$no_tiket_grp."|";
			$msg_title .= "No.Tiket, ".$tiket_nobat;


			$msg['title'] = $msg_title;
			$msg['message'] = $ket;
			$msg['info'] = "Berhasil ";
			$msg['data_foot'] = pasang_titik($tot_nominal);

			$msg['url'] = "apps/c_buat_tiket/form/?id_tiket_grp=".$id_tiket_grp."&no_tiket_grp=".$no_tiket_grp;
			$msg['url_print'] = "tiket_nobat=$tiket_nobat&no_keberangkatan=$no_tiket_grp";
			$data['arrMsg'] = $msg;

			$ket_log = $msg_title."<br>".$msg_keterangan;

			$log = datalog(
				'INSERT',
				''.$ket_log.''
			);
			
			$this->m_log->insert($log);
			$this->load->view('apps/home/msg_trx',$data);
		}
	}
}