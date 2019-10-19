<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_c_parameter extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(4,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,parameter,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_parameter';

			$data['access_add'] = $this->access_add;
			$data['access_delete'] = $this->access_delete;
			
			$groups = $this->input->get("groups") ? $this->input->get("groups") : 'USER';
			$data["groups"] = $groups;
			$data["tab"] = "tab1";
			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_parameter/index',$data);
			}
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->access_view;
			$data['access_add'] = $this->access_add;
			$data['access_edit'] = $this->access_edit;
			$data['access_delete'] = $this->access_delete;

			$data_set = array(
				'groups' => $this->input->get('groups')
			);

			$data["sql1"] = $this->m_parameter->views($data_set);
			$this->load->view("apps/a_v_parameter/data",$data);
		}
	}


	function tampil(){
		$data_set = array(
			'groups' => $this->input->get('g'),
			'name' => $this->input->get('n')
		);
		$data['groups'] = $this->input->get('g');
		$data['name'] = $this->input->get('n');
		$data["sql1"] = $this->m_parameter->pilih($data_set);
		$this->load->view("apps/a_v_parameter/data_pilih",$data);
	}

	function tambah(){
		if($this->cekAccess('add')){
			$groups = $this->input->post("groups");
			$name = $this->input->post("name");
			$id = $this->input->post("id");
			$description = $this->input->post("description");
			$notes = $this->input->post("notes");
			$notes2 = $this->input->post("notes2");
			$data_set = array(
				'name' => $name,
				'id' => $id,
				'description' => $description,
				'groups' => $groups,
				'notes' => $notes,
				'notes2' => $notes2,
				'dt_created' => time(),
				'by_created' => $_SESSION['arrayLogin']['userID']
			);

			$ket_log ="Tambah Data parameter<br>";

			if($this->m_parameter->insert($data_set)){
				$ket_log.="Berhasil<br>";
			}else{
				$ket_log.="Gagal<br>";
			}

			$ket_log .="groups : ".$groups;
			$ket_log .=", name : ".$name;
			$ket_log .=", id : ".$id;

			$log = datalog(
				'INSERT',
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

	function ubah(){
		if($this->cekAccess('edit')){
			$groups = $this->input->post("groups");
			$name = $this->input->post("name");
			$id = $this->input->post("id");
			$idLama = $this->input->post("idLama");
			$description = $this->input->post("description");
			$notes = $this->input->post("notes");
			$notes2 = $this->input->post("notes2");

			$cekParameterTransaksi=0;

			if($groups=="TRANSAKSI"){
				if($name=="transaksi_anggota"){
					$trx_group = "A";
				}else if($name=="transaksi_bukubesar"){
					$trx_group = "B";
				}else if($name=="transaksi_deposito"){
					$trx_group = "D";
				}else if($name=="transaksi_kredit"){
					$trx_group = "K";
				}else if($name=="transaksi_tabungan"){
					$trx_group = "T";
				}
				$cekParameterTransaksi = $this->m_parameter->cekParameterTransaksi($trx_group,$idLama);
			}

			$cekParameterCount = $this->m_parameter->cekParameterCount($groups,$name);
			
			$ket_log ="Ubah Data parameter<br>";
			if($cekParameterTransaksi>0){
				$a_type = 'danger';
				$ket_log.="Gagal<br>";
				$ket_log.="Parameter tidak dapat diubah karena memiliki ".$cekParameterTransaksi." transaksi";
			}
			else{
				$a_type = 'success';
				$ket_log.="Berhasil<br>";
				$data_set = array(
					'name' => $name,
					'id' => $id,
					'description' => $description,
					'groups' => $groups,
					'notes' => $notes,
					'notes2' => $notes2,
					'dt_updated' => time(),
					'by_updated' => $_SESSION['arrayLogin']['userID']
				);
				$this->m_parameter->update($groups,$name,$idLama,$data_set);

				$ket_log .="groups : ".$groups;
				$ket_log .=", name : ".$name;
				$ket_log .=", idLama : ".$idLama;
				$ket_log .=", id : ".$id;
			}
			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data_set = array(
				'tipe' => $a_type,
				'msg' => $ket_log,
			);
			echo json_encode($data_set);
		}
	}


	function hapus(){
		if($this->cekAccess('delete')){
			$groups = $this->input->post("groups");
			$name = $this->input->post("name");
			$id = $this->input->post("id");
			$idLama = $this->input->post("idLama");
			$description = $this->input->post("description");
			$notes = $this->input->post("notes");
			$notes2 = $this->input->post("notes2");

			$cekParameterTransaksi=0;

			if($groups=="TRANSAKSI"){
				if($name=="transaksi_anggota"){
					$trx_group = "A";
				}else if($name=="transaksi_bukubesar"){
					$trx_group = "B";
				}else if($name=="transaksi_deposito"){
					$trx_group = "D";
				}else if($name=="transaksi_kredit"){
					$trx_group = "K";
				}else if($name=="transaksi_tabungan"){
					$trx_group = "T";
				}
				$cekParameterTransaksi = $this->m_parameter->cekParameterTransaksi($trx_group,$idLama);
			}

			$cekParameterCount = $this->m_parameter->cekParameterCount($groups,$name);
			
			if($cekParameterTransaksi>0){
				echo "Parameter tidak dapat dihapus karena memiliki ".$cekParameterTransaksi." transaksi";
			}else if($cekParameterCount<2){
				echo "Parameter tidak dapat dihapus, harus sisa".$cekParameterCount."";
			}else{
				$this->m_parameter->delete($groups,$name,$idLama);
				$ket_log ="Hapus Data parameter berhasil<br>";
				$ket_log .="groups : ".$groups;
				$ket_log .=", name : ".$name;
				$ket_log .=", id : ".$idLama;

				$log = datalog(
					'DELETE',
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
}