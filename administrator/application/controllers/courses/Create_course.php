 <?php
    class create_course extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Create_course_model');
            $this->load->model('Classes_model');
            $this->load->model('Teacher_logs_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular(lcfirst('chapter_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['number_of_records'] = $this->Create_course_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;
            $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
            $this->data['records'] = $this->Create_course_model->records($this->data['number_of_pages'], $page, FALSE, FALSE);
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
            $teacherID = $this->session->userdata('user_id');
            $this->data['classes'] = $this->Classes_model->fetch_Allocated_Classes($teacherID);
            $this->load_views($this->data);
        }

        // function create()
        // {
        //     $this->data['classes'] = $this->Classes_model->fetchClasses();
        //     $this->load_views($this->data);
        // }

        function create_action()
        {
            // print_die($_FILES);
            // print_die($_POST);
            $this->form_validation->set_rules('class', 'class', 'required|trim');
            $this->form_validation->set_rules('chapter', 'Chapter', 'required|trim');
            $this->form_validation->set_rules('content_type', 'Content Type', 'required');
            // if ($_POST['content_type'] == 2) {
            //     $this->form_validation->set_rules('youtube_link', 'Youtube Link', 'required');
            // }
            // if ($_POST['content_type'] != 2 && empty($_FILES['pdf']['name'])) {
            //     $this->form_validation->set_rules('pdf', 'PDF', 'required');
            // }
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $assignment_status = FALSE;
                if (!empty($_FILES)) {
                    $assignment_status = TRUE;
                }
                $post = $this->input->post();
                // print_die($post);
                $check = $this->Create_course_model->create_record($post, $assignment_status);
                //print_die($check);
                $this->Teacher_logs_model->create_record($post, $check);
                if ($check == TRUE) {

                    if (isset($_FILES['pdf']) && !empty($_FILES['pdf'])) {
                        $this->lecture_upload($check);
                    }
                    if (isset($_FILES['assignment']) && !empty($_FILES['assignment'])) {
                        $this->assignment_upload($check);
                    }
                    if (!empty($post['youtube_link'])) {
                        $insert_data = array(
                            'path' => $post['youtube_link'],
                            'inserted_on' => date('Y-m-d h:i:s'),
                            'inserted_by' => $this->session->userdata('username'),
                            'chapter_id' => $check,
                            'type' => 'URL'
                        );
                        $this->db->insert('lectures', $insert_data);
                    }

                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                        'send' => base_url() . 'courses/manage_course'
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function edit()
        {

            $this->data['record_info'] = $this->Create_course_model->record_info_elearning($this->uri->segment(4));
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            // $this->data['is_home'] = TRUE;
            //echo "<pre>";
            //print_r($this->data['record_info']);
            // $this->load_views($this->data);
            // $this->load->view('template/header_view', $this->data);
            // $this->load->view('courses/createCourse_view', $this->data);
            // $this->load->view('template/footer_view', $this->data);
            $this->load_views($this->data, 'courses/createCourse_view');
        }


        function update_action()
        {

            $this->form_validation->set_rules('presentation_id', 'User Name', 'required|trim');
            $this->form_validation->set_rules('chapter', 'chapter', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();

                $check = $this->Create_course_model->user_update('elearning_chapter', $post);

                if ($check == TRUE) {
                    if (isset($_FILES) && !empty($_FILES)) {
                        $file_data = array(
                            'name' => $post['name'],
                            'sort' => $post['sort'],
                            'slide_type' => $post['slide_type']
                        );
                        $this->multiple_upload($file_data, $post['chapter_id']);
                    }

                    if (isset($post['photo_o']) && !empty($post['photo_o'])) {
                        $number_of_url = count($post['photo_o']);
                        // Faking upload calls to $_FILE
                        for ($i = 0; $i < $number_of_url; $i++) {
                            $insert_data = array(
                                'name' => $post['name_o'][$i],
                                'path' => $post['photo_o'][$i],
                                'sort' => $post['sort_o'][$i],
                                'inserted_on' => date('Y-m-d h:i:s'),
                                'inserted_by' => $this->session->userdata('user_id'),
                                'chapter_id' => $post['chapter_id'],
                                'slide_type' => $post['slide_type_o'][$i]

                            );
                            $this->db->insert('elearning_slide', $insert_data);
                        }
                    }
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh', 'send' => 'no'));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function delete()
        {
            $this->db->where('chapter_id', $this->uri->segment(4));
            $this->db->delete($this->table_name);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function remove()
        {
            $this->db->where('slide_id', $this->uri->segment(4));
            $this->db->delete('elearning_slide');
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
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
            $this->data['number_of_records'] = $this->Create_course_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Create_course_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $this->pagination->initialize($config);
            $this->load_views($this->data);
        }

        function purge_all()
        {
            $ids = $this->input->post('ids');
            $this->db->where_in('chapter_id', $ids);
            $check = $this->db->delete('elearning_chapter');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function all()
        {
            $this->data['number_of_records'] = $this->Create_course_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Create_course_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }

        public function assignment_upload($chapter_id)
        {
            // print_r($_FILES);
            $_FILES['assignment']['name'] = uniqid() . "_" . $_FILES['assignment']['name'];
            $config['upload_path'] = './upload/elearning/chapter/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = '2000000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '';
            $config['max_height'] = '';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if (!$this->upload->do_upload('assignment')) :
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            else :
                $fileName = explode(".", $_FILES['assignment']['name']);
                $insert_file = array(
                    'assignment_name' => $fileName[0],
                    'path' => $_FILES['assignment']['name'],
                    'inserted_on' => date('Y-m-d h:i:s'),
                    'inserted_by' => $this->session->userdata('username'),
                    'chapter_id' => $chapter_id,
                    'type' => $_FILES['assignment']['type'],
                    'size' =>  $_FILES['assignment']['size']
                );
                $this->db->insert('elearning_assignment', $insert_file);
            endif;
        }


        public function lecture_upload($chapter_id)
        {
            // print_r($_FILES);
            $_FILES['pdf']['name'] = uniqid() . "_" . $_FILES['pdf']['name'];
            $config['upload_path'] = './upload/elearning/chapter/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = '2000000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '';
            $config['max_height'] = '';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);


            if (!$this->upload->do_upload('pdf')) :
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            else :
                $fileName = explode(".", $_FILES['pdf']['name']);
                $insert_file = array(
                    'path' => $_FILES['pdf']['name'],
                    'inserted_on' => date('Y-m-d h:i:s'),
                    'inserted_by' => $this->session->userdata('username'),
                    'chapter_id' => $chapter_id,
                    'type' => $_FILES['pdf']['type'],
                    'size' =>  $_FILES['pdf']['size']
                );
                $this->db->insert('lectures', $insert_file);
            endif;
        }
    }
