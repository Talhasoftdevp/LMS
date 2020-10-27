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
    class Elearning_user extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Elearning_user_model');
            $this->load->model('Classes_model');
            // //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular(lcfirst('user_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['records'] = $this->Elearning_user_model->records();
            $this->load_views($this->data);
        }

        function create()
        {
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            $this->load_views($this->data);
        }

        function create_action()
        {
            // print_die($_POST);
            $studentInfo = array();
            $eLearningUserInfo = array();
            $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
            //$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('student[]', 'Student', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                $eLearningUserInfo = $post;
                $studentInfo['student'] = $post['student_name'];
                $studentInfo['class'] = $post['class'];
                $check = $this->Elearning_user_model->create_user($eLearningUserInfo, $studentInfo, FALSE);
                if ($check == TRUE) {
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
            //$studentsData = array();
            $this->data['record_info'] = $this->Elearning_user_model->record_info_user($this->uri->segment(4));
            $students = $this->Elearning_user_model->fetch_students($this->uri->segment(4));
            $this->data['classes'] = $this->Classes_model->fetchClasses();
            //print_r($this->data['record_info']);
            //echo "<pre>";
            //print_r($students);
            //die();

            $this->data['students'] = $students;
            //print_r($this->data['students']);
            // for ($inintial = 0; $inintial < count($check); $inintial++) {
            //     array_push($studentsData, $check[$inintial]['name']);
            // }
            //$this->data['students_name'] = json_encode($studentsData);
            $this->load_views($this->data);
        }
        // function check_email_avalibility($email)
        // {
        //     if ($this->Elearning_user_model->is_email_available($email) == false) {
        //         echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';
        //     }
        // }
        function active()
        {
            $data = array(
                'status' => 1
            );
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->update('elearning_user', $data);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Update Successfully..</strong>...Refresh'));
        }

        function notActive()
        {
            $data = array(
                'status' => 0
            );
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->update('elearning_user', $data);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Update Successfully..</strong>...Refresh'));
        }
        function update_action()
        {
            //print_die($_POST);
            $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
            //$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $post = $this->input->post();
                $studentInfo = array();
                if (!empty($post['student_name'])) {
                    $studentInfo['student'] = $post['student_name'];
                    $studentInfo['class'] = $post['class'];
                }
                $parentID = $this->input->post('user_id');
                $check = $this->Elearning_user_model->user_update($post, $studentInfo, $parentID);

                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh', 'send' => 'no'));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function delete()
        {
            $this->db->where('user_id', $this->uri->segment(4));
            $this->db->delete('elearning_user');
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function change_status()
        {
            $get = $this->db->get_where('elearning_user', array($this->row_id => $this->input->post('id')))->row_array();
            $this->db->where($this->row_id, $this->input->post('id'));
            if ($get['status'] == 0) {
                $check = $this->db->update('elearning_user', array('status' => 1));
                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                    die;
                }
            } else if ($get['status'] == 1) {
                $check = $this->db->update('elearning_user', array('status' => 0));
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
            $check = $this->db->update_batch('elearning_user', $data, 'user_id');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function deleted()
        {
            $this->data['number_of_records'] = $this->Elearning_user_model->records('elearning_user', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Elearning_user_model->records('elearning_user', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
            $check = $this->db->delete('elearning_user');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function all()
        {
            $this->data['number_of_records'] = $this->Elearning_user_model->records('elearning_user', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Elearning_user_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }
    }
