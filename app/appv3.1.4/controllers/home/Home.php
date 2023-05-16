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
        
        
        $news = $this->Articles_model->get_list(1, NEWS, "", "", "", "", 7, 0);
        $auction = $this->Articles_model->get_list(1, AUCTION, "", "", "", "", 7, 0);
        $document = $this->Articles_model->get_list(1, DOCUMENT, "", "", "", "", 7, 0);
        
        $data['news'] = $news;
        $data['auctions'] = $auction;
        $data['documents'] = $document;
        
        $bdss = $this->Bds_model->get_list_by_top(false, 16, 0);
        $bds_vips = $this->Bds_model->get_list_by_top(true, 10, 0);
        $data['bdss'] = $bdss;
        $data['bds_vips'] = $bds_vips;
        
        
        $news2 = $this->Articles_model->get_list(1, "", "", "", "", "", 5, 0);
        $data['news2'] = $news2;
        
        $data['communes'] = $this->Commune_model->get_list(1);
        
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward(12);
        

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'home/home_view', $data);
        
        $this->_loadFooter();
	}
}