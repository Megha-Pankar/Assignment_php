<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    public function getUserData()
    {
        $email = $this->session->userdata('email');
        $this->load->database();
        $this->db->select('*');
        $this->db->where('email',$email);
        $query = $this->db->get('user');
        $result = $query->result();
        return $result;
        // echo '<pre>';
        // print_r($result);die();
    }

    public function getDepartmentDD()
    {
        $this->load->database();
        $this->db->select('id,department_name');
        $query = $this->db->get('department');
        $result = $query->result();
        return $result;
    }

    public function fetchSubDepartmentDD($department_id='') {
        if($department_id == '' || $department_id == null) {
            return false;
        }
        
        
        // echo '<pre>';
        // print_r($department_id);die();
        $this->load->database();
        $this->db->select('id,department_id,sub_department_name');
        $this->db->where('department_id',$department_id);
        $query = $this->db->get('sub_department');
        $result = $query->result();
        return $result;
    }
}