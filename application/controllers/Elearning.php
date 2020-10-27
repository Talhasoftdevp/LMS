<?php
class Elearning extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(__CLASS__ . '_model');
		$this->table_name = humanize(lcfirst(__CLASS__));
		$this->row_id = singular(lcfirst(__CLASS__ . '_id'));
		$this->data['title'] = __CLASS__;
		$this->load->helper('url');
	}


	public function index()
	{
		//  $this->data['name']='waqar';
		$this->load_views($this->data);
	}

	public function in()
	{
		$post = $this->input->post();
		$this->Elearning_model->user_login_db($post);
		// $this->check_login();
	}

	public function out()
	{
		$this->Elearning_model->user_logout();
	}
	public function dashBoard()
	{
		// echo "HELLO";
		$this->load->view("teacher_dashboard");
	}
}
