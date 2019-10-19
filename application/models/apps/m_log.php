<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {

	function views($limit,$offset,$sidx,$sord,$where){
		$sql = $this->db->query("SELECT *
			FROM tbl_log
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit");
		return $sql;
	}

	function rows($where){
		$sql = $this->db->query("SELECT *
			FROM tbl_log
			$where
			");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_log",$data);
	}

	function detail($logID){
		$sql = $this->db->query("SELECT *
			FROM tbl_log
			WHERE logID='$logID'");
		return $sql;
	}
}
?>