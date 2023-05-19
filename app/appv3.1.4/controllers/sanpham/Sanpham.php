<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanpham extends MY_Controller {
	
	function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();

        
        
	}
    
    function chitiet($slug, $id){
        var_dump($slug,$id );
    }
}
