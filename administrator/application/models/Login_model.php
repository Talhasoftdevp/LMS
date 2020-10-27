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

        $this->db->from('user');
        $this->db->where('user_name ', $post['user_name']);
        $this->db->where('password', base64_encode(md5($post['password'])));
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result_array();
        if ($query->num_rows() > 0) {
            $array = array(
                'username' => $data[0]['user_name'],
                'photo' => $data[0]['avatar'],
                'user_id' => $data[0]['user_id'],
                'user_role' => $data[0]['user_role'],
                'is_logged_in' => TRUE
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
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('avatar');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('roles_id');
        $this->session->unset_userdata('is_logged_in', FALSE);
        $this->session->set_flashdata('msg', '<strong>Logout Successfully.</strong>');
        //  $this->session->set_flashdata('msg','<strong>Logout Successfully.</strong>');
        redirect('login?msg=logout');
    }
}
