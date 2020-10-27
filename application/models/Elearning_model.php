<?php
class Elearning_model extends MY_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->table_name = lcfirst(singular(rtrim(__CLASS__, '_model')));
    $this->row_id = 'user_id';
  }
  public function user_login_db($post)
  {
    $this->db->from('elearning_user');
    $this->db->where('email ', $post['email']);
    $this->db->where('password', base64_encode(md5($post['password'])));
    $this->db->where('status', 1);
    $this->db->limit(1);
    $query = $this->db->get();
    $data = $query->result_array();
    if ($query->num_rows() > 0) {
      $array = array(
        'e_portal_user_id' => $data[0]['user_id'],
        'e_portal_user_name' => $data[0]['user_name'],
        'e_portal_user_email' => $data[0]['email'],
        'elearn_photo' => $data[0]['avatar'],
        'is_elearn_logged_in' => TRUE
      );
      $this->session->set_userdata($array);
      $login_info = array();
      date_default_timezone_set("Asia/Karachi");
      $login_info['table_record_id'] = $data[0]['user_id'];
      $login_info['table_name'] = 'user';
      $login_info['user_id'] = $data[0]['user_id'];
      $login_info['user_name'] = $data[0]['user_name'];
      $login_info['user_type'] = 'Parent';
      $login_info['family_code'] =  $data[0]['email'];
      $login_info['flag'] = 'LOGIN';
      $login_info['message'] = 'User Logged In';
      $login_info['timestamp'] = date('Y-m-d h:i:s');
      $this->db->insert('user_activity', $login_info);
      redirect(lcfirst(rtrim(__CLASS__, '_model')));
    } else {
      $this->session->set_flashdata('msg', '<strong>Invalid Username/Password.</strong>');
      redirect(lcfirst(rtrim(__CLASS__, '_model')));
    }
  }

  public function user_logout()
  {
    $logout_info = array();
    date_default_timezone_set("Asia/Karachi");
    $logout_info['table_record_id'] = $this->session->userdata('e_portal_user_id');;
    $logout_info['table_name'] = 'user';
    $logout_info['user_id'] = $this->session->userdata('e_portal_user_id');
    $logout_info['user_name'] = $this->session->userdata('e_portal_user_name');
    $logout_info['family_code'] = $this->session->userdata('e_portal_user_email');
    $logout_info['user_type'] = 'Parent';
    $logout_info['flag'] = 'LOGOUT';
    $logout_info['message'] = 'User Logged Out';
    $logout_info['timestamp'] = date('Y-m-d h:i:s');
    $this->db->insert('user_activity', $logout_info);
    $this->session->unset_userdata('e_portal_user_name');
    $this->session->unset_userdata('e_portal_user_email');
    $this->session->unset_userdata('elearn_photo');
    $this->session->unset_userdata('e_portal_user_id');
    $this->session->unset_userdata('is_elearn_logged_in', FALSE);
    $this->session->set_flashdata('msg', '<strong>Logout Successfully.</strong>');
    redirect(base_url() . 'elearning');
  }

  public function get_quizes($user_id)
  {
    $this->db->select('elearning_assignment.*, classes.class');
    $this->db->from('elearning_assignment');
    $this->db->where('elearning_assignment.user_id', $user_id);
    $this->db->join('classes', 'classes.Id = elearning_assignment.presentation_id', 'left');
    $query = $this->db->get();
    $data = $query->result_array();
    return $data;
  }
}
