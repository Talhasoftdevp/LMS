<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manage_rols
 *
 * @author HP
 */
class Globle_option extends MY_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model(__CLASS__.'_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__.'_id'));
        $this->data['row_id']=$this->row_id;
        $this->data['title'] = 'Globle Option';
        
    }

    function index() {
//        $this->data['number_of_records'] = $this->Globle_option_model->records('user', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
//        $this->data['records'] = $this->Globle_option_model->records('user', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, FALSE);
//        $config['base_url'] = base_url().$this->uri->segment(1).'/'.lcfirst(__CLASS__).'/'.__FUNCTION__;
//        $config['total_rows'] = $this->data['number_of_records'];
//        $config['per_page'] = $this->data['number_of_pages'];
//        $this->pagination->initialize($config);
//       // 
        $this->data['record_info']=$this->Globle_option_model->record_info($this->session->userdata('user_id'));
        //print_r($this->data['record_info']);
        $this->load_views($this->data);
    }

    function create_action() {
        $this->form_validation->set_rules('Name', 'Name', 'required', array('required' => 'Required %s Name.'));
       // $this->form_validation->set_rules('roles_id', 'Roles', 'required', array('required' => 'Required %s Roles.'));
       // $this->form_validation->set_rules('contact_no', 'Contact No', 'required',array('required' => 'Required %s Contact No.'));
       // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array('required' => 'Invalid %s Fomate.'));
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            ($_FILES) ? $this->do_upload('photo') : '';
            $check = $this->Globle_option_model->create_record($post);

            if ($check != '') {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Created..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }

    function edit(){
      $this->data['record_info'] = $this->Globle_option_model->record_info($this->uri->segment(4)); 
      $this->load->views($this->data);
    }
    
    
    function update_action() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Required %s Name.'));
       // $this->form_validation->set_rules('roles_id', 'Roles', 'trim|required', array('required' => 'Required %s Name.'));
       // $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
       // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array('required' => 'Invalid %s Fomate.'));
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
        } else {
            $post = $this->input->post();
            ($_FILES) ? $this->do_upload('photo') : '';
            $check = $this->Globle_option_model->update_record($post);
            if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
        }
    }
    
    function delete(){
     $get=$this->db->get_where('user',array($this->row_id=>$this->input->post('id')))->row_array();
      $this->db->where($this->row_id,$this->input->post('id'));
     if($get['is_del'] == 0){
        $check= $this->db->update('user',array('is_del'=>1));
     }else if($get['is_del'] == 1){
       $check= $this->db->update('user',array('is_del'=>0)); 
     }
     
     if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
            } else {
                echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
            }
     
    }
    
    function change_status(){
      $get=$this->db->get_where('user',array($this->row_id=>$this->input->post('id')))->row_array();
      $this->db->where($this->row_id,$this->input->post('id'));
     if($get['status'] == 0){
        $check= $this->db->update('user',array('status'=>1));
         if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Active Successfully..</strong>...Refresh'));
                die;
          }
     }else if($get['status'] == 1){
       $check= $this->db->update('user',array('status'=>0)); 
        if ($check == TRUE) {
                echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Inactive Successfully..</strong>...Refresh'));
                die;
        }
     }
           
    }
    
  function delete_all(){
     
     $ids= $this->input->post('ids');
     foreach($ids as $id){
         $data[]=array('is_del'=>1,'user_id'=>$id);
     }
    $check=$this->db->update_batch('user',$data,'user_id'); 
   if ($check == TRUE) {
       echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
      } else {
       echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
      }
   
 }  
    
function deleted(){
    $this->data['number_of_records'] = $this->Globle_option_model->records('user', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, TRUE);
    $this->data['records'] = $this->Globle_option_model->records('user', $this->data['number_of_pages'], $this->uri->segment(4), TRUE, FALSE);
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
    $this->db->where_in('user_id',$ids);
    $check=$this->db->delete('user');
    if ($check == TRUE) {
       echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Permanent Delete Successfully..</strong>...Refresh'));
      } else {
       echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
      }
    
}
 function all(){
    $this->data['number_of_records'] = $this->Globle_option_model->records('user', $this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
    $this->data['records'] = $this->Globle_option_model->all();
    $this->data['parent_module'] = $this->modules();
    $this->data['module_child'] = $this->modules_child();
    $this->load_views($this->data);

}
 function do_upload($image) {
        $config['upload_path'] = './upload/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        //                $config['max_size']             = 100;
        //                $config['max_width']            = 1024;
        //                $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($image)) {
            echo json_encode(array('success' => 'no', 'msg' => $this->upload->display_errors()));
        } else {
            $this->upload->data($image);
        }
    }
}
