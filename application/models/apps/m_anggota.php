<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_anggota extends CI_Model {

	function getMaxIDNasabah($tipe_anggota){
		$maxNo = 0;
	 	$q = "select max(nomor_anggota) as 'maxNo' from tbl_anggota ";
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$maxNo = $row->maxNo;
		}
		return $maxNo;
	}


	function views($limit,$offset,$sidx,$sord,$where){
		$where = $this->where($where);
		$q = "SELECT *
			FROM tbl_anggota
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit";
			//print_r($q);
		$sql = $this->db->query($q);
		return $sql;
	}

	function rows($where){
		$where = $this->where($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_anggota
			$where
			");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_anggota",$data);
	}

	function where($where){
		$str = " WHERE id_anggota!='' ";
		foreach ($where as $key => $value) {
			if(!empty($value)){
				if($key=="id_anggota" || $key=="status_anggota" || $key=="kecamatan_id" || $key=="lingk_id" || $key=="tipe_anggota" || $key=="jenis_kelamin"){
					$str .= " AND ".$key. " = '".$value."'";
				}
				if($key=="nama"){
					$str .= " AND ".$key. " LIKE '%".$value."%'";
				}
				if($key=="tgl_awal"){
					$str .= " AND tgl_pendaftaran >= '".$value."'";
				}
				if($key=="tgl_akhir"){
					$str .= " AND tgl_pendaftaran <= '".$value."'";
				}
			}
		}
		//print_r($str);
		return $str;
	}

	function ubahStatusAnggota($id_anggota,$data){
		$this->db->where("id_anggota",$id_anggota);
		$this->db->update("tbl_anggota",$data);
	}

	function detail_anggota($id_anggota){
		$q = " SELECT * ";
		$q .= " FROM tbl_anggota ";
		$q .= " WHERE id_anggota='$id_anggota' ";
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$data = array(
				'id_anggota' => $row->id_anggota,
				'nomor_anggota' => $row->nomor_anggota,
				'tipe_anggota' => $row->tipe_anggota,
				'kartu_id_tipe' => $row->kartu_id_tipe,
				'kartu_id_no' => $row->kartu_id_no,
				'nama' => $row->nama,
				'nama_gelar' => $row->nama_gelar,
				'tingkat_pendidikan' => $row->tingkat_pendidikan,
				'lahir_tempat' => $row->lahir_tempat,
				'lahir_tgl' => $row->lahir_tgl,
				'jenis_kelamin' => $row->jenis_kelamin,
				'status_perkawinan' => $row->status_perkawinan,
				'alamat_id' => $row->alamat_id,
				'alamat_id_kota' => $row->alamat_id_kota,
				'alamat_id_pos' => $row->alamat_id_pos,
				'alamat_act' => $row->alamat_act,
				'alamat_act_kota' => $row->alamat_act_kota,
				'alamat_act_pos' => $row->alamat_act_pos,
				'phone' => $row->phone,
				'hp' => $row->hp,
				'pekerjaan' => $row->pekerjaan,
				'nama_kantor' => $row->nama_kantor,
				'alamat_kantor' => $row->alamat_kantor,
				'alamat_kantor_kota' => $row->alamat_kantor_kota,
				'alamat_kantor_pos' => $row->alamat_kantor_pos,
				'penghasilan_bulanan' => $row->penghasilan_bulanan,
				'tgl_pendaftaran' => $row->tgl_pendaftaran,
				'golongan_anggota' => $row->golongan_anggota,
				'status_anggota' => $row->status_anggota,
				'kecamatan_id' => $row->kecamatan_id,
				'lingk_id' => $row->lingk_id,
				'kartu_id_no2' => $row->kartu_id_no2,
				'kartu_id_no_kk' => $row->kartu_id_no_kk,
				'ahli_waris' => $row->ahli_waris,
				'ahli_waris_hub' => $row->ahli_waris_hub,
				'created_by' => $row->created_by,
				'dt_created' => $row->dt_created,
				'dt_updated' => $row->dt_updated,
				'updated_by' => $row->updated_by
			);
		}
		return $data;
	}

	function detailAnggotaKredit($norek_kredit){
		$q = " SELECT t1.kecamatan_id,t1.lingk_id,t1.id_anggota,t1.lahir_tgl, ";
		$q .= " t1.nama, ";
		$q .= " t2.jangka_waktu ";
		$q .= " FROM tbl_anggota t1, tbl_nasabah_kredit t2";
		$q .= " WHERE t1.id_anggota=t2.id_anggota ";
		$q .= " AND t2.norek_kredit='$norek_kredit' ";
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$data = array(
				'kecamatan_id' => $row->kecamatan_id,
				'lingk_id' => $row->lingk_id,
				'id_anggota' => $row->id_anggota,
				'nama' => $row->nama,
				'lahir_tgl' => $row->lahir_tgl,
				'jangka_waktu' => $row->jangka_waktu,
				'dt_created' => $row->dt_created,
				'dt_updated' => $row->dt_updated,
				'updated_by' => $row->updated_by
			);
		}
		return $data;
	}

	function getIDAnggotaNorek($norek, $trx_group){
		$id_anggota = "";
        if($trx_group=="T"){
    	 	$q = "SELECT id_anggota FROM tbl_nasabah_tabungan WHERE norek_tabungan='$norek'";
        } else if($trx_group=="D"){
    	 	$q = "SELECT id_anggota FROM tbl_nasabah_deposito WHERE norek_deposito='$norek'";
        } else if($trx_group=="K"){
    	 	$q = "SELECT id_anggota FROM tbl_nasabah_kredit WHERE norek_kredit='$norek'";
        } else if($trx_group=="A"){
    	 	$q = "SELECT id_anggota FROM tbl_nasabah_kredit WHERE norek_kredit='$norek'";
        } else if($trx_group=="B"){
    	 	$q = "SELECT id_anggota FROM tbl_nasabah_kredit WHERE norek_kredit='$norek'";
        }

        $sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$id_anggota = $row->id_anggota;
		}
		return $id_anggota;
	}
}
?>