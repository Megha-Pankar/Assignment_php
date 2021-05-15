<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('email')) {
			return redirect('Welcome');
		}
	}
}