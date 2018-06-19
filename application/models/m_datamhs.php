<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_datamhs extends CI_Model {
    public function view(){
        return $this->db->get('mahasiswa_sisfo')->result(); // Tampilkan semua data yang ada di tabel siswa
    }
    public function view_io(){
        return $this->db->get('mahasiswa_io')->result(); // Tampilkan semua data yang ada di tabel siswa
    }

    public function getdata(){
        return $this->db->get('mahasiswa_sisfo'); // Tampilkan semua data yang ada di tabel siswa
    }
    public function getdata_io(){
        return $this->db->get('mahasiswa_io'); // Tampilkan semua data yang ada di tabel siswa
    }

    public function irisanmhs(){
         $query=$this->db->query("SELECT nim, COUNT(*) nim FROM mahasiswa GROUP BY nim HAVING COUNT(nim)  > 1");
         return $query;
    }

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

    public function get_number_of_overall_students(){ //26835
        // $query=$this->db->query("SELECT nama, COUNT(*) nama FROM mahasiswa_sisfo where status = 'STUDENT' & 'EXCHANGE STUDENT INBOUND' GROUP BY nama HAVING COUNT(nama)  > 1");
        // $query=$this->db->query("SELECT nim, COUNT(*) nim FROM mahasiswa_sisfo where status = 'STUDENT' & 'EXCHANGE STUDENT INBOUND' GROUP BY nim HAVING COUNT(nim)  > 1");
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1' or jenjang = 'S2') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
        // $query=$this->db->query("SELECT nim, COUNT(*) nim FROM mahasiswa_sisfo where (status = 'STUDENT' & 'EXCHANGE STUDENT INBOUND') and (jenjang = 'D4' & 'S1' & 'S2') GROUP BY nim");
         return $query;
    }

    // INDIKATOR STUDENT - UNDERGRADUATE
    public function get_number_of_undergraduate_international_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (negara_asal = 'WNI' or negara_asal = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_inbound_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (ket2 = 'INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_outbound_students(){
        $query=$this->db->query("SELECT nim, nama, univ_dest FROM mahasiswa_io where (jenjang = 'Undergraduate') AND NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }
    public function get_number_of_undergraduate_first_year(){
        $query=$this->db->query("SELECT COUNT(nim), nim, nama, schoolyear, angkatan FROM mahasiswa_sisfo WHERE (jenjang = 'D4' or jenjang = 'S1') AND angkatan = 1617 AND schoolyear = 1617 AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }    

    // INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
    public function get_number_of_grapost_international_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'S2' or jenjang = 'S3') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (negara_asal = 'WNI' or negara_asal = 'INDONESIA') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'S2' or jenjang = 'S3') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_inbound_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'S2' or jenjang = 'S3') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (ket2 = 'INBOUND') GROUP BY nim");
         return $query;
    }
    public function get_number_of_grapost_outbound_students(){
        $query=$this->db->query("SELECT nim, nama, univ_dest FROM mahasiswa_io where (jenjang = 'Graduate' or jenjang = 'Postgraduate') AND NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }

    // INDIKATOR STUDENT - OVERALL
    public function get_number_of_female_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1' or jenjang = 'S2') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'WANITA') GROUP BY nim");
         return $query;
    }

    public function get_number_of_international_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1' or jenjang = 'S2') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND NOT (negara_asal = 'WNI' or negara_asal = 'INDONESIA') GROUP BY nim");
         return $query;
    }

    public function get_number_of_male_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1' or jenjang = 'S2') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (gender = 'PRIA') GROUP BY nim");
         return $query;
    }

    public function get_number_of_inbound_students(){
        $query=$this->db->query("SELECT nim FROM mahasiswa_sisfo where (jenjang = 'D4' or jenjang = 'S1' or jenjang = 'S2') AND (status = 'STUDENT' or status = 'EXCHANGE STUDENT INBOUND') AND (ket2 = 'INBOUND') GROUP BY nim");
         return $query;
    }

    public function get_number_of_outbound_students(){
        $query=$this->db->query("SELECT nim, nama, univ_dest FROM mahasiswa_io where NOT univ_dest = ' ' GROUP BY nim");
         return $query;
    }
}
