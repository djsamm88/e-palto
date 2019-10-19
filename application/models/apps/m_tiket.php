<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tiket extends CI_Model {

	function views_tiket_grp(){
		$sql = $this->db->query("SELECT t1.*,t2.description as nama_nakhoda
			FROM tbl_tiket_grp t1
			LEFT JOIN tbl_parameter t2 ON t1.nakhoda_id=t2.id
			WHERE t1.status=0  AND t2.name='daftar.nakhoda'
			ORDER BY t1.id_tiket_grp ASC");
		return $sql;
	}

	function insert_tiket_grp($data){
		$this->db->insert("tbl_tiket_grp",$data);
	}

	function update_tiket_grp($id_tiket_grp,$data){
		$this->db->where("id_tiket_grp",$id_tiket_grp);
		$this->db->update("tbl_tiket_grp",$data);
	}

	function no_tiket_grp($tanggal){
		$sql = $this->db->query("
			SELECT max(no_tiket_grp) AS no_tiket_grp FROM tbl_tiket_grp
			WHERE tanggal='$tanggal'
			");
		foreach ($sql->result() as $row) {
			$x = $row->no_tiket_grp;
			if($x!=""){
				$no_tiket_grp	= $x+1;
			}
			else{
				$no_tiket_grp		= 1;
			}
		}
		return $no_tiket_grp;
	}

	function insert($data){
		$this->db->insert("tbl_tiket",$data);
	}

	function detail($id){
		$sql = $this->db->query("SELECT *,
			DATE_FORMAT(pem_Tanggal_Lahir,'%d-%m-%Y') AS pem_Tanggal_Lahir,
			DATE_FORMAT(Tanggal_tiket,'%d-%m-%Y') AS Tanggal_tiket,
			CONCAT(pem_Kecamatan,'|',pem_Desa) as pem_Desa
			FROM tbl_tiket
			WHERE id_tiket='$id'");
		return $sql;
	}

	function tiket_nobat(){
		$sql = $this->db->query("SELECT max(tiket_nobat) AS tiket_nobat FROM tbl_tiket");
		foreach ($sql->result() as $row) {
			$x = $row->tiket_nobat;
			if($x!=""){
				$kode = $x;
				$tiket_nobat = $kode+1;
			}
			else{
				$tiket_nobat = 1;
			}
		}
		return $tiket_nobat;
	}

}
?>