<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen_tamu extends CI_Controller {
    private $filename = "import_data"; // Kita tentukan nama filenya

  function __construct(){
		parent::__construct();
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    $this->load->helper(array('form', 'url'));
    $this->load->library('datatables');
    $this->load->model('m_datadsn_tamu');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}

	public function index()
	{
    $data['dosen_tamu'] = $this->m_datadsn_tamu->view();
    // $data['dosen_tamu'] = $this->m_datadsn_tamu->view();
    // $this->load->view('dosen_tamu', array('error' => ' ' ));
		$this->load->view('dosen_tamu', $data);
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
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->m_datadsn_tamu->upload_file($this->filename);
      
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
    $data['dosen_tamu'] = $this->m_datadsn_tamu->view();
    $this->load->view('dosen_tamu', $data);
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
          'nama' => $row['A'], // Ambil data nama
          'gender' => $row['B'], // Ambil data gender
          'negara_asal' => $row['C'], // Ambil data jenis kelamin
          'nama_perusahaan' => $row['D'], // Ambil data alamat
          'nama_kegiatan' => $row['E'], // Ambil data alamat
          'jabatan' => $row['F'], // Ambil data alamat
          'pendidikan_terakhir' => $row['G'], // Ambil data alamat
          'tgl_pelaksanaan' => $row['H'], // Ambil data alamat
          'uraian_kegiatan' => $row['I'], // Ambil data alamat
          'tempat' => $row['J'], // Ambil data tempat
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->m_datadsn_tamu->insert_multiple($data);
    
    redirect("dosen_tamu"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }
}