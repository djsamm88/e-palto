<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proses extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
	 	$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = '';
		
			$data['access_add'] = $this->access_add;
			$data['access_delete'] = $this->access_delete;

			$data["tab"] = "tab1";
			$this->load->view('apps/header',$data);
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/home/home',$data);
			$this->load->view('apps/footer');
		}
	}
}