<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_msg extends CI_Controller {

	public function __construct(){
        parent::__construct(); 
	}
	
	function index(){
		$type = $_SESSION['arrMsg']['type'];
		$data["url_link"]="home";
		$data["breadcrumb"]="DASBOARD PERIODE ";
		$this->load->view('apps/header2');
		if($type=="msg_trx"){
			$this->load->view('apps/navbar',$data);
		}
		$this->load->view('apps/home/'.$type,$data);
		$this->load->view('apps/footer2');
	}

}