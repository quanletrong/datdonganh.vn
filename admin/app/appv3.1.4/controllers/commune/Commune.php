<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commune extends MY_Controller {
	
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

        // model
         $this->load->model('commune/Commune_model');
	}

	function index()
	{
        $data = [];
        if($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Quản lý danh sách xã phường thị trấn',
            'active_link' => 'commune',
            'header_page_css_js' => 'commune'
        ];

        if(isset($_POST['commune_name'])) {
            $commune_name = $this->input->post('commune_name');
            $commune_type = $this->input->post('commune_type');
            $commune_image = $this->input->post('commune_image');

            if($commune_name != '' && $commune_type != '' && $commune_image != '') {
                $exc = $this->Commune_model->add($commune_name, $commune_type, $commune_image, $this->_session_uid());
                $data['error_add'] = $exc;
            } else {
                $data['error_add'] = true;
            }

        }

        $list_commune =  $this->Commune_model->get_list();
        $data['list_commune'] = $list_commune;

        $data['cf_commune'] = $this->config->item('commune');
        
        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'commune/commune_view', $data);
        $this->_loadFooter();
	}
}
