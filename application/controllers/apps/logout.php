<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	function index(){
		$data = array('statusLogin' => 'Log Off');
		$this->db->where('userID', $_SESSION['arrayLogin']['userID']);
		$this->db->update('tbl_users', $data);
		$ket_log ="Logout |";
		$ket_log .="Username : ".$_SESSION['arrayLogin']['userName']." |";
		$ket_log .="Logout Berhasil";
		$log = datalog(
			'LOGOUT',
			''.$ket_log.''
		);
		$this->m_log->insert($log);
		session_destroy();
		$page = base_url();
		refresh($page);
	}
}