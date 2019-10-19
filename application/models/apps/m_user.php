<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	function views($limit,$offset,$sidx,$sord,$where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit");
		return $sql;
	}

	function rows($where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_users",$data);
	}

	function update($userID,$data){
		$this->db->where("userID",$userID);
		$this->db->update("tbl_users",$data);
	}

	function update2($data){
		$this->db->update("tbl_users",$data);
	}

	function detail($userID){
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			WHERE userID='$userID'");
		return $sql;
	}

	function delete($userID){
		$sql = $this->db->query("DELETE	FROM tbl_users
			WHERE userID='$userID'");
		return $sql;
	}

	function group_views($sidx,$sord,$where){
		$where = $this->parameterWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			$where
			ORDER BY $sidx $sord");
		return $sql;
	}

	function akses_tgl_views($limit,$offset,$sidx,$sord,$where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit");
		return $sql;
	}

	function akses_tgl_rows($where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			");
		return $sql;
	}


	function cek_logon($userID){
		$status_login = "Log On";
		$sessionTimeout = config_item('sessionTimeout');
		$sessionTimeoutSecond = 60 * $sessionTimeout;
		$time = time();
 		
 		$q = "SELECT statusLogin, userLastUpdate FROM tbl_users WHERE userID = '$userID'";


		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$statusLogin = $row->statusLogin;
			$lastAction = $row->userLastUpdate;
			if ($statusLogin=="Log Off" || $time-$lastAction >= $sessionTimeoutSecond){
				$status_login = "Log Off";
			}
		}
		return $status_login;
	}

	function parameterWhere($where){
		$str = " WHERE id!='' AND groups='USER' AND name='user.group'";
		foreach ($where as $key => $value) {
			if($key=="userID" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="userName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
			if($key=="realName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}

	function userWhere($where){
		$str = " WHERE userID!='' ";
		foreach ($where as $key => $value) {
			if($key=="userID" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="userName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
			if($key=="realName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}


	function detailUser($userID){
		$q = " SELECT * ";
		$q .= " FROM tbl_users ";
		$q .= " WHERE userID='$userID' ";
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$data = array(
				'userID' => $row->userID,
				'realName' => $row->realName,
				'userName' => $row->userName,
				'userGroup' => $row->userGroup,
				'kecamatan_id' => $row->kecamatan_id,
				'desa_id' => $row->desa_id,
				'accessDate' => $row->accessDate
			);
		}
		return $data;
	}

	function cekIdTransaksi($id){
		$sql = $this->db->query("SELECT * FROM tbl_transaksi
			WHERE created_by='$id' OR updated_by='$id'");
		return $sql->num_rows();
	}

}
?>