<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body>
	<!-- panel login -->
	<div style="margin-top: 100px;" class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h1 class="panel-title">Please login to set your session</h1>
					</div>
					<div class="panel-body">
						<form method="post" action="<?php echo base_url(); ?>auth/validate">
							<div class="form-group">
								<input placeholder="Username" type="text" class="form-control" id="user" name="user">
							</div>
							<div class="form-group">
								<input placeholder="Password" type="password" class="form-control" id="pass" name="pass">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block">Login</button>
							</div>
						</form>
					</div>
					<div class="panel-footer" align="center">
						Page rendered <strong>{elapsed_time}</strong> seconds
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
</body>
</html>