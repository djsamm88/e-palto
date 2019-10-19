<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_site extends CI_Controller {

	var $cekLog;
	public function __construct(){
		parent::__construct(); 
	 	$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
	 	return $this->m_security->cekAkses(5,$action);
	}


	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_site';

			$data['access_add'] = $this->cekAccess('add');
			$data['access_delete'] = $this->cekAccess('delete');

			$data['tab'] = $this->input->get('group') ? $this->input->get('group') : 'berita';
			
			$this->load->view('apps/header');
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/v_site/index',$data);
			$this->load->view('apps/footer');
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->cekAccess('view');
			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');
		
		
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'id_site';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "desc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : 20;
			
			$id_site = $this->input->post('id_site') ? $this->input->post('id_site') : '';
			$site_group = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$judul = $this->input->post('judul') ? $this->input->post('judul') : '';
			$isi = $this->input->post('isi') ? $this->input->post('isi') : '';

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$where = $this->where($id_site,$site_group,$judul,$isi);
				
			$data["sql1"] = $this->m_site->views($limit,$offset,$sidx,$sord,$where);
			$tot_hal = $this->m_site->rows($where);

			$data["site_group"] = $site_group;
			$data["offset"] = $offset;
			$data["total"] = $tot_hal->num_rows();

			$this->load->view("apps/v_site/data",$data);
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function rows(){
		if($this->cekAccess('view')){
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$limit = $this->input->post("limit") ? $this->input->post("limit") : 20;

			$id_site = $this->input->post('id_site') ? $this->input->post('id_site') : '';
			$site_group = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$judul = $this->input->post('judul') ? $this->input->post('judul') : '';
			$isi = $this->input->post('isi') ? $this->input->post('isi') : '';

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$where = $this->where($id_site,$site_group,$judul,$isi);


			$tot_hal = $this->m_site->rows($where);


			$jlh = $tot_hal->num_rows();
			echo ceil( $jlh/$limit );
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function add(){
		if($this->cekAccess('add')){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_site';

			$data['access_add'] = $this->cekAccess('add');
			$data['access_delete'] = $this->cekAccess('delete');
	
			$data['tab'] = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$data['site_group'] = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$data["form"] = "add";
			$data["op"] = "add";
			
			$this->load->view('apps/header');
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/v_site/form',$data);
			$this->load->view('apps/footer');
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function insert(){
		if($this->cekAccess('add')){
			$id_site = $this->m_site->creat_primary();
			$site_group = $this->input->post("site_group");
			$judul = $this->input->post("judul");
			$site = $this->input->post("site");
			$isi = $this->input->post("isi");

			$url_site = $this->input->post("judul");
			$url_site = buang_karakter($url_site);
			$url_site = buang_spasi($url_site);
			$url_site = huruf_kecil($url_site).'.html';

			$data = array(
				'id_site' => $id_site,	
				'site_group' => $this->input->post("site_group"),
				'url_site' => $url_site,
				'judul' => $this->input->post("judul"),
				'gambar' => $this->input->post("gambar"),
				'isi' => $this->input->post("isi"),
				'created_by' => $_SESSION['arrayLogin']['userID'],
				'created_on' => date("Y-m-d H:i:s")
			);
			$this->m_site->insert($data);

			$ket_log ="Tambah Konten: <br>";
			
			$ket_log .="ID : ".$id_site."<br>";
			$ket_log .="Grup : ".$site_group."<br>";
			$ket_log .="Judul : ".$judul."<br>";
			$log = datalog(
				'INSERT',
				'apps/c_site/insert',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$page = base_url().'apps/c_site/?group='.$site_group;
			refresh($page);
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function edit(){
		if($this->cekAccess('edit')){
			$id_site = $this->input->get('id_site') ? $this->input->get('id_site') : '';
			$data["sql1"] = $this->m_site->edit($id_site);
			$data["form"] = "edit";
			$data["url_link"] = 'apps/c_site';
			$menudata="apps/home, home, / |,site,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			
			$data['access_add'] = $this->cekAccess('add');
			$data['access_delete'] = $this->cekAccess('delete');
			
			$data['tab'] = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$data['site_group'] = $this->input->get('group') ? $this->input->get('group') : 'berita';
			$data["op"] = "edit";
			
			$this->load->view('apps/header');
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/v_site/form',$data);
			$this->load->view('apps/footer');
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function update(){
		if($this->cekAccess('edit')){
			$id_site = $this->input->post("id_site");
			$site_group = $this->input->post("site_group");
			$judul = $this->input->post("judul");
			$site = $this->input->post("site");
			$isi = $this->input->post("isi");

			$url_site = $this->input->post("judul");
			$url_site = buang_karakter($url_site);
			$url_site = buang_spasi($url_site);
			$url_site = huruf_kecil($url_site).'.html';
			
			$data = array(
				'site_group' => $this->input->post("site_group"),
				'url_site' => $url_site,
				'judul' => $this->input->post("judul"),
				'gambar' => $this->input->post("gambar"),
				'isi' => $this->input->post("isi"),
				'updated_by' => $_SESSION['id_user'],
				'updated_on' => date("Y-m-d H:i:s")
			);
			$this->m_site->update($id_site,$data);
			$ket_log ="Ubah Konten: <br>";
			
			$ket_log .="ID : ".$id_site."<br>";
			$ket_log .="Grup : ".$site_group."<br>";
			$ket_log .="Judul : ".$judul."<br>";
			$log = datalog(
				'UPDATE',
				'apps/c_site/update',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$page = base_url().'apps/c_site/?group='.$site_group;
			refresh($page);
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function detail($id_site){
		if($this->cekAccess('view')){
			$data["sql"] = $this->m_site->detail($id_site);
			$get_select = $this->m_site->get_select($id_site);
			$data["sql2"] = $this->m_user->detail_user($get_select['created_by']);
			$data["sql3"] = $this->m_user->detail_user($get_select['updated_by']);
			
			$this->load->view('apps/v_site/detail',$data);
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function delete(){
		if($this->cekAccess('delete')){
			$pilih = $this->input->post("pilih");
			if($pilih!=""){
				$i=0;
				foreach ($pilih as $key) {
					$data_a = $this->m_site->get_select($pilih[$i]);
					$this->m_site->delete($pilih[$i]);
					$ket_log ="Hapus Konten<br>";
					$ket_log .="ID : ".$data_a['id_site']."<br>";
					$ket_log .="Grup : ".$data_a['site_group']."<br>";
					$ket_log .="Judul : ".$data_a['judul']."<br>";
					$log = datalog(
						'DELETE',
						'apps/c_site/delete',
						''.$ket_log.''
					);
					$this->m_log->insert($log);
					$i++;
				}
			}
		}
		else{
			$this->load->view("apps/message");
		}
	}

	function where($id_site,$site_group,$judul,$isi){
		$where=" where id_site !='' ";
		if($id_site!=""){
			$where.=" and id_site LIKE '%".$id_site."%' ";
		}
		if($site_group!=""){
			$where.=" and site_group LIKE '%".$site_group."%' ";
		}
		if($judul!=""){
			$where.=" and judul LIKE '%".$judul."%' ";
		}
		if($isi!=""){
			$where.=" and isi LIKE '%".$isi."%' ";
		}
		return $where;
	}
}