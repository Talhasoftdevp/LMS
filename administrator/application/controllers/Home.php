<?php
class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        $this->data['title'] = __CLASS__;
    }

    public function index()
    {
        //  $this->data['name']='waqar';
        //print_r($this->data);
        $teachersCount = $this->Home_model->teachersCount();
        $studentCount = $this->Home_model->studentsCount();
        $coursesUpload = $this->Home_model->coursesUpload();
        $subjectsCount = $this->Home_model->subjectsCount();
        $classesAssignedCount = $this->Home_model->classesAssignedCount();
        $subjectsAssigned = $this->Home_model->subjectsAssigned();
        $classesCount =  $this->Home_model->classesCount();
        $this->data['teachersCount'] = $teachersCount;
        $this->data['studentCount'] = $studentCount;
        $this->data['coursesUpload'] = $coursesUpload;
        $this->data['subjectsCount'] = $subjectsCount;
        $this->data['classesAssigned'] = $classesAssignedCount;
        $this->data['subjectsAssigned'] = $subjectsAssigned;
        $this->data['classesCount'] = $classesCount;
        $this->load_views($this->data);
    }
}
function createCourse()
{
    echo "TESTING";
}
