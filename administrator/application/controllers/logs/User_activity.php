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
class user_activity extends MY_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_activity_model');
        $this->table_name = ltrim(__CLASS__);
        // $this->row_id = singular(lcfirst('user_id'));
        // $this->data['row_id'] = $this->row_id;
        $this->data['title'] = __CLASS__;
    }

    function index()
    {
        $this->data['records'] =  $this->User_activity_model->all_records();
        $this->load_views($this->data);
    }
}
