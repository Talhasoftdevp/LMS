<?php


class Manage_course_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'elearning_chapter';
        $this->load->model('Create_course_model');
        $this->load->model('Teacher_logs_model');
    }

    public function records()
    {
        $this->db->from($this->table_name);
        $this->db->where("is_del", 0);
        $this->db->order_by("chapter_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }


    function user_update($post, $chapterID, $assignment_exist, $record_created_date)
    {
        $this->delete_elearning_chapter_entry($chapterID);
        $this->delete_lectures_entry($chapterID);
        $this->delete_teacher_logs_entry($chapterID);
        $this->create_entry($post, $chapterID, TRUE, $assignment_exist, $record_created_date);
        return TRUE;
    }

    function delete_elearning_chapter_entry($chapterID)
    {
        $this->db->where('chapter_id', $chapterID);
        $this->db->delete('elearning_chapter');
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

    function update_assignment_entry($previousChapterID, $newChapterID)
    {
        $dataToUpdate = array('chapter_id' => $newChapterID);
        $this->db->where('chapter_id', $previousChapterID);
        $this->db->update('elearning_assignment', $dataToUpdate);
    }

    function assignment_entry_check($chapterID)
    {
        $this->db->select('assignment_id');
        $this->db->from('elearning_assignment');
        $this->db->where('chapter_id', $chapterID);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function all()
    {
        $this->db->from('roles');
        $query = $this->db->get();
        return $query->result_array();
    }


    function create_entry($post, $chapterID, $updateProcess, $assignment_exist, $record_created_date)
    {
        //print_r($_POST);
        $assignment_status = FALSE;
        if (!empty($_FILES) ||  $assignment_exist == TRUE) {
            $assignment_status = TRUE;
        }
        //$post = $this->input->post();
        $check = $this->create_record($post, $assignment_status, $chapterID, $record_created_date);
        // print_die($check);
        $this->create_teacher_logs_entry($post, $check, $record_created_date);
        if ($check == TRUE) {
            if (isset($_FILES) && !empty($_FILES)) {
                if ($_POST['content_type'] == 1) {
                    $this->lecture_upload($check);
                }
                $this->assignment_upload($check);
            }

            if (!empty($post['choice'])) {
                $insert_data = array(
                    'path' => $post['choice'],
                    'inserted_on' => date('Y-m-d h:i:s'),
                    'inserted_by' => $this->session->userdata('username'),
                    'chapter_id' => $check,
                    'type' => 'URL'
                );
                $this->db->insert('lectures', $insert_data);
            }
            if ($updateProcess == TRUE) {
                $this->update_assignment_entry($chapterID, $check);
            }
            // echo json_encode(array(
            //     'success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh',
            //     'send' => base_url() . 'courses/manage_course'
            // ));
        }
    }
    function create_record($post, $assignment_status, $chapterID, $record_created_date)
    {

        $chapter = array(
            'chapter_id' => $chapterID,
            'class' => $post['class'],
            'name' => $post['chapter'],
            'subject' => $post['subject'],
            'teacherName' => $post['TeacherName'],
            'inserted_on' => $record_created_date,
            'assignment_given' => $assignment_status
        );
        $this->db->insert($this->table_name, $chapter);
        $chapter_id = $this->db->insert_id();
        return  $chapter_id;
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
        $_FILES['choice']['name'] = uniqid() . "_" . $_FILES['choice']['name'];
        $config['upload_path'] = './upload/elearning/chapter/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '2000000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('choice')) :
            $error = array('error' => $this->upload->display_errors());
        //print_r($error);
        else :
            $fileName = explode(".", $_FILES['choice']['name']);
            $insert_file = array(
                'path' => $_FILES['choice']['name'],
                'inserted_on' => date('Y-m-d h:i:s'),
                'inserted_by' => $this->session->userdata('username'),
                'chapter_id' => $chapter_id,
                'type' => $_FILES['choice']['type'],
                'size' =>  $_FILES['choice']['size']
            );
            $this->db->insert('lectures', $insert_file);
        endif;
    }
    function create_teacher_logs_entry($post, $chapter_id, $record_created_date)
    {

        $record = array(
            'chapter_id' => $chapter_id,
            'class' => $post['class'],
            'name' => $post['chapter'],
            'subject' => $post['subject'],
            'teacherName' => $post['TeacherName'],
            'inserted_on' => $record_created_date
        );
        $this->db->insert('teacher_logs', $record);
        // $chapter_id = $this->db->insert_id();
        // return  $chapter_id;
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
    function youtubeLink($chapterID)
    {
        $this->db->select('path as youtube_link');
        $this->db->from('lectures');
        $this->db->where('chapter_id', $chapterID);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            $youtube_link = $row->youtube_link;
        }
        return $youtube_link;
    }
    function subjects($classID)
    {
        $this->db->select('subject');
        $this->db->from('classes');
        $this->db->where('class', $classID);
        $this->db->order_by('subject');
        $query = $this->db->get();
        return $query->result_array();
    }
}
