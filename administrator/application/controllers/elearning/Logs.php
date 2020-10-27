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
    class Logs extends MY_Controller
    {

        //put your code here
        function __construct()
        {
            parent::__construct();
            $this->load->model('Logs_model');
            $this->load->model('Classes_model');
            //$this->load->model('Manage_roles_model');
            $this->table_name = ltrim(__CLASS__);
            $this->row_id = singular(lcfirst('user_id'));
            $this->data['row_id'] = $this->row_id;
            $this->data['title'] = __CLASS__;
        }

        function index()
        {
            $this->data['number_of_records'] = $this->Logs_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
            $config['total_rows'] = $this->data['number_of_records'];
            $config['per_page'] = $this->data['number_of_pages'];
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;
            $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
            $this->data['records'] = $this->Logs_model->records($this->data['number_of_pages'], $page, FALSE, FALSE);
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



        function all()
        {
            $this->data['number_of_records'] = $this->Logs_model->records('elearning_user', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
            $this->data['records'] = $this->Logs_model->all();
            $this->data['parent_module'] = $this->modules();
            $this->data['module_child'] = $this->modules_child();
            $this->load_views($this->data);
        }
    }
