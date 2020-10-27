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
    class Classes extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Classes_model');
            //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular('Id');
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['records'] = $this->Classes_model->records();
            $this->load_views($this->data);
        }


        function create()
        {
            $this->load_views($this->data);
        }

        function create_action()
        {
            $this->form_validation->set_rules('class', 'Class', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $classInformation = $this->input->post();
                $check = $this->Classes_model->createClass($classInformation);

                if ($check == TRUE) {
                    echo json_encode(array(
                        'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
                        'send' => base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__)
                    ));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function edit()
        {
            $this->data['record_info'] = $this->Classes_model->record_info_user($this->uri->segment(4));
            $this->load_views($this->data);
        }


        function update_action()
        {
            $this->form_validation->set_rules('class', 'Class', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            } else {
                $updatedClassInfo = array();
                $updatedClassInfo['subject'] = $_POST['subject'];
                $updatedClassInfo = $this->input->post();
                // $updatedClassInfo = $this->Classes_model->record_info_user($updatedClassInfo['Id']);
                $check = $this->Classes_model->updateClassInformation('classes', $updatedClassInfo);

                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh', 'send' => 'no'));
                } else {
                    echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
                }
            }
        }

        function delete()
        {
            $this->db->where('Id', $this->uri->segment(4));
            $this->db->delete($this->table_name);
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        }

        function change_status()
        {
            $get = $this->db->get_where('classes', array($this->row_id => $this->input->post('id')))->row_array();
            $this->db->where($this->row_id, $this->input->post('id'));
            if ($get['status'] == 0) {
                $check = $this->db->update('classes', array('status' => 1));
                if ($check == TRUE) {
                    echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                    die;
                }
            } else if ($get['status'] == 1) {
                $check = $this->db->update('classes', array('status' => 0));
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
                $data[] = array('is_del' => 1, 'Id' => $id);
            }
            $check = $this->db->update_batch('classes', $data, 'Id');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function deleted()
        {
            $this->data['number_of_records'] = $this->Classes_model->records('classes', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
            $this->data['records'] = $this->Classes_model->records('classes', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
            $this->db->where_in('Id', $ids);
            $check = $this->db->delete('classes');
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }

        function all()
        {
            $this->data['number_of_records'] = $this->Classes_model->records('classes', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Classes_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }
    }
