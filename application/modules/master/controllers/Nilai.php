<?php 

/**
* 
*/
class Nilai extends CI_Controller
{

	var $tablename = "ujian_hasil";
	var $module = "master/nilai";
	var $view_dir_name = "nilai";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('crud','data');
	}

	function index()
	{
		if ($this->check_session() == true) {
			if ($this->session->userdata('level') == 'siswa') {
				$data['pilmp'] = $this->data->read('pelajaran');
				$data['list'] = $this->get_all_data();
				$this->load->view($this->view_dir_name.'/nilaisiswa', $data);
			} else {
				$this->load->view($this->view_dir_name.'/info');
			}
		} else {
			redirect('auth');
		}
	}

	function total_rows()
	{
		return $this->db->get($this->tablename)->num_rows();
	}

	function save()
	{
		$data['judul'] = $this->input->post('soal');
		$data['jumlah_soal'] = $this->input->post('jumlahsoal');
		$data['waktu'] = $this->input->post('lamawaktu');

		$level = $this->session->userdata('level');
		if ($level == 'admin') {
			$pembuat = 0;
		} else if ($level == 'guru') {
			$pembuat = $this->session->userdata('id_person');
		}

		$data['id_pembuat'] = $pembuat;
		$data['id_mapel'] = $_POST['mapel'];

		$this->data->write($this->tablename, $data);
	}

	function edit()
	{
		$id = $this->uri->segment(4);
	}

	function delete()
	{
		$where['id'] = $this->uri->segment(4);
		$sql = $this->data->remove($this->tablename, $where);
		if ($sql) {
			redirect($this->module.'/data');
		}
	}

	function get_all_data()
	{
		if ($this->session->userdata('level') == 'siswa') {
			return $this->db->get_where($this->tablename, array('id_siswa'=>$this->session->userdata('id_person')));
		} else if($this->session->userdata('level') == 'guru') {
			return $this->db->get_where($this->tablename, array('id_pembuat'=>$this->session->userdata('id_person')));
		} else {
			return $this->db->get($this->tablename);
		}
	}

	function check_session()
	{
		if ($this->session->userdata('logged_in') == 'yes') {
			return true;
		} else {
			return false;
		}
	}

	function detil()
	{
		$idsiswa = $this->session->userdata('id_person');
		$idujian = $this->uri->segment(4);
		// detail ujian
		$detil = array('id_ujian'=>$idujian, 'id_siswa'=>$idsiswa);
		$detilujian = $this->db->get_where('ujian_detil', $detil);

		$data['detilujian'] = $detilujian;

		// profil siswa
		$data['profilsiswa'] = $this->db->get_where('siswa', array('id'=>$this->session->userdata('id_person')));
		// profil pelajaran
		$getidmapel = $this->db->get_where('ujian', array('id'=>$idujian));
		$idmapel = $getidmapel->row()->id_mapel;
		$idpembuat = $getidmapel->row()->id_pembuat;
		$data['topikujian'] = $getidmapel->row()->judul;
		$data['profilmapel'] = $this->db->get_where('pelajaran', array('id'=>$idmapel));
		if ($idpembuat == 0) {
			$data['profilguru'] = 'Administrator';
		} else {
			$myguru = $this->db->get_where('guru', array('id'=>$idpembuat));
			$data['profilguru'] = $myguru->row()->nama;
		}
		$data['nilaiujian'] = $this->db->get_where('ujian_hasil', array('id_ujian'=>$idujian, 'id_siswa'=>$idsiswa));
		$this->load->view('nilai/detilnilai', $data);
	}
}

 ?>