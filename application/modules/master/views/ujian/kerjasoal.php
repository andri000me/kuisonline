<!DOCTYPE html>
<html>
<head>
	<title>Kerja soal ujian</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
</head>
<body>
	<!-- navigasi -->
	<?php $this->load->view('navigasi'); ?>

	<!-- waktu -->
	<?php $this->load->view('waktuterkini'); ?>

	<?php $this->load->view('timeout'); ?>

	<div class="container">
		<div class="form-group">
			<button id="cetakSoal" class="btn btn-sm btn-info center"><span><i class="glyphicon glyphicon-print"></i></span> CETAK SOAL</button>
		</div>

		<div id="cetakansoal"></div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table table-responsive">
				<form method="post" name="form_soal" action="">
					<input type="hidden" name="idsiswa" value="<?php echo $this->session->userdata('id_person'); ?>">
					<?php $no=1; foreach($soal->result() as $s) { ?>
					<table id="soalku" class="step table table-bordered">
						<tr>
							<td width="5%" style="text-align: center; vertical-align: middle;"><?php echo $no; ?></td>
							<td colspan="2"><?php echo $s->soal; ?></td>
						</tr>
						<?php 
							$opsi = array('A','B','C','D');
							for ($i=0; $i < sizeof($opsi); $i++) {
								$opsi_kecil = strtolower($opsi[$i]);
								$jawaban = "opsi_".$opsi_kecil; 
								?> <tr> <?php
								if ($opsi[$i] == $s->jawaban) {
									?> <td style="text-align: center; vertical-align: middle;"><input class="pilihjawaban"  id="<?php echo $s->id; ?>_<?php echo $opsi[$i]; ?>" name="pilihjawaban" value="<?php echo $opsi[$i]; ?>" type="radio"  ></td> <?php
									?> <td width="5%" style="text-align: center; vertical-align: middle;"><?php echo $opsi[$i]; ?></td> <?php
									?> <td>BENAR : <?php echo $s->$jawaban; ?></td> <?php
								} else {
									?> <td style="text-align: center; vertical-align: middle;"><input class="pilihjawaban" id="<?php echo $s->id; ?>_<?php echo $opsi[$i]; ?>" name="pilihjawaban" value="<?php echo $opsi[$i]; ?>" type="radio"  ></td> <?php
									?> <td width="5%" style="text-align: center; vertical-align: middle;"><?php echo $opsi[$i]; ?></td> <?php
									?> <td>SALAH : <?php echo $s->$jawaban; ?></td> <?php
								}
								?> </tr> <?php
							}
						 ?>
					</table>
					<?php $no++; } ?>
					<div class="btn-group">
						<button type="button" class="action btn prev btn-sm btn-success">Prev</button>
						<button type="button" class="action btn next btn-sm btn-success">Next</button>
						<button type="button" class="action btn submit btn-sm btn-success">Submit</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/aplikasi.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		

		var current = 1;

		// get each class
		widget = $('.step');
		btnNext = $('.next');
		btnPrev = $('.prev');
		btnSubmit = $('.submit');
		btnPilihOpsi = $('.pilihjawaban');

		// tampilkan soal awal
		widget.not(':eq(0)').hide();
		hideButtons(current);

		btnNext.click(function(){
			if (current < widget.length) {
				widget.show();
				widget.not(':eq('+(current++)+')').hide();
			}
			hideButtons(current);
		});

		btnPrev.click(function(){
			if (current > 1) {
				current = current - 2;
				if (current < widget.length) {
					widget.show();
					widget.not(':eq('+(current++)+')').hide();
				}
				hideButtons(current);
			}
			hideButtons(current);
		});

		btnSubmit.click(function(){
			var idujian = "<?php echo $this->uri->segment(4); ?>";
			var idsiswa = "<?php echo $this->session->userdata('id_person'); ?>";
			data = {'id_siswa':idsiswa, 'id_ujian':idujian};
			$.ajax({
				type: "POST",
				data: data,
				url: "<?php echo base_url(); ?>kuis/end",
			});
			var r = window.confirm('anda ingin mengakhiri?');
			if (r==true) {
				location.href=('<?php echo base_url(); ?>master/ujian/antrian');
			};
		});

		btnPilihOpsi.click(function(){
			var val = this.id.split('_');
			var idujian = "<?php echo $this->uri->segment(4); ?>";
			var idsiswa = "<?php echo $this->session->userdata('id_person'); ?>";
			console.log("Siswa : "+idsiswa+" IDujian : "+idujian+" IDsoal : "+val[0]+" Ans : "+val[1]);
			console.log(val);
			var jawaban = val[1];
			data = {'id_siswa':idsiswa, 'id_ujian':idujian, 'id_soal':val[0], 'jawaban':val[1]};
			$.ajax({
				type: "POST",
				data: data,
				url: "<?php echo base_url(); ?>kuis/submit",
			});
		});
	});

	// kendali next prev soal ujian
	hideButtons = function(current) {
		var limit = parseInt(widget.length);
		$(".action").hide();
		if (current<limit) {
			btnNext.show();
		}
		if (current > 1) {
			btnPrev.show();
		}
		if (current == limit) {
			btnNext.hide();
			btnSubmit.show();
		}
	}
	</script>

	<script type="text/javascript">
		$('#cetakSoal').click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cetaksoal/file/<?php echo $this->uri->segment(4); ?>",
				data: {"idsoal":<?php echo $this->uri->segment(4); ?>},
				success: function(e){
					location.href = "<?php echo base_url(); ?>cetaksoal/file/<?php echo $this->uri->segment(4); ?>";
				}
			});
		});
	</script>
</body>
</html>