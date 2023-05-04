<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['product_name'] = 'AdX Lead Ad Exchange';
$config['show_custom_error'] = 0;
$config['product_key'] = 'lead';
$config['typead'] = 4;
// excel library path
define('PHPEXCEL_LIB_PATH', '../app/appv3.1.4/libraries/Classes/');

// batik lib path
define('BATIK_LIB_PATH', '../app/appv3.1.4/libraries/batik/');

// mpdf lib path
define('MPDF_LIB_PATH', '../app/appv3.1.4/libraries/mpdf/');


// khi day len server se config = rong
//$config['cf_upload_local'] = 'uploads/images/';
$config['cf_upload_local'] = '';

// price
$config['price_min_cpc'] = 1500; // gia da gom VAT. Khi thay doi nho update gia tri trong bang ecomx_config
$config['price_min_cpm'] = 1500; // gia da gom VAT. Khi thay doi nho update gia tri trong bang ecomx_config
$config['price_min_lead'] = 1500;
$config['price_bid_step'] = 100;// buoc gia cho bid nho nhat la boi so cua 100 vnd. Khi thay doi nho update gia tri trong bang ecomx_config
$config['interlace_image'] = 120; // max dung luong anh - dung kich thuoc
$config['max_title'] = 35; // so ky tu toi da
$config['max_body'] = 65; // so ky tu toi da

$config['max_price_base'] = 9; //gia goc toi da 9 ky tu
$config['max_price_text'] = 9; //gia ban toi da 9 ky tu
$config['max_price_sale_off'] = 2; // % giam gia toi da 9 ky tu

$config['image_w'] = 300; // toi da 300px
$config['image_h'] = 300; // toi da 300px

$config['logo_w'] = 140;
$config['logo_h'] = 120;


$config['test'] = 'test';
