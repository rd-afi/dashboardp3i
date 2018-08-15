<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class isiqsaurp3i extends CI_Controller {

	public $sess = array();

	function __construct(){
		parent::__construct();

		// ME-LOAD MODEL
		$this->load->model('m_datadsn');
		$this->load->model('m_datadsn_tamu');
		$this->load->model('m_datamhs');
		$this->load->library('session');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	    if ($this->session->userdata('sess')) {
	        $this->sess = $this->session->userdata('sess');
	    }
	}

	public function index()
	{
		// Untuk men-set limit menjadi tanpa limit
    	// Untuk mencegah limit memori pada saat me-load data
		ini_set('memory_limit', '-1');

		// Mengecek bulan sekarang untuk menentukan Semester ganjil genap
		if (date('m')<=6) {
	    	$smt = "21";
	    } else {
	    	$smt = "12";
	    }

		if(isset($_POST['tahun'])){
			// contoh DATA 'tahun' = 2-1617/1-1718
			$st = $this->input->post('tahun');
			$y1 = substr($st, 2, 4); // 1617
            $y2 = substr($st, 9, 4); // 1718
            $s1 = substr($st, 0, 1); // 2
            $s2 = substr($st, 7, 1); // 1
	        $data['semester'] = $s1.$s2;
	        $data['tahun'] = $y1;
	        $semester = $s1.$s2;
	        $tahun = $y1;
	        $this->sess['semester'] = $semester;
		    $this->sess['tahun'] = $tahun;
		    $this->session->set_userdata('sess', $this->sess);
	        

	        // INDIKATOR FACULTY STAFF
			$data['staff_international'] = $this->m_datadsn->get_number_of_international_staff($semester,$tahun)->num_rows();
			$data['visiting_inbound_parttime'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($semester,$tahun)->num_rows();
			
			$data['staff_phd_full'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($semester,$tahun)->num_rows();
			$data['staff_phd_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($semester,$tahun)->num_rows();
			$data['staff_phd_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($semester,$tahun)->num_rows();

			$data['staff_dosen_full'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($semester,$tahun)->num_rows();
			$data['staff_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($semester,$tahun)->num_rows();
			$data['staff_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($semester,$tahun)->num_rows();

			// INDIKATOR STUDENT - UNDERGRADUATE
			$data['undergraduate_international_students'] = $this->m_datamhs->get_number_of_undergraduate_international_students($semester,$tahun)->num_rows();
			$data['undergraduate_students'] = $this->m_datamhs->get_number_of_undergraduate_students($semester,$tahun)->num_rows();
			$data['undergraduate_inbound_students'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($semester,$tahun)->num_rows();
			$data['undergraduate_outbound_students'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($semester,$tahun)->num_rows();
			$data['undergraduate_firstyear_student'] = $this->m_datamhs->get_number_of_undergraduate_first_year($semester,$tahun)->num_rows();

			// INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
			$data['grapost_international_students'] = $this->m_datamhs->get_number_of_grapost_international_students($semester,$tahun)->num_rows();
			$data['grapost_students'] = $this->m_datamhs->get_number_of_grapost_students($semester,$tahun)->num_rows();
			$data['grapost_inbound_students'] = $this->m_datamhs->get_number_of_grapost_inbound_students($semester,$tahun)->num_rows();
			$data['grapost_outbound_students'] = $this->m_datamhs->get_number_of_grapost_outbound_students($semester,$tahun)->num_rows();

			// INDIKATOR STUDENT - OVERALL
			$data['overall_students'] = $this->m_datamhs->get_number_of_overall_students($semester,$tahun)->num_rows();
			$data['female'] = $this->m_datamhs->get_number_of_female_students($semester,$tahun)->num_rows();
			$data['overall_international'] = $this->m_datamhs->get_number_of_international_students($semester,$tahun)->num_rows();
			$data['male'] = $this->m_datamhs->get_number_of_male_students($semester,$tahun)->num_rows();
			$data['inbound'] = $this->m_datamhs->get_number_of_inbound_students($semester,$tahun)->num_rows();
			$data['outbound'] = $this->m_datamhs->get_number_of_outbound_students($semester,$tahun)->num_rows();

			// AVERAGE TUITION FEES

			// JUMLAH MAHASISWA UNTUK HITUNG FEES
			$data['res_student_domestic'] = $this->m_datamhs->get_number_of_overall_students_domestic($semester,$tahun)->num_rows();
			$data['res_student_international'] = $this->m_datamhs->get_number_of_overall_students_international($semester,$tahun)->num_rows();
			$data['res_grapost_domestic'] = $this->m_datamhs->get_number_of_grapost_students_domestic($semester,$tahun)->num_rows();
			$data['res_undergraduate_domestic'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($semester,$tahun)->num_rows();
			
			// TOTAL FEES 
			$data['fees_undergraduate_student_domestic'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($semester,$tahun)->last_row();
			$data['fees_undergraduate_students_international'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($semester,$tahun)->last_row();
			$data['fees_grapost_student_domestic'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($semester,$tahun)->last_row();
			$data['fees_grapost_student_international'] = $this->m_datamhs->get_fees_of_grapost_students_international($semester,$tahun)->last_row();
			$data['fees_student_domestic'] = $this->m_datamhs->get_fees_of_overall_students_domestic($semester,$tahun)->last_row();
			$data['fees_students_international'] = $this->m_datamhs->get_fees_of_overall_students_international($semester,$tahun)->last_row();
	    }else{
	        $data['semester'] = $smt;
	        $data['tahun'] = date('y')-2;
	        $data['mhs'] = $this->m_datamhs->get_mhs($smt,date('y')-1);
	        $this->sess['semester'] = $smt;
		    $this->sess['tahun'] = date('y')-2;
		    $this->session->set_userdata('sess', $this->sess);

		    // INDIKATOR FACULTY STAFF
	        $data['staff_international'] = $this->m_datadsn->get_number_of_international_staff($smt,date('y')-1)->num_rows();
			$data['visiting_inbound_parttime'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($smt,date('y')-1)->num_rows();
			
			$data['staff_phd_full'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($smt,date('y')-1)->num_rows();
			$data['staff_phd_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($smt,date('y')-1)->num_rows();
			$data['staff_phd_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($smt,date('y')-1)->num_rows();

			$data['staff_dosen_full'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($smt,date('y')-1)->num_rows();
			$data['staff_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($smt,date('y')-1)->num_rows();
			$data['staff_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($smt,date('y')-1)->num_rows();

			// INDIKATOR STUDENT - UNDERGRADUATE
			$data['undergraduate_international_students'] = $this->m_datamhs->get_number_of_undergraduate_international_students($smt,date('y')-1)->num_rows();
			$data['undergraduate_students'] = $this->m_datamhs->get_number_of_undergraduate_students($smt,date('y')-1)->num_rows();
			$data['undergraduate_inbound_students'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($smt,date('y')-1)->num_rows();
			$data['undergraduate_outbound_students'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($smt,date('y')-1)->num_rows();
			$data['undergraduate_firstyear_student'] = $this->m_datamhs->get_number_of_undergraduate_first_year($smt,date('y')-1)->num_rows();

			// INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
			$data['grapost_international_students'] = $this->m_datamhs->get_number_of_grapost_international_students($smt,date('y')-1)->num_rows();
			$data['grapost_students'] = $this->m_datamhs->get_number_of_grapost_students($smt,date('y')-1)->num_rows();
			$data['grapost_inbound_students'] = $this->m_datamhs->get_number_of_grapost_inbound_students($smt,date('y')-1)->num_rows();
			$data['grapost_outbound_students'] = $this->m_datamhs->get_number_of_grapost_outbound_students($smt,date('y')-1)->num_rows();

			// INDIKATOR STUDENT - OVERALL
			$data['overall_students'] = $this->m_datamhs->get_number_of_overall_students($smt,date('y')-1)->num_rows();
			$data['female'] = $this->m_datamhs->get_number_of_female_students($smt,date('y')-1)->num_rows();
			$data['overall_international'] = $this->m_datamhs->get_number_of_international_students($smt,date('y')-1)->num_rows();
			$data['male'] = $this->m_datamhs->get_number_of_male_students($smt,date('y')-1)->num_rows();
			$data['inbound'] = $this->m_datamhs->get_number_of_inbound_students($smt,date('y')-1)->num_rows();
			$data['outbound'] = $this->m_datamhs->get_number_of_outbound_students($smt,date('y')-1)->num_rows();

			// AVERAGE TUITION FEES

			// JUMLAH MAHASISWA UNTUK HITUNG FEES
			$data['res_student_domestic'] = $this->m_datamhs->get_number_of_overall_students_domestic($smt,date('y')-1)->num_rows();
			$data['res_student_international'] = $this->m_datamhs->get_number_of_overall_students_international($smt,date('y')-1)->num_rows();
			$data['res_grapost_domestic'] = $this->m_datamhs->get_number_of_grapost_students_domestic($smt,date('y')-1)->num_rows();
			$data['res_undergraduate_domestic'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($smt,date('y')-1)->num_rows();
			
			// TOTAL FEES
			$data['fees_undergraduate_student_domestic'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($smt,date('y')-1)->last_row();
			$data['fees_undergraduate_students_international'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($smt,date('y')-1)->last_row();
			$data['fees_grapost_student_domestic'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($smt,date('y')-1)->last_row();
			$data['fees_grapost_student_international'] = $this->m_datamhs->get_fees_of_grapost_students_international($smt,date('y')-1)->last_row();
			$data['fees_student_domestic'] = $this->m_datamhs->get_fees_of_overall_students_domestic($smt,date('y')-1)->last_row();
			$data['fees_students_international'] = $this->m_datamhs->get_fees_of_overall_students_international($smt,date('y')-1)->last_row();
	    }
		$this->load->view('isiqsaurp3i', $data);
	}


	// EFIDENCE

	//Faculty Staff
	public function efidence_phd_staff_dosen_full(){
		$data['title'] = "Staff with Phd - Full Time";
		$data['data_evidence'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_faculty_staff', $data);
	}
	public function efidence_faculty_staff_dosen_full(){
		$data['title'] = "Faculty Staff - Full Time";
		$data['data_evidence'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_faculty_staff', $data);
	}
	public function efidence_faculty_staff_dosen_parttime(){
		$data['title'] = "Faculty Staff - Part Time";
		$data['data_evidence'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_faculty_staff', $data);
	}

	//Students - Undergraduate
	public function efidence_undergraduate_international_fulltime(){
		$data['title'] = "Undergraduate International Student - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_undergraduate_international_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_undergraduate_student_fulltime(){
		$data['title'] = "Undergraduate Student - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_undergraduate_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_undergraduate_inbound_fulltime(){
		$data['title'] = "Undergraduate exchange student - Inbound - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_undergraduate_outbound_fulltime(){
		$data['title'] = "Undergraduate exchange student - Outbound - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_undergraduate_first_fulltime(){
		$data['title'] = "Undergraduate student - First Year - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_undergraduate_first_year($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}

	//Students - Graduate / Postgraduate
	public function efidence_grapost_international_fulltime(){
		$data['title'] = "Graduate / Postgraduate International Students - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_grapost_international_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_grapost_inbound_fulltime(){
		$data['title'] = "Graduate / Postgraduate Inbound Exchange Students - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_grapost_inbound_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_grapost_outbound_fulltime(){
		$data['title'] = "Graduate / Postgraduate Outbound Exchange Students - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_grapost_outbound_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
	public function efidence_grapost_students_fulltime(){
		$data['title'] = "Graduate / Postgraduate Students - Full Time";
		$data['data_evidence'] = $this->m_datamhs->get_number_of_grapost_students($this->sess['semester'],$this->sess['tahun'])->result();
		$this->load->view('evidence_student', $data);
	}
}