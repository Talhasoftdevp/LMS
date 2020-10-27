<?php
class Mail_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->table_name = lcfirst(singular(rtrim(__CLASS__, '_model')));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
    }
    public function fetch_students_by_parent_id($parent_id)
    {
        $this->db->from('students');
        $this->db->where("parent_id", $parent_id);
        $this->db->order_by("student_id", 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetch_teachers($student_id)
    {

        $sql = "SELECT 
                teacherId,
                user_name
            FROM
                teacher_allocations AS alloc
                    left join
                students as std on std.class = alloc.class
                    LEFT JOIN
                user ON user.user_id = alloc.teacherId
            WHERE
                user.user_role = 'Teacher'
                    AND std.student_id = '$student_id'
            GROUP BY 
	            alloc.teacherId;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function get_teacher_id_by_name($teacher_name)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where("user_name", $teacher_name);
        $this->db->where("user_role", 'Teacher');
        $query = $this->db->get();
        return $query->row_array();
    }
    function mail_data($user_input, $teacher_Id, $parent_id)
    {
        if (isset($user_input['message_nature'])) {
            $student_name =  $user_input['student_name_'];
            $class = $user_input['student_class_'];
            $message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Replied To The Message Of Teacher" . "   " . $user_input['teacher'];
        } else {
            $student_name =  $user_input['student_name'];
            $class = $user_input['student_class'];
            $message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Sent Message To Teacher" . "   " . $user_input['teacher'];
        }
        $mail_data = array(
            'parent_id' => $parent_id,
            'sender_name' => $student_name,
            'sender_role' => $user_input['sender_role'],
            'sender_id' => $user_input['student_id'],
            'sender_class' =>  $class,
            'subject' => $user_input['subject'],
            'message' => $user_input['message'],
            'reciever_name' => $user_input['teacher'],
            'reciever_role' => $user_input['reciever_role'],
            'reciever_id' => $teacher_Id,
            'reciever_class' =>  $class,
            'inserted_on' => date('Y-m-d h:i:s'),
            'seen_status' => 0
        );
        $this->db->insert('mail', $mail_data);
        $mail_id = $this->db->insert_id();
        $this->student_activity_tracking($message, $mail_id);
        return  $mail_id;
    }

    function get_student_inbox_data($parent_id)
    {
        // pre_r($parent_id);
        $this->db->from('mail');
        $this->db->where("parent_id", $parent_id);
        $this->db->where("reciever_role", 'Student');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_student_send_data($parent_id)
    {
        // pre_r($parent_id);
        $this->db->from('mail');
        $this->db->where("parent_id", $parent_id);
        $this->db->where("sender_role", 'Student');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_view_status($record_id)
    {
        $updateData = array(
            'seen_status' => 1
        );

        $this->db->where('id', $record_id);
        $this->db->update('mail', $updateData);
    }
    function student_activity_tracking($message, $record_id = 0)
    {
        date_default_timezone_set("Asia/Karachi");
        $logout_info['table_record_id'] = $record_id;
        $logout_info['table_name'] = 'mail';
        $logout_info['user_id'] =  $this->session->userdata('e_portal_user_id');
        $logout_info['user_name'] = $this->session->userdata('e_portal_user_name');
        $logout_info['family_code'] = $this->session->userdata('e_portal_user_email');
        $logout_info['user_type'] = 'Parent';
        $logout_info['flag'] = 'MAILED';
        $logout_info['message'] = $message;
        $logout_info['timestamp'] = date('Y-m-d h:i:s');
        $this->db->insert('user_activity', $logout_info);
    }
}
