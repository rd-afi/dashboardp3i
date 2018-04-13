<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class m_datamhs extends CI_Model {

 
    public $table = 'mahasiswa';
    public $id = 'id';
    public $order = 'ASC';
 
    function __construct() {
        parent::__construct();
    }

    public function getdata(){
        return $this->db->get('mahasiswa'); // Tampilkan semua data yang ada di tabel siswa
    }
 
    //ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'schoolyear' => $dataarray[$i]['SCHOOLYEAR'],
                'semester' => $dataarray[$i]['SEMESTER'],
                'nim' => $dataarray[$i]['NIM'],
                'nama' => $dataarray[$i]['NAMA'],
                'angkatan' => $dataarray[$i]['ANGKATAN'],
                'fakultas' => $dataarray[$i]['FAKULTAS'],
                'prodi' => $dataarray[$i]['PRODI'],
                'jenjang' => $dataarray[$i]['JENJANG'],
                'gender' => $dataarray[$i]['GENDER'],
                'status' => $dataarray[$i]['STATUS'],
                'bpp' => $dataarray[$i]['BPP'],
                'negara_asal' => $dataarray[$i]['NEGARA_ASAL'],
                'univ_origin' => $dataarray[$i][''],
                'univ_dest' => $dataarray[$i]['UNIV_DES'],
                'exchange_period' => $dataarray[$i]['EXCHANGE_PERIOD'],
                'loa' => $dataarray[$i]['LOA'],
                'moa' => $dataarray[$i]['MOA'],
                'ket' => $dataarray[$i]['KET'],
                'ket2' => $dataarray[$i]['KET2']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            $this->db->where('nama', $this->input->post('nama'));            
            if ($cek) {
                $this->db->insert($this->table, $data);
            }
        }
    }
}