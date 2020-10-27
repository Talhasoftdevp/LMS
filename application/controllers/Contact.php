<?php
class Contact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(__CLASS__ . '_model');
        $this->table_name = humanize(lcfirst(__CLASS__));
        $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        $this->data['title']=__CLASS__;
       
    }

    public function index() {
        //  $this->data['name']='waqar';
        $this->load_views($this->data);
    }
	
	
	function send()
    {
    	if (defined('BASEPATH') && !$this->input->is_ajax_request()) 
            exit('No direct script access allowed'); 
        //set validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');

        //run validation on form input
        if ($this->form_validation->run() == FALSE)
        {
			
			echo json_encode(array('success' => 'no', 'msg' => validation_errors()));
            //validation fails
            //$this->load->view('contact_form_view');
        }
        else
        {
			$name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            //$to_email = 'sales@worldcompliancecheck.com';
            //$to_email = 'laeeq.zaheer@silversolve.com';
            $to_email = 'info@worldcompliancecheck.com';
            
            //$to_email = 'osama@worldcompliancecheck.com';

            //configure email settings
            $config['protocol'] = 'mail';
           /* $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'umair.silver@gmail.com';
            $config['smtp_pass'] = 'welcome_123';*/
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes
            
	    $this->load->library('email', $config);
            $this->email->initialize($config);                        

            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send())
            {
            
            	$reply = '
		Thank You for contacting World Compliance Check, We will get back to you soon.
				
		Warm Regards,
				
				
		WCC Adminstration
		';
		$this->email->from($to_email, 'worldcompliancecheck');
		$this->email->to($from_email);
		$this->email->subject('Acknowledgement');
		$this->email->message(nl2br($reply));		
		$this->email->send();
		
		echo json_encode(array('success' => 'yes', 'msg' => 'Your mail has been sent successfully!'));
               
            }
            else
            {
                //error
				echo json_encode(array('success' => 'no', 'msg' => 'There is error in sending mail! Please try again later'));
            
            }
		
        }
    }
	
	
	function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/",$str))
        {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
	


}
