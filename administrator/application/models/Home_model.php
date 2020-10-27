<?php
class Home_model extends MY_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function recorde()
	{

		$this->db->from('modules');
		$this->db->where('is_del', 0);
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	function teachersCount()
	{
		$teacherCount = 0;
		$row = $this->db->query('SELECT count(user_role) AS teacherCount FROM user WHERE user_role = "Teacher"')->row();
		if ($row) {
			$teacherCount = $row->teacherCount;
		}
		return $teacherCount;
	}

	function studentsCount()
	{
		$studentCount = 0;
		$row = $this->db->query('SELECT count(user_name) AS studentCount FROM elearning_user')->row();
		if ($row) {
			$studentCount = $row->studentCount;
		}
		return $studentCount;
	}

	function coursesUpload()
	{
		$teacherName = $this->session->userdata('username');
		$coursesUpload = 0;
		$this->db->select('count(chapter_id) as CoursesUpload');
		$this->db->from('elearning_chapter');
		$this->db->where('teacherName', $teacherName);
		$query = $this->db->get();
		$row = $query->row();
		if ($row) {
			$coursesUpload = $row->CoursesUpload;
		}
		return $coursesUpload;
	}

	function subjectsCount()
	{
		$subjectsCount = 0;
		$row = $this->db->query('SELECT count(distinct subject) AS subjectsCount FROM classes')->row();
		if ($row) {
			$subjectsCount = $row->subjectsCount;
		}
		return $subjectsCount;
	}

	function classesAssignedCount()
	{
		$teacherId = $this->session->userdata('user_id');
		$classesAssigned = 0;
		$this->db->select('count(distinct class) as classesAssigned');
		$this->db->from('teacher_allocations');
		$this->db->where('teacherId', $teacherId);
		$query = $this->db->get();
		$row = $query->row();
		if ($row) {
			$classesAssigned = $row->classesAssigned;
		}
		return $classesAssigned;
	}
	function classesAssigned()
	{
		$teacherId = $this->session->userdata('user_id');
		$classesAssigned = 0;
		$this->db->select('class as classesAssigned');
		$this->db->from('teacher_allocations');
		$this->db->where('teacherId', $teacherId);
		$query = $this->db->get();
		return $query->result_array();
	}
	function subjectsAssigned()
	{
		$teacherId = $this->session->userdata('user_id');
		$subjectsAssigned = 0;
		$this->db->select('count(distinct subject) as subjectsAssigned');
		$this->db->from('teacher_allocations');
		$this->db->where('teacherId', $teacherId);
		$query = $this->db->get();
		$row = $query->row();
		if ($row) {
			$subjectsAssigned = $row->subjectsAssigned;
		}
		return $subjectsAssigned;
	}

	function classesCount()
	{
		$classesCount = 0;
		$this->db->select('count(distinct class) as classesCount');
		$this->db->from('classes');
		$query = $this->db->get();
		$row = $query->row();
		if ($row) {
			$classesCount = $row->classesCount;
		}
		return $classesCount;
	}
}
