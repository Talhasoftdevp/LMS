<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage_rols_model
 *
 * @author HP
 */
class Teacher_logs_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'teacher_logs';
    }

    public function all_records()
    {
        $this->db->from('teacher_logs');
        $this->db->order_by("chapter_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function filtered_records($numberOfRecordsToShow, $offset, $count_all_records, $userInputString, $searchBy)
    {
        $offset = $offset - 1;
        if ($offset < 0) {
            $offset = 0;
        }
        $from = $offset * $numberOfRecordsToShow;

        if ($searchBy == 1) {
            $columnName = 'name';
        } else if ($searchBy == 2) {
            $columnName = 'subject';
        } else if ($searchBy == 3) {
            $columnName = 'teacherName';
        } else if ($searchBy == 4) {
            $columnName = 'class';
        } else {
            $columnName = "date(inserted_on)";
        }

        if ($count_all_records == TRUE) {
            $this->db->from('teacher_logs');
            $this->db->where($columnName, $userInputString);
            return $this->db->count_all_results();
        } else {
            $sql = "SELECT * FROM teacher_logs WHERE $columnName LIKE '%$userInputString%' LIMIT $numberOfRecordsToShow OFFSET $from";
            $result = $this->db->query($sql);
            return $result->result_array();
        }
    }

    public function filtered_records_by_date($userInputString, $searchBy)
    {

        $result = $this->db->query("SELECT * FROM teacher_logs where date(inserted_on) ='" . $userInputString . "'");
        return $result->result_array();
    }

    function create_record($post, $chapter_id)
    {

        $record = array(
            'chapter_id' => $chapter_id,
            'class' => $post['class'],
            'name' => $post['chapter'],
            'subject' => $post['subject'],
            'teacherName' => $post['TeacherName'],
            'inserted_on' => date('y-m-d')
        );
        $this->db->insert($this->table_name, $record);
        // $chapter_id = $this->db->insert_id();
        // return  $chapter_id;
    }
}
