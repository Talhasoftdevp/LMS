<?php

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        //$this->check_login();    
    }

    public function index()
    {
        // echo $this->session->userdata('is_logged_in');
        $this->load->view('login_view');
    }

    public function in()
    {
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        $data = array(

            'user_name' => $this->input->post('user_name'),
            'password' => $this->input->post('password'),
        );
        $this->session->set_flashdata($data);
        if ($this->form_validation->run() == FALSE) {
            // echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            $this->load->view("login_view", $data);
            return;
        } else {

            $post = $this->input->post();
            $this->Login_model->user_login_db($post);
            // $this->check_login();
        }
    }

    public function out()
    {
        $this->Login_model->user_logout();
    }
}
