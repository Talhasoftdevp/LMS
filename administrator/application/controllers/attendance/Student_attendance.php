<?php
class student_attendance extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Attendance_model');
        // $this->output->set_header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
        // header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
        // $this->load->model('Elearning_model');
        // $this->load->model(__CLASS__ . '_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }
    public function index()
    {

        // $this->check_elearning_login();
        // $userID = $this->session->userdata('e_portal_user_id');
        // $this->data['records'] = $this->Lectures_model->fetchStudentsByUserID($userID);
        // // print_r($this->data['records']);
        // // die();
        $input_post = $this->input->post();
        $class = $input_post['class'];
        $month = $input_post['month_selection'];
        $year = $input_post['year_selection'];
        $this->data['classes'] = $this->Attendance_model->fetch_classes();
        $this->data['records'] = $this->Attendance_model->fetch_records($class, $month, $year);
        // print_die($this->data['records']);
        // if (!empty($input_post)) {
        //     $this->data['records'] = $this->Attendance_model->fetch_records($class, $month, $year);
        // }
        $this->load_views($this->data);
    }

    function print_attendance()
    {
        $input_post = $this->input->post();
        $class = $input_post['class'];
        $month = $input_post['month_selection'];
        $year = $input_post['year_selection'];
        $this->data['records'] = $this->Attendance_model->fetch_records($class, $month, $year);
        // print_die($this->data['records']);
        echo "<pre>";
        print_r($input_post);
        // print_r($class);
        // print_r($month);
        // print_r($year);
    }
}
