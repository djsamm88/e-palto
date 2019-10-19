<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_akses_group extends CI_Model {

	function getfunctionID($groupID){
		$data = array();
		$q = " SELECT * FROM tbl_user_access WHERE groupID='$groupID'";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$kode = $obj1->functionID;
			//$data[$kode]['functionID'] = $obj1->functionID;
			$data[$kode]['view'] = $obj1->action_1;
			$data[$kode]['add'] = $obj1->action_2;
			$data[$kode]['edit'] = $obj1->action_3;
			$data[$kode]['delete'] = $obj1->action_4;
			$data[$kode]['report'] = $obj1->action_5;
		}
		return $data;
	}

	function updateGroupfunctionID($groupID,$functionID,$data){
		$this->db->where("groupID",$groupID);
		$this->db->where("functionID",$functionID);
		$this->db->update("tbl_user_access",$data);
	}

	function updateUserGroup($groupID,$data){
		$this->db->where("userGroup",$groupID);
		$this->db->update("tbl_users",$data);
	}
}
?>