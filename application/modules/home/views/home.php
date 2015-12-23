<?php 

	$siswaipa = $this->db->get_where('siswa',array('jurusan'=>'IPA'));
	$totalsiswaipa = $siswaipa->num_rows();

	$siswaips = $this->db->get_where('siswa',array('jurusan'=>'IPS'));
	$totalsiswaips = $siswaips->num_rows();

	$guruipa = $this->db->get_where('guru',array('jurusan'=>'IPA'))->num_rows();

	$guruips = $this->db->get_where('guru',array('jurusan'=>'IPS'))->num_rows();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/full-slider.css">

	<style type="text/css">
	#googleMap {
		width: auto;
		height: 300px;
	}
	</style>
</head>
<body>
	<!-- navigasi -->
	<?php $this->load->view('navigasi'); ?>

	<!-- waktu -->
	<?php $this->load->view('waktuterkini'); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12" align="center">
				<div class="jumbotron"><h2>Selamat datang anda login sebagai <?php echo $this->session->userdata('level'); ?></h2></div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">STATISTIK SISWA</div>
					</div>
					<div class="panel-body">
						<div id="chartsiswa"></div>
					</div>
					<div class="panel-footer">STATISTIK</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">STATISTIK GURU</div>
					</div>
					<div class="panel-body">
						<div id="chartguru"></div>
					</div>
					<div class="panel-footer">STATISTIK</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">LOCATION</div>
					</div>
					<div class="panel-body">
						<div id="googleMap"></div>
					</div>
					<div class="panel-footer">
						<div class="panel-title">MAPS</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript">
		var myCenter=new google.maps.LatLng(-0.861453,134.062042);
		var marker;

		function initialize()
		{
		var mapProp = {
		  center:myCenter,
		  zoom:15,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		  };

		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker=new google.maps.Marker({
		  position:myCenter,
		  animation:google.maps.Animation.BOUNCE
		  });

		marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>public/plugin/highcharts/highcharts.js"></script>
	
	<script type="text/javascript">
		$(function () {

		    $(document).ready(function () {

		        // Build the chart
		        $('#chartsiswa').highcharts({
		            chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'
		            },
		            title: {
		                text: 'DATA SISWA TERDAFTAR'
		            },
		            tooltip: {
		                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		            },
		            plotOptions: {
		                pie: {
		                    allowPointSelect: true,
		                    cursor: 'pointer',
		                    dataLabels: {
		                        enabled: false
		                    },
		                    showInLegend: true
		                }
		            },
		            series: [{
		                name: 'Brands',
		                colorByPoint: true,
		                data: [{
		                    name: 'IPA',
		                    y: <?php echo $totalsiswaipa; ?>
		                }, {
		                    name: 'IPS',
		                    y: <?php echo $totalsiswaips; ?>
		                }]
		            }]
		        });

				// Build the chart
		        $('#chartguru').highcharts({
		            chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'
		            },
		            title: {
		                text: 'DATA GURU TERDAFTAR'
		            },
		            tooltip: {
		                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		            },
		            plotOptions: {
		                pie: {
		                    allowPointSelect: true,
		                    cursor: 'pointer',
		                    dataLabels: {
		                        enabled: false
		                    },
		                    showInLegend: true
		                }
		            },
		            series: [{
		                name: 'Brands',
		                colorByPoint: true,
		                data: [{
		                    name: 'IPA',
		                    y: <?php echo $guruipa; ?>
		                }, {
		                    name: 'IPS',
		                    y: <?php echo $guruips; ?>
		                }]
		            }]
		        });
		    });
		});
	</script>

</body>
</html>