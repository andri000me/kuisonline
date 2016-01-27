<!DOCTYPE html>
<html>
<head>
	<title>Cetakan Soal</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body style="margin-top: 50px;">
	<div class="container" align="center">
		<div class="page-header">
			SOAL MATA PELAJARAN
		</div>
	</div>

	<div class="container">
	<?php $no=1; foreach($soal->result() as $d) { ?>
		<div class="panel panel-info">
			<div class="panel-heading" align="center">
				<div class="panel-title"><?php echo $no; ?></div>
			</div>
			<div class="panel-body">
				<div class="form-group" align="justify">
					<?php echo $d->soal; ?>
				</div>
				<div class="table-responsive">
					<?php $opsi = array('a','b','c','d'); ?>
					<table class="table table-bordered">
					<?php for($i=0; $i<sizeof($opsi); $i++) { ?>
						<tr>
							<td style="text-align: center; vertical-align: middle;" width="5%"><?php echo $opsi[$i]; ?></td>
							<td><?php $opsijawab = 'opsi_'.$opsi[$i]; echo $d->$opsijawab; ?></td>
						</tr>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	<?php $no++; } ?>
	</div>
</body>
</html>