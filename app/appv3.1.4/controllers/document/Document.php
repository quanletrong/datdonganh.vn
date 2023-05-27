<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		
        if (!$this->_isLogin())
        {
            if ($this->input->is_ajax_request())
            {
                echo 'unlogin';
                die();
            }
            $currUrl = getCurrentUrl();
            dbClose();
            redirect(site_url('login/?url=' . urlencode($currUrl), $this->_langcode));
            die();
        }
	}

	function index()
	{
        $data = [];
        
        $header = [
            'title' => 'Danh sách tài liệu',
            'active_link' => 'document',
            'header_page_css_js' => 'document'
        ];
        
        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'document/document_view', $data);
        
        $this->_loadFooter();
	}
}