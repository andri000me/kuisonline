	
	<!-- waktu -->
	<script type="text/javascript">

		function showTime()
		{
			var a_p = "";
		    var today = new Date();
		    var curr_hour = today.getHours();
		    var curr_minute = today.getMinutes();
		    var curr_second = today.getSeconds();
		    if (curr_hour < 12) {
		        a_p = "AM";
		    } else {
		        a_p = "PM";
		    }
		    if (curr_hour == 0) {
		        curr_hour = 12;
		    }
		    if (curr_hour > 12) {
		        curr_hour = curr_hour - 12;
		    }
		    curr_hour = checkTime(curr_hour);
		    curr_minute = checkTime(curr_minute);
		    curr_second = checkTime(curr_second);
		    document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
		}

		function checkTime(i)
		{
			if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}

		setInterval(showTime, 1000);
	</script>

	<div class="container">
		<div align="center" class="well well-info"><b>Tanggal</b> : <span id="waktuskrg"> </span> <b>Waktu</b> : <span id="clock"></span></div>
	</div>

	<!-- tanggal -->
	<script type="text/javascript">
		var txtbulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		var txthari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var thisDay = date.getDay(),
			thisDay = txthari[thisDay];
		var year = date.getYear();
		var thisyear = (year<1000) ? year + 1900 : year;

		document.getElementById('waktuskrg').innerHTML = thisDay + ', ' + day + ' ' + txtbulan[month] + ' ' + thisyear ;
	</script>