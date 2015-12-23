	

	<div class="container">
		<div align="center" class="alert alert-info"><span id="tampilkan"></span> <span id="info"></span></div>
	</div>

	<!-- timer ujian -->
	<script type="text/javascript">
		var detik = 0;
		var menit = <?php echo $timeout; ?>;
		function hitung() {
			setTimeout(hitung, 1000);
				document.getElementById('tampilkan').innerHTML = ( ' habis waktu ' + menit + ' menit ' + detik + ' detik ');
				if (menit == 0 && detik == 0) {
					var idujian = "<?php echo $this->uri->segment(4); ?>";
					var idsiswa = "<?php echo $this->session->userdata('id_person'); ?>";
					data = {'id_siswa':idsiswa, 'id_ujian':idujian};
					$.ajax({
						type: "POST",
						data: data,
						url: "<?php echo base_url(); ?>kuis/end",
					});
					var r = window.confirm('Waktu telah habis!');
					if (r==true) {
						location.href=('<?php echo base_url(); ?>master/ujian/antrian');
					} else {
						location.href=('<?php echo base_url(); ?>master/ujian/antrian');
					}
				} else if (menit == 1 && detik <= 55 ) {
					document.getElementById('info').innerHTML = "<b>Waktu hampir habis</b>";
				}

				detik --;

				if(detik < 0) {
					detik = 59;
					menit --;
				if(menit < 0) {
					menit = 0;
					detik = 0;
				}
			}
		}
		hitung();
	</script>