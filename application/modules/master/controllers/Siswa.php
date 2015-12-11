<?php 

/**
* 
*/
class Siswa extends CI_Controller
{

	var $tablename = "siswa";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('crud','data');
	}

	function index()
	{
		if ($this->check_session() == true) {
			$this->load->view('siswa/info');
		} else {
			redirect('auth');
		}
	}

	function data()
	{
		if ($this->check_session() == true) {
			$data['list'] = $this->get_all_data();
			$this->load->view('siswa/data', $data);
		} else {
			redirect('auth');
		}
	}

	function save()
	{
		$data['nama'] = $this->input->post('nama');
		$data['jurusan'] = $this->input->post('jurusan');
		
		$res = $this->data->write($this->tablename, $data);
		if ($res) {
			redirect('master/siswa/data');
		}
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
			redirect('master/siswa/data');
		}
	}

	function get_all_data()
	{
		return $this->data->read($this->tablename);
	}

	function check_session()
	{
		if ($this->session->userdata('logged_in') == 'yes') {
			return true;
		} else {
			return false;
		}
	}
}

 ?>