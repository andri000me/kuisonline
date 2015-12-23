<!DOCTYPE html>
<html>
<head>
	<title>Home Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body>
	<!-- navigasi -->
	<?php $this->load->view('navigasi'); ?>

	<!-- waktu -->
	<?php $this->load->view('waktuterkini'); ?>

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