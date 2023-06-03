<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->load->model('account/Account_model');
        $this->load->model('bds/Bds_model');
        
        if (!$this->_isLogin())
        {
            if ($this->input->is_ajax_request())
            {
                echo 'unlogin';
                die();
            }
            $currUrl = getCurrentUrl();
            dbClose();
            redirect(site_url(LINK_USER_LOGIN.'/?url=' . urlencode($currUrl), $this->_langcode));
            die();
        }
	}

	function index()
	{
        $data = [];
        
        $header = [
            'title' => 'Thông tin tài khoản',
            'active_link' => '',
            'header_page_css_js' => ''
        ];
        
        
        $this->_loadHeader($header);
        
        $favorite = $this->Bds_model->get_all_favorite_bds_by_user($this->_session_uid());
        
        $data['list_bds'] = $favorite['list'];
        $data['cf_bds'] = $this->config->item('bds');
        $this->load->view($this->_template_f . 'account/account_view', $data);
        
        $this->_loadFooter();
	}
}