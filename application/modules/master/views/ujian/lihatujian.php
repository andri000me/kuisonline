<!DOCTYPE html>
<html>
<head>
	<title> data <?php echo $this->uri->segment(2); ?></title>
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

			<?php 
				if ($this->session->userdata('level') == 'admin') {
					$this->load->view('nav-admin');
				} else if ($this->session->userdata('level') == 'guru') {
					$this->load->view('nav-guru');
				} else if ($this->session->userdata('level') == 'siswa') {
					$this->load->view('nav-siswa');
				}
			 ?>
		</div>
	</nav>

	<div class="container">
		<div id="" class="table-responsive">
			<table id="" class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Pelajaran</th>
					<th>Judul Ujian</th>
					<th>Jumlah Soal</th>
					<th>Lama Waktu</th>
					<th>Pembuat</th>
					<th>Start</th>
				</tr>
				<?php if($list->num_rows() != 0) { ?>
				<?php foreach($list->result() as $d) { ?>
				<?php 
					if ($d->id_pembuat != 0) {
						$pembuat = $this->db->get_where('guru',array('id'=>$d->id_pembuat))->row()->nama;
					} else {
						$pembuat = "admin";
					}
					$pel = $this->db->get_where('pelajaran',array('id'=>$d->id_mapel));
				 ?>
				<tr>
					<td><?php echo $d->id; ?></td>
					<td><?php echo $pel->row()->nama; ?></td>
					<td><?php echo $d->judul; ?></td>
					<td><?php echo $d->jumlah_soal; ?></td>
					<td><?php echo $d->waktu; ?> menit</td>
					<td><?php echo $pembuat; ?></td>
					<?php 
						$belumikut = $this->db->get_where('ujian_hasil',array('id_ujian'=>$d->id, 'id_siswa'=>$this->session->userdata('id_person')));
						if ($belumikut->num_rows() == 0) {
							?><td><a href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/start/<?php echo $d->id; ?>">Start</a></td><?php
						} else {
							?><td><a href="<?php echo base_url(); ?>master/nilai/detil/<?php echo $d->id; ?>">Sudah mengikuti</a></td><?php
						}
					 ?>
				</tr>
				<?php } ?>
				<?php } else { ?>
				<tr>
					<td colspan="10" style="vertical-align: middle; text-align: center;">Tidak ada data atau belum mengadakan ujian</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<!-- <div id="result"></div> -->

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	$('#btnSave').click(function() {
		var mapel = $('#mapel').val();
		var soal = $('#soal').val();
		var lamawaktu = $('#lamawaktu').val();
		var jumlahsoal = $('#jumlahsoal').val();

		if ( soal == '') {
			window.alert('masukkan data dengan benar');
		} else {
			var mydata = {'mapel':mapel,'soal':soal, 'lamawaktu':lamawaktu, 'jumlahsoal':jumlahsoal};
			jQuery.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/save',
				dataType: 'text',
				data: mydata,
				success: function (e) {
					location.href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/data";
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert('terjadi error : '+thrownError);
				}
			});
		}
	});
	</script>
</body>
</html>