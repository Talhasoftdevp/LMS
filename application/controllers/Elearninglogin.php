<?php

class Elearninglogin extends CI_Controller
{
    // function __construct()
    // {
    //     // Call the Model constructor  
    //     parent::__construct();
    //     $this->load->database();
    //     $this->load->model('UserModel');
    // }
    public function index()
    {
    }

    public  function teacherLogin()
    {
        $this->load->helper('url');
        $this->load->view('teacherLogin');
    }
}
