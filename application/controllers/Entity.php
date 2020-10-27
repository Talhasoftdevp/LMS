<?php
class Entity extends MY_Controller {

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
	
	
	function search(){
		$post = $this->input->post();	
		//$queryString =  http_build_query($post);
		//print_r($post);		
		//echo $queryString;
		//die();		
		$url = 'http://api.ofacanalyzer.com/serviceSearch.asmx/OFAC_Search?ofac_idF=803438&name_word_1F='.$post['company_name'].'&name_word_2F=&name_word_3F=&name_word_4F=&name_word_5F=&search_dobF=21-02-2000&add_numF=&add_streetF=&add_cityF='.$post['city'].'&add_st_provF='.$post['state'].'&add_zipF='.$post['zip'].'&add_countryF='.$post['country'].'&search_commentsF='.$post['alias'].'';
		$sxml = simplexml_load_file($url);
		//print_r($sxml);
		echo json_encode($sxml);
	}

}
