<?php
class mail extends MY_Controller
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
        $parent_id = $this->session->userdata('e_portal_user_id');
        $this->data['students'] = $this->Mail_model->fetch_students_by_parent_id($parent_id);
        $this->load_views($this->data);
    }
    public function reply($reciever_name, $sender_name, $subject, $sender_id, $sender_class)
    {
        $this->data['reciever_name'] = $reciever_name;
        $this->data['sender_name'] = $sender_name;
        $this->data['subject'] = $subject;
        $this->data['student_id'] = $sender_id;
        $this->data['student_class'] = $sender_class;
        $this->load_views($this->data, 'reply_mail_view');
    }
    function fetch_teachers()
    {
        $requestedData = array();
        $check = $this->Mail_model->fetch_teachers($_POST['value']);
        for ($inintial = 0; $inintial < count($check); $inintial++) {
            array_push($requestedData, $check[$inintial]['user_name']);
        }
        echo json_encode($requestedData);
    }

    function send_mail()
    {
        // $this->form_validation->set_rules('student_id', 'Student Selection', 'required');
        $this->form_validation->set_rules('subject', 'Mail Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $user_input = $this->input->post();
            $parent_id = $this->session->userdata('e_portal_user_id');
            $teacher_name = $user_input['teacher'];
            $teacher_Id = $this->Mail_model->get_teacher_id_by_name($teacher_name);
            $check = $this->Mail_model->mail_data($user_input, $teacher_Id['user_id'], $parent_id);
            if ($check == TRUE) {
                echo json_encode(array(
                    'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                    'send' =>  base_url() . 'mail/sent'
                ));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }
    function inbox()
    {
        $parent_id = $this->session->userdata('e_portal_user_id');
        $this->data['inbox'] = $this->Mail_model->get_student_inbox_data($parent_id);
        // echo "<pre>";
        // print_r($this->data['inbox']);
        // die();
        $this->load_views($this->data, 'inbox_view');
    }

    function sent()
    {
        $parent_id = $this->session->userdata('e_portal_user_id');
        $this->data['send'] = $this->Mail_model->get_student_send_data($parent_id);
        $this->load_views($this->data, 'send_view');
    }
    function update_view_status($record_id)
    {
        $this->Mail_model->update_view_status($record_id);
    }
}
