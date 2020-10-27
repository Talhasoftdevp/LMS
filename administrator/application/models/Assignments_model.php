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
class Assignments_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'teacher_logs';
    }

    public function all_records()
    {
        $userName = $this->session->userdata('username');
        $this->db->from('elearning_chapter');
        // $this->db->where('assignment_given', 1);
        $this->db->where('teacherName', $userName);
        $this->db->order_by('chapter_id', 'desc');
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
            $columnName = 'class';
        } else {
            $columnName = "date(inserted_on)";
        }

        if ($count_all_records == TRUE) {
            $this->db->from('elearning_chapter');
            $this->db->where($columnName, $userInputString);
            return $this->db->count_all_results();
        } else {
            $sql = "SELECT * FROM elearning_chapter WHERE $columnName LIKE '%$userInputString%' AND assignment_given=1 LIMIT $numberOfRecordsToShow OFFSET $from";
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
    function fetch_students_ids($Id)
    {
        if (!empty($Id)) {
            $student_ids = array();
            foreach ($Id as $studentID) {
                array_push($student_ids, $studentID['student_id']);
            }
            $this->db->from('submitted_assignments');
            $this->db->where_in('student_id', $student_ids);
            $this->db->group_by('student_id');
            $query = $this->db->get();
            $query->result_array();
            return $query;
        }
    }
    function get_students_name_submitted_assignment($class, $chapter_id)
    {
        $this->db->from('submitted_assignments');
        $this->db->where('class', $class);
        $this->db->where('chapter_id',  $chapter_id);
        $this->db->group_by('student_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    function fetch_students($chapterID)
    {
        $this->db->from('submitted_assignments');
        $this->db->where('chapter_id', $chapterID);
        $this->db->group_by('student_id');
        $this->db->order_by("inserted_on", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function getFile($chapter_id, $student_id, $class)
    {
        $this->db->from('submitted_assignments');
        $this->db->where('class', $class);
        $this->db->where('chapter_id', $chapter_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    function getFilePath($chapter_id, $student_id, $class)
    {
        $this->db->select('path');
        $this->db->from('submitted_assignments');
        $this->db->where('class', $class);
        $this->db->where('chapter_id', $chapter_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
