<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
<?php
class lectures extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Lectures_model');
        $this->load->model('Elearning_model');
        // $this->load->model(__CLASS__ . '_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }

    public function index()
    {

        $this->check_elearning_login();
        $userID = $this->session->userdata('e_portal_user_id');
        $this->data['records'] = $this->Lectures_model->fetchStudentsByUserID($userID);
        $this->load_views($this->data);
    }
    public function lecturesClassWise($class, $student_id, $student_name)
    {
        $this->data['class'] = $class;
        $this->data['student_name'] = urldecode($student_name);
        $this->data['student_id'] = $student_id;
        $this->data['records'] = $this->Lectures_model->getLecturesClassWise($class, $this->data['student_name']);
        $this->load_views($this->data, "lectures_class_wise");
    }


    public function start_lecture($chapter_id, $student_id, $class, $subject)
    {
        $this->check_elearning_login();
        $student_name = $this->Lectures_model->get_student_name_by_id($student_id);
        $view_status_check = $this->Lectures_model->student_log_entry_check($chapter_id, $student_id, $class, $subject);
        if ($view_status_check == FALSE) {
            $this->Lectures_model->student_log_entry($chapter_id, $student_id, $class, $subject);
        }
        $this->data['lectureDetails'] = $this->Lectures_model->getLecturesChapterWise($chapter_id);
        $this->data['lectureContent'] = $this->Lectures_model->getLectures($chapter_id);
        $this->data['searchVal'] = 'watch?v=';
        $this->data['replaceVal'] = 'embed/';
        $this->data['student_id'] = $student_id;
        $message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Viewed" . "   " . "Topic" . " " . $this->data['lectureDetails']['lectureName'];
        $this->Lectures_model->student_activity_tracking($message, $chapter_id);
        $this->load->view('lecture_preview', $this->data);
    }

    public function download_assignment($chapter_id, $student_id, $class)
    {
        $student_name = $this->Lectures_model->get_student_name_by_id($student_id);
        $chapter_name = $this->Lectures_model->get_chapter_name_by_id($chapter_id);
        $message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Downloaded Assignment Of" . "   " . "Topic" . " " . $chapter_name;
        $this->Lectures_model->student_activity_tracking($message, $chapter_id);
        $file_data = $this->Lectures_model->getFile($chapter_id);
        if (!empty($file_data)) {
            $file_name = $file_data[0]['assignment_name'];
            $file_path = base_url() . "administrator/upload/elearning/chapter/" . $file_data[0]['path'];
            $getExtension = explode("/", $file_data[0]['type']);
            $file_type = $getExtension[1];
            //header("Content-Length: " . filesize($file_path));
            header("Content-Disposition: attachment; filename=" . $file_name);
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: inline; filename=' . $file_name . '.' . $file_type);
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
        } else {
            //$noAssignment = TRUE;
            echo "<script type=\"text/javascript\">alert('No Assignment Uplaoded');</script>";
            // redirect("lectures/lecturesClassWise/" . $class . "/" . $student_id . "/" . $noAssignment);
        }
    }
    public function upload_assignment($student_id, $class, $student_name, $chapter_id)
    {
        $student_name = $this->Lectures_model->get_student_name_by_id($student_id);
        $chapter_name = $this->Lectures_model->get_chapter_name_by_id($chapter_id);
        $message = urldecode(ucwords(strtolower($student_name), ' ')) . "   " . "Of" . " " . "Class" . " " . $class . " " . "Uploaded Assignment Of" . "   " . "Topic" . " " . $chapter_name;
        $this->Lectures_model->student_activity_tracking($message, $chapter_id);
        $number_of_files_uploaded = count($_FILES['uploadAssignment']['name']);
        for ($i = 0; $i < $number_of_files_uploaded; $i++) :
            $_FILES['userfile']['name']     = uniqid() . '_' . $_FILES['uploadAssignment']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['uploadAssignment']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['uploadAssignment']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['uploadAssignment']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['uploadAssignment']['size'][$i];
            $config['upload_path'] = './upload/submittedAssignments/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['max_size'] = '2000000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '';
            $config['max_height'] = '';
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) :
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            else :
                $insert_file = array(
                    'student_id' => $student_id,
                    'class' => $class,
                    'chapter_id' => $chapter_id,
                    'student_name' => urldecode($student_name),
                    'path' => $_FILES['userfile']['name'],
                    'type' => $_FILES['userfile']['type'],
                    'inserted_on' => date('Y-m-d h:i:s'),
                );
                $this->db->insert('submitted_assignments', $insert_file);
            endif;
        endfor;
    }
}
