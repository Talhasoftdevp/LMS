<?php
class Aircraft_model extends MY_Model{

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
	
	
}