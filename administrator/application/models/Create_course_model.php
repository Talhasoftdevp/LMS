<?php


class Create_course_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'elearning_chapter';
    }

    public function records($number_of_pages, $offset, $deleted = null, $count_all_records = null)
    {
        $offset = $offset - 1;
        if ($offset < 0) {
            $offset = 0;
        }
        $from = $offset * $number_of_pages;

        $this->db->from($this->table_name);
        // ($deleted == TRUE) ? $this->db->where(array('is_del' => 1, 'status' => 1)) : $this->db->where(array('is_del' => 0, 'status' => 1));
        if ($count_all_records == TRUE) {
            return $this->db->count_all_results();
        } else {

            $this->db->limit($number_of_pages, $from);
            //    $this->db->order_by($this->order_by);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    function create_record($post, $assignment_status)
    {

        $chapter = array(
            'class' => $post['class'],
            'name' => $post['chapter'],
            'subject' => $post['subject'],
            'teacherName' => $post['TeacherName'],
            'inserted_on' => date('Y-m-d h:i:s'),
            'assignment_given' => $assignment_status
        );
        $this->db->insert($this->table_name, $chapter);
        $chapter_id = $this->db->insert_id();
        return  $chapter_id;
    }

    function user_update($table_name, $post)
    {

        $chapter = array(
            'presentation_id' => $post['presentation_id'],
            'name' => $post['chapter'],
            'updated_on' => date('Y-m-d h:i:s')
        );


        $this->db->where('chapter_id', $post['chapter_id']);
        $check = $this->db->update($table_name, $chapter);

        if ($check) {

            if (isset($post['slide_id'])) {
                $number_of_upd_slides = count($post['slide_id']);
                for ($a = 0; $a < $number_of_upd_slides; $a++) {
                    $slides = array();
                    $slides['name'] = $post['name1'][$a];
                    $slides['sort'] = $post['sort1'][$a];
                    $slides['updated_on'] = date('Y-m-d h:i:s');

                    $this->db->where('slide_id', $post['slide_id'][$a]);
                    $check = $this->db->update('elearning_slide', $slides);
                }
            }

            $this->db->where('chapter_id', $post['chapter_id']);
            $del = $this->db->delete('elearning_question');
            if ($del) {
                if (isset($post['question'])) {
                    $number_of_question = count($post['question']);
                    for ($i = 0; $i < $number_of_question; $i++) {
                        if ($post['question'][$i]) {
                            $question = array();
                            $question['chapter_id'] = $post['chapter_id'];
                            $question['question'] = $post['question'][$i];
                            $question['type'] = $post['type'][$i];
                            $question['ansa'] = $post['ans_a'][$i];
                            $question['ansb'] = $post['ans_b'][$i];
                            if ($post['type'][$i] != 3) {
                                $question['ansc'] = $post['ans_c'][$i];
                                $question['ansd'] = $post['ans_d'][$i];
                            }
                            $question['correct_ans'] = $post['correct_ans'][$i];
                            $question['master_practice'] = $post['master_practice'][$i];
                            $this->db->insert('elearning_question', $question);
                        }
                    }
                }
            }
        }

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

    public function record_info_elearning($row_id)
    {
        $this->db->from($this->table_name);
        $this->db->where($this->row_id, $row_id);
        $this->db->where('is_del', 0);
        $query = $this->db->get();
        $data = $query->row_array();

        $this->db->from('elearning_slide');
        $this->db->where($this->row_id, $row_id);
        $this->db->where('is_del', 0);
        $query_slides = $this->db->get();
        $data['slides'] = $query_slides->result_array();

        $this->db->from('elearning_question');
        $this->db->where($this->row_id, $row_id);
        //$this->db->where('is_del',0);
        $query_question = $this->db->get();
        $data['questions'] = $query_question->result_array();
        return $data;
    }
}
