<?php 

/**
* 
*/
class Soal extends CI_Controller
{

	var $tablename = "soal";
	var $module = "master/soal";
	var $view_dir_name = "soal";
	
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
			$data['list'] = $this->get_all_guru();
			$this->load->view($this->view_dir_name.'/data', $data);
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
		$data['soal'] = $this->input->post('soal');
		$data['opsi_a'] = $this->input->post('opsi_a');
		$data['opsi_b'] = $this->input->post('opsi_b');
		$data['opsi_c'] = $this->input->post('opsi_c');
		$data['opsi_d'] = $this->input->post('opsi_d');
		$data['jawaban'] = $this->input->post('jawaban');

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

	function get_all_guru()
	{
		if ($this->session->userdata('level') == 'guru') {
			return $this->db->get_where($this->tablename, array('id_pembuat'=>$this->session->userdata('id_person')));
		} else if ($this->session->userdata('level') == 'admin') {
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
}

 ?>