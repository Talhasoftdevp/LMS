<?php
class Attendance_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->table_name = lcfirst(singular(rtrim(__CLASS__, '_model')));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
    }
    public function fetch_classes()
    {
        $this->db->select('class');
        $this->db->from('classes');
        $this->db->group_by('class');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function fetch_records($class, $month, $year)
    {
        // $this->db->select('name');
        // $this->db->from('students');
        // $this->db->where('class', $class);
        // $query = $this->db->get();
        // $data = $query->result_array();
        // return $data;
        $sql = "SELECT 
                    std.student_id,
                    std.name AS student_name,
                    std.class,
                    MONTHNAME(STR_TO_DATE(MONTH(DATE(chap.inserted_on)), '%m')) AS month,
                    YEAR(DATE(chap.inserted_on)) AS year,
                    COUNT(chap.chapter_id) AS total_lectures,
                    COUNT(std_log.id) AS viewed_lectures,
                    CONCAT(ROUND((COUNT(std_log.id) / COUNT(chap.chapter_id)) * 100), '%') AS percentage
                FROM 
                    students AS std 
                        LEFT JOIN
                    elearning_chapter AS chap ON chap.class = std.class
                        LEFT JOIN
                    student_logs AS std_log ON std_log.class = chap.class AND std_log.student_id = std.student_id AND std_log.chapter_id = chap.chapter_id
                WHERE
                    std.class = '$class'
                    AND MONTH(DATE(chap.inserted_on)) = '$month'
                    AND YEAR(DATE(chap.inserted_on)) = '$year'
                GROUP BY
                    std.name;";

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}
