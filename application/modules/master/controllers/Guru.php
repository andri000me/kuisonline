<?php 

/**
* 
*/
class Guru extends CI_Controller
{

	var $tablename = "guru";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('crud','data');
	}

	function index()
	{
		if ($this->check_session() == true) {
			$this->load->view('guru/info');
		} else {
			redirect('auth');
		}
	}

	function data()
	{
		if ($this->check_session() == true) {
			$data['list'] = $this->get_all_guru();
			$this->load->view('guru/data', $data);
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
		$id = $this->total_rows()+1;
		$data['nama'] = $this->input->post('nama');
		$data['jurusan'] = $this->input->post('jurusan');
		
		$res = $this->data->write($this->tablename, $data);
		if ($res) {
			redirect('master/guru/data');
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
			redirect('master/guru/data');
		}
	}

	function get_all_guru()
	{
		return $this->data->read('guru');
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