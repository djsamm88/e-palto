<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_lap_tiket extends CI_Model {

	function lap_tiket1_data($kecamatan_id,$desa_id,$tgl_awal,$tgl_akhir,$limit,$offset){
		$dataSet = array();
		$q = " SELECT * FROM tbl_tiket ";
		$q .= " WHERE id_tiket!='' ";
        if($kecamatan_id!=""){
			$q .= "AND kecamatan_id = '$kecamatan_id' ";
       		if($desa_id!=""){
				$q .= "AND desa_id = '$desa_id' ";
       		}
		}
		if($tgl_awal!=""){
			$q .= "AND tgl_tiket >= '$tgl_awal' ";
		}
        if($tgl_akhir!=""){
			$q .= "AND tgl_tiket <= '$tgl_akhir' ";
		}
		if($status_anggota!=""){
			$q .= "AND status_anggota = '$status_anggota' ";
		}
		$q .= " ORDER BY id_tiket ASC";
		if($limit!=''){
			$q .= " LIMIT $offset,$limit";
		}
		//print($q);
		$sql = $this->db->query($q);
		return $sql;
	}

	function lap_tiket2_data($kecamatan_id,$desa_id,$tgl_awal,$tgl_akhir,$status_anggota,$limit,$offset){
		$dataSet = array();
		$q = " SELECT * FROM tbl_tiket ";
		$q .= " WHERE id_tiket!='' ";
        if($kecamatan_id!=""){
			$q .= "AND kecamatan_id = '$kecamatan_id' ";
       		if($desa_id!=""){
				$q .= "AND desa_id = '$desa_id' ";
       		}
		}
		if($tgl_awal!=""){
			$q .= "AND tgl_tiket >= '$tgl_awal' ";
		}
        if($tgl_akhir!=""){
			$q .= "AND tgl_tiket <= '$tgl_akhir' ";
		}
		if($status_anggota!=""){
			$q .= "AND status_anggota = '$status_anggota' ";
		}
		$q .= " ORDER BY id_tiket ASC";
		if($limit!=''){
			$q .= " LIMIT $offset,$limit";
		}
		//print($q);
		$sql = $this->db->query($q);
		return $sql;
	}

	function lap_tiket3_data($tgl_saldo_awal, $akun_kode, $tgl_awal, $tgl_akhir, $kecamatan_id){
		$dataSet = array();

		return $dataSet;
	}

	function m_lap_tiket_range($tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
					
					SELECT 
						a.id_tiket_grp,
						b.no_tiket_grp,
                        a.tiket_nobat,
						a.tiket_nik AS nomor_id,
						a.tiket_nama,
						a.jenis_penumpang,
						a.jenis_penumpang_id,
						a.nominal,
						b.tanggal,
						b.nakhoda_id,
						c.description AS nama_nakhoda,
						d.description AS jenis_detail,
						e.description AS tujuan

						
					FROM tbl_tiket a 
						
					INNER JOIN tbl_tiket_grp b 
						ON a.id_tiket_grp=b.id_tiket_grp
						
					INNER JOIN 
						(
						    SELECT description,id FROM tbl_parameter WHERE name='daftar.nakhoda'
						)c 

					ON b.nakhoda_id=c.id

					INNER JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='PENUMPANG'
						)d

					ON a.jenis_penumpang=d.name AND a.jenis_penumpang_id=d.id	


					LEFT JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='RUTE'
						)e

					ON a.tujuan_id=e.id
                    
					 WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' 

					 ORDER BY tanggal DESC
			");
		return $q->result();
	}



	function m_lap_tiket_cetak($tiket_nobat)	
	{
		$q = $this->db->query("

				SELECT 
						a.tiket_nobat,
						a.tiket_nik AS nomor_id,
						a.tiket_nama,
						a.jenis_penumpang,
						a.jenis_penumpang_id,
						a.nominal,
						b.tanggal,
						b.nakhoda_id,
						c.description AS nama_nakhoda,
						d.description AS jenis_detail,
						e.description AS tujuan

						
					FROM tbl_tiket a 
						
					INNER JOIN tbl_tiket_grp b 
						ON a.id_tiket_grp=b.id_tiket_grp
						
					INNER JOIN 
						(
						    SELECT description,id FROM tbl_parameter WHERE name='daftar.nakhoda'
						)c 

					ON b.nakhoda_id=c.id

					INNER JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='PENUMPANG'
						)d

					ON a.jenis_penumpang=d.name AND a.jenis_penumpang_id=d.id	


					LEFT JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='RUTE'
						)e

					ON a.tujuan_id=e.id	

					WHERE a.tiket_nobat='$tiket_nobat'

			");

		return $q->result();
	}





	function m_lap_keuangan_range($tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
					
					SELECT 
					a.tanggal,
					SUM(a.penum_orang) AS penum_orang,
					SUM(a.penum_kendaraan) AS penum_kendaraan,
					SUM(a.penum_paket) AS penum_paket,
					SUM(a.nominal) as nominal
					FROM(
							SELECT 
							a.tanggal,a.nominal,
							CASE WHEN a.jenis_penumpang='penum.orang' THEN 1 END AS penum_orang,
							CASE WHEN a.jenis_penumpang='penum.kendaraan' THEN 1 END AS penum_kendaraan,
							CASE WHEN a.jenis_penumpang='penum.paket' THEN 1 END AS penum_paket
								
							FROM(
									SELECT b.tanggal,a.jenis_penumpang,a.nominal
							        FROM tbl_tiket a
							        INNER JOIN tbl_tiket_grp b 
							        ON a.id_tiket_grp=b.id_tiket_grp
							    	WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' 
							    )a

					)a
					GROUP BY a.tanggal


					 ORDER BY tanggal DESC
			");
		return $q->result();
	}

	function m_lap_tiket_by_trip($id_tiket_grp)
	{
		$q = $this->db->query("
				SELECT 
						a.id_tiket_grp,
						b.no_tiket_grp,
						a.tiket_nobat,
						a.tiket_nik AS nomor_id,
						a.tiket_nama,
						a.jenis_penumpang,
						a.jenis_penumpang_id,
						a.nominal,
						b.tanggal,
						b.nakhoda_id,
						c.description AS nama_nakhoda,
						d.description AS jenis_detail,
						e.description AS tujuan

						
					FROM tbl_tiket a 
						
					INNER JOIN tbl_tiket_grp b 
						ON a.id_tiket_grp=b.id_tiket_grp
						
					INNER JOIN 
						(
						    SELECT description,id FROM tbl_parameter WHERE name='daftar.nakhoda'
						)c 

					ON b.nakhoda_id=c.id

					INNER JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='PENUMPANG'
						)d

					ON a.jenis_penumpang=d.name AND a.jenis_penumpang_id=d.id	


					LEFT JOIN 
						(
							SELECT description,name,id FROM tbl_parameter WHERE groups='RUTE'
						)e

					ON a.tujuan_id=e.id
                    
                    WHERE a.id_tiket_grp='$id_tiket_grp'
			");

		return $q->result();
	}

	
}