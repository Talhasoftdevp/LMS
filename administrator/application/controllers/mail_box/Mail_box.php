<?php
class mail_box extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mail_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }

    public function index()
    {
        redirect(base_url() . 'mail_box/mail_box/inbox');
    }

    public function compose($parent_id, $student_id, $student_name, $student_class, $subject)
    {
        $this->data['parent_id'] = $parent_id;
        $this->data['student_id'] = $student_id;
        $this->data['student_name'] = $student_name;
        $this->data['student_class'] = $student_class;
        $this->data['subject'] = urldecode($subject);
        $this->load_views($this->data);
    }


    function fetch_teachers()
    {
        $requestedData = array();
        $check = $this->Mail_model->fetch_teachers($_POST['value']);
        // print_r($check);
        for ($inintial = 0; $inintial < count($check); $inintial++) {
            array_push($requestedData, $check[$inintial]['user_name']);
        }
        echo json_encode($requestedData);
    }

    public function send_mail()
    {
        // $this->form_validation->set_rules('student_id', 'Student Selection', 'required');
        $this->form_validation->set_rules('subject', 'Mail Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $user_input = $this->input->post();
            // print_die($user_input);
            $teacher_name = $this->session->userdata('username');
            $check = $this->Mail_model->mail_data($user_input, $teacher_name);
            if ($check == TRUE) {
                echo json_encode(array(
                    'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                    'send' =>  base_url() . 'mail_box/mail_box/sent'
                ));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }
    function inbox()
    {
        $teacher_id = $this->session->userdata('user_id');
        $this->data['inbox'] = $this->Mail_model->get_teacher_inbox_data($teacher_id);
        // print_die($this->data['inbox']);
        $this->load_views($this->data, 'mail_box/inbox_view');
    }

    function sent()
    {
        $teacher_id = $this->session->userdata('user_id');
        $this->data['send'] = $this->Mail_model->get_teacher_send_data($teacher_id);
        $this->load_views($this->data, 'mail_box/send_view');
    }
    function update_view_status($record_id)
    {
        $this->Mail_model->update_view_status($record_id);
    }
}
