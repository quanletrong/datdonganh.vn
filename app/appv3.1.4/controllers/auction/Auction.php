<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auction extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
        
        $this->load->model('articles/Articles_model');
        $this->load->model('bds/Bds_model');
		
//        if (!$this->_isLogin())
//        {
//            if ($this->input->is_ajax_request())
//            {
//                echo 'unlogin';
//                die();
//            }
//            $currUrl = getCurrentUrl();
//            dbClose();
//            redirect(site_url('login/?url=' . urlencode($currUrl), $this->_langcode));
//            die();
//        }
	}

	function index()
	{
        $data = [];
        $data['title'] = 'Lịch đấu giá';
        //top 5 tin tuc mơi nhat
        $article_new = $this->Articles_model->get_list(AUCTION, "", 4, 0);
        $data['article_new'] = $article_new;
        
        //top 10 tin tuc có luot view cao nhat
        $article_view_top = $this->Articles_model->get_list_by_view(AUCTION, 10);
        $get_num_article_by_commune_ward = $this->Articles_model->get_num_article_by_commune_ward(AUCTION);
        $data['article_view_top'] = $article_view_top;
        $data['get_num_article_by_commune_ward'] = $get_num_article_by_commune_ward;
        //showLOG($data['news_new']);die;
        
        $header = [
            'title' => 'Danh sách lịch đấu giá',
            'active_link' => 'auction',
            'header_page_css_js' => 'news'
        ];
        
        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'auction/auction_view', $data);
        
        $this->_loadFooter();
	}
    
    function ajx_more_data()
	{
        if($this->input->is_ajax_request())
		{
            
            //top 5 tin tuc mơi nhat
            $page = trim($this->input->post("page"));
            $page = isIdNumber($page) ? $page : 1;
            
            $numrow = 4;
            $start = ($page - 1) * $numrow;
            $news = $this->Articles_model->get_list(AUCTION, "", $numrow, $start);
            echo json_encode($news);
        } 
	}

    function detail($slug, $id) {

        $id = isIdNumber($id) ? $id : 0;
        $info = $this->Articles_model->get_info($id);

        if(empty($info)){
            redirect(site_url("/"));
            die;
        }
        
        if($info['slug'] != $slug ){
            redirect(site_url(LINK_TIN_TUC.'/'.$info['slug'].'-p'.$info['id_articles']));
            die;
        }
        
        $article_view_top = $this->Articles_model->get_list_by_view(AUCTION, 10);
        $list_bds_by_commune = $this->Bds_model->get_list(1, $info['id_commune_ward'], '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','', '', '', '', '', '', 'is_vip', 'DESC', 20, 0);

        $get_num_article_by_commune_ward = $this->Articles_model->get_num_article_by_commune_ward(AUCTION);
        
        $data = [];
        $data['page'] = 'Lịch đấu giá';
        $data['info'] = $info;
        $data['article_view_top'] = $article_view_top;
        $data['list_bds_by_commune'] = $list_bds_by_commune;
        $data['get_num_article_by_commune_ward'] = $get_num_article_by_commune_ward;

        $header = [
            'title' => $info['title'],
            'active_link' => 'auction',
            'header_page_css_js' => 'news'
        ];
        
        if ($this->_isLogin()) {
            if($this->_session_uid() == $info['id_user'] || $this->_session_role() == SUPERADMIN) {
                $header['edit_link'] = 'admin/auction/edit/'.$id;
            }
        }

        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'auction/detail/auction_detail_view', $data);
        
        $this->_loadFooter();

    }
}