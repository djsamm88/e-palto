<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_edit_password extends CI_Model {
	
	function update($pass_lama,$pass_baru,$ulang_pass_baru){
		$userID = $_SESSION['arrayLogin']['userID'];
		$userPassword = $_SESSION['arrayLogin']['userPassword'];
		if($pass_lama!=$userPassword){
			$data = array(
				'status' => 0,
				'keterangan' => 'password lama tidak sama'
			);
		}
		else if($pass_baru!=$ulang_pass_baru){
			$data = array(
				'status' => 0,
				'keterangan' => 'anda salah mengulang password'
			);
		}
		else{
			$sql = $this->db->query("UPDATE tbl_users SET userPassword='$pass_baru' WHERE userID='$userID'");
			if($sql){
				$_SESSION['arrayLogin']['userPassword'] = $pass_baru;
				$data = array(
					'status' => 1,
					'keterangan' => 'password berhasil di edit'
				);
			}
			else{
				$data = array(
					'status' => 0,
					'keterangan' => 'gagal update password'
				);
			}
		}
		return $data;

	}
}