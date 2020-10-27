<?php
class Settings_model extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->table_name = 'addteacher';
  }
  /*public function recorde(){
		
		$this->db->from('modules');
		$this->db->where('is_del',0);
		$this->db->where('status',1);
		$query=$this->db->get();
		return $query->result_array();
	
	}*/
  public function records($number_of_pages, $offset, $deleted = null, $count_all_records = null)
  {
    $this->db->from($this->table_name);
    ($deleted == TRUE) ? $this->db->where(array('is_del' => 1, 'status' => 1, 'parent_id' => $this->session->userdata('user_id'))) : $this->db->where(array('is_del' => 0, 'status' => 1, 'parent_id' => $this->session->userdata('user_id')));
    if ($count_all_records == TRUE) {
      return $this->db->count_all_results();
    } else {

      $this->db->limit($number_of_pages, $offset);
      //    $this->db->order_by($this->order_by);
      $query = $this->db->get();
      return $query->result_array();
    }
  }

  function create_user($post)
  {
    $post['password'] = base64_encode(md5($post['password']));
    $post['inserted_on'] = date('Y-m-d h:i:s');
    $this->db->insert($this->table_name, $post);
    return  $this->db->insert_id();
  }

  function user_update($table_name, $post)
  {
    if ($post['password'] == '') {
      unset($post['password']);
    } else {
      $post['password'] =  base64_encode(md5($post['password']));
    }
    if ($_FILES) {
      $post['avatar'] = $_FILES['photo']['name'];
    } else {
      unset($post['photo']);
    }
    $post['updated_on'] = date('Y-m-d h:i:s');
    $this->db->where('user_id', $post['user_id']);
    $check = $this->db->update($table_name, $post);

    return $check;
  }

  public function record_info_user($row_id)
  {
    $this->db->from($this->table_name);
    $this->db->where($this->row_id, $row_id);
    $this->db->where('is_del', 0);
    $query = $this->db->get();
    return $data = $query->row_array();
  }
}
