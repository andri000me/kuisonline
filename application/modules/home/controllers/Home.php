<?php 

/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if ($this->check_session() == true) {
			$level = $this->session->userdata('level');
			if ($level == 'admin') {
				$this->load->view('home');
			} else if ($level == 'guru') {
				$this->load->view('home');
			} else if ($level == 'siswa') {
				$this->load->view('home');
			}
		} else {
			redirect('auth');
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