<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_inputmhs extends CI_Controller {

	function __construct(){
		parent::__construct();
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}

	public function index()
	{
		$this->load->view('inputmhs');
	}

	
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->SiswaModel->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->load->view('datadsn', $data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = [];
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, [
					'nis'=>$row['A'], // Insert data nis dari kolom A di excel
					'nama'=>$row['B'], // Insert data nama dari kolom B di excel
					'jenis_kelamin'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
					'alamat'=>$row['D'], // Insert data alamat dari kolom D di excel
				]);
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->SiswaModel->insert_multiple($data);
		
		redirect("Siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

// 	public function upload(){
//         $fileName = $this->input->post('file', TRUE);
         
//         $config['upload_path'] = './upload/'; 
//   		$config['file_name'] = $fileName;
//   		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
//   		$config['max_size'] = 10000;
         
//         $this->load->library('upload', $config);
//   		$this->upload->initialize($config); 
         
//         if (!$this->upload->do_upload('file')) {
//    			$error = array('error' => $this->upload->display_errors());
//    			$this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
//    			redirect('datamhs'); 
//   		} else {
//    			$media = $this->upload->data();
//    			$inputFileName = 'upload/'.$media['file_name'];
   
//    	try {
// 	    $inputFileType = IOFactory::identify($inputFileName);
//     	$objReader = IOFactory::createReader($inputFileType);
//     	$objPHPExcel = $objReader->load($inputFileName);
//    	} catch(Exception $e) {
//     	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
//    	}

//    	$sheet = $objPHPExcel->getSheet(0);
//    	$highestRow = $sheet->getHighestRow();
//    	$highestColumn = $sheet->getHighestColumn();

//    	for ($row = 2; $row <= $highestRow; $row++){  
//     	$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
//     	NULL,TRUE,FALSE);
//     	$data = array(
// 	    	"idimport"=> $rowData[0][0],
// 	     	"schoolyear"=> $rowData[0][1],
// 	      	"semester"=> $rowData[0][2],
// 	      	"nim"=> $rowData[0][3],
// 	      	"nama"=> $rowData[0][4],
// 	      	"angkatan"=> $rowData[0][5],
// 	      	"fakultas"=> $rowData[0][6],
// 	      	"prodi"=> $rowData[0][7],
// 	      	"jenjang"=> $rowData[0][8],
// 	      	"gender"=> $rowData[0][9],
// 	      	"status"=> $rowData[0][10],
// 	      	"bpp"=> $rowData[0][11],
// 	      	"negara_asal"=> $rowData[0][12],
// 	      	"univ_dest"=> $rowData[0][13],
// 	      	"exchange_period"=> $rowData[0][14],
// 	      	"loa"=> $rowData[0][15],
// 	      	"moa"=> $rowData[0][16],
// 	      	"ket"=> $rowData[0][17],
// 	      	"ket2"=> $rowData[0][18]
//     );
//     	$this->db->insert("mahasiswa",$data);
//    	} 
//    		$this->session->set_flashdata('msg','Berhasil upload ...!!'); 
//    		redirect('datamhs');
// 	}  
// } 

}
