<?php
class MY_Controller extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->output->set_header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
    $this->data['number_of_pages'] = '50';
    if ($this->uri->segment(3) == 'edit') {
      $this->data['edit'] = TRUE;
    } else {
      $this->data['edit'] = False;
    }

    if ($this->session->userdata('user_role') != 'Admin') {
      $this->data['Rights_check']['view'] = $this->check_rights('view');
      $this->data['Rights_check']['add'] = $this->check_rights('add');
      $this->data['Rights_check']['update'] = $this->check_rights('update');
      $this->data['Rights_check']['delete'] = $this->check_rights('delete');
    } else {

      $this->data['Rights_check']['view'] = TRUE;
      $this->data['Rights_check']['add'] = TRUE;
      $this->data['Rights_check']['update'] = TRUE;
      $this->data['Rights_check']['delete'] = TRUE;
      $this->data['Rights_check']['active'] = TRUE;
    }

    $this->check_login();

    $this->data['segment_1n2'] = $this->uri->segment(1) . '/' . $this->uri->segment(2);

    $this->data['globle_option'] = $this->global_option();
  }
  public function modules($STATUS)
  {

    $this->db->from('modules');
    $this->db->where('is_del', 0);
    $this->db->where('have_child', 1);
    $this->db->where('module_parent_id', 0);
    $this->db->where('status', $STATUS);
    $this->db->order_by('sort_id asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  function check_login()
  {
    if ($this->session->userdata('is_logged_in') == false) {
      redirect('login', 'refresh');
    } else {
      if ($this->session->userdata('user_role') == 'Teacher') {
        $STATUS = 0;
      } else {
        $STATUS = 1;
      }
      $this->data['module'] = $this->modules($STATUS);

      $this->data['module_childs'] = $this->modules_child($STATUS);
      // print_rail($this->data['module_childs']);
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




    if ($this->uri->segment(2)) {

      $this->load->view('template/header_view', $all_data);

      if (in_array($this->uri->segment(3), $this->config->item('config_seg'))) {

        if ($view_name_overwrite !== null) {

          $this->load->view($view_name_overwrite, $all_data);
        } else {

          $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2) . '_form_view', $all_data);
        }
      } else {

        $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2) . '_view', $all_data);
      }
    } else {
      if ($this->uri->segment(2) == 'teacher_logs ') {
        $this->load->view('template/header_view', $all_data);
        if (in_array($this->uri->segment(2), $this->config->item('config_seg'))) {
          if ($view_name_overwrite !== null) {
            $this->load->view($view_name_overwrite, $all_data);
            $this->load->view('template/footer_view', $all_data);
          }
        }
      }
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
    if ($this->uri->segment(2)) {
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

  function modules_child($STATUS)
  {

    $this->db->from('modules');
    $this->db->where('is_del', 0);
    $this->db->where('have_child', 0);
    $this->db->where('is_del', 0);
    $this->db->where('status', $STATUS);
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

  public function multiple_upload($file_data, $chapter_id = 0)
  {
    $this->load->library('upload');
    $number_of_files_uploaded = count($_FILES['photo']['name']);
    // Faking upload calls to $_FILE
    for ($i = 0; $i < $number_of_files_uploaded; $i++) :
      $_FILES['userfile']['name']     = uniqid() . $_FILES['photo']['name'][$i];
      $_FILES['userfile']['type']     = $_FILES['photo']['type'][$i];
      $_FILES['userfile']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
      $_FILES['userfile']['error']    = $_FILES['photo']['error'][$i];
      $_FILES['userfile']['size']     = $_FILES['photo']['size'][$i];
      $config['upload_path'] = './upload/elearning/chapter/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|pdf';
      $config['max_size'] = '2000000';
      $config['remove_spaces'] = true;
      $config['overwrite'] = false;
      $config['max_width'] = '';
      $config['max_height'] = '';
      $this->upload->initialize($config);

      if (!$this->upload->do_upload()) :
        $error = array('error' => $this->upload->display_errors());
      //$this->load->view('upload_form', $error);
      else :
        $insert_file = array(
          'slide_name' => $file_data['slide_name'][$i],
          'path' => $_FILES['userfile']['name'],
          'sort' => $file_data['sort'][$i],
          'inserted_on' => date('Y-m-d h:i:s'),
          'inserted_by' => $this->session->userdata('user_id'),
          'chapter_id' => $chapter_id,
          'slide_type' => $file_data['slide_type'][$i]

        );
        $this->db->insert('elearning_slide', $insert_file);
      //$final_files_data[] = $this->upload->data();
      //$fileName = $_FILES['userfile']['name'];
      //$images[] = $fileName;
      // Continue processing the uploaded data
      endif;
    endfor;

    /*if(!empty($images)){
		$fileName = implode(',',$images);
		$this->welcome->upload_image($this->input->post(),$fileName);
        
	}*/
  }
}
