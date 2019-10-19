<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_c_user extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(1,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_user';

			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');

			$data["tab"] = "tab1";
			
			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_user/index',$data);
			}
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->cekAccess('view');
			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');

			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'userID';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data["sql1"] = $this->m_user->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_hal = $this->m_user->rows($data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_hal->num_rows();

			$this->load->view("apps/a_v_user/data",$data);
		}
	}

	function rows(){
		if($this->cekAccess('view')){
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$tot_hal = $this->m_user->rows($data_set);

			$jlh = $tot_hal->num_rows();
			echo ceil( $jlh/$limit );
		}
	}

	function add(){
		if($this->cekAccess('add')){
			$data["form_op"] = "insert";
			$data["tab"] = "tab1";
			$this->load->view('apps/a_v_user/form',$data);
		}
	}

	function insert(){
		if($this->cekAccess('add')){
			$data_set = array(
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName'),
				'userPassword' => md5(config_item('passDefault')),
				'userDescription' => $this->input->post('userDescription'),
				'userGroup' => $this->input->post('userGroup'),
				'statusLogin' => "Log Off",
				'userStatus' => $this->input->post('userStatus'),
				'kecamatan_id' => $this->input->post('kecamatan_id'),
				'desa_id' => $this->input->post('desa_id')
			);
			$this->m_user->insert($data_set);

			$ket_log ="Tambah user<br>";
			$ket_log .="userName : ".$this->input->post('userName')."";

			$user = datalog(
				'INSERT',
				''.$ket_log.''
			);
			$this->m_log->insert($user);
			$data_set = array(
				'tipe' => 'success',
				'msg' => $ket_log,
			);
			echo json_encode($data_set);
		}
	}

	function edit($userID){
		if($this->cekAccess('edit')){
			$data["sql1"] = $this->m_user->detail($userID);
			$data["form_op"] = "update";
			$data["tab"] = "tab1";
			$this->load->view('apps/a_v_user/form',$data);
		}
	}

	function update(){
		if($this->cekAccess('edit')){
			$userID = $this->input->post('userID') ? $this->input->post('userID') : '';
			$userName = $this->input->post("userName");
			$data_set = array(
				'realName' => $this->input->post('realName'),
				'userDescription' => $this->input->post('userDescription'),
				'userGroup' => $this->input->post('userGroup'),
				'userStatus' => $this->input->post('userStatus'),
				'statusLogin' => "Log Off",
				'kecamatan_id' => $this->input->post('kecamatan_id'),
				'desa_id' => $this->input->post('desa_id')
			);
			$this->m_user->update($userID,$data_set);

			$ket_log ="Ubah user<br>";
			$ket_log .="userID : ".$userID.",";
			$ket_log .="userName : ".$userName;

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

	function reset_pass(){
		if($this->cekAccess('edit')){
			$pilih = $this->input->post("pilih");
			if($pilih!=""){
				$i=0;
				$ket_log ="Resset Password User<br>";
				foreach ($pilih as $key) {
					if($pilih[$i]==$_SESSION['arrayLogin']['userID']){
						$ket_log .= "User (".$pilih[$i].") Sendiri Tidak Boleh Reset |";
					}else{
						$data_set = array(
							'userPassword' => md5(config_item('passDefault'))
						);
						$this->m_user->update($pilih[$i],$data_set);
						$ket_log .= "User (".$pilih[$i].") Berhasil Reset |";
					}
					$i++;
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
			}else{
				$ket_log = "Pilih terlebih dahulu";
				$data_set = array(
					'tipe' => 'info',
					'msg' => $ket_log,
				);
			}
			echo json_encode($data_set);
			
		}
	}

	function delete(){
		if($this->cekAccess('delete')){
			$pilih = $this->input->post("pilih");
			if($pilih!=""){
				$i=0;
				$ket_log ="Hapus user<br>";
				foreach ($pilih as $key) {
					if($pilih[$i]==$_SESSION['arrayLogin']['userID']){
						$ket_log .= "User (".$pilih[$i].") Sendiri Tidak Boleh Dihapus |";
					//}else if($this->m_user->cekIdTransaksi($pilih[$i])>0){
					//	$ket_log .= "User (".$pilih[$i].") Telah Menginput Transaksi, Tidak Boleh Dihapus |";
					}else{
						$this->m_user->delete($pilih[$i]);
						$ket_log .= "User (".$pilih[$i].") Berhasil Dihapus |";
					}
					$i++;
				}
				$log = datalog(
					'DELETE',
					''.$ket_log.''
				);
				$this->m_log->insert($log);
				$data_set = array(
					'tipe' => 'success',
					'msg' => $ket_log,
				);
			}else{
				$ket_log = "Pilih terlebih dahulu";
				$data_set = array(
					'tipe' => 'info',
					'msg' => $ket_log,
				);
			}
			echo json_encode($data_set);	
		}
	}
	
	function detail($userID){
		if($this->cekAccess('view')){
			$data["sql1"] = $this->m_user->detail($userID);
			$this->load->view('apps/a_v_user/detail',$data);
		}
	}

	function group(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_user';

			$data["tab"] = "tab2";
			
			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_user/group/index',$data);
			}
		}
	}

	function group_views(){
		if($this->cekAccess('view')){
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'id';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";

			$data['access_edit'] = $this->cekAccess('edit');
			
			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			$data["sql1"] = $this->m_user->group_views($sidx,$sord,$data_set);
			$this->load->view("apps/a_v_user/group/data",$data);
		}
	}

	function group_edit(){
		if($this->cekAccess('edit')){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_user';

			$data["tab"] = "tab2";
			$groupID = $this->input->get('groupID');
			if(!empty($groupID)){
				$_SESSION['groupID'] = $groupID;
			}
			$groupID = $_SESSION['groupID'];
			$data["groupID"] = $groupID;

			$parameterArr1 = $this->m_parameter->getParameterArray($groupID, "user.group");
			$groupIDstr = $parameterArr1['description'];
			$data["groupIDstr"] = $groupIDstr;

			$this->load->view('apps/a_v_user/group/form',$data);
		}
	}

	function group_update(){
		if($this->cekAccess('edit')){
			$cbTotal = $this->input->post("cbTotal");
			$groupID = $this->input->post("groupID");
			
			$ket_log ="Update akses group pengguna<br>";
			
			for ($i=1; $i <=$cbTotal ; $i++) { 
				$functionID = $this->input->post("functionID".$i);
				$pilih_view = $this->input->post("pilih_view".$i);
				$pilih_add = $this->input->post("pilih_add".$i);
				$pilih_edit = $this->input->post("pilih_edit".$i);
				$pilih_delete = $this->input->post("pilih_delete".$i);

				if(!empty($pilih_view)){$view = 1;}else{$view = 0;}
				if(!empty($pilih_add)){$add = 1;}else{$add = 0;}
				if(!empty($pilih_edit)){$edit = 1;}else{$edit = 0;}
				if(!empty($pilih_delete)){$delete = 1;}else{$delete = 0;}

				$data = array(
					'action_1' => $view, 
					'action_2' => $add, 
					'action_3' => $edit, 
					'action_4' => $delete, 
					'action_5' => 1 
				);

				$data2 = array(
					'statusLogin' => "Log Off"
				);

				$this->m_akses_group->updateGroupfunctionID($groupID,$functionID,$data);
				$this->m_akses_group->updateUserGroup($groupID,$data2);

				$ket_log.= 'groupID :'.$groupID;
				$ket_log.= ', functionID :'.$functionID;
				$ket_log.= ', view :'.$view;
				$ket_log.= ', add :'.$add;
				$ket_log.= ', edit :'.$edit;
				$ket_log.= ', delete :'.$delete." |";
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

	function akses_tgl(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_user';
			$data["tab"] = "tab3";
			
			$data['access_edit'] = $this->cekAccess('edit');

			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_user/akses_tgl/index',$data);
			}
		}
	}

	function akses_tgl_views(){
		if($this->cekAccess('view')){
			$data['access_edit'] = $this->cekAccess('edit');
			
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'userID';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data["sql1"] = $this->m_user->akses_tgl_views($limit,$offset,$sidx,$sord,$data_set);
			$tot_hal = $this->m_user->akses_tgl_rows($data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_hal->num_rows();

			$this->load->view("apps/a_v_user/akses_tgl/data",$data);
		}
	}

	function akses_tgl_rows(){
		if($this->cekAccess('view')){
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'userID' => $this->input->post('userID'),
				'userName' => $this->input->post('userName'),
				'realName' => $this->input->post('realName')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$tot_hal = $this->m_user->akses_tgl_rows($data_set);

			$jlh = $tot_hal->num_rows();
			echo ceil( $jlh/$limit );
		}
	}

	function akses_tgl_update(){
		if($this->cekAccess('edit')){
			$pilih = $this->input->post("pilih");
			if($pilih!=""){
				$i=0;
				$data1 = array('accessDate' =>0);
				$data2 = array('accessDate' =>1);
				$ket_log ="Update pengguna akses tanggal<br>";
				
				foreach ($pilih as $key => $value) {
					$data1 = array('accessDate' =>$value);
					$this->m_user->update($key,$data1);
					$ket_log .="ID User : ".$key."=".$value." |";
					$i++;
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
}