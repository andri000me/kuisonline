<?php 

/**
* 
*/
class Kuis extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function end()
	{
		$data = array(
			'id_ujian'=>$_POST['id_ujian'],
			'id_siswa'=>$this->session->userdata('id_person'),
			// hitung nilai
		);
		$hitungnilai = $this->db->get_where('ujian_detil',$data);
		static $benar = 0;
		foreach ($hitungnilai->result() as $ans) {
			if ($ans->jawaban == $ans->opsi_benar) {
				$benar+=1;
			}
		}
		
		$ujian = $this->db->get_where('ujian', array('id'=>$_POST['id_ujian']));
		$jmlsoal = $ujian->row()->jumlah_soal;

		$data['jumlah_benar'] = $benar;
		$point = 100 / $jmlsoal;
		$data['nilai'] = $benar * $point;
		$this->db->insert('ujian_hasil', $data);
	}

	function stop()
	{
		redirect('master/ujian/antrian');
	}

	function submit()
	{
		// cek dulu sudah pernah di insert apa belum
		$res = $this->db->get_where('ujian_detil', array('id_ujian'=>$_POST['id_ujian'], 'id_soal'=>$_POST['id_soal'], 'id_siswa'=>$this->session->userdata('id_person')));
		if ($res->num_rows() == 0) {
			$data = array(
				'id_ujian' => $this->input->post('id_ujian'),
				'id_siswa' => $this->session->userdata('id_person'),
				'id_soal' => $this->input->post('id_soal'),
				'jawaban' => $this->input->post('jawaban'),
				'opsi_benar' => $this->db->get_where('soal', array('id'=>$this->input->post('id_soal')))->row()->jawaban,
			);
			$res = $this->db->insert('ujian_detil', $data);
		} else {
			$data = array(
				'jawaban' => $this->input->post('jawaban'),
				'opsi_benar' => $this->db->get_where('soal', array('id'=>$this->input->post('id_soal')))->row()->jawaban,
			);
			$where = array(
				'id_ujian'=>$this->input->post('id_ujian'),
				'id_soal'=>$this->input->post('id_soal'),
				'id_siswa'=>$this->session->userdata('id_person'),
			);
			$res = $this->db->update('ujian_detil', $data, $where);
		}

	}
}

 ?>