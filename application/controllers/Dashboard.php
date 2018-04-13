<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['dosen'] = $this->m_datadsn->getdata()->num_rows();
		$data['dosen_tamu'] = $this->m_datadsn_tamu->getdata()->num_rows();
		$data['mahasiswa'] = $this->m_datamhs->getdata()->num_rows();
		$this->load->view('dashboard',$data);
	}
}