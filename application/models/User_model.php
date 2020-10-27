<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage_rols_model
 *
 * @author HP
 */
class User_model extends MY_Model{
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->table_name='user';
    }
    
    public function records($number_of_pages,$offset,$deleted=null,$count_all_records=null){
        $this->db->from($this->table_name);
        ($deleted ==TRUE)? $this->db->where(array('is_del'=>1,'status'=>1)): $this->db->where(array('is_del'=>0,'status'=>1));
        if($count_all_records == TRUE){
            return $this->db->count_all_results();
        }else{
            
        $this->db->limit($number_of_pages,$offset);
       //    $this->db->order_by($this->order_by);
        $query=$this->db->get();
         return $query->result_array();
        }
        
   }
   function create_user($post){
      $post['password']= base64_encode(md5($post['password']));
      $post['inserted_on']=date('Y-m-d h:i:s');
      $this->db->insert($this->table_name,$post);
     return  $this->db->insert_id();
      
   }
   
   function user_update($table_name,$post){
      if($post['password'] == ''){
          unset($post['password']);
      }else{
          $post['password']=  base64_encode(md5($post['password']));
      }  if($_FILES){
       $post['avatar']=$_FILES['photo']['name'];
      }else{
          unset($post['photo']);
      }
      
      $post['updated_on']=date('Y-m-d h:i:s');
     $this->db->where('user_id',$post['user_id']);
    $check= $this->db->update($table_name,$post);
   
    return $check;
      }
   public function all(){
       $this->db->from('roles');
       $query=$this->db->get();
       return $query->result_array();
   }
    
   
   
   
    function user_roles($data,$all_modules){
    $array=array('role_name'=>$data['roles'],'description'=>$data['description']);
    $id=$this->create_recorde('roles',$array);  
    //=$this->db->insert_id();
    $check=$this->user_right($id,$data,$all_modules,TRUE);         
    return $check;
    }
    
    function user_roles_update($data,$all_modules){
        
    $array=array('role_name'=>$data['roles'],'description'=>$data['description'],'roles_id'=>$data['roles_id']);
    $update=$this->update_recorde('roles',$array);  
    if($update){
     $this->db->where('roles_id',$data['roles_id']);
     $this->db->delete('rights');
    $check=$this->user_right($data['roles_id'],$data,$all_modules,FALSE);         
    return $check;
    }else{return FALSE;}
    
    }
   
    function user_right($insert_id,$data,$all_modules,$states){
        if($insert_id){
    foreach($all_modules as $value){
        if($states == TRUE){
       $roles=array(
           'can_view'=>0,
           'can_add'=>0,
           'can_update'=>0,
           'can_delete'=>0,
           'roles_id'=>$insert_id,
           'module_id'=>$value['module_id'],
           'inserted_on'=>date('Y-m-d h:i:s'),
           'inserted_by'=>$this->session->userdata('user_id')
           ); 
        }else{
          $roles=array(
           'can_view'=>0,
           'can_add'=>0,
           'can_update'=>0,
           'can_delete'=>0,
           'roles_id'=>$insert_id,
           'module_id'=>$value['module_id'],
           'updated_on'=>date('Y-m-d h:i:s'),
           'inserted_by'=>$this->session->userdata('user_id')
           );  
        }
       
       $this->db->insert('rights',$roles);
       $this->db->where(array('roles_id'=>$insert_id,'module_id'=>$value['module_id']));
        if(isset($data['rights']['view'][$value['module_id']]) == 1){
            
            $view=array(
                'can_view'=>$data['rights']['view'][$value['module_id']]
            );
        }else{
            $view=array(
                'can_view'=>0
            );
        }
                $this->db->update('rights',$view);

        $this->db->where(array('roles_id'=>$insert_id,'module_id'=>$value['module_id']));
        if(isset($data['rights']['add'][$value['module_id']]) == 1){
            $add=array(
                'can_add'=>$data['rights']['add'][$value['module_id']]
            );
            
        }else{
            $add=array(
                'can_add'=>0
            );
        }
        
                $this->db->update('rights',$add);
         $this->db->where(array('roles_id'=>$insert_id,'module_id'=>$value['module_id']));       
        if(isset($data['rights']['update'][$value['module_id']]) == 1){
            $update=array(
                'can_update'=>$data['rights']['update'][$value['module_id']]
            );
            
        }else{
            $update=array(
                'can_update'=>0
            );
        }
         $this->db->update('rights',$update);
         $this->db->where(array('roles_id'=>$insert_id,'module_id'=>$value['module_id']));           
        if(isset($data['rights']['delete'][$value['module_id']]) == 1){
            $delete=array(
                'can_delete'=>$data['rights']['delete'][$value['module_id']]
            );
            
        }else{
            $delete=array(
                'can_delete'=>0
            );
        }
          $this->db->update('rights',$delete);
 
      }
      return true;
    }else{
        
        return false;
    }
     
    }
    
  public function record_info_user($row_id){
       $this->db->from($this->table_name);
       $this->db->where($this->row_id,$row_id);
       $this->db->where('is_del',0);
       $query=$this->db->get();
       return $data=$query->row_array();
  }
    
}
