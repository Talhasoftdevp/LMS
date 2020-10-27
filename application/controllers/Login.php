<?php

class Login extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
		$this->data['title'] = '';
        //$this->check_login();
    
    }

    public function index() {
           // echo $this->session->userdata('is_logged_in');
        //$this->load->view('login_view');
		$this->load_views($this->data);
    }

    public function in() {
        $post = $this->input->post();	
		$this->Login_model->user_login_db($post);
       // $this->check_login();
    }

    public function out() {
        $this->Login_model->user_logout();
    }
	
	public function sign_up(){
		$this->session->set_flashdata('msg','<strong>Invalid Username/Password.</strong>');	
	}

}
