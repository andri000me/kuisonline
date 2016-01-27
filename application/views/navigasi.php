	
	<nav class="navbar navbar-inverse">
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
				?>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class=""><a href="<?php echo base_url(); ?>home">Home</a></li>
							<li class="dropdown">
								<a href="javascript:void(0);" data-toggle="dropdown">Master Data <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url(); ?>master/siswa">Setup Siswa</a></li>
									<li><a href="<?php echo base_url(); ?>master/guru">Setup Guru</a></li>
									<li><a href="<?php echo base_url(); ?>master/pelajaran">Setup Pelajaran</a></li>
								</ul>
							</li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class=""><a href="<?php echo base_url(); ?>auth/logout">Logout <?php echo $this->session->userdata('level'); ?>:<?php echo $this->session->userdata('id_person'); ?></a></li>
						</ul>
					</div>
				<?php
				} else if ($this->session->userdata('level') == 'guru') {
				?>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class=""><a href="<?php echo base_url(); ?>home">Home</a></li>
							<li class=""><a href="<?php echo base_url(); ?>master/soal">Data Soal</a></li>
							<li class=""><a href="<?php echo base_url(); ?>master/ujian">Data Ujian</a></li>
							<li class=""><a href="<?php echo base_url(); ?>uploadfile">Upload</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class=""><a href="<?php echo base_url(); ?>auth/logout">Logout <?php echo $this->session->userdata('level'); ?>:<?php echo $this->session->userdata('id_person'); ?></a></li>
						</ul>
					</div>
				<?php
				}  else if ($this->session->userdata('level') == 'siswa') {
				?>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class=""><a href="<?php echo base_url(); ?>home">Home</a></li>
							<li class=""><a href="<?php echo base_url(); ?>master/ujian/antrian">Data Ujian</a></li>
							<li class=""><a href="<?php echo base_url(); ?>master/nilai">Hasil Ujian</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class=""><a href="<?php echo base_url(); ?>auth/logout">Logout <?php echo $this->session->userdata('level'); ?>:<?php echo $this->session->userdata('id_person'); ?></a></li>
						</ul>
					</div>
				<?php
				}
			 ?>
		</div>
	</nav>