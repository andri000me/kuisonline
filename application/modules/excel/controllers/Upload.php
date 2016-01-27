<?php 

/**
* 
*/
class Upload extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('/upload');
	}

public function read_file($table = 'users', $filename = 'test.xls') {

    $pathToFile = './uploads/' . $filename;
    // $this->load->library('Excel_Reader');
    require 'excel_reader.php';
    $data = new Spreadsheet_Excel_Reader($pathToFile);
    $sql = "INSERT INTO $table (";
    for($index = 1;$index <= $data->sheets[0]['numCols']; $index++){
        $sql.= strtolower($data->sheets[0]['cells'][1][$index]) . ", ";
    }

    $sql = rtrim($sql, ", ")." ) VALUES ( ";
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
        $valuesSQL = '';
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
            $valuesSql .= "\"" . $data->sheets[0]['cells'][$i][$j] . "\", ";
        }
        echo $sql . rtrim($valuesSql, ", ")." ) <br>";
    }
}

	function proses()
	{
		require 'excel_reader.php';
		if(isset($_POST['submit'])){
	 
	    $target = basename($_FILES['filepegawaiall']['name']) ;
	    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
	    
	    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
	    
	//    menghitung jumlah baris file xls
	    $baris = $data->rowcount($sheet_index=0);
	    
	//    jika kosongkan data dicentang jalankan kode berikut
	    if($_POST['drop']==1){
	//             kosongkan tabel pegawai
	             $truncate ="TRUNCATE TABLE pegawai";
	             $this->db->query($truncate);
	    };
	    
	//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
	    for ($i=2; $i<=$baris; $i++)
	    {
	//       membaca data (kolom ke-1 sd terakhir)
	      $nama           = $data->val($i, 1);
	      $tempat_lahir   = $data->val($i, 2);
	      $tanggal_lahir  = $data->val($i, 3);

	      echo $nama; echo " ";
	      echo $tempat_lahir; echo " ";
	      echo $tanggal_lahir; echo " ";

	      echo "<br>";
		// setelah data dibaca, masukkan ke tabel pegawai sql
	    // $query = "INSERT into pegawai (nama,tempat_lahir,tanggal_lahir)values('$nama','$tempat_lahir','$tanggal_lahir')";
	    // $hasil = $this->db->query($query);
	    }
	    
	    // if(!$hasil){
	//          jika import gagal
	          // die(mysql_error());
	      // }else{
	//          jika impor berhasil
	          // echo "Data berhasil diimpor.";
	    // }
	    
	//    hapus file xls yang udah dibaca
	    unlink($_FILES['filepegawaiall']['name']);
		}
	}
}

 ?>