<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');

	}

	public function index()
	{
		if($this->session->userdata('status') == "login"){
			redirect(base_url("dashboard"));
		}
		$this->load->view('login');
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("akun",$where);
		// $cek = $this->m_login->cek_login("akun",$where)->result();
		if($cek->num_rows() > 0){
 			foreach($cek->result() as $data){

			$data_session = array(
				'username' => $username,
				'status' => "login",
				'role' => $data->role
				);
 			}
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("dashboard"));
 
		}else{
			echo "Username dan password salah !";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
