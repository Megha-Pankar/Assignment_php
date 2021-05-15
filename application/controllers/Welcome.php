<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('email')) {
			return redirect('DashboardController');
		}
	}
	public function index()
	{
		$data['title'] = 'Login Page';
		$this->load->view('login_view',$data);
	}
}
