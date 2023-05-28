<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bds extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->load->model('articles/Articles_model');
        $this->load->model('bds/Bds_model');
        $this->load->model('commune/Commune_model');
        $this->load->model('street/Street_model');
        $this->load->model('tag/Tag_model');
        
        
	}

    // chi tiết bất động sản
	function index($name_bds, $id_bds)
	{
        $id_bds = isIdNumber($id_bds) ? $id_bds : 0;
        $bdsInfo = $this->Bds_model->get_info($id_bds);

        if(empty($bdsInfo)){
            redirect(site_url("/"));
            die;
        }
        
        if($bdsInfo['slug_title'] != $name_bds ){
            redirect(site_url($bdsInfo['slug_title'].'-p'.$bdsInfo['id_bds'].'.html'));
            die;
        }
        
        $data = [];
        $data['bdsInfo'] = $bdsInfo;
        $data['imgs'] = json_decode($bdsInfo['images'], true);
        $cf_bds = $this->config->item('bds');
        $data['cf_direction'] = $cf_bds['direction'];
        $data['cf_floor'] = $cf_bds['floor'];
        $data['cf_juridical'] = $cf_bds['juridical'];

         // du lieu tim kiem
         $data['id_commune_ward'] = $bdsInfo['id_commune_ward'];
         $data['type']            = $bdsInfo['type'];
         $data['title']           = $bdsInfo['title'];
         $data['f_price']         = $bdsInfo['price_total']/PRICE_ONE_BILLION;
         $data['t_price']         = $bdsInfo['price_total']/PRICE_ONE_BILLION;
         $data['f_acreage']       = $bdsInfo['acreage'];
         $data['t_acreage']       = $bdsInfo['acreage'];
         $data['direction']       = $bdsInfo['direction'];
         $data['orderby']         = '';
         $data['sort']            = '';
        
        //top 5 bds danh cho ban
        $bdss = $this->Bds_model->get_list_by_top(false, 0, 5, 0);
        $data['bdss'] = $bdss;
        
        //top 10 bds cung khu vuc
        $bds_palace_area = $this->Bds_model->get_list_by_top(false, $bdsInfo['id_commune_ward'], 10, 0);
        $data['bds_palace_area'] = $bds_palace_area;
        
        //top 10 bds noi bat
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward(10);
        
        //get all tag 
        $data['tags'] = $this->Bds_model->get_all_tag_by(TAG_BDS, $bdsInfo['id_bds']);

        // get num_bds by contact name
        $data['get_num_bds_by_contact_name'] = $this->Bds_model->get_num_bds_by_contact_name($bdsInfo['contactname']);
        
        $data['list_commune'] = $this->Commune_model->get_list(1);
        $data['cf_bds'] = $this->config->item('bds');
        $header = [
            'title' => $bdsInfo['title'],
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];
        
        

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        
        $this->_loadFooter();
	}

    // danh sách bất động sản bán
    function list_ban()
 	{
         $data = [];
 

        $category        = 1;
        $id_commune_ward = trim($this->input->get('id_commune_ward'));

        $id_street       = trim($this->input->get('id_street'));
        $id_project      = '';
        $id_user         = '';
        $status          = '1';
        $type            = trim($this->input->get('type'));
        $title           = trim($this->input->get('title'));
        $f_price         = trim($this->input->get('f_price'));
        $f_price_unit    = trim($this->input->get('f_price_unit'));
        $t_price         = trim($this->input->get('t_price'));
        $t_price_unit    = PRICE_UNIT_TY;
        $price_type      = PRICE_TYPE_TOTAL;
        $f_acreage       = trim($this->input->get('f_acreage'));
        $t_acreage       = trim($this->input->get('t_acreage'));
        $direction       = trim($this->input->get('direction'));
        $floor           = '';
        $toilet          = '';
        $bedroom         = '';
        $noithat         = '';
        $road_surface    = '';
        $juridical       = '';
        $is_vip          = '';
        $is_home_vip     = '';
        $f_expired       = '';
        $t_expired       = '';
        $f_create        = '';
        $t_create        = '';
        $orderby         = trim($this->input->get('orderby'));
        $sort            = trim($this->input->get('sort'));
        $limit           = 1000;
        $offset          = 0;

        // du lieu tim kiem
        $data['id_commune_ward'] = $id_commune_ward;
        $data['type']            = $type;
        $data['title']           = $title;
        $data['f_price']         = $f_price;
        $data['t_price']         = $t_price;
        $data['f_acreage']       = $f_acreage;
        $data['t_acreage']       = $t_acreage;
        $data['direction']       = $direction;
        $data['orderby']         = $orderby;
        $data['sort']            = $sort;

        // check du lieu
        if ($f_price != '') {
            $f_price = $f_price_unit == PRICE_UNIT_TRIEU ? $f_price * PRICE_ONE_MILLION : $f_price * PRICE_ONE_BILLION;
        }

        if ($t_price != '') {
            $t_price = $t_price_unit == PRICE_UNIT_TRIEU ? $t_price * PRICE_ONE_MILLION : $t_price * PRICE_ONE_BILLION;
        }

        $orderby = $orderby == '' ? 'is_vip' : $orderby;
        $sort = $sort == '' ? 'DESC' : $sort;
        // end check du lieu

        $list_bds = $this->Bds_model->get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset);
        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        $data['list_bds'] = $list_bds;
        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward();
        $data['street_and_num_bds'] = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price'] = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage'] = $this->Bds_model->get_num_bds_by_acreage();
        $data['all_tag'] = $this->Tag_model->get_list(TAG_BDS);

        $header = [
            'title' => 'Danh sách bất động sản',
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'bds/list/bds_list_view.php', $data);
        
        $this->_loadFooter();
	}
}