<!DOCTYPE html>
<html>
<head>
	<title> data <?php echo $this->uri->segment(2); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body>
	<!-- navigasi -->
	<?php $this->load->view('navigasi'); ?>

	<!-- waktu -->
	<?php $this->load->view('waktuterkini'); ?>

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
							<select id="mapel" name="mapel" class="form-control">
								<option>--Pilih Mata Pelajaran--</option>
								<?php foreach($pilmp->result() as $mp) { ?>
									<option value="<?php echo $mp->id; ?>"><?php echo $mp->nama; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="soal" name="soal" placeholder="Judul Soal">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="jumlahsoal" name="jumlahsoal" placeholder="Jumlah Soal">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="lamawaktu" name="lamawaktu" placeholder="Lama Waktu">
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
					<th>Judul Ujian</th>
					<th>Jumlah Soal</th>
					<th>Lama Waktu</th>
					<th>Pembuat</th>
					<th>Hapus</th>
					<th>Ubah</th>
					<th>Peserta</th>
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
					<td><a href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/delete/<?php echo $d->id; ?>">Hapus</a></td>
					<td><a href="<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/edit/<?php echo $d->id; ?>">Ubah</a></td>
					<td><button type="button" onclick="lihatPeserta(<?php echo $d->id; ?>)" value="<?php echo $d->id; ?>" class="btn btn-sm btn-info">Lihat Peserta</button></td>
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

	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title" align="center">DATA PESERTA UJIAN</div>
			</div>
			<div class="panel-body">
				<div id="dataPeserta"></div>
			</div>
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

	function lihatPeserta(idKuis){
		console.log("KUIS : "+idKuis);
		mydata = {'idkuis':idKuis};
		$('#dataPeserta').empty();
		$.ajax({
			type: "POST",
			data: mydata,
			url: "<?php echo base_url(); ?>master/ujian/peserta",
			success: function(e){
				$('#dataPeserta').append(e);
			}
		});
	}
	</script>
</body>
</html>