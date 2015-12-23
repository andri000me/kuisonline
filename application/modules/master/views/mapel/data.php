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
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan">
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
					<th>Nama Lengkap</th>
					<th>Jurusan</th>
					<th>Hapus</th>
					<th>Ubah</th>
				</tr>
				<?php if($list->num_rows() != 0) { ?>
				<?php foreach($list->result() as $d) { ?>
				<tr>
					<td><?php echo $d->id; ?></td>
					<td><?php echo $d->nama; ?></td>
					<td><?php echo $d->jurusan; ?></td>
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

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	$('#btnSave').click(function() {
		var nama = $('#nama').val();
		var jurusan = $('#jurusan').val();

		if ( nama == '' && jurusan == '') {
			window.alert('masukkan data dengan benar');
		} else {
			var mydata = {'nama':nama,'jurusan':jurusan};
			jQuery.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>master/<?php echo $this->uri->segment(2); ?>/save',
				dataType: 'text',
				data: mydata,
				success: function (e) {
					// $('#result').append(e);
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