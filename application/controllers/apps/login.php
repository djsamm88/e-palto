<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() { 
		parent::__construct(); 
	}

	function index(){
		$this->load->view('apps/login');
	}

	function anti_injection($data){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}

	function proses(){
		$userName = $this->anti_injection($this->input->post('userName'));
		$userPassword = $this->anti_injection(md5($this->input->post('userPassword')));
		$arrCek = $this->m_security->login($userName,$userPassword);

		if($arrCek['userStatus']==1){
			$arrUser = $this->m_user->detailUser($arrCek['userID']);
			$a = $this->m_parameter->getParameterArray($arrCek['userGroup'],"user.group");
			$b = $this->m_kecamatan->getkecamatanStr($arrUser['kecamatan_id']);
			$c = $this->m_kecamatan->detail($arrUser['kecamatan_id'],$arrUser['desa_id']);
			$theme=config_item('theme');
			$arrayLogin = array(
				'userID' => $arrUser['userID'], 
				'realName' => $arrUser['realName'], 
				'userName' => $arrUser['userName'], 
				'userPassword' => $userPassword, 
				'userGroup' => $arrUser['userGroup'],
				'userGroupStr' => $a['description'],
				'accessDate' => $arrUser['accessDate'],
				'kecamatan_id' => $arrUser['kecamatan_id'],
				'kecamatan_str' => $b['nama'],
				'desa_id' => $arrUser['desa_id'],
				'desa_str' => $c['nama'],
				'theme' => $theme
				);

			$_SESSION['arrayLogin']=$arrayLogin;
			$arrList = $this->m_akses_group->getfunctionID($_SESSION['arrayLogin']['userGroup']);
			$_SESSION['arrList']=$arrList;

			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Berhasil";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);

			$page = base_url().'apps/home';
			refresh($page);

		}else if($arrCek['userStatus']==2){
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data["error"]="userName Masih Pending Hubungi Administrator";
			$this->load->view('apps/login',$data);
			session_destroy();
		}else if($arrCek['userStatus']==3){
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data["error"]="userName Sudah Di Blocked Hubungi Administrator";
			$this->load->view('apps/login',$data);
			session_destroy();
		
		}else{
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data["error"]="Kombinasi userName Atau Pessword Salah";
			$this->load->view('apps/login',$data);
			session_destroy();
		}
	}
}