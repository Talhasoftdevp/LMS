<?php
class assignments_logs extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Home_model');
        $this->load->model('Assignments_model');
        // $this->load->model(__CLASS__ . '_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }
    public function index()
    {
        // print_r($this->session->userdata('user_id'));
        $input_post = $this->input->post();
        if (!empty($input_post)) {
            $searchBy = $input_post['search_by'];
            $userInputString = $input_post['userInputString'];
            $this->data['number_of_records'] = $this->Assignments_model->filtered_records(15, $this->uri->segment(4), TRUE, $userInputString, $searchBy);
        } else {
            $this->data['number_of_records'] = $this->Assignments_model->all_records(15, $this->uri->segment(4), TRUE);
        }
        $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
        $config['total_rows'] = $this->data['number_of_records'];
        $config['per_page'] = 15;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;
        $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        if (!empty($input_post)) {
            $this->data['records'] =  $this->Assignments_model->filtered_records(15, $page, FALSE, $userInputString, $searchBy);
        } else {
            $this->data['records'] =  $this->Assignments_model->all_records(15, $page, FALSE);
        }
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $this->pagination->initialize($config);
        if ($input_post == '') {
            $this->data['records'] =  $this->Assignments_model->all_records(15, $page, FALSE);
        }
        // echo '<pre>';
        // print_r($this->data['records']);
        $this->load_views($this->data);
    }
    function submitted_assignments($chapterName, $Class, $subject, $chapterID)
    {
        $this->data['class'] = $Class;
        $this->data['subject'] = $subject;
        $this->data['chapter_id'] = $chapterID;
        $this->data['chapter_name'] = $chapterName;
        $this->data['students_data'] = $this->Assignments_model->fetch_students($Class);
        $this->load_views($this->data, 'assignments/submitted_assignments_view');
    }
    function download_assignment($chapter_id, $student_id, $class)
    {
        $files = array();
        $this->load->library('zip');
        $file_data = $this->Assignments_model->getFile($chapter_id, $student_id, $class);

        if (!empty($file_data)) {
            $zipname = $file_data[0]['student_name'] . '.zip';
            for ($i = 0; $i < count($file_data); $i++) {
                $files[$i] = base_url() . "/upload/submittedAssignments/" . $file_data[$i]['path'];
            }

            $this->zip->add_data("TESTING", $files);
            $file_path = base_url() . "/TEST/" . $zipname;
            $this->zip->archive($file_path);
            // echo '<pre>';
            // print_r($files);
            // die();
            // $zip->close();
            // echo '<pre>';
            // print_r($zip);
            // die();
            // ob_clean();
            // ob_end_flush();
            // if (file_exists($zipname)) {
            //     header('Content-Type: application/zip');
            //     header('Content-disposition: attachment; filename=' . $zipname);
            //     // // header('Content-Length: ' . filesize($zipname));
            //     echo 'Downlaoded.....!!!';
            //     readfile($zipname);
            // } else {
            //     echo 'ERROR.....!!!';
            // }
            // unlink($zipname);
            // exit();
        }
    }
}
