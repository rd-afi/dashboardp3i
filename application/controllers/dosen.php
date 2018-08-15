<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen extends CI_Controller {
    private $filename = "import_data";

  function __construct(){
		parent::__construct();
    // Me-Load helper, library, dan model yang dibutuhkan
    $this->load->helper(array('form', 'url'));
    $this->load->library('datatables');
    $this->load->model('m_datadsn');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}


  public function index(){
    // Untuk men-set limit menjadi tanpa limit
    // Untuk mencegah limit memori pada saat me-load data
    ini_set('memory_limit', '-1');
    
    // Mengecek bulan sekarang untuk menentukan Semester ganjil genap
    if (date('m')<=6) {
      $smt = "12";
    } else {
      $smt = "21";
    }

      if(isset($_POST['tahun'])){
        $st = $this->input->post('tahun');
        $y1 = substr($st, 2, 4);
        $y2 = substr($st, 9, 4);
        $s1 = substr($st, 0, 1);
        $s2 = substr($st, 7, 1);
        $data['semester'] = $s1.$s2;
        $data['tahun'] = $y1;
        $semester = $s1.$s2;
        $tahun = $y1;
        $data['dsn'] = $this->m_datadsn->get_dsn($semester,$tahun);
      }else{
        $data['semester'] = $smt;
        $data['tahun'] = date('y');
        $data['dsn'] = $this->m_datadsn->get_dsn($smt,date('y'));
      }
    $this->load->view('dosen',$data);
  }

  // UNTUK TAMBAH DATA DOSEN
  public function tambahdosen()
  {
    $this->load->view('tambahdosen');
  }

  // UNTUK DOWNLOAD TEMPLATE
  public function download_template(){       
    force_download('template/Template_Data_Dosen.xlsx',NULL);
  }

  // UNTUK UPLOAD EXCEL
  public function aksi_upload(){
    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size'] = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = 'import_data';
 
    $this->load->library('upload', $config);
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('dosen', $error);
    }else{
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('dosen', $data);
    }
  }

  // UNTUK MENAMPILKAN EXCEL YANG SUDAH DI UPLOAD 
  public function form(){
    $data = array();
    
    if(isset($_POST['preview'])){
      $upload = $this->m_datadsn->upload_file($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        include APPPATH.'third_party/PHPExcel/PHPExcel.php'; // Load plugin PHPExcel nya
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke view
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error'];
      }
    }
    // Meload view tambahdosen dengan membawa data-data pada $data
    $this->load->view('tambahdosen', $data);
  }
  
  // PROSES IMPORT KE DATABASE DARI EXCEL YANG SUDAH DIUPLOAD
  public function import(){
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = [];
    
    $numrow = 1;
    foreach($sheet as $row){
      if($numrow > 1){
        array_push($data, [
          'schoolyear' => $row['A'],
          'semester' => $row['B'],
          'nip' => $row['C'],
          'name' => $row['D'],
          'position' => $row['E'],
          'employee_status' => $row['F'],
          'education' => $row['G'],
          'country_of_origin' => $row['H'],
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    $this->m_datadsn->insert_multiple($data);
    redirect("dosen");
  }
}