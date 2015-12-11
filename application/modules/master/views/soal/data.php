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
				}  else if ($this->session->userdata('level') == 'siswa') {
					$this->load->view('nav-siswa');
				}
			 ?>
		</div>
	</nav>

	<div class="container">
		<div class="form-group">
			<button type="button" data-toggle="modal" data-target="#form_add" class="btn btn-primary btn-block">Tambah data</button>
		</div>

		<div id="form_add" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Form Add</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<textarea type="text" class="form-control" id="soal" name="soal" placeholder="Isi soal"></textarea>
						</div>
						<div class="form-group">
							<select id="mapel" name="mapel" class="form-control">
								<option>--Pilih Mata Pelajaran--</option>
								<?php foreach($pilmp->result() as $mp) { ?>
									<option value="<?php echo $mp->id; ?>"><?php echo $mp->nama; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<textarea type="text" class="form-control" id="opsi_a" name="opsi_a" placeholder="Opsi A"></textarea>
						</div>
						<div class="form-group">
							<textarea type="text" class="form-control" id="opsi_b" name="opsi_b" placeholder="Opsi B"></textarea>
						</div>
						<div class="form-group">
							<textarea type="text" class="form-control" id="opsi_c" name="opsi_c" placeholder="Opsi C"></textarea>
						</div>
						<div class="form-group">
							<textarea type="text" class="form-control" id="opsi_d" name="opsi_d" placeholder="Opsi D"></textarea>
						</div>
						<div class="form-group">
							<select id="jawaban" name="jawaban" class="form-control">
								<option value="">--Atur jawaban--</option>
								<option value="A">Opsi A</option>
								<option value="B">Opsi B</option>
								<option value="C">Opsi C</option>
								<option value="D">Opsi D</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btnSave">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div id="" class="table-responsive">
			<table id="" class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Pelajaran</th>
					<th>Soal</th>
					<th>Jawaban</th>
					<th>Pembuat</th>
					<th>Hapus</th>
					<th>Ubah</th>
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
					<td><?php echo $d->soal; ?></td>
					<td><?php echo $d->jawaban; ?></td>
					<td><?php echo $pembuat; ?></td>
					<td><a href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/delete/<?php echo $d->id; ?>">Hapus</a></td>
					<td><a href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/edit/<?php echo $d->id; ?>">Ubah</a></td>
				</tr>
				<?php } ?>
				<?php } else { ?>
				<tr>
					<td colspan="4" style="vertical-align: middle; text-align: center;">Tidak ada data</td>
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
		var soal = $('#soal').val();
		var mapel = $('#mapel').val();
		var opsi_a = $('#opsi_a').val();
		var opsi_b = $('#opsi_b').val();
		var opsi_c = $('#opsi_c').val();
		var opsi_d = $('#opsi_d').val();
		var jawaban = $('#jawaban').val();

		if ( soal == '') {
			window.alert('masukkan data dengan benar');
		} else {
			var mydata = {'soal':soal,'mapel':mapel,'opsi_a':opsi_a,'opsi_b':opsi_b,'opsi_c':opsi_c,'opsi_d':opsi_d,'jawaban':jawaban};
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