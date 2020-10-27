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
class Classes_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'classes';
    }

    public function records()
    {
        $this->db->from($this->table_name);
        $this->db->order_by('Id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function createClass($post)
    {
        $classInformation = array();
        $numberOfSubjects = count($post['subject']);
        for ($initial = 0; $initial < $numberOfSubjects; $initial++) {
            $classInformation['class'] = $post['class'];
            $classInformation['section'] = $post['section'];
            $classInformation['subject'] = $post['subject'][$initial];
            $classInformation['inserted_on'] = date('Y-m-d h:i:s');
            $this->db->insert($this->table_name, $classInformation);
        }

        return $this->db->insert_id();
    }

    function updateClassInformation($table_name, $post)
    {

        $updatedClassInfo = array();
        $updatedClassInfo['class'] = $post['class'];
        $updatedClassInfo['section'] = $post['section'];
        $updatedClassInfo['subject'] = $post['subject'][0];
        $updatedClassInfo['updated_on'] = date('Y-m-d h:i:s');
        $this->db->where('Id', $post['Id']);
        $check = $this->db->update($table_name, $updatedClassInfo);
        return $check;
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
        return $data = $query->row_array();
    }

    public function fetchClasses()
    {
        $this->db->from($this->table_name);
        $this->db->group_by('class');
        $this->db->order_by("class", "asc");
        $query = $this->db->get();
        return $data = $query->result_array();
    }

    public function fetch_Allocated_Classes($teacherID)
    {
        $this->db->from('teacher_allocations');
        $this->db->where('teacherId', $teacherID);
        $this->db->group_by('class');
        $this->db->order_by("class", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetchSubjects($value)
    {
        $this->db->select('subject');
        $this->db->from($this->table_name);
        $this->db->where('class', $value);
        $this->db->order_by('subject');
        // $this->db->where('is_del', 0);
        $query = $this->db->get();
        //print_r($query);
        return $data = $query->result_array();
        //var_dump($data);
    }
    public function fetchSections($value)
    {
        $this->db->select('section');
        $this->db->from($this->table_name);
        $this->db->group_by('section');
        $this->db->order_by('section');
        $this->db->where('class', $value);
        // $this->db->where('is_del', 0);
        $query = $this->db->get();
        //print_r($query);
        return $data = $query->result_array();
        //var_dump($data);
    }
}
