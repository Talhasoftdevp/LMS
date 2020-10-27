<?php
class Home_model extends MY_Model{

     function __construct(){
	 parent::__construct();
	
          
     }

	public function recorde(){
		
		$this->db->from('modules');
		$this->db->where('is_del',0);
		$this->db->where('status',1);
		$query=$this->db->get();
		return $query->result_array();
	
	}
	
	
	function get_news(){	   
	   	$this->db->order_by('inserted_at', 'DESC');				
		$this->db->limit(3);
		$query = $this->db->get('news');
		return $query->result_array();
   }
	
	
}