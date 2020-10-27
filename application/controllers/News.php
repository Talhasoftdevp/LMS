<?php
class News extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        $this->data['title']=__CLASS__;
       
    }

    public function index() {
        //  $this->data['name']='waqar';
		
		$this->data['news'] = $this->News_model->get_all_news();	
        $this->load_views($this->data);
    }
	
	
	public function details($news_id) {		
		$this->data['current_news'] = $this->News_model->get_news($news_id);
		$this->data['recent_post'] = $this->News_model->recent_post_news();	        
        $this->load_views($this->data, 'blog_view');
    }

}
