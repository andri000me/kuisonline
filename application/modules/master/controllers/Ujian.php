<?php 

/**
* 
*/
class Ujian extends CI_Controller
{

	var $tablename = "ujian";
	var $module = "master/ujian";
	var $view_dir_name = "ujian";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('crud','data');
	}

	function index()
	{
		if ($this->check_session() == true) {
			$this->load->view($this->view_dir_name.'/info');
		} else {
			redirect('auth');
		}
	}

	function data()
	{
		if ($this->check_session() == true) {
			$data['pilmp'] = $this->data->read('pelajaran');
			$data['list'] = $this->get_all_data();
			$this->load->view($this->view_dir_name.'/data', $data);
		} else {
			redirect('auth');
		}
	}

	function antrian()
	{
		if ($this->check_session() == true) {
			$data['pilmp'] = $this->data->read('pelajaran');
			$data['list'] = $this->get_all_data();
			$this->load->view($this->view_dir_name.'/lihatujian', $data);
		} else {
			redirect('auth');
		}
	}

	function total_rows()
	{
		return $this->db->get($this->tablename)->num_rows();
	}

	function save()
	{
		$data['judul'] = $this->input->post('soal');
		$data['jumlah_soal'] = $this->input->post('jumlahsoal');
		$data['waktu'] = $this->input->post('lamawaktu');

		$level = $this->session->userdata('level');
		if ($level == 'admin') {
			$pembuat = 0;
		} else if ($level == 'guru') {
			$pembuat = $this->session->userdata('id_person');
		}

		$data['id_pembuat'] = $pembuat;
		$data['id_mapel'] = $_POST['mapel'];

		$this->data->write($this->tablename, $data);
	}

	function edit()
	{
		$id = $this->uri->segment(4);
	}

	function delete()
	{
		$where['id'] = $this->uri->segment(4);
		$sql = $this->data->remove($this->tablename, $where);
		if ($sql) {
			redirect($this->module.'/data');
		}
	}

	function get_all_data()
	{
		if ($this->session->userdata('level') == 'guru') {
			return $this->db->get_where($this->tablename, array('id_pembuat'=>$this->session->userdata('id_person')));
		} else if ($this->session->userdata('level') == 'admin') {
			return $this->data->read($this->tablename);
		} else if ($this->session->userdata('level') == 'siswa') {
			return $this->data->read($this->tablename);
		}
	}

	function check_session()
	{
		if ($this->session->userdata('logged_in') == 'yes') {
			return true;
		} else {
			return false;
		}
	}

	function start()
	{
		if ($this->check_session() == true) {
			$uri = $this->uri->segment(4);
			// ambil seluruh soal ujian sesuai id ujian
			$getidmp = $this->db->get_where('ujian', array('id'=>$uri));
			$idmp = $getidmp->row()->id_mapel;
			$limit = $getidmp->row()->jumlah_soal;
			$data['soal'] = $this->db->query("SELECT * FROM soal WHERE id_mapel = $idmp ORDER BY RAND() LIMIT $limit;");

			$this->load->view($this->view_dir_name.'/kerjasoal', $data);
		} else {
			redirect('auth');
		}
	}
}

 ?>