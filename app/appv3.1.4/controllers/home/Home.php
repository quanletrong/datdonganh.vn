<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->load->model('articles/Articles_model');
        $this->load->model('bds/Bds_model');
        $this->load->model('commune/Commune_model');
        
        
	}

	function index()
	{
        $data = [];
        
        $header = [
            'title' => 'Trang chủ',
            'active_link' => 'home',
            'header_page_css_js' => 'home'
        ];
        
        $data['cf_bds'] = $this->config->item('bds');
        
        $news = $this->Articles_model->get_list(NEWS, "", 7, 0);
        $auction = $this->Articles_model->get_list(AUCTION, "", 7, 0);
        $document = $this->Articles_model->get_list(DOCUMENT, "", 7, 0);
        
        $data['news'] = $news;
        $data['auctions'] = $auction;
        $data['documents'] = $document;
        
        $home_vip = $this->Bds_model->get_list_vip_home(6, 0);

        // $limit_thuong = count($home_vip) <=6 ? 6 : count($home_vip)*2;

        
        $bdss = $this->Bds_model->get_list_by_top(false, 0, 12, 0);
        $data['bdss'] = $bdss;
        $data['home_vip'] = $home_vip;
        
        $news2 = $this->Articles_model->get_list("", "", 5, 0);
        $data['news2'] = $news2;
        
        $data['communes'] = $this->Commune_model->get_list(1);
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward();
        $data['commune_ward_and_num_bds_chunk3'] = array_chunk($data['commune_ward_and_num_bds'], 3);
        $data['street_and_num_bds'] = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price'] = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage'] = $this->Bds_model->get_num_bds_by_acreage();

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'home/home_view', $data);
        
        $this->_loadFooter();
	}
}