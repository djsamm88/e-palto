<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_edit_password extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		$this->m_security->cekArrayLogin();
	}
	
	function index(){
		$menudata="apps/home,Home, / |,Edit Password,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["keterangan"]="";
		$data["url_link"]="";
		$data["menu"]="home";
		$this->load->view('apps/edit_password',$data);
	}

	function update(){
		$pass_lama = md5($this->input->post('pass_lama'));
		$pass_baru = md5($this->input->post('pass_baru'));
		$ulang_pass_baru = md5($this->input->post('ulang_pass_baru'));

		$data = $this->m_edit_password->update($pass_lama,$pass_baru,$ulang_pass_baru);
		if($data['status']==1){
			$a_type = 'success';
			$ket_log ="Ubah Password: <br>";
			$ket_log .="Username : ".$_SESSION['arrayLogin']['userName']."|";
			$ket_log .="Ubah Password Berhasil";
			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
		}
		else{
			$a_type = 'danger';
			$ket_log ="Ubah Password: <br>";
			$ket_log .="Username : ".$_SESSION['arrayLogin']['userName']."|";
			$ket_log .="Ubah Password Gagal|";
			$ket_log .=$data['keterangan'];

			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
		}
		$data_set = array(
			'tipe' => $a_type,
			'msg' => $ket_log,
		);
		echo json_encode($data_set);
	}
}