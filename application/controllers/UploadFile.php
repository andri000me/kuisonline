<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class UploadFile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // load helper dan library
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
 
    public function index($error = NULL)
    {
        $data = array(
            'action' => site_url('upload/proses'),
            'judul' => set_value('judul'),
            'error' => $error['error'] // ambil parameter error
        );
    
        $data['mp'] = $this->db->get('pelajaran');

        $this->load->view('uploadfile', $data);
    }
 
    public function proses()
    {
        // validasi judul
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
 
        if ($this->form_validation->run() == FALSE) {
            // jika validasi judul gagal
            $this->index();
        } else {
            // config upload
            $config['upload_path'] = './excel/';
            $config['allowed_types'] = 'jpg|png|gif|bmp|xls';
            $config['max_size'] = '100';
            $this->load->library('upload', $config);
 
            if ( ! $this->upload->do_upload('gambar')) {
                // jika validasi file gagal, kirim parameter error ke index
                $error = array('error' => $this->upload->display_errors());
                $this->index($error);
            } else {
                // jika berhasil upload ambil data dan masukkan ke database
                $upload_data = $this->upload->data();
 
                // pada contoh ini kita hanya menampilkan dataupload
                echo '<pre>';
                print_r($upload_data);
                echo '</pre>';
                echo anchor(site_url('uploadfile'), 'Upload Lagi');

                // include 'path/to/PHPExcel/IOFactory.php';
                $this->load->library('Excel/PHPExcel');

                // Let IOFactory determine the spreadsheet format
                $document = PHPExcel_IOFactory::load('excel/'.$upload_data['file_name']);

                // Get the active sheet as an array
                $activeSheetData = $document->getActiveSheet()->toArray(null, true, true, true);

                // echo "<pre>";
                // var_dump($activeSheetData);
                // print_r($activeSheetData);

                echo "<br>";

                for ($i=2; $i<=sizeof($activeSheetData) ; $i++) {
                    // [row][column]
                    $soal = $activeSheetData[$i]['A'];
                    $opsi_a = $activeSheetData[$i]['B'];
                    $opsi_b = $activeSheetData[$i]['C'];
                    $opsi_c = $activeSheetData[$i]['D'];
                    $opsi_d = $activeSheetData[$i]['E'];
                    $jawaban = $activeSheetData[$i]['F'];

                    $data = array(
                        'soal'=>$soal,
                        'opsi_a'=>$opsi_a,
                        'opsi_b'=>$opsi_b,
                        'opsi_c'=>$opsi_c,
                        'opsi_d'=>$opsi_d,
                        'jawaban'=>$jawaban,
                        'id_mapel'=>$_POST['judul'],
                        'id_pembuat'=>$this->session->userdata('id_person'),
                    );

                    $this->db->insert('soal', $data);
                }

                // delete file (for demo purpose only)
                $this->load->helper('file');
                delete_files('./excel/');
            }
        }
    }
 
}