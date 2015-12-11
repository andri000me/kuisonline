			
			<!-- menu -->
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="javascript:void(0);" data-toggle="dropdown">Master Data <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>master/siswa">Manage Siswa</a></li>
							<li><a href="<?php echo base_url(); ?>master/guru">Manage Guru</a></li>
							<li><a href="<?php echo base_url(); ?>master/soal">Manage Soal</a></li>
							<li><a href="<?php echo base_url(); ?>master/pelajaran">Manage Pelajaran</a></li>
						</ul>
					</li>
					<li class=""><a href="<?php echo base_url(); ?>home">Home</a></li>
					<li class=""><a href="<?php echo base_url(); ?>master/soal">Data Soal</a></li>
					<li class=""><a href="<?php echo base_url(); ?>master/ujian">Data Ujian</a></li>
					<li class=""><a href="<?php echo base_url(); ?>master/nilai">Hasil Ujian</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class=""><a href="<?php echo base_url(); ?>auth/logout">Logout <?php echo $this->session->userdata('level'); ?>:<?php echo $this->session->userdata('id_person'); ?></a></li>
				</ul>
			</div>