<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
	<?php $this->load->view($template_f . 'component/header/header_meta_view'); ?>
	<?php $this->load->view($template_f . 'component/header/header_common_view'); ?>

	<?php 
	// check load file css, js theo tung page
	if(isset($header_page_css_js) && $header_page_css_js != '')
	{
		$this->load->view($template_f . 'component/header/pages/header_' . $header_page_css_js . '_view');
	}
	?>
</head>
<?php flush();?>
<body>
	<a href="logout">Thoát</a>
	<hr>
	<!--[if lt IE 10]>
	<p style="font-size: 110%; text-align:center;padding: 8px; margin: 0; background-color: #fff; color:red;">Bạn đang sử dụng trình duyệt IE version thấp.<br /> Để đảm bảo hệ thống hoạt động đúng, Bạn vui lòng sử dụng IE version 10 trở lên,<br/>hoặc sử dụng các trình duyệt khác như: Chrome, Firefox, Opera,...</p>
	<![endif]-->
	