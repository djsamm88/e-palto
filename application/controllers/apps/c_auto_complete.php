<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_auto_complete extends CI_Controller {
	public function __construct(){
		parent::__construct(); 
	}

	function loadDesa(){
		$kecamatan_id = $this->input->get("kecamatan_id");
		$sql1 = $this->m_kecamatan->getdesa($kecamatan_id);
		echo "<option value=''>Pilih Semua</option>";
		foreach ($sql1->result() as $obj1) {
			echo "<option value='".$obj1->desa_id."'>[".$obj1->desa_id."] ".$obj1->nama."</option>";
		}
	}

	function anggotaAutocomplete(){
		$status_anggota = $_GET['status_anggota'] ? $_GET['status_anggota'] : '';
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$sql = mysql_query("SELECT * FROM tbl_anggota WHERE (id_anggota LIKE '%$term%' OR nama LIKE '%$term%') LIMIT 0,10");
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_anggota']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['desa_id'];
				$row['id_anggota']=htmlentities(stripslashes($t['id_anggota']));
				$row['value']=htmlentities(stripslashes($t['id_anggota']." - ".$t['nama']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}


	function akunAutocomplete(){
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$sql = mysql_query("SELECT * FROM tbl_bukubesar WHERE (akun_kode LIKE '%$term%' OR nama LIKE '%$term%') AND akun_level=4 ORDER BY akun_kode LIMIT 0,10");
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_akun']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			$row['id']=0;
			$row['id_akun']="";
			$row['value']="Pilih Semua";
			$row_set[] = $row;
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['akun_kode'];
				$row['id_akun']=htmlentities(stripslashes($t['akun_kode']));
				$row['value']=htmlentities(stripslashes($t['akun_kode']." - ".$t['nama']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}

	function depositoAutocomplete(){
		$status_deposito = $_GET['status_deposito'] ? $_GET['status_deposito'] : '';
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$q = " SELECT t2.*, t1.nama FROM tbl_anggota t1, tbl_nasabah_deposito t2 ";
		$q .= " WHERE (t2.norek_deposito LIKE '%$term%' OR t1.id_anggota LIKE '%$term%' OR t1.nama LIKE '%$term%') ";
		$q .= " AND t1.id_anggota=t2.id_anggota ";
		//$q .= " AND t1.status_anggota!='10' ";
		//$q .= " AND t2.status_deposito='$status_deposito' ";
		$q .= " LIMIT 0,10";
		$sql = mysql_query($q);
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_anggota']="";
			$row['norek_deposito']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['nomor_deposito'];
				$row['id_anggota']=htmlentities(stripslashes($t['id_anggota']));
				$row['norek_deposito']=htmlentities(stripslashes($t['norek_deposito']));
				$row['value']=htmlentities(stripslashes("[".$t['norek_deposito']."] ".$t['id_anggota']." - ".$t['nama']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}

	function kreditAutocomplete(){
		$status_kredit = $_GET['status_kredit'] ? $_GET['status_kredit'] : '';
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$q = " SELECT t2.*, t1.nama FROM tbl_anggota t1, tbl_nasabah_kredit t2 ";
		$q .= " WHERE (t2.norek_kredit LIKE '%$term%' OR t1.id_anggota LIKE '%$term%' OR t1.nama LIKE '%$term%') ";
		$q .= " AND t1.id_anggota=t2.id_anggota ";
		//$q .= " AND t1.status_anggota!='10' ";
		//$q .= " AND t2.status_kredit='$status_kredit' ";
		$q .= " LIMIT 0,10";
		$sql = mysql_query($q);
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_anggota']="";
			$row['norek_kredit']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['nomor_kredit'];
				$row['id_anggota']=htmlentities(stripslashes($t['id_anggota']));
				$row['norek_kredit']=htmlentities(stripslashes($t['norek_kredit']));
				$row['value']=htmlentities(stripslashes("[".$t['norek_kredit']."] ".$t['id_anggota']." - ".$t['nama']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}

	function tabunganAutocomplete(){
		$status_tabungan = $_GET['status_tabungan'] ? $_GET['status_tabungan'] : '';
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$q = " SELECT t2.*, t1.nama FROM tbl_anggota t1, tbl_nasabah_tabungan t2 ";
		$q .= " WHERE (t2.norek_tabungan LIKE '%$term%' OR t1.id_anggota LIKE '%$term%' OR t1.nama LIKE '%$term%') ";
		$q .= " AND t1.id_anggota=t2.id_anggota ";
		//$q .= " AND t1.status_anggota!='10' ";
		//$q .= " AND t2.status_tabungan='$status_tabungan' ";
		$q .= " LIMIT 0,10";
		$sql = mysql_query($q);
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_anggota']="";
			$row['norek_tabungan']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['nomor_tabungan'];
				$row['id_anggota']=htmlentities(stripslashes($t['id_anggota']));
				$row['norek_tabungan']=htmlentities(stripslashes($t['norek_tabungan']));
				$row['value']=htmlentities(stripslashes("[".$t['norek_tabungan']."] ".$t['id_anggota']." - ".$t['nama']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}

	function userAutocomplete(){
		$status_user = $_GET['status_user'] ? $_GET['status_user'] : '';
		$term = $_GET['term'] ? $_GET['term'] : '';
		$term = trim(strip_tags($term));
		$sql = mysql_query("SELECT * FROM tbl_users WHERE (userID LIKE '$term%' OR userName LIKE '%$term%') LIMIT 0,10");
		if(mysql_num_rows($sql)<=0){
			$row['id']=0;
			$row['id_user']="";
			$row['value']="Tidak Ditemukan";
			$row_set[] = $row;
		}
		else{
			$row['id']=0;
			$row['id_user']="";
			$row['value']="Pilih Semua";
			$row_set[] = $row;
			while ($t= mysql_fetch_array($sql)) {
				$row['id']=(int)$t['userID'];
				$row['id_user']=htmlentities(stripslashes($t['userID']));
				$row['value']=htmlentities(stripslashes($t['userID']." - ".$t['userName']));
				$row_set[] = $row;
			}
		}
		echo json_encode($row_set);
	}
}