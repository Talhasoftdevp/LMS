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
class News extends MY_Controller
{
    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        //$this->load->model('Manage_roles_model');
        $this->table_name = 'news';
        $this->row_id = singular(lcfirst('news_id'));
        $this->data['row_id'] = $this->row_id;
        $this->data['title'] = __CLASS__;
        $this->load->library("pagination");
    }

    function index()
    {
        $this->data['number_of_records'] = $this->News_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);

        $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;

        $config['total_rows'] = $this->data['number_of_records'];
        $config['per_page'] = $this->data['number_of_pages'];
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        //$config['num_links'] = $this->data['number_of_records'];
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;
        $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
        $this->data['records'] = $this->News_model->records($this->data['number_of_pages'], $page, FALSE, FALSE);
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
        $this->load_views($this->data);
    }

    function create_action()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('headline', 'Headline', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            ($_FILES) ? $this->do_upload('image') : '';
            $check = $this->News_model->create_news($post);
            ($_FILES) ? $this->do_upload('image') : '';
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }

    function edit()
    {
        $this->data['record_info'] = $this->News_model->record_info_user($this->uri->segment(4));
        $this->load_views($this->data);
    }


    function update_action()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('headline', 'Headline', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            ($_FILES) ? $this->do_upload('image') : '';
            $check = $this->News_model->news_update('news', $post);

            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }

    function delete()
    {
        $this->db->where('news_id', $this->uri->segment(4));
        $this->db->delete($this->table_name);
        echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
    }

    function change_status()
    {
        $get = $this->db->get_where('news', array($this->row_id => $this->input->post('id')))->row_array();
        $this->db->where($this->row_id, $this->input->post('id'));
        if ($get['status'] == 0) {
            $check = $this->db->update('news', array('status' => 1));
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                die;
            }
        } else if ($get['status'] == 1) {
            $check = $this->db->update('news', array('status' => 0));
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
            $data[] = array('is_del' => 1, 'news_id' => $id);
        }
        $check = $this->db->update_batch('news', $data, 'news_id');
        if ($check == TRUE) {
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
        } else {
            echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
        }
    }

    function deleted()
    {
        $this->data['number_of_records'] = $this->News_model->records('news', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
        $this->data['records'] = $this->News_model->records('news', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
        $this->db->where_in('news_id', $ids);
        $check = $this->db->delete('news');
        if ($check == TRUE) {
            echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
        } else {
            echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
        }
    }

    function all()
    {
        $this->data['number_of_records'] = $this->News_model->records('news', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
        $this->data['records'] = $this->News_model->all();
        $this->data['parent_module'] = $this->modules();
        $this->data['module_child'] = $this->modules_child();
        $this->load_views($this->data);
    }

    function do_upload($image)
    {
        $config['upload_path'] = './upload/news/';
        $config['allowed_types'] = 'gif|jpg|png';
        //                $config['max_size']             = 100;
        //                $config['max_width']            = 1024;
        //                $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($image)) {
            echo json_encode(array('success' => 'no', 'msg' => $this->upload->display_errors()));
        } else {
            $this->upload->data($image);
        }
    }
}
