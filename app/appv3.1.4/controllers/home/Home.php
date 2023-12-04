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
            'title' => 'Đất Đông Anh | Bất động sản Đông Anh',
            'active_link' => 'home',
            'header_page_css_js' => 'home'
        ];
        
        $data['total_bds_active']                = $this->Bds_model->get_total_bds_active();
        $data['bds_vip']                         = $this->Bds_model->get_list_by_top(BDS_VIP, '', '', 100000, 0);
        $data['bds_home_vip']                    = $this->Bds_model->get_list_vip_home(12, 0);                             // tối đa hiện 12 tin vip
        $limit_new_most                          = count($data['bds_home_vip']) < 12 ? 12 : count($data['bds_home_vip']);  // tối thiểu hiện 12 tin thường
        $data['bds_new_most']                    = $this->Bds_model->get_list_by_top('', '', '', $limit_new_most, 0);
        $data['street_and_num_bds']              = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price']            = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage']          = $this->Bds_model->get_num_bds_by_acreage();
        $data['commune_ward_and_num_bds']        = $this->Bds_model->get_num_bds_by_commune_ward();
        $data['news']                            = $this->Articles_model->get_list(NEWS.','.AUCTION, "", 7, 0);            // yeeu cau moi: new = new + dau gia
        $data['auctions']                        = $this->Articles_model->get_list(AUCTION, "", 7, 0);
        $data['documents']                       = $this->Articles_model->get_list(DOCUMENT, "", 7, 0);
        $data['news2']                           = $this->Articles_model->get_list("", "", 5, 0);
        $data['communes']                        = $this->Commune_model->get_list(1);
        $data['cf_bds']                          = $this->config->item('bds');
        $data['commune_ward_and_num_bds_chunk3'] = array_chunk($data['commune_ward_and_num_bds'], 3);

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'home/home_view', $data);
        $this->_loadFooter();
	}
}