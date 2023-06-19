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
        $tab = removeAllTags($this->input->get('tab'));
        $tab = in_array($tab, ['favoritebds', 'accountDetail', 'accountPassword']) ? $tab : 'favoritebds';

        $favorite = $this->Bds_model->get_all_favorite_bds_by_user($this->_session_uid());
        $uinfo = $this->Account_model->get_user_info_by_uid($this->_session_uid());
        
        $data['tab'] = $tab;
        $data['uinfo']    = $uinfo;
        $data['list_bds'] = $favorite['list'];
        $data['cf_bds']   = $this->config->item('bds');

        $header = [
            'title' => 'Thông tin tài khoản',
            'active_link' => '',
            'header_page_css_js' => ''
        ];
        
        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'account/account_view', $data);
        $this->_loadFooter();
	}

    function ajax_edit_uinfo() {
        echo json_encode(['success'=>true]);
    }
}