<?php
Class Manage_roles_model extends MY_Model{
    
    public function __construct(){
    parent::__construct();
    $this->table_name='roles';
    $this->row_id=$this->table_name.'_id';
    $this->order_by=$this->table_name.'.inserted_on DSEC';
    }
    
    
    public function records($table_name,$number_of_pages,$offset,$deleted=null,$count_all_records=null){
        $this->db->from($table_name);
        ($deleted ==TRUE)? $this->db->where('is_del',1): $this->db->where('is_del',0);
        if($count_all_records == TRUE){
            return $this->db->count_all_results();
        }else{
            
        $this->db->limit($number_of_pages,$offset);
       //    $this->db->order_by($this->order_by);
        $query=$this->db->get();
         return $query->result_array();
        }
        
   }
   
   public function active_records(){
       $this->db->from('roles');
       $this->db->where(array('is_del'=>0,'status'=>1));
       $query=$this->db->get();
       return $query->result_array();
   }
   
   public function all(){
       $this->db->from('roles');
       $query=$this->db->get();
       return $query->result_array();
   }
   
}
