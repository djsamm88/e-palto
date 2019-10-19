<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_c_kecamatan extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(3,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,kecamatan,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_kecamatan';

			$data['access_add'] = $this->access_add;
			$data['access_delete'] = $this->access_delete;

			$data["tab"] = "tab1";
			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_kecamatan/index',$data);
			}
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->access_view;
			$data['access_add'] = $this->access_add;
			$data['access_edit'] = $this->access_edit;
			$data['access_delete'] = $this->access_delete;

			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'kecamatan_id';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'id' => $this->input->post('id'),
				'judul' => $this->input->post('judul'),
				'tgl' => $this->input->post('tgl'),
				'isi' => $this->input->post('isi'),
				'field4' => $this->input->post('field4'),
				'field5' => $this->input->post('field5'),
				'field6' => $this->input->post('field6'),
				'field7' => $this->input->post('field7'),
				'field8' => $this->input->post('field8'),
				'field9' => $this->input->post('field9')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data["sql1"] = $this->m_kecamatan->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_hal = $this->m_kecamatan->rows($data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_hal->num_rows();

			$this->load->view("apps/a_v_kecamatan/data",$data);
		}
	}

	function rows(){
		if($this->cekAccess('view')){
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');
			$data_set = array(
				'id' => $this->input->post('id'),
				'judul' => $this->input->post('judul'),
				'tgl' => $this->input->post('tgl'),
				'isi' => $this->input->post('isi'),
				'field4' => $this->input->post('field4'),
				'field5' => $this->input->post('field5'),
				'field6' => $this->input->post('field6'),
				'field7' => $this->input->post('field7'),
				'field8' => $this->input->post('field8'),
				'field9' => $this->input->post('field9')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$tot_hal = $this->m_kecamatan->rows($data_set);

			$jlh = $tot_hal->num_rows();
			echo ceil( $jlh/$limit );
		}
	}

	function edit(){
		if($this->cekAccess('edit')){
			$menudata="apps/home, home, / |,kecamatan,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_kecamatan';

			$data['access_add'] = $this->access_add;
			$data['access_delete'] = $this->access_delete;

			$data["tab"] = "tab2";
			if($this->cekAccess('edit')){
				$this->load->view('apps/a_v_kecamatan/form',$data);
			}
		}
	}

	function update(){
		if($this->cekAccess("edit")){
			$op = $this->input->post('op') ? $this->input->post('op') : '';
			$kecamatan_idGet = $this->input->post("kecamatan_idGet");
			$kecamatan_id = $this->input->post("kecamatan_id");
			$desa_id = $this->input->post("desa_id");
			$nama = $this->input->post("nama");
			$pimpinan = $this->input->post("pimpinan");
			$kategori = $this->input->post("kategori");

			$kecamatan_idLama = $this->input->post("kecamatan_idLama");
			$desa_idLama = $this->input->post("desa_idLama");
			
			if($op==""){
				if($kategori=="kecamatan"){
					$desa_id = "000";
				}
				$data = array(
					'kecamatan_id' => $kecamatan_id,
					'desa_id' => $desa_id,
					'nama' => $nama,
					'pimpinan' => $pimpinan,
					'dt_created' => time(),
					'created_by' => $_SESSION['arrayLogin']['userID']
				);
				$this->m_kecamatan->insert($data);
				$ket_log ="Tambah data kecamatan berhasil<br>";
				$ket_log .=", kecamatan_id : ".$kecamatan_id.$desa_id;
				$ket_log .=", nama : ".$nama;
				
				$log = datalog(
					'INSERT',
					''.$ket_log.''
				);
				$this->m_log->insert($log);
				$data_set = array(
					'tipe' => 'success',
					'msg' => $ket_log,
				);
				echo json_encode($data_set);

			}
			else if($op=="edit"){
				$cekkecamatanAnak = 0;
				$cekkecamatanUser = 0;
				if($kategori=="kecamatan"){
					$cekkecamatanAnak = $this->m_kecamatan->cekkecamatanAnak($kecamatan_idLama);
					$cekkecamatanUser = $this->m_kecamatan->cekkecamatanUser($kecamatan_idLama);
				}
				$cekkecamatanAnggota = $this->m_kecamatan->cekkecamatanAnggota($kecamatan_idLama,$desa_idLama);
				/*if($cekkecamatanAnak>0 || $cekkecamatanAnggota>0 || $cekkecamatanUser>0){
					$ket_log ="Ubah data kecamatan gagal<br>";
					$ket_log .="kecamatan_id : ".$kecamatan_id.".".$desa_id."<br>";
					$ket_log .="nama : ".$nama."<br>";

					if($cekkecamatanAnggota>0){
						$ket_log .= "kecamatan tidak dapat diubah karena memiliki ".$cekkecamatanAnggota." anggota";
					}
					else if($cekkecamatanUser>0){
						$ket_log .= "kecamatan tidak dapat diubah karena memiliki ".$cekkecamatanUser." user";
					}else{
						$ket_log .= "kecamatan tidak dapat diubah karena kecamatan sudah memiliki ".$cekkecamatanAnak." desa";
					}

					$log = datalog(
						'UPDATE',
						''.$ket_log.''
					);
					$this->m_log->insert($log);

					$data_set = array(
						'tipe' => 'danger',
						'msg' => $ket_log,
					);
					echo json_encode($data_set);


				}else{
				*/	$data = array(
						'kecamatan_id' => $kecamatan_id,
						'desa_id' => $desa_id,
						'nama' => $nama,
						'pimpinan' => $pimpinan,
						'dt_updated' => time(),
						'updated_by' => $_SESSION['arrayLogin']['userID']
					);
					$this->m_kecamatan->update($kecamatan_idLama,$desa_idLama,$data);
					$ket_log ="Ubah data kecamatan berhasil<br>";
					$ket_log .="kecamatan_id : ".$kecamatan_id;
					$ket_log .=", desa_id : ".$desa_id;
					$ket_log .=", nama : ".$nama;

					$log = datalog(
						'UPDATE',
						''.$ket_log.''
					);
					$this->m_log->insert($log);
					$data_set = array(
						'tipe' => 'success',
						'msg' => $ket_log,
					);
					echo json_encode($data_set);
				//}
			}
			else if($op=="hapus"){
				$cekkecamatanAnak = 0;
				$cekkecamatanUser = 0;
				if($kategori=="kecamatan"){
					$cekkecamatanAnak = $this->m_kecamatan->cekkecamatanAnak($kecamatan_idLama);
					$cekkecamatanUser = $this->m_kecamatan->cekkecamatanUser($kecamatan_idLama);
				}
				$cekkecamatanAnggota = $this->m_kecamatan->cekkecamatanAnggota($kecamatan_idLama,$desa_idLama);
				if($cekkecamatanAnak>0 || $cekkecamatanAnggota>0 || $cekkecamatanUser>0){

					$ket_log ="Hapus data kecamatan gagal<br>";
					$ket_log .="kecamatan_id : ".$kecamatan_id;
					$ket_log .=", desa_id : ".$desa_id;
					$ket_log .=", nama : ".$nama;

					if($cekkecamatanAnggota>0){
						$ket_log .= "kecamatan tidak dapat dihapus karena memiliki ".$cekkecamatanAnggota." anggota";
					}
					else if($cekkecamatanUser>0){
						$ket_log .= "kecamatan tidak dapat dihapus karena memiliki ".$cekkecamatanUser." user";
					}else{
						$ket_log .= "kecamatan tidak dapat dihapus karena kecamatan sudah memiliki ".$cekkecamatanAnak." desa";
					}


					$log = datalog(
						'DELETE',
						''.$ket_log.''
					);
					$this->m_log->insert($log);

					$data_set = array(
						'tipe' => 'danger',
						'msg' => $ket_log,
					);
					echo json_encode($data_set);


				}else{
					$this->m_kecamatan->delete($kecamatan_idLama,$desa_idLama);
					$ket_log ="Hapus data kecamatan berhasil<br>";
					$ket_log .="kecamatan_id : ".$kecamatan_id;
					$ket_log .=", nama : ".$nama;

					$log = datalog(
						'DELETE',
						''.$ket_log.''
					);
					$this->m_log->insert($log);
					$data_set = array(
						'tipe' => 'success',
						'msg' => $ket_log,
					);
					echo json_encode($data_set);
				}
			}
			
			
		}
	}
}