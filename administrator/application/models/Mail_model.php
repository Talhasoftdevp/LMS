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
        $this->db->order_by("name", 'asc');
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
                    AND std.student_id = '$student_id';";
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
    function mail_data($user_input, $teacher_name)
    {
        $mail_data = array(
            'parent_id' => $user_input['parent_id'],
            'sender_name' => $teacher_name,
            'sender_role' => $user_input['sender_role'],
            'sender_id' => $user_input['sender_id'],
            'sender_class' => $user_input['student_class'],
            'subject' => $user_input['subject'],
            'message' => $user_input['message'],
            'reciever_name' => $user_input['student_name'],
            'reciever_role' => $user_input['reciever_role'],
            'reciever_id' => $user_input['student_id'],
            'reciever_class' => $user_input['student_class'],
            'inserted_on' => date('Y-m-d h:i:s'),
            'seen_status' => 0
        );
        $this->db->insert('mail', $mail_data);
        $mail_id = $this->db->insert_id();
        return  $mail_id;
    }

    function get_teacher_inbox_data($teacher_id)
    {
        // pre_r($user_id);
        $this->db->from('mail');
        $this->db->where("reciever_id", $teacher_id);
        $this->db->where("reciever_role", 'Teacher');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_teacher_send_data($teacher_id)
    {
        // pre_r($parent_id);
        $this->db->from('mail');
        $this->db->where("sender_id", $teacher_id);
        $this->db->where("sender_role", 'Teacher');
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
}
