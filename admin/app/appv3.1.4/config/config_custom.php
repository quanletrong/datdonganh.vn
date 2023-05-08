<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['product_name'] = 'Admin Đất Đông Anh';
$config['show_custom_error'] = 1;
$config['product_key'] = 'admin';
// excel library path
define('PHPEXCEL_LIB_PATH', '../app/appv3.1.4/libraries/Classes/');

// batik lib path
define('BATIK_LIB_PATH', '../app/appv3.1.4/libraries/batik/');

// mpdf lib path
define('MPDF_LIB_PATH', '../app/appv3.1.4/libraries/mpdf/');


// khi day len server se config = rong
//$config['cf_upload_local'] = 'uploads/images/';
$config['cf_upload_local'] = '';


$config['commune'] = [];
$config['commune']['name'] = ['rq' => 1, 'max' => '256'];
$config['commune']['type'] = ['rq' => 1];
$config['commune']['image'] = ['rq' => 1];
$config['commune']['list'] = ['1' => 'Xã', '2' => 'Phường', '3' => 'Thị trấn'];
$config['commune']['status'] = ['1' => 'Hoạt động', '2' => 'Ngừng hoạt động'];