<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
  
	}
    
    function index(){
        if ($this->_isLogin()) {
            redirect(site_url(""));
            die();
        }
        $data = [];
        
        $this->load->view($this->_template_f . 'signup/signup_view', $data);
    }
}
