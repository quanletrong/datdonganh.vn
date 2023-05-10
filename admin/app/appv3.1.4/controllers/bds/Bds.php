<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bds extends MY_Controller {
	
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
        $this->load->model('street/Street_model');
        $this->load->model('commune/Commune_model');
        $this->load->model('bds/Bds_model');
	}

	function index()
	{
        $data = [];
        if($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Danh sách bài đăng bất động sản',
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];
        
        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        $this->_loadFooter();
	}

    function add()
	{
        $data = [];
        if($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        
        $list_street =  $this->Street_model->get_list('1'); // đường đang hoạt động
        $list_commune =  $this->Commune_model->get_list('1'); // đường đang hoạt động

        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;

        $header = [
            'title' => 'Danh sách bài đăng bất động sản',
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];
        
        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_add_view', $data);
        $this->_loadFooter();
	}
    
    function add_submit()
	{
        $data = [];
        if($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        var_dump($_POST);
        $street = $this->input->post('street');
        $commune = $this->input->post('commune');
        $maps = $this->input->post('maps', false);
        $maps = (htmlentities(htmlspecialchars($maps))); // to save db // var_dump(html_entity_decode(htmlspecialchars_decode($maps))); // to render
        $type = $this->input->post('type');
        $title = $this->input->post('title');
        $tag = $this->input->post('tag');
        $sapo = $this->input->post('sapo');
        $content = $this->input->post('content');
        $price = $this->input->post('price');
        $direction = $this->input->post('direction');
        $toilet = $this->input->post('toilet');
        $floor = $this->input->post('floor');
        $expired = $this->input->post('expired');
        $acreage = $this->input->post('acreage');
        $road_surface = $this->input->post('road_surface');
        $bedroom = $this->input->post('bedroom');
        $is_hot = $this->input->post('is_hot');
        $noithat = $this->input->post('noithat');
        $juridical = $this->input->post('juridical');
        $image = $this->input->post('image');
        $video = $this->input->post('video');
        
        redirect('bds');
	}
}