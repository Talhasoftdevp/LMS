<?php
class Settings extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(__CLASS__ . '_model');
		$this->row_id = singular(lcfirst('user_id'));
		$this->data['row_id'] = $this->row_id;
		//$this->table_name = humanize(lcfirst(__CLASS__));
		//$this->row_id = singular(lcfirst(__CLASS__ . '_id'));
		$this->data['title'] = __CLASS__;
	}

	public function index()
	{
		//  $this->data['name']='waqar';
		$this->data['number_of_records'] = $this->Settings_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, TRUE);
		$this->data['records'] = $this->Settings_model->records($this->data['number_of_pages'], $this->uri->segment(4), FALSE, FALSE);
		$config['base_url'] = base_url() . $this->uri->segment(1) . '/' . lcfirst(__CLASS__) . '/' . __FUNCTION__;
		$config['total_rows'] = $this->data['number_of_records'];
		$config['per_page'] = $this->data['number_of_pages'];
		$this->pagination->initialize($config);
		//$this->data['roles_recorde']=$this->Manage_roles_model->active_records();
		$this->load_views($this->data);
	}


	function create()
	{
		if ($this->check_subscriber() >= $this->session->userdata('no_of_subusers')) {
			echo '<script>alert("you are not allowed to Add more subscribers");</script>';
			redirect(base_url() . $this->uri->segment(1), 'refresh');
		} else {
			$this->load_views($this->data, 'settings_form_view');
		}
	}

	function create_action()
	{

		if ($this->check_subscriber() >= $this->session->userdata('no_of_subusers')) {
			echo json_encode(array('success' => 'no', 'msg' => 'you are not allowed to Add more subscribers'));
		} else {
			$this->form_validation->set_rules('user_name', 'Company Name', 'required|trim');
			//$this->form_validation->set_rules('no_of_subusers', 'No of subusers', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
			} else {
				$post = $this->input->post();
				$post['parent_id'] = $this->session->userdata('addteacher_id');
				$check = $this->Settings_model->create_user($post);
				if ($check == TRUE) {
					echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Create..</strong>..Refresh'));
				} else {
					echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
				}
			}
		}
	}

	function edit()
	{
		$this->data['record_info'] = $this->Settings_model->record_info_user($this->uri->segment(3));
		$this->data['edit'] = true;
		$this->load_views($this->data, 'settings_form_view');
	}


	function update_action()
	{
		$this->form_validation->set_rules('user_name', 'Company Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
		} else {
			$post = $this->input->post();
			$check = $this->Settings_model->user_update('addteacher', $post);

			if ($check == TRUE) {
				echo json_encode(array('success' => 'yes', 'msg' => '<strong>Successfully Update..</strong>..Refresh'));
			} else {
				echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
			}
		}
	}

	function check_subscriber()
	{
		$this->db->from('addteacher');
		$this->db->where(array('parent_id' => $this->session->userdata('addteacher_id')));
		return $this->db->count_all_results();
	}


	function delete()
	{
		$this->db->where('user_id', $this->uri->segment(3));
		$chk = $this->db->delete('addteacher');
		if ($chk) {
			echo json_encode(array('success' => 'yes', 'msg' => '<strong>Recorde Delete Successfully..</strong>...Refresh'));
		} else {
			echo json_encode(array('success' => 'no', 'msg' => 'Some Bad Happening..Contact to developer'));
		}
	}
}
