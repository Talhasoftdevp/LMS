<?php
class History extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        //$this->table_name = humanize(lcfirst(__CLASS__));
        //$this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        $this->data['title']=__CLASS__;
       
    }

    public function index() {
        //  $this->data['name']='waqar';
        $this->load_views($this->data);
    }

}
