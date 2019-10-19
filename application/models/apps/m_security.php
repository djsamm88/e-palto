<?php
Class M_security extends CI_Model{

	function login($userName, $userPassword){
		$data = array();
		$time = time();
		$this->db->from('tbl_users');
		$this->db->where('userName', $userName);
		$this->db->where('userPassword', $userPassword);
		$this->db->limit(1);
		$sql = $this->db->get();
		$row = $sql->row();
		if(isset($row)){
			if($row->userStatus==1){
				$q =" UPDATE tbl_users SET ";
				$q .=" statusLogin='Log On', ";
				$q .=" userHitCount=userHitCount+1, ";
				$q .=" userLastlogin='$time', ";
				$q .=" userLastUpdate='$time' ";
				$q .=" WHERE userName='$userName' AND userPassword='$userPassword'";
				$this->db->query($q);
			}
			$data = array(
				'userID' =>$row->userID,
				'userGroup' =>$row->userGroup,
				'userStatus' =>$row->userStatus
			);
			return $data;
		}
		else{
			return false;
		}
	}

	function cekArrayLogin(){
		$str=0;
		$userID = $_SESSION['arrayLogin']['userID'];
		$userName = $_SESSION['arrayLogin']['userName'];
		$userPassword = $_SESSION['arrayLogin']['userPassword'];
		if($userID AND $userName AND $userPassword){
			$str = $this->cekSesi($userID,$userName,$userPassword);
			if($str==1){
				return 1;
			}
			else if($str==2){
				$msg['type'] = "msg_confirm";
				$msg['color'] = "card-warning";
				$msg['caption'] = "Sesi Anda Sudah Habis";
				$msg_title  = "Sesi anda sudah habis silahkan login";
				$msg['title'] = "";
				$msg['message'] = "";
				$msg['info'] = "Silahkan Login Kembali";
				$msg['url'] = "apps/login";
				$_SESSION['arrMsg'] = $msg;

				$data_log = $msg_title;
				$log = datalog(
					'ERROR',
					''.$data_log.''
				);
				$this->m_log->insert($log);	
				$page = base_url().'apps/c_msg';
				refresh($page);
			}
			else if($str==3){
				$msg['type'] = "msg_confirm";
				$msg['color'] = "card-warning";
				$msg['caption'] = "Status User Log Off";
				$msg_title  = "Status anda Log Off silahkan login";
				$msg['title'] = "";
				$msg['message'] = "";
				$msg['info'] = "Silahkan Login";
				$msg['url'] = "apps/login";
				$_SESSION['arrMsg'] = $msg;

				$data_log = $msg_title;
				$log = datalog(
					'ERROR',
					''.$data_log.''
				);
				$this->m_log->insert($log);	
				$page = base_url().'apps/c_msg';
				refresh($page);

			}

		}
		else{
			$msg['type'] = "msg_confirm";
			$msg['color'] = "card-warning";
			$msg['caption'] = "Anda Sudah Logout";
			$msg_title  = "Anda sudah logout silahkan login";
			$msg['title'] = "";
			$msg['message'] = "";
			$msg['info'] = "Silahkan Login";
			$msg['url'] = "apps/login";
			$_SESSION['arrMsg'] = $msg;

			$data_log = $msg_title;
			$log = datalog(
				'ERROR',
				''.$data_log.''
			);
			$this->m_log->insert($log);	
			$page = base_url().'apps/c_msg';
			refresh($page);
		}
	}

	function cekSesi($userID,$userName,$userPassword){
		$str = 0;
		$sessionTimeout = config_item('sessionTimeout');
		$sessionTimeoutSecond = 60 * $sessionTimeout;
		$time = time();

		$q = " SELECT statusLogin, userLastUpdate FROM tbl_users WHERE userID = '$userID' AND userName='$userName' AND userPassword='$userPassword' ";

		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$lastAction = $row->userLastUpdate;
			if($row->statusLogin=="Log Off"){
				$str = 3;
			}else{
				if ($time-$lastAction >= $sessionTimeoutSecond){
					$str = 2;
				}
				else{
					$this->userLastUpdate($userID);
					$str = 1;
				}

			}
		}
		return $str;
	}

	function cekAkses($functionID,$action){
		$userGroup = $_SESSION['arrayLogin']['userGroup'];
		if($_SESSION['arrList'][$functionID][$action]==1){
			return true;
		}else{
			return false;
		}
	}

	function userLastUpdate($userID){
		$time = time();
		$q = " UPDATE tbl_users SET userLastUpdate='$time' WHERE userID='$userID'";
		$sql = $this->db->query($q);
		return $sql;
	}
}
?>
