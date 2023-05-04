<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

    function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();

        // model
        $this->load->model('login/Login_model');
        $this->load->model('account/Account_model');
    }

    function auth()
    {
        $currUrl = removeAllTags($this->input->get('url'));
        $userame = removeAllTags($this->input->post('username'));
        $password = removeAllTags($this->input->post('password'));
        // validate current url for redirect
        if($currUrl != '')
        {
            // check is url
            if(isUrl($currUrl))
            {
                // check domain of url
                $currUrl = strtolower(getDomainFromUrl($currUrl)) ==  strtolower(DOMAIN_NAME) ? $currUrl : '';
            }
            else
            {
                $currUrl = '';
            }
        }

        $currUrl = $currUrl != '' ? $currUrl : site_url('home', $this->_langcode);

        if($userame =='admin' && md5($password) == md5('admin1234')) 
        {

            $userInfo['role']          = 1;
            $userInfo['user_id']       = 1;
            $userInfo['username']      = 'Administrator';
            $userInfo['phone']         = '0987654321';
            $userInfo['email_address'] = 'admin@datdonganh.vn';
            
            // unset all session before init
            session_unset();
            session_regenerate_id(true);

            $this->session->set_userdata('uname', $userInfo['username']);
            $this->session->set_userdata('uid', $userInfo['user_id']);
            $this->session->set_userdata('role', $userInfo['role']);
            $this->session->set_userdata('phone', $userInfo['phone']);
            $this->session->set_userdata('email', $userInfo['email_address']);
   
            //Update login date TODO: có dùng
            // $this->Login_model->user_last_login_log($userInfo['user_id']);
			
            dbClose();
            redirect(urldecode($currUrl));
            die();
        }
        else
        {
            dbClose();
            //redirect to login
            redirect(site_url('login?url=' . urlencode($currUrl), $this->_langcode));
            die();
        }
    }

    function index()
    {
        $currUrl = removeAllTags(urldecode($this->input->get('url')));
        // validate current url for redirect
        if($currUrl != '')
        {
            // check is url
            if(isUrl($currUrl))
            {
                // check domain of url
                $currUrl = strtolower(getDomainFromUrl($currUrl)) ==  strtolower(DOMAIN_NAME) ? $currUrl : '';

            }
            else
            {
                $currUrl = '';
            }
        }
        $currUrl = $currUrl != '' ? $currUrl : site_url('home', $this->_langcode);

        // da login
        if($this->_islogin())
        {
            dbClose();

            $login_url = site_url('login', $this->_langcode);
            if($currUrl != $login_url)
            {
                redirect($currUrl);
                die();
            }
            else
            {
                redirect(site_url('home', $this->_langcode));
                die();
            }
        }
        else
        {
            $data['currUrl'] = $currUrl;
            $this->load->view($this->_template_f . 'login/login_view', $data);
        }
    }
}