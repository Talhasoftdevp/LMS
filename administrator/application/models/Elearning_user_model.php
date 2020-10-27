<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage_rols_model
 *
 * @author HP
 */
class Elearning_user_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'elearning_user';
    }

    public function records()
    {
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    function create_user($eLearningUserInfo, $studentInfo, $updateCycle)
    {
        //print_r($eLearningUserInfo['user_name']);
        //print_r($studentInfo);
        $userInformation = array();
        if ($updateCycle == TRUE) {
            $userInformation['user_id'] = $eLearningUserInfo['user_id'];
            $userInformation['status'] = $eLearningUserInfo['record_status'];
            if (empty($eLearningUserInfo['password'])) {
                $user_password = $eLearningUserInfo['current_password'];
            } else {
                $user_password = base64_encode(md5($eLearningUserInfo['password']));
            }
        } else {
            $userInformation['status'] = 0;
            $user_password = base64_encode(md5($eLearningUserInfo['password']));
        }
        $userInformation['user_name'] = $eLearningUserInfo['user_name'];
        $userInformation['email'] = $eLearningUserInfo['email'];
        $userInformation['password'] = $user_password;
        $userInformation['status'] = $userInformation['status'];
        $userInformation['inserted_on'] = date('Y-m-d h:i:s');
        $this->db->insert($this->table_name, $userInformation);
        $user_id = $this->db->insert_id();
        if ($user_id) {
            $numberOfStudents = count($studentInfo['student']);
            for ($i = 0; $i < $numberOfStudents; $i++) {
                $student = array();
                $student['parent_id'] = $user_id;
                $student['name'] = $studentInfo['student'][$i];
                $student['class'] = $studentInfo['class'][$i];
                $student['inserted_on'] =  date('Y-m-d h:i:s');
                $this->db->insert('students', $student);
            }
        }
        return  $user_id;
    }

    function user_update($post, $studentInfo, $parentID)
    {
        $post['record_status'] = $this->fetch_record_status($parentID);
        $post['current_password'] = $this->fetch_user_current_password($parentID);
        $this->delete_parent($parentID);
        $this->delete_students($parentID);
        $this->create_user($post, $studentInfo, TRUE);
        return TRUE;
    }

    function delete_parent($parentID)
    {
        $this->db->where('user_id', $parentID);
        $this->db->delete('elearning_user');
    }
    function delete_students($parentID)
    {
        $this->db->where('parent_id', $parentID);
        $this->db->delete('students');
    }
    function fetch_record_status($parentID)
    {
        $this->db->select('status');
        $this->db->from('elearning_user');
        $this->db->where('user_id', $parentID);
        $query = $this->db->get()->row()->status;
        return $query;
    }
    function fetch_user_current_password($parentID)
    {
        $this->db->select('password');
        $this->db->from('elearning_user');
        $this->db->where('user_id', $parentID);
        $query = $this->db->get()->row()->password;
        return $query;
    }
    function is_email_available($email)
    {
        $this->db->from('elearning_user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $query->result_array();
        print_r($query);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function all()
    {
        $this->db->from('roles');
        $query = $this->db->get();
        return $query->result_array();
    }

    function user_roles($data, $all_modules)
    {
        $array = array('role_name' => $data['roles'], 'description' => $data['description']);
        $id = $this->create_recorde('roles', $array);
        //=$this->db->insert_id();
        $check = $this->user_right($id, $data, $all_modules, TRUE);
        return $check;
    }

    function user_roles_update($data, $all_modules)
    {

        $array = array('role_name' => $data['roles'], 'description' => $data['description'], 'roles_id' => $data['roles_id']);
        $update = $this->update_recorde('roles', $array);
        if ($update) {
            $this->db->where('roles_id', $data['roles_id']);
            $this->db->delete('rights');
            $check = $this->user_right($data['roles_id'], $data, $all_modules, FALSE);
            return $check;
        } else {
            return FALSE;
        }
    }

    function user_right($insert_id, $data, $all_modules, $states)
    {
        if ($insert_id) {
            foreach ($all_modules as $value) {
                if ($states == TRUE) {
                    $roles = array(
                        'can_view' => 0,
                        'can_add' => 0,
                        'can_update' => 0,
                        'can_delete' => 0,
                        'roles_id' => $insert_id,
                        'module_id' => $value['module_id'],
                        'inserted_on' => date('Y-m-d h:i:s'),
                        'inserted_by' => $this->session->userdata('user_id')
                    );
                } else {
                    $roles = array(
                        'can_view' => 0,
                        'can_add' => 0,
                        'can_update' => 0,
                        'can_delete' => 0,
                        'roles_id' => $insert_id,
                        'module_id' => $value['module_id'],
                        'updated_on' => date('Y-m-d h:i:s'),
                        'inserted_by' => $this->session->userdata('user_id')
                    );
                }

                $this->db->insert('rights', $roles);
                $this->db->where(array('roles_id' => $insert_id, 'module_id' => $value['module_id']));
                if (isset($data['rights']['view'][$value['module_id']]) == 1) {

                    $view = array(
                        'can_view' => $data['rights']['view'][$value['module_id']]
                    );
                } else {
                    $view = array(
                        'can_view' => 0
                    );
                }
                $this->db->update('rights', $view);

                $this->db->where(array('roles_id' => $insert_id, 'module_id' => $value['module_id']));
                if (isset($data['rights']['add'][$value['module_id']]) == 1) {
                    $add = array(
                        'can_add' => $data['rights']['add'][$value['module_id']]
                    );
                } else {
                    $add = array(
                        'can_add' => 0
                    );
                }

                $this->db->update('rights', $add);
                $this->db->where(array('roles_id' => $insert_id, 'module_id' => $value['module_id']));
                if (isset($data['rights']['update'][$value['module_id']]) == 1) {
                    $update = array(
                        'can_update' => $data['rights']['update'][$value['module_id']]
                    );
                } else {
                    $update = array(
                        'can_update' => 0
                    );
                }
                $this->db->update('rights', $update);
                $this->db->where(array('roles_id' => $insert_id, 'module_id' => $value['module_id']));
                if (isset($data['rights']['delete'][$value['module_id']]) == 1) {
                    $delete = array(
                        'can_delete' => $data['rights']['delete'][$value['module_id']]
                    );
                } else {
                    $delete = array(
                        'can_delete' => 0
                    );
                }
                $this->db->update('rights', $delete);
            }
            return true;
        } else {

            return false;
        }
    }

    public function record_info_user($row_id)
    {
        $this->db->from($this->table_name);
        $this->db->where($this->row_id, $row_id);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }

    public function fetch_students($parentID)
    {
        $this->db->select('student_id,name,class');
        $this->db->from('students');
        $this->db->where('parent_id', $parentID);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
