<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen_tamu extends CI_Controller {
    private $filename = "import_data"; // Kita tentukan nama filenya

  function __construct(){
		parent::__construct();
    // Me-Load helper, library, dan model yang dibutuhkan
    $this->load->helper(array('form', 'url'));
    $this->load->library('datatables');
    $this->load->model('m_datadsn_tamu');

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
        $data['dsn_tamu'] = $this->m_datadsn_tamu->get_dsn_tamu($semester,$tahun);
      }else{
        // $data['bulan'] = date('F');
        $data['semester'] = $smt;
        $data['tahun'] = date('y');
        $data['dsn_tamu'] = $this->m_datadsn_tamu->get_dsn_tamu($smt,date('y'));
      }
    $this->load->view('dosen_tamu',$data);
  }

  public function tambahdosen()
  {
    $this->load->view('tambahdosen_tamu');
  }

  public function download_template(){       
    force_download('template/Template_Data_Dosen_Tamu.xlsx',NULL);
  }

  public function aksi_upload(){
    $config['upload_path'] = './excel/';
    $config['allowed_types'] = 'xlsx';
    $config['max_size'] = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = 'import_data';
 
    $this->load->library('upload', $config);
 
    if ( ! $this->upload->do_upload('file')){
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('dosen_tamu', $error);
    }else{
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('dosen_tamu', $data);
    }
  }


  public function form(){
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di model
      $upload = $this->m_datadsn_tamu->upload_file($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke view
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    $data['dosen_tamu'] = $this->m_datadsn_tamu->view();
    $this->load->view('tambahdosen_tamu', $data);
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
          'schoolyear' => $row['A'],
          'semester' => $row['B'],
          'name' => $row['C'],
          'gender' => $row['D'],
          'country_of_origin' => $row['E'],
          'institution' => $row['F'],
          'event' => $row['G'],
          'position' => $row['H'],
          'education' => $row['I'],
          'time_period' => $row['J'],
          'venue' => $row['K']
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->m_datadsn_tamu->insert_multiple($data);
    
    redirect("dosen_tamu"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }
}