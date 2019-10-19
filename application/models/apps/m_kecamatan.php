<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kecamatan extends CI_Model {

	function views($limit,$offset,$sidx,$sord,$where){
		$where = $this->where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_kecamatan
			$where
			ORDER BY $sidx,desa_id $sord LIMIT $offset,$limit");
		return $sql;
	}

	function rows($where){
		$where = $this->where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_kecamatan
			$where
			");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_kecamatan",$data);
	}

	function update($kecamatan_id,$desa_id,$data){
		$this->db->where("kecamatan_id",$kecamatan_id);
		$this->db->where("desa_id",$desa_id);
		$this->db->update("tbl_kecamatan",$data);
	}

	function detail($kecamatan_id,$desa_id){
		$data = array();
		$q = " SELECT * FROM tbl_kecamatan ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id='$desa_id' ";
		//print_r($q);
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$data['kecamatan_id'] = $obj1->kecamatan_id;
			$data['desa_id'] = $obj1->desa_id;
			$data['nama'] = $obj1->nama;
			$data['pimpinan'] = $obj1->pimpinan;
		}
		return $data;
	}

	function delete($kecamatan_id,$desa_id){
		$sql = $this->db->query("DELETE	FROM tbl_kecamatan
			WHERE kecamatan_id='$kecamatan_id' AND desa_id='$desa_id'");
		return $sql;
	}

	function where($where){

		return "";
	}

	function getkecamatan(){
		$data = array();
		$q = " SELECT * FROM tbl_kecamatan ";
		$q .= " WHERE desa_id='000' ORDER BY kecamatan_id ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$kode = $obj1->kecamatan_id.$obj1->desa_id;
			$data[$kode]['kecamatan_id'] = $obj1->kecamatan_id;
			$data[$kode]['desa_id'] = $obj1->desa_id;
			$data[$kode]['nama'] = $obj1->nama;
			$data[$kode]['pimpinan'] = $obj1->pimpinan;
		}
		return $data;
	}

	function getkecamatanStr($kecamatan_id){
		$data = array();
		$q = " SELECT * FROM tbl_kecamatan ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id='000' ";
		$q .= " ORDER BY kecamatan_id ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$kode = $obj1->kecamatan_id.$obj1->desa_id;
			$data['kecamatan_id'] = $obj1->kecamatan_id;
			$data['desa_id'] = $obj1->desa_id;
			$data['nama'] = $obj1->nama;
			$data[$kode]['pimpinan'] = $obj1->pimpinan;
		}
		return $data;
	}

	function getdesa($kecamatan_id){
		$q = " SELECT * FROM tbl_kecamatan ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id!='000' ";
		$sql = $this->db->query($q);
		return $sql;
	}

	function getdesa2($kecamatan_id){
		$data = array();
		$q = " SELECT * FROM tbl_kecamatan ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id!='000' ";
		$q .= " ORDER BY kecamatan_id ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $obj1) {
			$kode = $obj1->kecamatan_id.$obj1->desa_id;
			$data[$kode]['kecamatan_id'] = $obj1->kecamatan_id;
			$data[$kode]['desa_id'] = $obj1->desa_id;
			$data[$kode]['nama'] = $obj1->nama;
			$data[$kode]['pimpinan'] = $obj1->pimpinan;
		}
		return $data;
	}

	function getJlhAnggota($kecamatan_id,$desa_id,$status){
		$q = " SELECT * FROM tbl_anggota ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id='$desa_id' AND status_anggota='$status' ";
		$sql = $this->db->query($q);
		return $sql->num_rows();
	}

	function getNotJlhAnggota($kecamatan_id,$desa_id,$status){
		$q = " SELECT * FROM tbl_anggota ";
		$q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id='$desa_id' AND status_anggota!='$status' ";
		$sql = $this->db->query($q);
		return $sql->num_rows();
	}

	function cekkecamatanAnak($kecamatan_id){
		$sql = $this->db->query("SELECT * FROM tbl_kecamatan
			WHERE kecamatan_id='$kecamatan_id' AND desa_id!='000'");
		return $sql->num_rows();
	}

	function cekkecamatanUser($kecamatan_id){
		$sql = $this->db->query("SELECT * FROM tbl_users
			WHERE kecamatan_id='$kecamatan_id'");
		return $sql->num_rows();
	}

	function cekkecamatanAnggota($kecamatan_id,$desa_id){
		$sql = $this->db->query("SELECT * FROM tbl_anggota
			WHERE kecamatan_id='$kecamatan_id' AND desa_id='$desa_id'");
		return $sql->num_rows();
	}
}
?>