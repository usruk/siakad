<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
	parent::__construct();
		// session_start();
		$this->load->model('M_login');
	}

	public function index(){
		$this->load->library('session');
		$cek = $this->session->userdata('username');
		if(empty($cek)) {
			$this->load->view('login_v');
		}else{
			$st = $this->session->userdata('status');
			if ($st == 'admin')
					header("location:".base_url().'admin/home');
			else if($st == 'dekan')
					header("location:".base_url().'dekan/home');
			else if($st == 'dosen')
					header("location:".base_url().'dosen/home');
			else if($st == 'mhs')
					header("location:".base_url().'mahasiswa/home');
			else
				header('location:'.base_url());
		}
	}
}
