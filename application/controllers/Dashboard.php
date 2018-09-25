<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('m_datamhs');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		// FEB FIF FIK FIT FKB FRI FTE
		$data['feb'] = $this->m_datamhs->f_feb();
		$data['fif'] = $this->m_datamhs->f_fif();
		$data['fik'] = $this->m_datamhs->f_fik();
		$data['fit'] = $this->m_datamhs->f_fit();
		$data['fkb'] = $this->m_datamhs->f_fkb();
		$data['fri'] = $this->m_datamhs->f_fri();
		$data['fte'] = $this->m_datamhs->f_fte();
		$this->load->view('dashboard',$data);
	}

	// function all_prodi_mhs(){
 //        $data=$this->m_datamhs->prodi_all_total();
 //        echo json_encode($data);
 //    }
}