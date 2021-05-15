<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('email')) {
			return redirect('Welcome');
		}
	}
	public function index()
	{
		$data['title'] = 'Dashboard Page';
		$this->load->model('DashboardModel');
		$result = $this->DashboardModel->getUserData();
		$data['userData'] = $result;
		$departmentDD = $this->DashboardModel->getDepartmentDD();
		$data['departmentDD'] = $departmentDD;
		// echo '<pre>';
		// print_r($departmentDD);die();
		$this->load->view('dashboard_view',$data);
	}

	public function updateProfile() {
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$department = $this->input->post('department');
		$sub_department = $this->input->post('sub_department');
		echo $sub_department;
		$array = array(
			'first_name'=>$fname,
			'last_name'=>$lname,
			'department'=>$department,
			'sub_department'=>$sub_department
		);

		$this->db->where('email',$this->session->userdata('email'));
		$this->db->update('user',$array);

		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			$config['upload_path']   = './uploads/'; 
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
			$config['max_size']      = 100; 
			$config['max_width']     = 1024; 
			$config['max_height']    = 768;  
			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$array = $this->upload->data();
			$profile_picture = $array['file_name'];
			$array = array(
				'profile_picture'=>$profile_picture
			);
			$this->db->where('email',$this->session->userdata('email'));
			$this->db->update('user',$array);
		}

		// $data['title'] = 'Dashboard Page';
		// $this->load->model('DashboardModel');
		// $result = $this->DashboardModel->getUserData();
		// $data['userData'] = $result;
		// $departmentDD = $this->DashboardModel->getDepartmentDD();
		// $data['departmentDD'] = $departmentDD;
		// $data['profileUpdate'] = 'Profile updated successfully!';
		// $this->load->view('dashboard_view',$data);
		$this->session->set_flashdata('profileUpdated','Profile Information Updated!');
		return redirect('DashboardController');
		// echo '<pre>';
		// print_r($sub_department);die();

	}

	public function fetchSubDepartmentDD() {
		$department_id = $this->input->post('department_id');
		$this->load->model('DashboardModel');
		$result = $this->DashboardModel->fetchSubDepartmentDD($department_id);
		echo json_encode($result);
	}
}
