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
		<div class="row">
			<div class="col-lg-2">
				<div class="thumbnail">
					<img class="img-responsive" src="<?php echo base_url(); ?>public/images/logo.png">
				</div>
			</div>
			<div class="col-lg-5">
				<table class="table table-bordered">
					<tr>
						<td width="30%">Pengajar</td>
						<?php if ($profilguru != 'administrator') { ?>
							<td><?php echo $profilguru; ?></td>
						<?php } else { ?>
							<td>Administrator</td>
						<?php } ?>
					</tr>
					<tr>
						<td>Nama</td>
						<td><?php echo $profilsiswa->row()->nama; ?></td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td><?php echo $profilsiswa->row()->jurusan; ?></td>
					</tr>
					<tr>
						<td>Mata pelajaran</td>
						<td><?php echo $profilmapel->row()->nama; ?></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-5">
				<table class="table table-bordered">
					<tr>
						<td width="20%">Topik Ujian</td>
						<td><?php echo $topikujian; ?></td>
					</tr>
					<tr>
						<td width="20%">Nilai Ujian</td>
						<td><?php echo $nilaiujian->row()->nilai; ?></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Soal</th>
							<th>Submit</th>
							<th>Jawaban</th>
						</tr>
						<?php foreach($detilujian->result() as $du) { ?>
						<tr>
							<td><?php echo $du->id_soal; ?></td>
							<?php 
								$soal = $this->db->get_where('soal', array('id'=>$du->id_soal))->row()->soal;
							 ?>
							<td><?php echo $soal; ?></td>
							<td><?php echo $du->jawaban; ?></td>
							<?php 
								$jawaban = $this->db->get_where('soal', array('id'=>$du->id_soal))->row()->jawaban;
							 ?>
							<td><?php echo $jawaban; ?></td>

						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	
</body>
</html>