<?php 

/**
* 
*/
class CetakSoal extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function file($idsoal)
	{
		$get = $this->db->get_where('ujian',array('id'=>$idsoal));
		$idmp = $get->row()->id_mapel;
		$jumlahsoal = $get->row()->jumlah_soal;

		$sql = "SELECT * FROM soal WHERE id_mapel = $idmp ORDER BY RAND() LIMIT $jumlahsoal";
		$data['soal'] = $this->db->query($sql);

		$this->load->view('printsoal',$data);
	}
}

 ?>