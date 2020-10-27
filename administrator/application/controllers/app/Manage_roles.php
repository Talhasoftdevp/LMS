<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage_rols
 *
 * @author waqar
 */
class Manage_roles extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst('Roles_id'));
        $this->data['row_id']=$this->row_id;
        $this->data['title'] = 'Manage Roles';
    }

    function index() {
        $this->data['number_of_records'] = $this->Manage_roles_model->records('roles', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
        $this->data['records'] = $this->Manage_roles_model->records('roles', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, FALSE);
        $this->data['parent_module'] = $this->modules();
        $this->data['module_child'] = $this->modules_child();
        $config['base_url'] = base_url().$this->uri->segment(1).'/'.lcfirst(__CLASS__).'/'.__FUNCTION__;
        $config['total_rows'] = $this->data['number_of_records'];
        $config['per_page'] = $this->data['number_of_pages'];
        $config['full_tag_open']='<p>';
        $config['full_tag_close']='</p>';
        $config['first_link']='FIRST';
        $config['first_tag_open']='<div>';
        $config['first_tag_close']='</div>';
        $config['last_link']='LAST';
        $this->pagination->initialize($config);
        
          $this->load_views($this->data);
    }

    function create() {
        $this->form_validation->set_rules('roles', 'Roles', 'required', array('required' => 'Required %s Name.'));
        //$this->form_validation->set_rules('password', 'Password', 'required');
        //$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            $check = $this->User_model->user_roles($post, $this->all_modules());

            if ($check == true) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Created..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }

    function edit(){
      $this->data['record_info'] = $this->Manage_roles_model->select_row('roles',$this->input->post('record_id'));  
      $this->data['rights'] = $this->Manage_roles_model->record_info('rights','roles_id',$this->input->post('record_id'));  
      $this->data['all_module'] = $this->all_modules();
      $html='';
      foreach($this->data['all_module'] as $key=>$value){
       $name=($value['module_parent_id']==0)? '<strong>'.$value['module_name'].'</strong>' : '--'.$value['module_name'];
        $html .='<tr>';
        $html  .='<td>'.$name.'</td>';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_view'] == 1)? $view='checked="checked"' : $view='';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_add'] == 1)? $add='checked="checked"' : $add='';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_update'] == 1)? $update='checked="checked"' : $update='';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_delete'] == 1)? $delete='checked="checked"' : $delete='';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_view'] == 1)? $view_val='1' : $view_val='0';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_add'] == 1)? $add_val='1' : $add_val='0';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_update'] == 1)? $update_val='1' : $update_val='0';
          (!empty($this->data['rights'][$key]['can_view']) && $this->data['rights'][$key]['can_delete'] == 1)? $delete_val='1' : $delete_val='0';
                  
        
        $html .='<td><input type="checkbox" '.$view.' class="right_view" name="rights[view]['.$value['module_id'].']" value="'.$view_val.'" /></td>
                 <td><input type="checkbox" '.$add.' class="right_add" name="rights[add]['.$value['module_id'].']" value="'.$add_val.'" /></td>
                 <td><input type="checkbox" '.$update.' class="right_update" name="rights[update]['.$value['module_id'].']" value="'.$update_val.'"/></td>
                 <td><input type="checkbox" '.$delete.' class="right_delete" name="rights[delete]['.$value['module_id'].']" value="'.$delete_val.'" /></td>';

        $html .='</tr>';
      }
       echo  json_encode(array('rights'=>$html,'role_name'=>$this->data['record_info']['role_name'],'description'=>$this->data['record_info']['description'],'record_id'=>$this->input->post('record_id')));

    }
    
    
    function update() {
        $this->form_validation->set_rules('roles', 'Roles', 'required', array('required' => 'Required %s Name.'));
        //$this->form_validation->set_rules('password', 'Password', 'required');
        //$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            //  $this->output->enable_profupdateiler(TRUE);   
            $post = $this->input->post();
             $check = $this->User_model->user_roles_update($post, $this->all_modules());

            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }
    
    function delete(){
     $get=$this->db->get_where('roles',array($this->row_id=>$this->input->post('id')))->row_array();
      $this->db->where($this->row_id,$this->input->post('id'));
     if($get['is_del'] == 0){
        $check= $this->db->update('roles',array('is_del'=>1));
     }else if($get['is_del'] == 1){
       $check= $this->db->update('roles',array('is_del'=>0)); 
     }
     
     if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
     
    }
    
    function change_status(){
      $get=$this->db->get_where('roles',array($this->row_id=>$this->input->post('id')))->row_array();
      $this->db->where($this->row_id,$this->input->post('id'));
     if($get['status'] == 0){
        $check= $this->db->update('roles',array('status'=>1));
         if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                die;
          }
     }else if($get['status'] == 1){
       $check= $this->db->update('roles',array('status'=>0)); 
        if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Inactive Successfully..</strong>...Refresh'));
                die;
        }
     }
           
    }
    
  function delete_all(){
     
     $ids= $this->input->post('ids');
     foreach($ids as $id){
         $data[]=array('is_del'=>1,'roles_id'=>$id);
     }
    $check=$this->db->update_batch('roles',$data,'roles_id'); 
   if ($check == TRUE) {
       echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
      } else {
       echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
      }
   
 }  
    
function deleted(){
    $this->data['number_of_records'] = $this->Manage_roles_model->records('roles', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
    $this->data['records'] = $this->Manage_roles_model->records('roles', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
    $this->data['parent_module'] = $this->modules();
    $this->data['module_child'] = $this->modules_child();
    $config['base_url'] = base_url().$this->uri->segment(1).'/'.lcfirst(__CLASS__).'/'.__FUNCTION__;
    $config['total_rows'] = $this->data['number_of_records'];
    $config['per_page'] = $this->data['number_of_pages'];
    $this->pagination->initialize($config);
    $this->load_views($this->data);

}

function purge_all(){
    $ids=$this->input->post('ids');
    $this->db->where_in('roles_id',$ids);
    $check=$this->db->delete('roles');
    if ($check == TRUE) {
       echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
      } else {
       echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
      }
    
}
 function all(){
    $this->data['number_of_records'] = $this->Manage_roles_model->records('roles', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
    $this->data['records'] = $this->Manage_roles_model->all();
    $this->data['parent_module'] = $this->modules();
    $this->data['module_child'] = $this->modules_child();
//    $config['base_url'] = base_url().$this->uri->segment(1).'/'.lcfirst(__CLASS__).'/'.__FUNCTION__;
//    $config['total_rows'] = $this->data['number_of_records'];
//    $config['per_page'] = $this->data['number_of_pages'];
//    $this->pagination->initialize($config);
    $this->load_views($this->data);

}


}
