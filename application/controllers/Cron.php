<?php
class Cron extends MY_Controller {

    function __construct() {
        parent::__construct();
        
		
       
    }

	function expire(){		
		$this->db->from('elearning_assignment');
		$this->db->where('status', 0);
		$this->db->where("DATE_FORMAT(expiry,'%Y-%m-%d') <= CURDATE()");
		$this->db->where("DATE_FORMAT(expiry,'%Y-%m-%d') <> '0000-00-00'");
		$check = $this->db->update('elearning_assignment',array('status'=>3, 'updated_on'=>date('Y-m-d h:i:s')));     
    }
	
}
