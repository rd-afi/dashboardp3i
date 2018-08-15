<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_datadsn extends CI_Model {
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '10240';
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
	
	// UNTUK INSERT LEBIH DARI 1 DATA
	public function insert_multiple($data){
		$this->db->insert_batch('dosen', $data);
	}

    // UNTUK MEMANGGIL DATA DARI DATABASE
    function get_dsn ($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
        $query=$this->db->query("SELECT * FROM dosen where ((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))")->result();
        } else if ($semester == "21") {
        $query=$this->db->query("SELECT * FROM dosen where ((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))")->result();
        }
        return $query;
    }

	//FACULTY STAFF
	// International Faculty Staff
	public function get_number_of_international_staff($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT nip FROM dosen WHERE ".$where." AND NOT (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nip");
         return $query;
    }

    // Visiting International Faculty Staff - Inbound
    public function get_number_of_visiting_international_inbound_parttime($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT name, country_of_origin FROM dosen_tamu WHERE ".$where." AND NOT country_of_origin = 'Indonesia' GROUP BY name");
         return $query;
    }

    // Visiting International Faculty Staff - Outbound


    // Staff with PhD
    public function get_number_of_faculty_staff_phd_fulltime($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen WHERE ".$where." AND education = 'S3' GROUP BY nip");
        return $query;
    }
    public function get_number_of_faculty_staff_phd_dosen_part($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen WHERE ".$where." AND education = 'S3' AND employee_status = 'DOSEN PROFESIONAL PART TIME' GROUP BY nip");
        return $query;
    }
    public function get_number_of_faculty_staff_phd_tamu_part($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen_tamu WHERE ".$where." AND name LIKE 'Dr.%' OR name LIKE 'Prof.%' OR name LIKE '%Ph.d' OR name LIKE '%PhD' OR education = 'S3' GROUP BY name");
        return $query;
    }


    // Faculty Staff
    public function get_number_of_faculty_staff_fulltime($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen WHERE ".$where." GROUP BY nip");
        return $query;
    }

    public function get_number_of_faculty_staff_parttime_dosen($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen WHERE ".$where." AND (employee_status = 'DOSEN PROFESIONAL PART TIME') AND (NOT education = ' ') GROUP BY nip");
        return $query;
    }
    public function get_number_of_faculty_staff_parttime_tamu($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
        } 
        $query=$this->db->query("SELECT * FROM dosen_tamu WHERE ".$where." GROUP BY name");
        return $query;
    }


}
