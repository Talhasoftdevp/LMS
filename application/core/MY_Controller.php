<?php
class MY_Controller extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->output->set_header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
    $this->data['number_of_pages'] = '5';
    if ($this->uri->segment(3) == 'edit') {
      $this->data['edit'] = TRUE;
    } else {
      $this->data['edit'] = False;
    }

    if ($this->session->userdata('user_id') > 1) {
      $this->data['Rights_check']['view'] = $this->check_rights('view');
      $this->data['Rights_check']['add'] = $this->check_rights('add');
      $this->data['Rights_check']['update'] = $this->check_rights('update');
      $this->data['Rights_check']['delete'] = $this->check_rights('delete');
    } else {

      $this->data['Rights_check']['view'] = TRUE;
      $this->data['Rights_check']['add'] = TRUE;
      $this->data['Rights_check']['update'] = TRUE;
      $this->data['Rights_check']['delete'] = TRUE;
    }

    //$this->check_login();

    $this->data['segment_1n2'] = $this->uri->segment(1) . '/' . $this->uri->segment(2);

    $this->data['globle_option'] = $this->global_option();
  }
  public function modules()
  {

    $this->db->from('modules');
    $this->db->where('is_del', 0);
    $this->db->where('have_child', 1);
    $this->db->where('module_parent_id', 0);
    $this->db->where('status', 1);
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  function check_login()
  {
    if ($this->session->userdata('is_front_logged_in') == false) {
      redirect('login', 'refresh');
    } else {

      // if($this->session->userdata('user_id') > 1){
      // $this->data['module']=$this->modules_with_rights($this->session->userdata('roles_id'));
      // $this->data['module_childs']=$this->modules_with_rights_childe($this->session->userdata('roles_id'));
      //}else{
      $this->data['module'] = $this->modules();
      $this->data['module_childs'] = $this->modules_child();
      //  }  

    }
  }

  function check_elearning_login()
  {
    if ($this->session->userdata('is_elearn_logged_in') == false) {
      redirect(base_url() . 'elearning', 'refresh');
    } else {

      // if($this->session->userdata('user_id') > 1){
      // $this->data['module']=$this->modules_with_rights($this->session->userdata('roles_id'));
      // $this->data['module_childs']=$this->modules_with_rights_childe($this->session->userdata('roles_id'));
      //}else{
      $this->data['module'] = $this->modules();
      $this->data['module_childs'] = $this->modules_child();
      //  }  

    }
  }
  function modules_with_rights($roles_id)
  {
    $this->db->select('r.*,m.*');
    $this->db->from('rights r');
    $this->db->join('modules m', 'm.module_id=r.module_id');
    $this->db->where('m.module_parent_id', 0);
    $this->db->where(array('r.is_del' => 0, 'r.roles_id' => $roles_id, 'r.can_view' => 1));
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  function modules_with_rights_childe($roles_id)
  {
    $this->db->select('r.*,m.*');
    $this->db->from('rights r');
    $this->db->join('modules m', 'm.module_id=r.module_id');
    $this->db->where('m.module_parent_id !=', 0);
    $this->db->where(array('r.is_del' => 0, 'r.roles_id' => $roles_id, 'r.can_view' => 1));
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  function load_views($all_data, $view_name_overwrite = null)
  {

    if ($this->uri->segment(1)) {

      $this->load->view('template/header_view', $all_data);
      if (in_array($this->uri->segment(2), $this->config->item('config_seg'))) {

        if ($view_name_overwrite !== null) {

          $this->load->view($view_name_overwrite, $all_data);
        } else {

          $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2) . '_form_view', $all_data);
        }
      } else {
        if ($view_name_overwrite !== null) {
          $this->load->view($this->uri->segment(1) . '_form_view', $all_data);
        } else {

          $this->load->view($this->uri->segment(1) . '_view', $all_data);
        }
      }
    } else {
    }
    if ($this->uri->segment_array()) {

      if (empty($all_data['current_js'])) {


        $all_data['current_js'] = APPPATH . 'views/' . $this->uri->segment(1) . '/javascript/' . $this->uri->segment(2) . '_js.php';
      } else {
        $all_data['current_js'] = $all_data['current_js'];
      }
    } else {


      $all_data['is_home'] = TRUE;
      $this->load->view('template/header_view', $all_data);
      $this->load->view('home_view', $all_data);
      $this->load->view('template/footer_view', $all_data);
    }
    if ($this->uri->segment(1)) {
      $this->load->view('template/footer_view', $all_data);
    }
  }


  function check_rights($rights)
  {
    // $this->output->enable_profiler(TRUE);
    $this->db->select('r.*,m.*');
    $this->db->from('rights r');
    $this->db->join('modules m', 'm.module_id=r.module_id');
    $this->db->where('r.roles_id', $this->session->userdata('roles_id'));
    $this->db->where('r.can_' . $rights, 1);
    $query = $this->db->get();
    if ($query->num_rows() === 0) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function modules_child()
  {

    $this->db->from('modules');
    $this->db->where('is_del', 0);
    $this->db->where('have_child', 0);
    $this->db->where('is_del', 0);
    $this->db->where('status', 1);
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  function all_modules()
  {
    $this->db->from('modules');
    $this->db->where('is_del', 0);
    $this->db->where('status', 1);
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }
  function get_textbox_with_div($labels, $classes, $ids, $name, $value, $number_of_textbox)
  {

    if (count($classes) == $number_of_textbox && count($ids) == $number_of_textbox) {

      $textbox = '';
      for ($attri = 0; $attri <= $number_of_textbox - 1; $attri++) {
        //  ($value[$attri] =='')?$values='' : $values=$value[$attri] ;

        $class = $classes[$attri];
        $id = $ids[$attri];
        $label = $labels[$attri];

        ($value == '') ? $values = $value[$attri] : $values = '';
        $textbox .= '<div class="control-group">											
        <label class="control-label" for="' . $label . '">' . $label . '</label>
        <div class="controls">
        <input type="text" class="' . $class . '" id="' . $id . '" value="' . $values . '" />
        </div> 				
        </div>';
      }
      return $textbox;
    } else if (count($classes) != $number_of_textbox && count($ids) != $number_of_textbox) {
      return $error = 'Missing Some Thing In Input Attributes';
    }
  }


  function last_insert_record_plus_one()
  {
    $this->db->from($this->table_name);
    $this->db->where('is_del', 0);
    $this->db->where('status', 1);
    $this->db->limit(1);
    $this->db->order_by($this->row_id, 'DESC');
    $query = $this->db->get();
    $data = $query->result_array();
    //print_r($data);
    //die;

    return (!empty($data)) ? $data[0][$this->row_id] : 1;
  }

  function global_option()
  {

    $this->load->model('Globle_option_model');
    return  $this->Globle_option_model->all();
  }
}
