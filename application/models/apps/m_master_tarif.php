<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_master_tarif extends CI_Model {

	function views($sidx,$sord,$where){
		$where = $this->Where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			$where
			ORDER BY $sidx $sord");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_master_tarif",$data);
	}

	function update($id,$data){
		$this->db->where("id",$id);
		$this->db->update("tbl_master_tarif",$data);
	}

	function detail($id){
		$sql = $this->db->query("SELECT *
			FROM tbl_master_tarif
			WHERE id='$id'");
		return $sql;
	}

	function delete($id){
		$sql = $this->db->query("DELETE	FROM tbl_master_tarif
			WHERE tujuan_id='$id'");
		return $sql;
	}

	function Where($where){
		$str = " WHERE name='jenis.tarif' ";
		foreach ($where as $key => $value) {
			if($key=="id" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="description" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
			if($key=="realName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}


	function edit_tarif($tujuan_id){
		$data = array();
		$q = " SELECT * FROM tbl_master_tarif ";
		$q .= " WHERE tujuan_id='$tujuan_id' ";
		//print_r($q);
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$data[$obj1->tujuan_id.$obj1->jenis_penumpang.$obj1->tiket_jenis] = $obj1->nominal;
		}
		//print_r($data);
		return $data;
	}
}
?>