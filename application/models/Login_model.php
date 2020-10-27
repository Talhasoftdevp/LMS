<?php
class Login_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = lcfirst(singular(rtrim(__CLASS__, '_model')));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
    }
    public function user_login_db($post)
    {
        // print_r($post);        
        $this->db->from('addteacher');
        $this->db->where('email ', $post['email']);
        $this->db->where('password', base64_encode(md5($post['password'])));
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result_array();
        if ($query->num_rows() > 0) {
            $array = array(
                'company_name' => $data[0]['user_name'],
                'no_of_subusers' => $data[0]['no_of_subusers'],
                'front_email' => $data[0]['email'],
                'front_photo' => $data[0]['avatar'],
                'addteacher_id' => $data[0]['user_id'],
                'parent_id' => $data[0]['roles_id'],
                'is_front_logged_in' => TRUE
            );
            $this->session->set_userdata($array);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('msg', '<strong>Invalid Username/Password.</strong>');
            redirect('login?msg=no');
        }
    }

    public function user_logout()
    {
        $this->session->unset_userdata('company_name');
        $this->session->unset_userdata('no_of_subusers');
        $this->session->unset_userdata('front_email');
        $this->session->unset_userdata('front_photo');
        $this->session->unset_userdata('addteacher_id');
        $this->session->unset_userdata('parent_id');
        $this->session->unset_userdata('is_front_logged_in', FALSE);
        $this->session->set_flashdata('msg', '<strong>Logout Successfully.</strong>');
        //  $this->session->set_flashdata('msg','<strong>Logout Successfully.</strong>');
        redirect('login?msg=logout');
    }
}
