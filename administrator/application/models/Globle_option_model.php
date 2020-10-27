<?php
Class Globle_option_model extends CI_Model{
    
    public function __construct(){
    parent::__construct();
    $this->table_name= rtrim(lcfirst(__CLASS__),'_model');
    $this->row_id=$this->table_name.'_id';
    $this->order_by=$this->row_id.' ASC';
    }
    
    
    public function records($number_of_pages,$offset,$deleted=null,$count_all_records=null){
        $this->db->from($this->table_name);
        ($deleted ==TRUE)? $this->db->where('is_del',1): $this->db->where('is_del',0);
        if($count_all_records == TRUE){
            return $this->db->count_all_results();
        }else{
            
        $this->db->limit($number_of_pages,$offset);
         $this->db->order_by($this->order_by);
        $query=$this->db->get();
         return $query->result_array();
        }
        
   }
   
    function last_insert_record_plus_one(){
          $this->db->from($this->table_name);
          $this->db->where('is_del',0);
          $this->db->where('status',1);
          $this->db->limit(1);
          $this->db->order_by($this->row_id,'DESC');
          $query=$this->db->get();
          $data=$query->result_array();
          //print_r($data);
          //die;
          
          return (!empty($data))?$data[0][$this->row_id]:1;
      }
   
   function create_record($data){
       
       $data['inserted_on']=mysql_date();
       if($_FILES){
       $data['image']=$_FILES['photo']['name'];
      }else{
          unset($data['photo']);
      }
       //$data['grn']=$this->last_insert_record_plus_one();
      // $data['date']=date('Y-m-d',strtotime($data['date']));
       $data['inserted_by']=$this->session->userdata('username');
       return  $this->db->insert($this->table_name,$data);
   }
   
   function update_record($data){
       $data['updated_on']=mysql_date();
      if($_FILES){
       $data['image']=$_FILES['photo']['name'];
      }else{
          unset($data['photo']);
      }
       
      // $data['date']=date('Y-m-d',strtotime($data['date']));
       $dat['updated_by']=$this->session->userdata('username');
       $this->db->where($this->row_id,$data[$this->row_id]);
       return  $this->db->update($this->table_name,$data);
   }
   
   public function record_info($row_id){
       $this->db->from($this->table_name);
       $this->db->where($this->row_id,$row_id);
       $this->db->where('is_del',0);
       $query=$this->db->get();
       $data=$query->row_array();
       return $data;
        
   }
   
   public function active_records(){
       $this->db->from($this->table_name);
       $this->db->where(array('is_del'=>0,'status'=>1));
       $query=$this->db->get();
       return $query->result_array();
   }
   
   public function all(){
       $this->db->from($this->table_name);
       $query=$this->db->get();
       return $query->result_array();
   }
   
}
