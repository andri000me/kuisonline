<?php 

/**
* 
*/
class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_auth','data');
	}

	function index()
	{
		if ($this->session->userdata('logged_in') == true) {
			redirect('home');
		} else {
			$this->load->view('page-login');
		}
	}

	function validate()
	{
		$user['username'] = $_POST['user'];
		$user['password'] = $_POST['pass'];

		$pengguna = $this->data->get_user('pengguna',$user);
		if ($pengguna->num_rows() != 0) {
			$sess['logged_in'] = 'yes';
			$sess['id_person'] = $pengguna->row()->id_person;
			$sess['level'] = $pengguna->row()->level;
			$this->session->set_userdata($sess);
			if ($pengguna->row()->level == 'admin') {
				redirect('home');
			} else if ($pengguna->row()->level == 'siswa') {
				redirect('home');
			} else if ($pengguna->row()->level == 'guru') {
				redirect('home');
			}
		} else {
			?> 
				<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
				<div style="margin-top: 100px;" class="container">
					<div class="alert alert-info" align="center">
						<div class="form-group">
							<label class="control-label">
								MUNGKIN BELUM TERDAFTAR
							</label>
						</div>
						<div class="form-group">
							<button onclick="backtologin()" id="btntologin" name="btntologin" class="btn btn-sm btn-primary">Klik Untuk Login</button>
						</div>
					</div>
				</div>
				<script type="text/javascript">
				function backtologin() {
					location.href="<?php echo base_url(); ?>auth";
				}
				</script>
			 <?php
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

	function logout()
	{
		if ($this->check_session() == true) {
			$this->session->unset_userdata('logged_in');
			?> 
				<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
				<div style="margin-top: 100px;" class="container">
					<div class="alert alert-info" align="center">
						<div class="form-group">
							<label class="control-label">
								LOGOUT SUCCESS
							</label>
						</div>
						<div class="form-group">
							<button onclick="backtologin()" id="btntologin" name="btntologin" class="btn btn-sm btn-primary">Klik Untuk Login</button>
						</div>
					</div>
				</div>
				<script type="text/javascript">
				function backtologin() {
					location.href="<?php echo base_url(); ?>auth";
				}
				</script>
			 <?php
		} else {
			?> 
				<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
				<div style="margin-top: 100px;" class="container">
					<div class="alert alert-info" align="center">
						<div class="form-group">
							<label class="control-label">
								TERIMA KASIH ATAS PARTISIPASINYA
							</label>
						</div>
						<div class="form-group">
							<button onclick="backtologin()" id="btntologin" name="btntologin" class="btn btn-sm btn-primary">Klik Untuk Login</button>
						</div>
					</div>
				</div>
				<script type="text/javascript">
				function backtologin() {
					location.href="<?php echo base_url(); ?>auth";
				}
				</script>
			 <?php
		}
	}
}

 ?>