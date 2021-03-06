<?php
class create_live_session extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Create_course_model');
        $this->load->model('Classes_model');
        $this->load->model('Live_session_model');
        // $this->table_name = ltrim(__CLASS__);
        // $this->row_id = singular(lcfirst('chapter_id'));
        // $this->data['row_id'] = $this->row_id;
        $this->data['title'] = __CLASS__;
    }

    function index()
    {
        $teacherID = $this->session->userdata('user_id');
        $this->data['classes'] = $this->Classes_model->fetch_Allocated_Classes($teacherID);
        $this->load_views($this->data);
    }

    function create_action()
    {
        // print_die($_POST);
        $this->form_validation->set_rules('class', 'class', 'required');
        $this->form_validation->set_rules('session_id', 'Live Session ID', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            $check = $this->Live_session_model->create_record($post);
            if ($check == TRUE) {
                echo json_encode(array(
                    'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                    'send' => base_url() . 'live_session/manage_live_sessions'
                ));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }
}
