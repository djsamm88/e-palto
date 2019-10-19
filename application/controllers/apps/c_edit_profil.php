<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_edit_profil extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		$this->m_security->cekArrayLogin();
	}
	
	function index(){
		$menudata="apps/home,Home, / |,Edit Password,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["keterangan"]="";
		$data["url_menu"]="";
		$data["menu"]="home";
		
		$data["sql2"] = $this->m_parameter->get_theme();	
		
		$this->load->view('apps/header');
		$this->load->view('apps/navbar',$data);
		$this->load->view('apps/navleft',$data);
		$this->load->view('apps/edit_profil',$data);
		$this->load->view('apps/footer');
	}

	function update(){
		$id_user = $_SESSION['id_user'];
		$pass_lama = md5($this->input->post('pass_lama'));
		$pass_baru = md5($this->input->post('pass_baru'));
		$ulang_pass_baru = md5($this->input->post('ulang_pass_baru'));

		$data = $this->m_edit_password->update($pass_lama,$pass_baru,$ulang_pass_baru);
		if($data['status']==1){
			$ket_log ="Ubah Password: <br>";
			$ket_log .="Username : ".$_SESSION['username']."<br>";
			$ket_log .="Ubah Password Berhasil";
			$log = datalog(
				'UPDATE',
				'apps/c_edit_password/proses',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$page = base_url().'apps/c_edit_password/success';
			refresh($page);
		}
		else{
			$menudata="apps/home,Home, / | ,Edit Password,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["menu"] = $this->m_access->cek_menu('apps/c_edit_password');
			$data["keterangan"]= $data["keterangan"];
			$get_data_user = $this->m_user->get_data($id_user);
			$data["theme"] =$get_data_user['theme'];
			$data["sql1"]= $this->m_edit_password->cek();
			$data["sql2"] = $this->m_parameter->get_theme();	
			$this->load->view('apps/header');
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/v_edit_password/form',$data);
			$this->load->view('apps/footer');
			$ket_log ="Ubah Password: <br>";
			$ket_log .="Username : ".$_SESSION['username']."<br>";
			$ket_log .="Ubah Password Gagal";
			$log = datalog(
				'UPDATE',
				'apps/c_edit_password/proses',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
		}
	}

	function success(){
		$id_user = $_SESSION['id_user'];
		$menudata="apps/home,Home, / | ,Edit Password,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["menu"] = $this->m_access->cek_menu('apps/c_edit_password');
		$data["keterangan"]= "password berhasil di edit";
		$get_data_user = $this->m_user->get_data($id_user);
		$data["theme"] =$get_data_user['theme'];
		$data["sql1"]= $this->m_edit_password->cek();
		$data["sql2"] = $this->m_parameter->get_theme();	
		$this->load->view('apps/header');
		$this->load->view('apps/navbar',$data);
		$this->load->view('apps/navleft',$data);
		$this->load->view('apps/v_edit_password/form',$data);
		$this->load->view('apps/footer');
	}

	function update_theme(){
		$id_user = $_SESSION['id_user'];
		$data = array('theme' =>$this->input->post('theme'));
		$data = $this->m_user->update($id_user,$data);
			$ket_log ="Ubah Theme: <br>";
			$ket_log .="Username : ".$_SESSION['username']."<br>";
			$ket_log .="Ubah Theme Berhasil";
			$log = datalog(
				'UPDATE',
				'apps/c_edit_password/proses',
				''.$ket_log.''
			);
			$this->m_log->insert($log);

		$page = base_url().'apps/c_edit_password';
		refresh($page);
	}
}