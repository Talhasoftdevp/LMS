<?php
class News_model extends MY_Model{

     function __construct(){
	 parent::__construct();
	
          
     }	
	 
	 
	 
	 function get_all_news(){
		$this->db->from('news');
		$this->db->where(array('is_del'=>0,'status'=>1));
		$this->db->order_by('inserted_at', 'DESC');
		$query=$this->db->get();
		return $query->result_array();	 
		 
 	 }
	 
	 
	 function get_news($news_id){		 
		 $this->db->from('news');
		$this->db->where('news_id',$news_id);
		$result = $this->db->get();
		return $result->row_array();	 
	 }
	 
	 function recent_post_news(){	   
	   	$this->db->order_by('inserted_at', 'DESC');				
		$this->db->limit(4);
		$query = $this->db->get('news');
		return $query->result_array();
   }
	 
	 
	
}
