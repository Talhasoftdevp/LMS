<?php
class Lectures_model extends MY_Model
{

	function __construct()
	{
		parent::__construct();
	}

	// public function recorde()
	// {

	// 	$this->db->from('modules');
	// 	$this->db->where('is_del', 0);
	// 	$this->db->where('status', 1);
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	function getLecturesClassWise($class, $student_name)
	{
		$message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Browsed" . "   " . "Lectures";
		$this->student_activity_tracking($message);
		$this->db->select('chapter_id,subject,name,teacherName,inserted_on,assignment_given');
		$this->db->from('elearning_chapter');
		$this->db->where('class', $class);
		$this->db->order_by("inserted_on", "desc");
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	function getLecturesChapterWise($chapter_id)
	{
		$this->db->select('name,subject');
		$this->db->from('elearning_chapter');
		$this->db->where('chapter_id', $chapter_id);
		$row = $this->db->get()->row();
		if ($row) {
			$lectureName = $row->name;
			$subject = $row->subject;
		}
		$data = array(
			'lectureName' => $lectureName,
			'subject' => $subject
		);
		return $data;
	}

	function fetchStudentsByUserID($userID)
	{
		$this->parent_activity_tracking($userID);
		$this->db->select('student_id,name,class');
		$this->db->from('students');
		$this->db->where('parent_id', $userID);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}
	function student_log_entry_check($chapter_id, $student_id, $class, $subject)
	{
		$this->db->select('view_status');
		$this->db->from('student_logs');
		$this->db->where('student_id', $student_id);
		$this->db->where('chapter_id', $chapter_id);
		$this->db->where('class', $class);
		$this->db->where('subject', $subject);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	function get_student_name_by_id($student_id)
	{
		$this->db->select('name');
		$this->db->from('students');
		$this->db->where('student_id', $student_id);
		$query = $this->db->get()->row()->name;
		return $query;
	}
	function get_chapter_name_by_id($chapter_id)
	{
		$this->db->select('name');
		$this->db->from('elearning_chapter');
		$this->db->where('chapter_id', $chapter_id);
		$query = $this->db->get()->row()->name;
		return $query;
	}

	function student_log_entry($chapter_id, $student_id, $class, $subject)
	{
		$student_log_data = array(
			'student_id' => $student_id,
			'chapter_id' => $chapter_id,
			'class' => $class,
			'subject' => urldecode($subject),
			'view_status' => 1
		);
		$this->db->insert('student_logs', $student_log_data);
	}
	public function getSlides($chapter_id)
	{
		// print_r($chapter_id);
		$this->db->from('elearning_slide');
		$this->db->where('chapter_id', $chapter_id);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	public function getLectures($chapter_id)
	{
		// print_r($chapter_id);
		$this->db->from('lectures');
		$this->db->where('chapter_id', $chapter_id);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	public function getFile($chapter_id)
	{
		$this->db->from('elearning_assignment');
		$this->db->where('chapter_id', $chapter_id);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}
	function student_activity_tracking($message, $record_id = 0)
	{
		date_default_timezone_set("Asia/Karachi");
		$logout_info['table_record_id'] = $record_id;
		$logout_info['table_name'] = 'elearning_chapter';
		$logout_info['user_id'] =  $this->session->userdata('e_portal_user_id');
		$logout_info['user_name'] = $this->session->userdata('e_portal_user_name');
		$logout_info['family_code'] = $this->session->userdata('e_portal_user_email');
		$logout_info['user_type'] = 'Parent';
		$logout_info['flag'] = 'VIEW';
		$logout_info['message'] = $message;
		$logout_info['timestamp'] = date('Y-m-d h:i:s');
		$this->db->insert('user_activity', $logout_info);
	}
	function parent_activity_tracking($parent_id)
	{
		date_default_timezone_set("Asia/Karachi");
		$logout_info['table_record_id'] = $parent_id;
		$logout_info['table_name'] = 'students';
		$logout_info['user_id'] =  $parent_id;
		$logout_info['user_name'] = $this->session->userdata('e_portal_user_name');
		$logout_info['family_code'] = $this->session->userdata('e_portal_user_email');
		$logout_info['user_type'] = 'Parent';
		$logout_info['flag'] = 'VIEW';
		$logout_info['message'] = 'Viewed Children';
		$logout_info['timestamp'] = date('Y-m-d h:i:s');
		$this->db->insert('user_activity', $logout_info);
	}
}
