<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_datadsn_tamu extends CI_Model {
	public function view(){
		return $this->db->get('dosen_tamu')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function getdata(){
		return $this->db->get('dosen_tamu'); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('dosen_tamu', $data);
	}

    function get_dsn_tamu($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
        $query=$this->db->query("SELECT * FROM dosen_tamu where ((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))")->result();
        } else if ($semester == "21") {
        $query=$this->db->query("SELECT * FROM dosen_tamu where ((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))")->result();
        }
        return $query;
    }
}
