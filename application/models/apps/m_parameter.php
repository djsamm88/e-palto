<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_parameter extends CI_Model {

	function views($where){
		$where = $this->where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			$where
			GROUP BY name ORDER BY name,id ASC");
		return $sql;
	}

	function pilih($where){
		$where = $this->where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			$where ORDER BY name,id ASC");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_parameter",$data);
	}

	function update($groups,$name,$id,$data){
		$this->db->where("groups",$groups);
		$this->db->where("name",$name);
		$this->db->where("id",$id);
		$this->db->update("tbl_parameter",$data);
	}

	function detail($id_parameter){
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			WHERE id='$id_parameter'");
		return $sql;
	}


	function delete($groups,$name,$id){
		$this->db->where("groups",$groups);
		$this->db->where("name",$name);
		$this->db->where("id",$id);
		$this->db->delete("tbl_parameter");
	}

	function where($where){
		$str = " WHERE id!='' ";
		foreach ($where as $key => $value) {
			if($key=="groups"){
				$str .= " AND groups ='".$value."'";
				//$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
			if($key=="name"){
				$str .= " AND name ='".$value."'";
				//$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}

	function getParameterArray($id,$name){
		$data = array();
		$q = " SELECT * FROM tbl_parameter ";
		$q .= " WHERE id='$id' AND name='$name' ";

		//zprint_r($q);
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$data = array(
				'nama' => $row->name,
				'description' => $row->description,
				'notes' => $row->notes
				);
		}
		return $data;
	}


	function getParameter($name){
		$data = array();
		$q = " SELECT * FROM tbl_parameter ";
		$q .= " WHERE name='$name' ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$kode = $obj1->groups.$obj1->id;
			$data[$kode]['groups'] = $obj1->groups;
			$data[$kode]['id'] = $obj1->id;
			$data[$kode]['description'] = $obj1->description;
			$data[$kode]['notes'] = $obj1->notes;
		}
		return $data;
	}

	function cekParameterTransaksi($trx_group,$trx_jurnal){
		$sql = $this->db->query("SELECT * FROM tbl_transaksi
			WHERE trx_group='$trx_group' AND trx_jurnal='$trx_jurnal'");
		return $sql->num_rows();
	}

	function cekParameterCount($groups,$name){
		$sql = $this->db->query("SELECT * FROM tbl_parameter
			WHERE groups='$groups' AND name='$name'");
		return $sql->num_rows();
	}
}
?>