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
class Add_teacher_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'addteacher';
    }

    public function records($number_of_pages, $offset, $deleted = null, $count_all_records = null)
    {
        $offset = $offset - 1;
        if ($offset < 0) {
            $offset = 0;
        }
        $from = $offset * $number_of_pages;

        $this->db->from('user');
        $this->db->where('user_role', 'Teacher');
        if ($count_all_records == TRUE) {
            return $this->db->count_all_results();
        } else {
            $this->db->limit($number_of_pages, $from);
            // $this->db->group_by('user_name');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    function teacherAssignmentsInfo()
    {
        $this->db->select('section, subjects');
        $this->db->from($this->table_name);
        $this->db->where('`user_name` IN (SELECT `user_name` FROM `addteacher` GROUP BY user_name)', NULL, FALSE);
        //$this->db->order_by('section');
        $query = $this->db->get();
        //print_r($query);
        return $data = $query->result_array();
    }
    function createTeacher($post, $teacherAllocations, $updateCycle)
    {
        $teacherData = array();
        if ($updateCycle == TRUE) {
            $teacherData['user_id'] = $post['user_id'];
            if (empty($post['password'])) {
                // $user_password = array('password' => $post['current_password']);
                $user_password = $post['current_password'];
                // print_r($user_password['password']);
            } else {
                $user_password = base64_encode(md5($post['password']));
            }
        }
        if ($updateCycle == FALSE) {
            $user_password = base64_encode(md5($post['password']));
        }
        $teacherData['user_name'] = $post['user_name'];
        $teacherData['email'] = $post['email'];
        $teacherData['user_role'] = $post['user_role'];
        $teacherData['password'] = $user_password;
        $teacherData['inserted_on'] = date('Y-m-d h:i:s');
        $this->db->insert('user', $teacherData);
        $user_id = $this->db->insert_id();
        if ($user_id) {
            $assignedClassesAndSubjects = count($teacherAllocations['class']);
            for ($i = 0; $i < $assignedClassesAndSubjects; $i++) {
                $allocations = array();
                $allocations['teacherId'] = $user_id;
                $allocations['class'] = $teacherAllocations['class'][$i];
                $allocations['section'] = $teacherAllocations['section'][$i];
                $allocations['subject'] = $teacherAllocations['subject'][$i];
                $this->db->insert('teacher_allocations', $allocations);
            }
        }
        return  $user_id;
    }
    function get_user_password($user_id)
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get()->row()->password;
        return $query;
    }

    public function fetchSubjects($class, $teacher_id)
    {
        $this->db->select('subject');
        $this->db->from('teacher_allocations');
        $this->db->where('class', $class);
        $this->db->where('teacherId', $teacher_id);
        $this->db->order_by('subject');
        // $this->db->where('is_del', 0);
        $query = $this->db->get();
        //print_r($query);
        return $data = $query->result_array();
        //var_dump($data);
    }
    function user_update($post, $teacherID)
    {
        // print_die($teacherID);
        $teacherAllocations = array();
        $teacherAllocations['class'] = $post['classes_assigned'];
        $teacherAllocations['section'] = $post['section_assigned'];
        $teacherAllocations['subject'] = $post['subject_assigned'];
        $post['current_password'] = $this->get_user_password($teacherID);
        $this->delete_teacher($teacherID);
        $this->delete_teachers_allocation($teacherID);
        $this->createTeacher($post, $teacherAllocations, TRUE);
        return TRUE;
    }

    function delete_teacher($teacherID)
    {
        $this->db->where('user_id', $teacherID);
        $this->db->where('user_role', 'Teacher');
        $this->db->delete('user');
    }
    function delete_teachers_allocation($teacherID)
    {
        $this->db->where('teacherId', $teacherID);
        $this->db->delete('teacher_allocations');
    }
    public function all()
    {
        $this->db->from('roles');
        $query = $this->db->get();
        return $query->result_array();
    }
    function teacherAllocations($teacher_id)
    {
        $this->db->from('teacher_allocations');
        $this->db->where('teacherId', $teacher_id);
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
        $this->db->from('user');
        $this->db->where($this->row_id, $row_id);
        // $this->db->where('is_del', 0);
        $query = $this->db->get();
        return $data = $query->row_array();
    }
}
