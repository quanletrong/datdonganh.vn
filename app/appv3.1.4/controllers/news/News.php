<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
        
        $this->load->model('articles/Articles_model');
		
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
        $data['title'] = 'Tin tức';
        //top 5 tin tuc mơi nhat
        $article_new = $this->Articles_model->get_list(NEWS, "", 4, 0);
        $data['article_new'] = $article_new;
        
        //top 10 tin tuc có luot view cao nhat
        $article_view_top = $this->Articles_model->get_list_by_view(NEWS, 10);
        $get_num_article_by_commune_ward = $this->Articles_model->get_num_article_by_commune_ward(NEWS);
        $data['article_view_top'] = $article_view_top;
        $data['get_num_article_by_commune_ward'] = $get_num_article_by_commune_ward;
        //showLOG($data['news_new']);die;
        
        $header = [
            'title' => 'Danh sách tin tức',
            'active_link' => 'news',
            'header_page_css_js' => 'news'
        ];
        
        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'news/news_view', $data);
        
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
            $news = $this->Articles_model->get_list(NEWS, "", $numrow, $start);
            echo json_encode($news);
        } 
	}
}