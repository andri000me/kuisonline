<!DOCTYPE html>
<html>
<head>
	<title>Home Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
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

			<?php $this->load->view('nav-admin'); ?>
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron" align="center">
			<h2>MODULE <?php echo strtoupper($this->uri->segment(2)); ?></h2>
			<p>Digunakan untuk manajemen data-data <?php echo $this->uri->segment(2); ?></p>
		</div>
		<div class="form-group" align="center">
			<button onclick="lihat_data()" class="btn btn-info btn-lg">LIHAT DATA</button>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	function lihat_data() {
		location.href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/data";
	}
	</script>
</body>
</html>