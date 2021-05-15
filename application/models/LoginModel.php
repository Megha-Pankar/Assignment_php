<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    public function validateEmail($email='') {
        if($email == '') {
            return 'E-mail field is required!';
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return 'Invalid E-mail';
        }
        $this->load->database();
        $this->db->select('email');
        $this->db->where('email',$email);
        $query = $this->db->get('user');
        $num_rows = $query->num_rows();

        if($num_rows < 1) {
            return 'E-mail not exist';
        }
        if($num_rows > 0) {
            return array('emailExist'=>true,'email_address'=>$email);
        }
    }


    public function validatePassword($email,$password) {
        if($password == '') {
            return 'Password field is required!';
        }
        if($email == '') {
            return 'Email field is required!';
        }
        
        $this->load->database();
        $this->db->select('email,password');
        $this->db->where('email',$email);
        $query = $this->db->get('user');
        $result = $query->result();
        
        $hashed_password = $result[0]->password;
        // $verify = password_verify($password,$hashed_password);
        if (password_verify($password, $hashed_password)) {
            return 'Correct Password';
        } else {
            return 'Incorrect Password!';
        }
        // echo '<pre>';
        // print_r($verify);die();
    }
}