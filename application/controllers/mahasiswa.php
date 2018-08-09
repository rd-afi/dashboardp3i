<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mahasiswa extends CI_Controller {
    private $filename = "import_data"; // Kita tentukan nama filenya

  function __construct(){
		parent::__construct();
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    $this->load->helper(array('form', 'url'));
    $this->load->library('datatables');
    $this->load->model('m_datamhs');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}

  //---------------------------------- SISFO -----------------------------

	public function index(){
    if (date('m')<=6) {
      $smt = "12";
    } else {
      $smt = "21";
    }
    ini_set('memory_limit', '-1');
    $data['mahasiswa_sisfo'] = $this->m_datamhs->view();

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
      $data['mhs'] = $this->m_datamhs->get_mhs($semester,$tahun);
    }else{
      // $data['bulan'] = date('F');
      $data['semester'] = $smt;
      $data['tahun'] = date('y');
      $data['mhs'] = $this->m_datamhs->get_mhs($smt,date('y'));
      // $data['mhs_all'] = $this->m_datamhs->view();
    }
    $this->load->view('mahasiswa',$data);
	}

  public function tambahmhs()
  {
    ini_set('memory_limit', '-1');
    $data['mahasiswa_sisfo'] = $this->m_datamhs->view();
    // $data['user'] = $this->m_datadsn->tampil_data()->result();
    // $this->load->view('dosen', array('error' => ' ' ));
    $this->load->view('tambahmahasiswa', $data);
  }

  public function download_template_mhs(){       
    force_download('template/Template_Data_Mahasiswa.xlsx',NULL);
  }

  public function aksi_upload(){
    ini_set('memory_limit', '-1');
    $this->load->library('upload'); // Load librari upload

    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size'] = '10240';
    $config['overwrite'] = true;
    $config['file_name'] = 'import_data';
 
    // $this->load->library('upload', $config);
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    // if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
    //   // Jika berhasil :
    //   $error = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
    //   return $this->load->view('mahasiswa', $error);
    // }else{
    //   // Jika gagal :
    //   $data = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    //   return $this->load->view('mahasiswa', $data);
    // }
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('mahasiswa', $error);
    }else{
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('mahasiswa', $data);
    }
  }


  public function form(){
    ini_set('memory_limit', '-1');
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->m_datamhs->upload_file($this->filename);
      
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
    
    $this->load->view('tambahmahasiswa', $data);
  }
  
  public function import(){
    ini_set('memory_limit', '-1');
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
        	  'schoolyear' => $row['A'], // Ambil data nama
            'semester' => $row['B'], // Ambil data gender
            'nim' => $row['C'], // Ambil data jenis kelamin
            'name' => $row['D'], // Ambil data alamat
            'generation' => $row['E'], // Ambil data alamat
            'faculty' => $row['F'], // Ambil data alamat
            'study_program' => $row['G'], // Ambil data alamat
            'degree' => $row['H'], // Ambil data alamat
            'gender' => $row['I'], // Ambil data alamat
            'status' => $row['J'], // Ambil data alamat
            'fee' => $row['K'], // Ambil data alamat
            'country_of_origin' => $row['L'], // Ambil data alamat
            'univ_origin' => $row['M'], // Ambil data alamat
            'univ_dest' => $row['N'], // Ambil data alamat
            'exchange_period' => $row['O'], // Ambil data alamat
            'inf' => $row['P'], // Ambil data alamat
            'inf2' => $row['Q'] // Ambil data alamat
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->m_datamhs->insert_multiple($data);
    
    redirect("mahasiswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }



  //-------------------------------------- IO ------------------------------

  public function index_io(){
    if (date('m')<=6) {
      $smt = "12";
    } else {
      $smt = "21";
    }
    ini_set('memory_limit', '-1');
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
        $data['mhs_io'] = $this->m_datamhs->get_mhs_io($semester,$tahun);
      }else{
        // $data['bulan'] = date('F');
        $data['semester'] = $smt;
        $data['tahun'] = date('y');
        $data['mhs_io'] = $this->m_datamhs->get_mhs_io($smt,date('y'));
        // $data['mhs_all'] = $this->m_datamhs->view();
      }
    $this->load->view('mahasiswa_io',$data);
  }

  public function tambahmhs_io()
  {
    $data['mahasiswa_io'] = $this->m_datamhs->view_io();
    // $data['user'] = $this->m_datadsn->tampil_data()->result();
    // $this->load->view('dosen', array('error' => ' ' ));
    $this->load->view('tambahmahasiswa_io', $data);
  }
  public function download_template_mhs_io(){       
    force_download('template/Template_Data_Mahasiswa_IO.xlsx',NULL);
  }
  public function aksi_upload_io(){
    ini_set('memory_limit', '-1');
    $this->load->library('upload'); // Load librari upload

    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size'] = '10240';
    $config['overwrite'] = true;
    $config['file_name'] = 'import_data';
 
    // $this->load->library('upload', $config);
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    // if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
    //   // Jika berhasil :
    //   $error = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
    //   return $this->load->view('mahasiswa', $error);
    // }else{
    //   // Jika gagal :
    //   $data = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    //   return $this->load->view('mahasiswa', $data);
    // }
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('mahasiswa_io', $error);
    }else{
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('mahasiswa_io', $data);
    }
  }


  public function form_io(){
    ini_set('memory_limit', '-1');
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->m_datamhs->upload_file_io($this->filename);
      
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
    
    $this->load->view('tambahmahasiswa_io', $data);
  }
  
  public function import_io(){
    ini_set('memory_limit', '-1');
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
            'schoolyear' => $row['A'],
            'semester' => $row['B'],
            'nim' => $row['C'],
            'name' => $row['D'],
            'generation' => $row['E'],
            'faculty' => $row['F'],
            'study_program' => $row['G'],
            'degree' => $row['H'],
            'gender' => $row['I'],
            'status' => $row['J'],
            'fee' => $row['K'],
            'country_of_origin' => $row['L'],
            'univ_origin' => $row['M'],
            'univ_dest' => $row['N'],
            'exchange_period' => $row['O'],
            'passport' => $row['P'],
            'inf' => $row['Q']
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->m_datamhs->insert_multiple_io($data);
    
    redirect("mahasiswa_io"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }



}