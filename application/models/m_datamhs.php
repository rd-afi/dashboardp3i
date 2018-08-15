<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_datamhs extends CI_Model {
    
    //------------------------- SISFO -------------------------
    
    // Fungsi untuk melakukan proses upload file
    public function upload_file($filename){
        ini_set('memory_limit', '-1');
        $this->load->library('upload'); // Load librari upload
        
        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '10240';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
    
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
            ini_set('memory_limit', '-1');
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            ini_set('memory_limit', '-1');
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    
    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple($data){
        ini_set('memory_limit', '-1');
        $this->db->insert_batch('mahasiswa_sisfo', $data);
    }


    //------------------------- IO -------------------------
    
    public function upload_file_io($filename){
        ini_set('memory_limit', '-1');
        $this->load->library('upload');
        
        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '10240';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
    
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
            ini_set('memory_limit', '-1');
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            ini_set('memory_limit', '-1');
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    
    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple_io($data){
        ini_set('memory_limit', '-1');
        $this->db->insert_batch('mahasiswa_io', $data);
    }

    // UNTUK ISI INDIKATOR
    function mhs_list(){
        $hasil = $this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        return $hasil->result();
    }

    function get_mhs ($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))")->result();
        } else if ($semester == "21") {
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))")->result();
        }
        return $query;
    }

    function get_mhs_io ($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
        $query=$this->db->query("SELECT * FROM mahasiswa_io where ((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))")->result();
        } else if ($semester == "21") {
        $query=$this->db->query("SELECT * FROM mahasiswa_io where ((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))")->result();
        }
        return $query;
    }

    public function get_number_of_overall_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }

    public function get_number_of_overall_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }

    public function get_number_of_overall_students_international($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }

    // INDIKATOR STUDENT - UNDERGRADUATE
    public function get_number_of_undergraduate_international_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_inbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo WHERE ".$where." AND (inf2 = 'Inbound') AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo WHERE (inf2 = 'Inbound') AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_outbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_io where ".$where." AND (degree = 'Undergraduate') AND NOT univ_dest = ' ' GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_io where (degree = 'Undergraduate') AND NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_first_year($semester,$tahun){
        $year = substr($tahun, 0, 2);
        $year1 = $year+1;
        $year2 = $year1+1;
        $smt = $semester;
        $gan = substr($smt, 0, -1);
        $gen = substr($smt, -1);    

        if ($semester == "12") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gen.") OR (schoolyear = ".$year.$year1." AND semester = ".$gan."))";
            $generation = "generation = ".$year.$year1." AND schoolyear = ".$year.$year1."";
        } else if ($semester == "21") {
            $where = "((schoolyear = ".$year.$year1." AND semester = ".$gan.") OR (schoolyear = ".$year1.$year2." AND semester = ".$gen."))";
            $generation = "generation = ".$year.$year1." AND schoolyear = ".$year.$year1."";
        }
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo WHERE ".$where." AND (degree = 'Undergraduate') AND ".$generation." AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo WHERE (degree = 'Undergraduate') AND generation = 1617 AND schoolyear = 1617 AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }    

    // INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
    public function get_number_of_grapost_international_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_inbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (inf2 = 'INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (inf2 = 'INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_outbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_io where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND NOT univ_dest = ' ' GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_io where (degree = 'Graduate' or degree = 'Postgraduate') AND NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }

    // INDIKATOR STUDENT - OVERALL
    public function get_number_of_female_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'F') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'F') GROUP BY nim");
         return $query;
    }

    public function get_number_of_international_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim");
         return $query;
    }

    public function get_number_of_male_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'M') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'M') GROUP BY nim");
         return $query;
    }

    public function get_number_of_inbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (inf2 = 'INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (inf2 = 'INBOUND') GROUP BY nim");
         return $query;
    }

    public function get_number_of_outbound_students($semester,$tahun){
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
        $query=$this->db->query("SELECT * FROM mahasiswa_io where ".$where." AND NOT univ_dest = ' ' GROUP BY nim");
        // $query=$this->db->query("SELECT * FROM mahasiswa_io where NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }

    //AVERAGE TUITION FEES
    public function get_fees_of_overall_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where (degree = 'Undergraduate' or degree = 'Graduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }
    public function get_fees_of_overall_students_international($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Graduate', 22000000, IF(degree='Undergraduate', 23000000, 0))) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate' OR degree = 'Graduate' OR degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Graduate', 22000000, IF(degree='Undergraduate', 23000000, 0))) as fee FROM mahasiswa_sisfo where (degree = 'Undergraduate' OR degree = 'Graduate' OR degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
         return $query;
    }


    public function get_fees_of_undergraduate_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }
    public function get_fees_of_undergraduate_students_international($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Undergraduate', 23000000, 0)) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Undergraduate', 23000000, 0)) as fee FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        return $query;
    }

    public function get_fees_of_grapost_students_domestic($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(fee) as fee FROM mahasiswa_sisfo where (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }
    public function get_fees_of_grapost_students_international($semester,$tahun){
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
        $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Graduate', 22000000, IF(degree='Postgraduate', 22000000, 0))) as fee FROM mahasiswa_sisfo where ".$where." AND (degree = 'Graduate' or degree = 'Postgraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (country_of_origin = 'WNI' OR country_of_origin = 'INDONESIA' OR country_of_origin LIKE '%INDONESIA%') GROUP BY nim WITH ROLLUP");
        // $query=$this->db->query("SELECT DISTINCT SUM(IF(degree='Undergraduate', 23000000, 0)) as fee FROM mahasiswa_sisfo where (degree = 'Undergraduate') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (country_of_origin = 'WNI' or country_of_origin = 'INDONESIA') GROUP BY nim WITH ROLLUP");
         return $query;
    }
}