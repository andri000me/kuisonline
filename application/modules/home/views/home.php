<!DOCTYPE html>
<html>
<head>
	<title>Home Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/full-slider.css">
</head>
<body>
	<!-- navigasi -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo base_url(); ?>" class="navbar-brand">KUIS ONLINE</a>
			</div>

			<?php 
				if ($this->session->userdata('level') == 'admin') {
					$this->load->view('nav-admin');
				} else if ($this->session->userdata('level') == 'guru') {
					$this->load->view('nav-guru');
				}  else if ($this->session->userdata('level') == 'siswa') {
					$this->load->view('nav-siswa');
				}
			 ?>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-lg-12" align="center">
				<div class="jumbotron"><h2>Selamat datang anda login sebagai <?php echo $this->session->userdata('level'); ?></h2></div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
</body>
</html>