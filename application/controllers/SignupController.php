<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignupController extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('email')) {
			return redirect('Dashboard');
		}
	}

	public function index()
	{
		$data['title'] = 'Sign Up Page';
        $this->load->view('signup_view',$data);
	}

    public function validateData() {
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $pwd = $this->input->post('pwd');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('signup_view');
        }else {
            $hashPwd = password_hash($pwd,PASSWORD_DEFAULT);
            $array = array(
                'first_name'=>$fname,
                'last_name'=>$lname,
                'email'=>$email,
                'profile_picture'=>'',
                'password'=>$hashPwd
            );
            $this->db->insert('user',$array);
            $this->session->set_userdata(['email'=>$email]);
            return redirect('DashboardController');
        }
    }
}
