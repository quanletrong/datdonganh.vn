<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bds extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->load->model('articles/Articles_model');
        $this->load->model('bds/Bds_model');
        $this->load->model('commune/Commune_model');
        
        
	}

	function index($name_bds, $id_bds)
	{
        $id_bds = isIdNumber($id_bds) ? $id_bds : 0;
        $bdsInfo = $this->Bds_model->get_info($id_bds);

//        if(empty($bdsInfo) || $bdsInfo['slug_title'] != $name_bds ){
//            redirect(site_url("/"));
//            die;
//        }
        
        if(empty($bdsInfo)){
            redirect(site_url("/"));
            die;
        }
        //showLOG($bdsInfo);die;
        $data = [];
        $data['bdsInfo'] = $bdsInfo;
        $data['imgs'] = json_decode($bdsInfo['images'], true);
        $cf_bds = $this->config->item('bds');
        $data['direction'] = $cf_bds['direction'];
        $data['floor'] = $cf_bds['floor'];
        $data['juridical'] = $cf_bds['juridical'];
        $data['price_type'] = $cf_bds['price_type'];
        
        //top 5 bds danh cho ban
        $bdss = $this->Bds_model->get_list_by_top(false, 5, 0);
        $data['bdss'] = $bdss;
        
        //get all tag 
        $data['tags'] = $this->Bds_model->get_all_tag_by(TAG_BDS, $bdsInfo['id_bds']);
        $header = [
            'title' => $bdsInfo['title'],
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];
        
        

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        
        $this->_loadFooter();
	}
}