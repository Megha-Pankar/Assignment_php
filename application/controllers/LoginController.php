<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	public function index()
	{
		echo 'hello';
	}

    public function validateEmail() {
        $email = $this->input->post('email');
        $this->load->model('LoginModel');
        $result = $this->LoginModel->validateEmail($email);
        // echo '<pre>';
        // print_r($result);die();
        if(isset($result['emailExist']) && $result['emailExist'] == true) {
            $data['title'] = 'Login Page';
            $data['email_address'] = $result['email_address'];
            $this->load->view('Login_view2.php',$data);
        }else {
            $data['title'] = 'Login Page';
            $data['error'] = $result;
            $this->load->view('login_view',$data);
        }
        
    }

    public function validatePassword() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model('LoginModel');
        $result = $this->LoginModel->validatePassword($email,$password);
        // echo '<pre>';
        // print_r($email);die();
        if($result == 'Correct Password') {
            $this->session->set_userdata(['email'=>$email]);
            return redirect('DashboardController');
        }else {
            $data['error'] = $result;
            $data['email_address'] = $email;
            $this->load->view('login_view2',$data);
        }
    }

    public function logout() {
        $this->session->unset_userdata('email');
        return redirect('Welcome');
    }
}
