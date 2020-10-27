<?php


class Live_session_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'live_sessions';
    }

    public function live_session_records($teacherName)
    {
        $this->db->from($this->table_name);
        $this->db->where('teacher_name', $teacherName);
        $this->db->order_by("date", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function live_session_record($record_id)
    {
        $this->db->from($this->table_name);
        $this->db->where('record_id', $record_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    function create_record($post)
    {
        // print_die($post);
        $chapter = array(
            'class' => $post['class'],
            'session_id' => $post['session_id'],
            'subject' => $post['subject'],
            'teacher_name' => $post['TeacherName'],
            'date' => $post['date'],
            'start_time' => $post['start_time'],
            'end_time' => $post['end_time'],
        );
        $this->db->insert($this->table_name, $chapter);
        $chapter_id = $this->db->insert_id();
        return  $chapter_id;
    }

    function update_record($post, $record_id)
    {
        $updateData = array(
            'class' => $post['class'],
            'session_id' => $post['session_id'],
            'subject' => $post['subject'],
            'teacher_name' => $post['TeacherName'],
            'date' => $post['date'],
            'start_time' => $post['start_time'],
            'end_time' => $post['end_time'],
        );
        $this->db->where('record_id', $record_id);
        $updated_record = $this->db->update($this->table_name, $updateData);
        return  $updated_record;
    }

    function delete_record($record_id)
    {
        $this->db->where('record_id', $record_id);
        $deleted_record = $this->db->delete($this->table_name);
        return  $deleted_record;
    }
}
