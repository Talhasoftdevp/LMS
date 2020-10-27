 <?php

    /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    /**
     * Description of manage_rols
     *
     * @author HP
     */
    class Elearning_chapter extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Elearning_chapter_model');
            $this->load->model('Classes_model');
            //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular(lcfirst('chapter_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['number_of_records'] = $this->Elearning_chapter_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;
            $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
            $this->data['records'] = $this->Elearning_chapter_model->records($this->data['number_of_pages'], $page, FALSE, FALSE);
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
            //$this->data['roles_recorde'] = $this->Manage_roles_model->active_records();
            $this->load_views($this->data);
        }

        function create()
        {
            $this->data['presentations'] = $this->Classes_model->get_active_records();
            $this->load_views($this->data);
        }

        function create_action()
        {
            $this->form_validation->set_rules('presentation_id', 'Presentation', 'required|trim');
            $this->form_validation->set_rules('chapter', 'Chapter', 'required|trim');
            //$this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                //print_r($post);
                $check = $this->Elearning_chapter_model->create_record($post);

                if ($check == TRUE) {
                    $file_data = array(
                        'name' => $post['name'],
                        'sort' => $post['sort'],
                        'slide_type' => $post['slide_type']
                    );

                    if (isset($_FILES) && !empty($_FILES)) {
                        $this->multiple_upload($file_data, $check);
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
                                'chapter_id' => $check,
                                'slide_type' => $post['slide_type_o'][$i]

                            );
                            $this->db->insert('elearning_slide', $insert_data);
                        }
                    }

                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                        'send' => base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/edit/' . $check
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function edit()
        {

            $this->data['record_info'] = $this->Elearning_chapter_model->record_info_elearning($this->uri->segment(4));
            $this->data['presentations'] = $this->Classes_model->get_active_records();
            //echo "<pre>";
            //print_r($this->data['record_info']);
            $this->load_views($this->data);
        }


        function update_action()
        {
            $this->form_validation->set_rules('presentation_id', 'User Name', 'required|trim');
            $this->form_validation->set_rules('chapter', 'chapter', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();

                $check = $this->Elearning_chapter_model->user_update('elearning_chapter', $post);

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
            $this->data['number_of_records'] = $this->Elearning_chapter_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Elearning_chapter_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
            $this->data['number_of_records'] = $this->Elearning_chapter_model->records('elearning_chapter', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Elearning_chapter_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }

        public function file_upload()
        {
            $files = $_FILES;
            $count = count($_FILES['photo']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['photo']['name'] = time() . $files['photo']['name'][$i];
                $_FILES['photo']['type'] = $files['photo']['type'][$i];
                $_FILES['photo']['tmp_name'] = $files['photo']['tmp_name'][$i];
                $_FILES['photo']['error'] = $files['photo']['error'][$i];
                $_FILES['photo']['size'] = $files['photo']['size'][$i];
                $config['upload_path'] = './upload/elearning/chapter/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2000000';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = '';
                $config['max_height'] = '';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload();
                $fileName = $_FILES['photo']['name'];
                $images[] = $fileName;
            }/*
                  $fileName = implode(',',$images);
                  $this->welcome->upload_image($this->input->post(),$fileName);
                  redirect('welcome/view');*/
        }



        public function multiple_upload($file_data, $chapter_id = 0)
        {
            $this->load->library('upload');
            $number_of_files_uploaded = count($_FILES['photo']['name']);
            // Faking upload calls to $_FILE
            for ($i = 0; $i < $number_of_files_uploaded; $i++) :
                $_FILES['userfile']['name']     = uniqid() . $_FILES['photo']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['photo']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['photo']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['photo']['size'][$i];
                $config['upload_path'] = './upload/elearning/chapter/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
                $config['max_size'] = '2000000';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = '';
                $config['max_height'] = '';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) :
                    $error = array('error' => $this->upload->display_errors());
                //$this->load->view('upload_form', $error);
                else :
                    $insert_file = array(
                        'name' => $file_data['name'][$i],
                        'path' => $_FILES['userfile']['name'],
                        'sort' => $file_data['sort'][$i],
                        'inserted_on' => date('Y-m-d h:i:s'),
                        'inserted_by' => $this->session->userdata('user_id'),
                        'chapter_id' => $chapter_id,
                        'slide_type' => $file_data['slide_type'][$i]

                    );
                    $this->db->insert('elearning_slide', $insert_file);
                //$final_files_data[] = $this->upload->data();
                //$fileName = $_FILES['userfile']['name'];
                //$images[] = $fileName;
                // Continue processing the uploaded data
                endif;
            endfor;

            /*if(!empty($images)){
		$fileName = implode(',',$images);
		$this->welcome->upload_image($this->input->post(),$fileName);
        
	}*/
        }
    }
