<?php 
class MY_Model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        //$this->check_login();
        $this->order_by='insert_on DSEC';
    }
    
   
    
    public function select_all(){
                $this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->order_by($table_name.'_id DSEC');
		$query=$this->db->get();
		return $query->result_array();
	}
	
    public function create_recorde($table_name,$data){
		$data['inserted_on']=date('Y-m-d h:i:s');
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
    public function update_recorde($table_name,$data){
		$data['updated_on']=date('Y-m-d h:i:s');
		$this->db->where($table_name.'_id',$data[$table_name.'_id']);
		$check=$this->db->update($table_name,$data);
		return $check;
	}
	
    public function select_row($table_name,$id){
		$this->db->from($table_name);
		$this->db->where('is_del',0);
		$this->db->where($table_name.'_id',$id);
		$query=$this->db->get();
		$result_array = $query->result_array();
		return ($query->num_rows() > 0)? $result_array[0]:$result_array;
	}
	
    public function select_multiple_rows($table_name,$coulmn,$value) {
        $this->db->from($table_name);
        (is_array($value))?$this->db->where_in($coulmn,$value):$this->db->where($coulmn,$value) ;    
        $this->db->get();
        return $query->result_array();
    }
        
   public function record_info($table_name,$where,$id){
                $this->db->from($table_name);
		$this->db->where('is_del',0);
		$this->db->where($where,$id);
		$query=$this->db->get();
		 $result_array = $query->result_array();
                 return $result_array;
        //	return ($query->num_rows() > 0)? $result_array[0]:$result_array;
   }     

} 