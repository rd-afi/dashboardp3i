<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_inputmhs extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}

	public function index()
	{
		$this->load->view('inputmhs');
	}

	public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "idimport"=> $rowData[0][0],
                    "schoolyear"=> $rowData[0][1],
                    "semester"=> $rowData[0][2],
                    "nim"=> $rowData[0][3],
                    "nama"=> $rowData[0][4],
                    "angkatan"=> $rowData[0][5],
                    "fakultas"=> $rowData[0][6],
                    "prodi"=> $rowData[0][7],
                    "jenjang"=> $rowData[0][8],
                    "gender"=> $rowData[0][9],
                    "status"=> $rowData[0][10],
                    "bpp"=> $rowData[0][11],
                    "negara_asal"=> $rowData[0][12],
                    "univ_dest"=> $rowData[0][13],
                    "exchange_period"=> $rowData[0][14],
                    "loa"=> $rowData[0][15],
                    "moa"=> $rowData[0][16],
                    "ket"=> $rowData[0][17],
                    "ket2"=> $rowData[0][18]
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("mahasiswa",$data);
                delete_files($media['file_path']);
                     
            }
        redirect('datamhs/');
    }

}
