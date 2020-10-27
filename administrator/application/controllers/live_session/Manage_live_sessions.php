<?php
class manage_live_sessions extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Manage_course_model');
        $this->load->model('Classes_model');
        $this->load->model('Live_session_model');
        // $this->table_name = ltrim(__CLASS__);
        // $this->row_id = singular(lcfirst('chapter_id'));
        // $this->data['row_id'] = $this->row_id;
        $this->data['title'] = __CLASS__;
    }

    function index()
    {
        $teacherName = $this->session->userdata('username');
        $this->data['records'] = $this->Live_session_model->live_session_records($teacherName);
        // print_die($this->data['records']);
        $this->load_views($this->data);
    }

    function edit()
    {

        $teacherID = $this->session->userdata('user_id');
        $this->data['classes'] = $this->Classes_model->fetch_Allocated_Classes($teacherID);
        $this->data['record_info'] = $this->Live_session_model->live_session_record($this->uri->segment(4));
        $classID = $this->data['record_info']['class'];
        $this->data['subjects'] = $this->Manage_course_model->subjects($classID);
        // print_die($this->data['subjects']);
        $this->load_views($this->data, 'live_session/create_live_session_view.php');
    }

    function update_action()
    {
        $this->form_validation->set_rules('class', 'class', 'required');
        $this->form_validation->set_rules('session_id', 'Live Session ID', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            $record_id = $this->uri->segment(4);
            $check = $this->Live_session_model->update_record($post, $record_id);
            if ($check == TRUE) {
                echo json_encode(array(
                    'success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh',
                    'send' => base_url() . 'live_session/manage_live_sessions'
                ));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }

    function delete($record_id)
    {
        $check = $this->Live_session_model->delete_record($record_id);
        if ($check == TRUE) {
            echo json_encode(array(
                'success' => 'yes', 'msg' => '<strong>Successfully deleted..</strong>..Refresh',
                'send' => base_url() . 'live_session/manage_live_sessions'
            ));
        } else {
            echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
        }
    }
}
