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
    class add_teacher extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Add_teacher_model');
            $this->load->model('Classes_model');
            //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__, 'Manage_');
            $this->row_id = singular(lcfirst('user_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['number_of_records'] = $this->Add_teacher_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;
            $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
            $this->data['records'] = $this->Add_teacher_model->records($this->data['number_of_pages'], $page, FALSE, FALSE);
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
            $this->data['assignments'] = $this->Add_teacher_model->teacherAssignmentsInfo();
            $this->load_views($this->data);
            //print_r($);
        }

        function create()
        {
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            $this->load_views($this->data);
        }

        function create_action()
        {
            $teacherInfo = array();
            $teacherAllocations = array();
            $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                $teacherInfo['user_name'] = $post['user_name'];
                $teacherInfo['email'] = $post['email'];
                $teacherInfo['password'] = $post['password'];
                $teacherInfo['user_role'] = $post['user_role'];
                $teacherAllocations['class'] = $post['classes_assigned'];
                $teacherAllocations['section'] = $post['section_assigned'];
                $teacherAllocations['subject'] = $post['subject_assigned'];
                $check = $this->Add_teacher_model->createTeacher($teacherInfo, $teacherAllocations, FALSE);
                if ($check == TRUE) {
                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                        'send' => base_url() . 'app/add_teacher'
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }
        function fetchSubjects()
        {
            $requestedData = array();
            $class = $_POST['value'];
            $teacher_id = $this->session->userdata('user_id');
            $check = $this->Classes_model->fetchSubjects($class);
            for ($inintial = 0; $inintial < count($check); $inintial++) {
                array_push($requestedData, $check[$inintial]['subject']);
            }
            echo json_encode($requestedData);
        }

        function fetch_assigned_Subjects()
        {
            $requestedData = array();
            $class = $_POST['value'];
            $teacher_id = $this->session->userdata('user_id');
            $check = $this->Add_teacher_model->fetchSubjects($class, $teacher_id);
            for ($inintial = 0; $inintial < count($check); $inintial++) {
                array_push($requestedData, $check[$inintial]['subject']);
            }
            echo json_encode($requestedData);
        }

        function fetchSections()
        {
            // print_r("SECTIONS POST DATA:");
            // print_r($_POST);
            $requestedData = array();
            $check = $this->Classes_model->fetchSections($_POST['value']);
            for ($inintial = 0; $inintial < count($check); $inintial++) {
                array_push($requestedData, $check[$inintial]['section']);
            }
            echo json_encode($requestedData);
        }
        function edit()
        {
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            $this->data['record_info'] = $this->Add_teacher_model->record_info_user($this->uri->segment(4));
            $this->data['teacherInfo'] = $this->Add_teacher_model->teacherAllocations($this->uri->segment(4));
            // print_die($this->data['record_info']);
            $this->load_views($this->data);
        }
        function active()
        {
            $data = array(
                'status' => 1
            );
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->update('user', $data);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong> Recorde Update Successfully..</strong>...Refresh'));
        }

        function notActive()
        {
            $data = array(
                'status' => 0
            );
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->update('user', $data);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Update Successfully..</strong>...Refresh'));
        }

        function update_action()
        {
            $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                // echo '<pre>';
                // print_r($post);
                $teacherID = $this->input->post('user_id');
                $check = $this->Add_teacher_model->user_update($post, $teacherID);

                if ($check == TRUE) {
                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh',
                        'send' => base_url() . 'app/add_teacher'
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function delete()
        {
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->delete('user');

            $this->db->where('teacherId', $this->uri->segment(4));
            $this->db->delete('teacher_allocations');
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function change_status()
        {
            $get = $this->db->get_where('addteacher', array($this->row_id => $this->input->post('id')))->row_array();
            $this->db->where($this->row_id, $this->input->post('id'));
            if ($get['status'] == 0) {
                $check = $this->db->update('addteacher', array('status' => 1));
                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                    die;
                }
            } else if ($get['status'] == 1) {
                $check = $this->db->update('addteacher', array('status' => 0));
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
                $data[] = array('is_del' => 1, 'user_id' => $id);
            }
            $check = $this->db->update_batch('addteacher', $data, 'user_id');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function deleted()
        {
            $this->data['number_of_records'] = $this->Add_teacher_model->records('addteacher', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Add_teacher_model->records('addteacher', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
            $this->db->where_in('user_id', $ids);
            $check = $this->db->delete('addteacher');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
        function all()
        {
            $this->data['number_of_records'] = $this->Add_teacher_model->records('addteacher', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Add_teacher_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }
    }
