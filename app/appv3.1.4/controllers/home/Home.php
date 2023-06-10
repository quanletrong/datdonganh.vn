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
        
        $time_start = microtime(true); 
        $data['news']                            = $this->Articles_model->get_list(NEWS, "", 7, 0);
        $data['auctions']                        = $this->Articles_model->get_list(AUCTION, "", 7, 0);
        $data['documents']                       = $this->Articles_model->get_list(DOCUMENT, "", 7, 0);
        $data['total_bds_active']                = $this->Bds_model->get_total_bds_active();
        $data['bds_new_most']                    = $this->Bds_model->get_list_by_top(false, 0, 12, 0);
        $data['bds_home_vip']                    = $this->Bds_model->get_list_vip_home(6, 0);
        $data['news2']                           = $this->Articles_model->get_list("", "", 5, 0);
        $data['communes']                        = $this->Commune_model->get_list(1);
        $data['street_and_num_bds']              = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price']            = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage']          = $this->Bds_model->get_num_bds_by_acreage();
        $data['commune_ward_and_num_bds']        = $this->Bds_model->get_num_bds_by_commune_ward();
        echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);
        die;
        $data['commune_ward_and_num_bds_chunk3'] = array_chunk($data['commune_ward_and_num_bds'], 3);
        $data['cf_bds']                          = $this->config->item('bds');

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'home/home_view', $data);
        $this->_loadFooter();
	}
}