<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_datadsn extends CI_Model {
	public function view(){
		return $this->db->get('dosen')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function getdata(){
		return $this->db->get('dosen'); // Tampilkan semua data yang ada di tabel siswa
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
		$this->db->insert_batch('dosen', $data);
	}

	//FACULTY STAFF
	// International Faculty Staff
	public function get_number_of_international_staff(){
        $query=$this->db->query("SELECT nip FROM dosen WHERE NOT (kewarganegaraan = 'WNI' or kewarganegaraan = 'INDONESIA') GROUP BY nip");
         return $query;
    }

    // Visiting International Faculty Staff - Inbound
    public function get_number_of_visiting_international_inbound_parttime(){
        $query=$this->db->query("SELECT nama, negara_asal FROM dosen_tamu WHERE NOT negara_asal = 'Indonesia' GROUP BY nama");
         return $query;
    }

    // Visiting International Faculty Staff - Outbound


    // Staff with PhD
    public function get_number_of_faculty_staff_phd_fulltime(){
        $query=$this->db->query("SELECT nip FROM dosen WHERE pendidikan = 'S3' AND NOT employeestatus = 'DOSEN PROFESIONAL PART TIME' GROUP BY nip");
         return $query;
    }
    public function get_number_of_faculty_staff_phd_dosen_part(){
        $query=$this->db->query("SELECT nip FROM dosen WHERE pendidikan = 'S3' AND employeestatus = 'DOSEN PROFESIONAL PART TIME' GROUP BY nip");
         return $query;
    }
    public function get_number_of_faculty_staff_phd_tamu_part(){
        $query=$this->db->query("SELECT nama FROM dosen_tamu WHERE nama LIKE 'Dr.%' OR nama LIKE 'Prof.%' OR nama LIKE '%Ph.d' OR nama LIKE '%PhD' OR pendidikan_terakhir = 'S3' GROUP BY nama");
         return $query;
    }


    // Faculty Staff
    public function get_number_of_faculty_staff_fulltime(){
        $query=$this->db->query("SELECT nip FROM dosen WHERE NOT pendidikan = ' ' GROUP BY nip");
         return $query;
    }

    public function get_number_of_faculty_staff_parttime_dosen(){
        $query=$this->db->query("SELECT nip FROM dosen WHERE (employeestatus = 'DOSEN PROFESIONAL PART TIME') AND (NOT pendidikan = ' ') GROUP BY nip");
         return $query;
    }
    public function get_number_of_faculty_staff_parttime_tamu(){
        $query=$this->db->query("SELECT nama FROM dosen_tamu GROUP BY nama");
         return $query;
    }
    // public function get_number_of_faculty_staff(){
    //     $query=$this->db->query("SELECT dosen_tamu.nama FROM dosen JOIN dosen_tamu WHERE NOT pendidikan = ' ' GROUP BY dosen_tamu.nama");
    //      return $query;
    // }


}
