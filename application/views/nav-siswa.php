			
			<!-- menu -->
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