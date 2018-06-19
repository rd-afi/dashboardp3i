<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class isiqsaurp3i extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_datadsn');
		$this->load->model('m_datadsn_tamu');
		$this->load->model('m_datadsn_phd');
		$this->load->model('m_datamhs');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		// INDIKATOR FACULTY STAFF
		$data['staff_international'] = $this->m_datadsn->get_number_of_international_staff()->num_rows();
		$data['visiting_inbound_parttime'] = $this->m_datadsn->get_number_of_visiting_international_inbound_parttime()->num_rows();
		
		$data['staff_phd_full'] = $this->m_datadsn->get_number_of_faculty_staff_phd_fulltime()->num_rows();
		$data['staff_phd_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_dosen_part()->num_rows();
		$data['staff_phd_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_phd_tamu_part()->num_rows();

		$data['staff_dosen_full'] = $this->m_datadsn->get_number_of_faculty_staff_fulltime()->num_rows();
		$data['staff_dosen_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_dosen()->num_rows();
		$data['staff_tamu_part'] = $this->m_datadsn->get_number_of_faculty_staff_parttime_tamu()->num_rows();

		// INDIKATOR STUDENT - UNDERGRADUATE
		$data['undergraduate_international_students'] = $this->m_datamhs->get_number_of_undergraduate_international_students()->num_rows();
		$data['undergraduate_students'] = $this->m_datamhs->get_number_of_undergraduate_students()->num_rows();
		$data['undergraduate_inbound_students'] = $this->m_datamhs->get_number_of_undergraduate_inbound_students()->num_rows();
		$data['undergraduate_outbound_students'] = $this->m_datamhs->get_number_of_undergraduate_outbound_students()->num_rows();
		$data['undergraduate_firstyear_student'] = $this->m_datamhs->get_number_of_undergraduate_first_year()->num_rows();

		// INDIKATOR STUDENT - GRADUATE/POSTGRADUATE
		$data['grapost_international_students'] = $this->m_datamhs->get_number_of_grapost_international_students()->num_rows();
		$data['grapost_students'] = $this->m_datamhs->get_number_of_grapost_students()->num_rows();
		$data['grapost_inbound_students'] = $this->m_datamhs->get_number_of_grapost_inbound_students()->num_rows();
		$data['grapost_outbound_students'] = $this->m_datamhs->get_number_of_grapost_outbound_students()->num_rows();

		// INDIKATOR STUDENT - OVERALL
		$data['overall_students'] = $this->m_datamhs->get_number_of_overall_students()->num_rows();
		$data['female'] = $this->m_datamhs->get_number_of_female_students()->num_rows();
		$data['overall_international'] = $this->m_datamhs->get_number_of_international_students()->num_rows();
		$data['male'] = $this->m_datamhs->get_number_of_male_students()->num_rows();
		$data['inbound'] = $this->m_datamhs->get_number_of_inbound_students()->num_rows();
		$data['outbound'] = $this->m_datamhs->get_number_of_outbound_students()->num_rows();
		$this->load->view('isiqsaurp3i', $data);
	}
}
