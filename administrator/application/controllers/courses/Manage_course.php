 <?php
    class Manage_course extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Manage_course_model');
            $this->load->model('Classes_model');
            //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular(lcfirst('chapter_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['records'] = $this->Manage_course_model->records();
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            $this->load_views($this->data);
        }

        function edit()
        {

            $this->data['record_info'] = $this->Manage_course_model->record_info_elearning($this->uri->segment(4));
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            $classID = $this->data['record_info']['class'];
            $chapterID = $this->data['record_info']['chapter_id'];
            $this->data['subjects'] = $this->Manage_course_model->subjects($classID);
            // echo "<pre>";
            // print_r($this->data['subjects']);
            // die();
            $this->data['chapter_id'] = $chapterID;
            $this->data['youtube_link'] = $this->Manage_course_model->youtubeLink($chapterID);
            // print_die($chapterID);
            $this->load_views($this->data, 'courses/create_course_view.php');
        }


        function update_action()
        {
            // echo '<pre>';
            // print_die($_POST);
            $this->form_validation->set_rules('class', 'class', 'required|trim');
            $this->form_validation->set_rules('chapter', 'chapter', 'trim|required');
            $this->form_validation->set_rules('choice', 'Content', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                $record_created_date = $post['record_created_date'];
                $assignment_exist = FALSE;
                $chapterID = $this->input->post('chapter_id');
                $assignment_entry_check = $this->Manage_course_model->assignment_entry_check($chapterID);
                if ($assignment_entry_check == TRUE) {
                    $assignment_exist = TRUE;
                }
                $check = $this->Manage_course_model->user_update($post, $chapterID, $assignment_exist, $record_created_date);

                if ($check == TRUE) {
                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh',
                        'send' => base_url() . 'courses/manage_course'
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function delete($chapterID)
        {
            $this->delete_elearning_chapter_entry($chapterID);
            $this->delete_lectures_entry($chapterID);
            $this->delete_teacher_logs_entry($chapterID);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function remove()
        {
            $this->db->where('slide_id', $this->uri->segment(4));
            $this->db->delete('elearning_slide');
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function delete_elearning_chapter_entry($chapterID)
        {
            $updateData = array(
                'is_del' => 1
            );
            $this->db->where('chapter_id', $chapterID);
            $this->db->update('elearning_chapter', $updateData);
        }
        function delete_lectures_entry($chapterID)
        {
            $this->db->where('chapter_id', $chapterID);
            $this->db->delete('lectures');
        }
        function delete_teacher_logs_entry($chapterID)
        {
            $this->db->where('chapter_id', $chapterID);
            $this->db->delete('teacher_logs');
        }

        function change_status()
        {
            $get = $this->db->get_where('elearning_chapter', array($this->row_id => $this->input->post('id')))->row_array();
            $this->db->where($this->row_id, $this->input->post('id'));
            if ($get['status'] == 0) {
                $check = $this->db->update('elearning_chapter', array('status' => 1));
                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                    die;
                }
            } else if ($get['status'] == 1) {
                $check = $this->db->update('elearning_chapter', array('status' => 0));
                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Inactive Successfully..</strong>...Refresh'));
                    die;
                }
            }
        }

        function delete_all()
        {

            $ids = $this->input->post('ids');
            foreach ($ids as $id) {
                $data[] = array('is_del' => 1, 'chapter_id' => $id);
            }
            $check = $this->db->update_batch('elearning_chapter', $data, 'chapter_id');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function deleted()
        {
            $this->data['number_of_records'] = $this->Manage_course_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Manage_course_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $this->pagination->initialize($config);
            $this->load_views($this->data);
        }
    }
