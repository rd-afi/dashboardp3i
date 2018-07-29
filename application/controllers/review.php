<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class review extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_datadsn');
		$this->load->model('m_datadsn_tamu');
		$this->load->model('m_datamhs');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		ini_set('memory_limit', '-1');
		if (date('m')<=6) {
	    	$smt = "12";
	    } else {
	    	$smt = "21";
	    }

		if(isset($_POST['semester']) && isset($_POST['tahun'])){
	        $data['semester'] = $this->input->post('semester');
	        $data['semester2'] = $this->input->post('semester2');
	        $data['tahun'] = $this->input->post('tahun');
	        $data['tahun2'] = $this->input->post('tahun2');
	        $semester = $this->input->post('semester');
	        $semester2 = $this->input->post('semester2');
	        $tahun = $this->input->post('tahun');
	        $tahun2 = $this->input->post('tahun2');
	        

	        // INDIKATOR FACULTY STAFF
			$data['staff_international'] = $this->m_datadsn->get_number_of_international_staff($semester,$tahun)->num_rows();
			$data['staff_international2'] = $this->m_datadsn->get_number_of_international_staff($semester2,$tahun2)->num_rows();

			$data['visiting_inbound_parttime'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($semester,$tahun)->num_rows();
			$data['visiting_inbound_parttime2'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($semester2,$tahun2)->num_rows();
			
			$data['staff_phd_full'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($semester,$tahun)->num_rows();
			$data['staff_phd_full2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($semester2,$tahun2)->num_rows();

			$data['staff_phd_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($semester,$tahun)->num_rows();
			$data['staff_phd_dosen_part2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($semester2,$tahun2)->num_rows();

			$data['staff_phd_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($semester,$tahun)->num_rows();
			$data['staff_phd_tamu_part2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($semester2,$tahun2)->num_rows();

			$data['staff_dosen_full'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($semester,$tahun)->num_rows();
			$data['staff_dosen_full2'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($semester2,$tahun2)->num_rows();

			$data['staff_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($semester,$tahun)->num_rows();
			$data['staff_dosen_part2'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($semester2,$tahun2)->num_rows();

			$data['staff_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($semester,$tahun)->num_rows();
			$data['staff_tamu_part2'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($semester2,$tahun2)->num_rows();

			// INDIKATOR STUDENT - UNDERGRADUATE
			$data['undergraduate_international_students'] = $this->m_datamhs->get_number_of_undergraduate_international_students($semester,$tahun)->num_rows();
			$data['undergraduate_international_students2'] = $this->m_datamhs->get_number_of_undergraduate_international_students($semester2,$tahun2)->num_rows();

			$data['undergraduate_students'] = $this->m_datamhs->get_number_of_undergraduate_students($semester,$tahun)->num_rows();
			$data['undergraduate_students2'] = $this->m_datamhs->get_number_of_undergraduate_students($semester2,$tahun2)->num_rows();

			$data['undergraduate_inbound_students'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($semester,$tahun)->num_rows();
			$data['undergraduate_inbound_students2'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($semester2,$tahun2)->num_rows();

			$data['undergraduate_outbound_students'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($semester,$tahun)->num_rows();
			$data['undergraduate_outbound_students2'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($semester2,$tahun2)->num_rows();

			$data['undergraduate_firstyear_student'] = $this->m_datamhs->get_number_of_undergraduate_first_year($semester,$tahun)->num_rows();
			$data['undergraduate_firstyear_student2'] = $this->m_datamhs->get_number_of_undergraduate_first_year($semester2,$tahun2)->num_rows();


			// INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
			$data['grapost_international_students'] = $this->m_datamhs->get_number_of_grapost_international_students($semester,$tahun)->num_rows();
			$data['grapost_international_students2'] = $this->m_datamhs->get_number_of_grapost_international_students($semester2,$tahun2)->num_rows();

			$data['grapost_students'] = $this->m_datamhs->get_number_of_grapost_students($semester,$tahun)->num_rows();
			$data['grapost_students2'] = $this->m_datamhs->get_number_of_grapost_students($semester2,$tahun2)->num_rows();

			$data['grapost_inbound_students'] = $this->m_datamhs->get_number_of_grapost_inbound_students($semester,$tahun)->num_rows();
			$data['grapost_inbound_students2'] = $this->m_datamhs->get_number_of_grapost_inbound_students($semester2,$tahun2)->num_rows();

			$data['grapost_outbound_students'] = $this->m_datamhs->get_number_of_grapost_outbound_students($semester,$tahun)->num_rows();
			$data['grapost_outbound_students2'] = $this->m_datamhs->get_number_of_grapost_outbound_students($semester2,$tahun2)->num_rows();

			// INDIKATOR STUDENT - OVERALL
			$data['overall_students'] = $this->m_datamhs->get_number_of_overall_students($semester,$tahun)->num_rows();
			$data['overall_students2'] = $this->m_datamhs->get_number_of_overall_students($semester2,$tahun2)->num_rows();

			$data['female'] = $this->m_datamhs->get_number_of_female_students($semester,$tahun)->num_rows();
			$data['female2'] = $this->m_datamhs->get_number_of_female_students($semester2,$tahun2)->num_rows();

			$data['overall_international'] = $this->m_datamhs->get_number_of_international_students($semester,$tahun)->num_rows();
			$data['overall_international2'] = $this->m_datamhs->get_number_of_international_students($semester2,$tahun2)->num_rows();

			$data['male'] = $this->m_datamhs->get_number_of_male_students($semester,$tahun)->num_rows();
			$data['male2'] = $this->m_datamhs->get_number_of_male_students($semester2,$tahun2)->num_rows();

			$data['inbound'] = $this->m_datamhs->get_number_of_inbound_students($semester,$tahun)->num_rows();
			$data['inbound2'] = $this->m_datamhs->get_number_of_inbound_students($semester2,$tahun2)->num_rows();

			$data['outbound'] = $this->m_datamhs->get_number_of_outbound_students($semester,$tahun)->num_rows();
			$data['outbound2'] = $this->m_datamhs->get_number_of_outbound_students($semester2,$tahun2)->num_rows();

			// AVERAGE TUITION FEES
			$data['res_student_domestic'] = $this->m_datamhs->get_number_of_overall_students_domestic($semester,$tahun)->num_rows();
			$data['res_student_domestic2'] = $this->m_datamhs->get_number_of_overall_students_domestic($semester2,$tahun2)->num_rows();

			$data['res_student_international'] = $this->m_datamhs->get_number_of_overall_students_international($semester,$tahun)->num_rows();
			$data['res_student_international2'] = $this->m_datamhs->get_number_of_overall_students_international($semester2,$tahun2)->num_rows();

			$data['res_grapost_domestic'] = $this->m_datamhs->get_number_of_grapost_students_domestic($semester,$tahun)->num_rows();
			$data['res_grapost_domestic2'] = $this->m_datamhs->get_number_of_grapost_students_domestic($semester2,$tahun2)->num_rows();

			$data['res_undergraduate_domestic'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($semester,$tahun)->num_rows();
			$data['res_undergraduate_domestic2'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($semester2,$tahun2)->num_rows();
			
			$data['fees_undergraduate_student_domestic'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($semester,$tahun)->last_row();
			$data['fees_undergraduate_student_domestic2'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($semester2,$tahun2)->last_row();

			$data['fees_undergraduate_students_international'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($semester,$tahun)->last_row();
			$data['fees_undergraduate_students_international2'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($semester2,$tahun2)->last_row();

			$data['fees_grapost_student_domestic'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($semester,$tahun)->last_row();
			$data['fees_grapost_student_domestic2'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($semester2,$tahun2)->last_row();

			$data['fees_grapost_student_international'] = $this->m_datamhs->get_fees_of_grapost_students_international($semester,$tahun)->last_row();
			$data['fees_grapost_student_international2'] = $this->m_datamhs->get_fees_of_grapost_students_international($semester2,$tahun2)->last_row();

			$data['fees_student_domestic'] = $this->m_datamhs->get_fees_of_overall_students_domestic($semester,$tahun)->last_row();
			$data['fees_student_domestic2'] = $this->m_datamhs->get_fees_of_overall_students_domestic($semester2,$tahun2)->last_row();

			$data['fees_students_international'] = $this->m_datamhs->get_fees_of_overall_students_international($semester,$tahun)->last_row();
			$data['fees_students_international2'] = $this->m_datamhs->get_fees_of_overall_students_international($semester2,$tahun2)->last_row();
	    }else{
	        // $data['bulan'] = date('F');
	        $data['semester'] = $smt;
	        $data['semester2'] = $smt;
	        $data['tahun'] = date('Y')-2;
	        $data['tahun2'] = date('Y')-1;

	        $data['staff_international'] = $this->m_datadsn->get_number_of_international_staff($smt,date('Y')-2)->num_rows();
	        $data['staff_international2'] = $this->m_datadsn->get_number_of_international_staff($smt,date('Y')-1)->num_rows();

			$data['visiting_inbound_parttime'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($smt,date('Y')-2)->num_rows();
			$data['visiting_inbound_parttime2'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime($smt,date('Y')-1)->num_rows();
			
			$data['staff_phd_full'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($smt,date('Y')-2)->num_rows();
			$data['staff_phd_full2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime($smt,date('Y')-1)->num_rows();

			$data['staff_phd_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($smt,date('Y')-2)->num_rows();
			$data['staff_phd_dosen_part2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part($smt,date('Y')-1)->num_rows();

			$data['staff_phd_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($smt,date('Y')-2)->num_rows();
			$data['staff_phd_tamu_part2'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part($smt,date('Y')-1)->num_rows();

			$data['staff_dosen_full'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($smt,date('Y')-2)->num_rows();
			$data['staff_dosen_full2'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime($smt,date('Y')-1)->num_rows();

			$data['staff_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($smt,date('Y')-2)->num_rows();
			$data['staff_dosen_part2'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen($smt,date('Y')-1)->num_rows();

			$data['staff_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($smt,date('Y')-2)->num_rows();
			$data['staff_tamu_part2'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu($smt,date('Y')-1)->num_rows();

			// INDIKATOR STUDENT - UNDERGRADUATE
			$data['undergraduate_international_students'] = $this->m_datamhs->get_number_of_undergraduate_international_students($smt,date('Y')-2)->num_rows();
			$data['undergraduate_international_students2'] = $this->m_datamhs->get_number_of_undergraduate_international_students($smt,date('Y')-1)->num_rows();

			$data['undergraduate_students'] = $this->m_datamhs->get_number_of_undergraduate_students($smt,date('Y')-2)->num_rows();
			$data['undergraduate_students2'] = $this->m_datamhs->get_number_of_undergraduate_students($smt,date('Y')-1)->num_rows();

			$data['undergraduate_inbound_students'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($smt,date('Y')-2)->num_rows();
			$data['undergraduate_inbound_students2'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students($smt,date('Y')-1)->num_rows();

			$data['undergraduate_outbound_students'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($smt,date('Y')-2)->num_rows();
			$data['undergraduate_outbound_students2'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students($smt,date('Y')-1)->num_rows();

			$data['undergraduate_firstyear_student'] = $this->m_datamhs->get_number_of_undergraduate_first_year($smt,date('Y')-2)->num_rows();
			$data['undergraduate_firstyear_student2'] = $this->m_datamhs->get_number_of_undergraduate_first_year($smt,date('Y')-1)->num_rows();

			// INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
			$data['grapost_international_students'] = $this->m_datamhs->get_number_of_grapost_international_students($smt,date('Y')-2)->num_rows();
			$data['grapost_international_students2'] = $this->m_datamhs->get_number_of_grapost_international_students($smt,date('Y')-1)->num_rows();

			$data['grapost_students'] = $this->m_datamhs->get_number_of_grapost_students($smt,date('Y')-2)->num_rows();
			$data['grapost_students2'] = $this->m_datamhs->get_number_of_grapost_students($smt,date('Y')-1)->num_rows();

			$data['grapost_inbound_students'] = $this->m_datamhs->get_number_of_grapost_inbound_students($smt,date('Y')-2)->num_rows();
			$data['grapost_inbound_students2'] = $this->m_datamhs->get_number_of_grapost_inbound_students($smt,date('Y')-1)->num_rows();

			$data['grapost_outbound_students'] = $this->m_datamhs->get_number_of_grapost_outbound_students($smt,date('Y')-2)->num_rows();
			$data['grapost_outbound_students2'] = $this->m_datamhs->get_number_of_grapost_outbound_students($smt,date('Y')-1)->num_rows();

			// INDIKATOR STUDENT - OVERALL
			$data['overall_students'] = $this->m_datamhs->get_number_of_overall_students($smt,date('Y')-2)->num_rows();
			$data['overall_students2'] = $this->m_datamhs->get_number_of_overall_students($smt,date('Y')-1)->num_rows();

			$data['female'] = $this->m_datamhs->get_number_of_female_students($smt,date('Y')-2)->num_rows();
			$data['female2'] = $this->m_datamhs->get_number_of_female_students($smt,date('Y')-1)->num_rows();

			$data['overall_international'] = $this->m_datamhs->get_number_of_international_students($smt,date('Y')-2)->num_rows();
			$data['overall_international2'] = $this->m_datamhs->get_number_of_international_students($smt,date('Y')-1)->num_rows();

			$data['male'] = $this->m_datamhs->get_number_of_male_students($smt,date('Y')-2)->num_rows();
			$data['male2'] = $this->m_datamhs->get_number_of_male_students($smt,date('Y')-1)->num_rows();

			$data['inbound'] = $this->m_datamhs->get_number_of_inbound_students($smt,date('Y')-2)->num_rows();
			$data['inbound2'] = $this->m_datamhs->get_number_of_inbound_students($smt,date('Y')-1)->num_rows();

			$data['outbound'] = $this->m_datamhs->get_number_of_outbound_students($smt,date('Y')-2)->num_rows();
			$data['outbound2'] = $this->m_datamhs->get_number_of_outbound_students($smt,date('Y')-2)->num_rows();

			// AVERAGE TUITION FEES
			$data['res_student_domestic'] = $this->m_datamhs->get_number_of_overall_students_domestic($smt,date('Y')-2)->num_rows();
			$data['res_student_domestic2'] = $this->m_datamhs->get_number_of_overall_students_domestic($smt,date('Y')-1)->num_rows();

			$data['res_student_international'] = $this->m_datamhs->get_number_of_overall_students_international($smt,date('Y')-2)->num_rows();
			$data['res_student_international2'] = $this->m_datamhs->get_number_of_overall_students_international($smt,date('Y')-1)->num_rows();

			$data['res_grapost_domestic'] = $this->m_datamhs->get_number_of_grapost_students_domestic($smt,date('Y')-2)->num_rows();
			$data['res_grapost_domestic2'] = $this->m_datamhs->get_number_of_grapost_students_domestic($smt,date('Y')-1)->num_rows();

			$data['res_undergraduate_domestic'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($smt,date('Y')-2)->num_rows();
			$data['res_undergraduate_domestic2'] = $this->m_datamhs->get_number_of_undergraduate_students_domestic($smt,date('Y')-1)->num_rows();
			
			$data['fees_undergraduate_student_domestic'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($smt,date('Y')-2)->last_row();
			$data['fees_undergraduate_student_domestic2'] = $this->m_datamhs->get_fees_of_undergraduate_students_domestic($smt,date('Y')-1)->last_row();

			$data['fees_undergraduate_students_international'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($smt,date('Y')-2)->last_row();
			$data['fees_undergraduate_students_international2'] = $this->m_datamhs->get_fees_of_undergraduate_students_international($smt,date('Y')-1)->last_row();

			$data['fees_grapost_student_domestic'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($smt,date('Y')-2)->last_row();
			$data['fees_grapost_student_domestic2'] = $this->m_datamhs->get_fees_of_grapost_students_domestic($smt,date('Y')-1)->last_row();

			$data['fees_grapost_student_international'] = $this->m_datamhs->get_fees_of_grapost_students_international($smt,date('Y')-2)->last_row();
			$data['fees_grapost_student_international2'] = $this->m_datamhs->get_fees_of_grapost_students_international($smt,date('Y')-1)->last_row();

			$data['fees_student_domestic'] = $this->m_datamhs->get_fees_of_overall_students_domestic($smt,date('Y')-2)->last_row();
			$data['fees_student_domestic2'] = $this->m_datamhs->get_fees_of_overall_students_domestic($smt,date('Y')-1)->last_row();

			$data['fees_students_international'] = $this->m_datamhs->get_fees_of_overall_students_international($smt,date('Y')-2)->last_row();
			$data['fees_students_international2'] = $this->m_datamhs->get_fees_of_overall_students_international($smt,date('Y')-1)->last_row();
	    }

		$this->load->view('review', $data);
	}
}