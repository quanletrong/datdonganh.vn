<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends MY_Controller {
	
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
        $data['title'] = 'Tài liệu';
        //top 5 tin tuc mơi nhat
        $article_new = $this->Articles_model->get_list(DOCUMENT, "", 4, 0);
        $data['article_new'] = $article_new;
        
        //top 10 tin tuc có luot view cao nhat
        $article_view_top = $this->Articles_model->get_list_by_view(DOCUMENT, 10);
        $data['article_view_top'] = $article_view_top;
        
        $header = [
            'title' => 'Danh sách tài liệu',
            'active_link' => 'document',
            'header_page_css_js' => 'news'
        ];
        
        $this->_loadHeader($header);
        
        $this->load->view($this->_template_f . 'document/document_view', $data);
        
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
            $news = $this->Articles_model->get_list(DOCUMENT, "", $numrow, $start);
            echo json_encode($news);
        } 
	}
}