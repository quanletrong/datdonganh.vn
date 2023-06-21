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
        $id_user = $this->_session_uid();
        $uinfo = $this->Account_model->get_user_info_by_uid($id_user);
        if(!empty($uinfo)) {
            //post
            $fullname    = removeAllTags($this->input->post('fullname'));
            $email       = removeAllTags($this->input->post('email'));
            $phonenumber = removeAllTags($this->input->post('phonenumber'));
            $avatar      = $uinfo['avatar'];

            //check post
            if(strlen($fullname) > 256) {
                resError('Tên tài khoản không quá 256 ký tự');
            }
            if(!validEmail($email)) {
                resError('Email không đúng định dạng');
            }
            if(!str_valid_phone($phonenumber)) {
                resError('Số điện thoại không đúng định dạng');
            }
            
            // check email đã tồn tại
            if($email != $uinfo['email']) {
                $uinfoEmail = $this->Account_model->get_user_info_by_email($email);
                if(!empty($uinfoEmail)) {
                    resError('Email đã tồn tại. Vui lòng chọn email khác. Hoặc liên hệ với chúng tôi để được cập nhật email này.');
                }
            }
            
            // check phonenumber đã tồn tại
            if($phonenumber != $uinfo['phonenumber']) {
                $uinfoPhone = $this->Account_model->get_user_info_by_phone($phonenumber);
                if(!empty($uinfoPhone)) {
                    resError('Số điện thoại đã tồn tại. Vui lòng chọn số khác. Hoặc liên hệ với chúng tôi để được cập nhật sô điện thoại này.');
                }
            }

            // save
            $edit_chk = $this->Account_model->edit($fullname, $email, $phonenumber, $avatar, $id_user);
            $edit_chk ? resSuccess('Thành công') : resError('Lỗi lưu dữ liệu');
            
        } else{
            resError('User không tồn tại');
        }
    }

    function ajax_edit_password() {
        $id_user = $this->_session_uid();
        $uinfo = $this->Account_model->get_user_info_by_uid($id_user);
        if(!empty($uinfo)) {
            //post
            $password_new = removeAllTags($this->input->post('password_new'));

            //check post
            if(strlen($password_new) < 6) {
                resError('Mật khẩu tối thiểu 6 ký tự');
            }
            $password_new_hash = PasswordHash::hash($uinfo['username'], md5($password_new));
            $edit_chk = $this->Account_model->edit_password($password_new_hash, $id_user);
            $edit_chk ? resSuccess('Thành công') : resError('Lỗi lưu dữ liệu');
            
            
        } else{
            resError('User không tồn tại');
        }
    }
}