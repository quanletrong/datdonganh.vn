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

$config['bds'] = [];
$config['bds']['type']['1'] = 'Đất thổ cư';
$config['bds']['type']['2'] = 'Đất đấu giá';
$config['bds']['type']['3'] = 'Đất nền dự án';
$config['bds']['type']['4'] = 'Đất dịch vụ';
$config['bds']['type']['5'] = 'Đất mặt đường';
$config['bds']['type']['6'] = 'Nhà trong ngõ';
$config['bds']['type']['7'] = 'Nhà mặt đường';
$config['bds']['type']['8'] = 'Nhà liền kề dự án';

$config['bds']['status']['1'] = 'Công khai';
$config['bds']['status']['2'] = 'Riêng tư';
$config['bds']['status']['3'] = 'Xóa';

$config['bds']['direction']['1'] = 'Đông';
$config['bds']['direction']['2'] = 'Tây';
$config['bds']['direction']['3'] = 'Nam';
$config['bds']['direction']['4'] = 'Bắc';
$config['bds']['direction']['5'] = 'Đông-Bắc';
$config['bds']['direction']['6'] = 'Tây-Bắc';
$config['bds']['direction']['7'] = 'Tây-Nam';
$config['bds']['direction']['8'] = 'Đông-Nam';

$config['bds']['bedroom']['1'] = '1 phòng ngủ';
$config['bds']['bedroom']['2'] = '2 phòng ngủ';
$config['bds']['bedroom']['3'] = '3 phòng ngủ';
$config['bds']['bedroom']['4'] = '4 phòng ngủ';
$config['bds']['bedroom']['5'] = '5 phòng ngủ';
$config['bds']['bedroom']['6'] = '5+ phòng ngủ';

$config['bds']['toilet']['1'] = '1 toilet';
$config['bds']['toilet']['2'] = '2 toilet';
$config['bds']['toilet']['3'] = '3 toilet';
$config['bds']['toilet']['4'] = '4 toilet';
$config['bds']['toilet']['5'] = '5 toilet';
$config['bds']['toilet']['6'] = '5+ toilet';

$config['bds']['floor']['1'] = '1 tầng';
$config['bds']['floor']['2'] = '2 tầng';
$config['bds']['floor']['3'] = '3 tầng';
$config['bds']['floor']['4'] = '4 tầng';
$config['bds']['floor']['5'] = '5 tầng';
$config['bds']['floor']['6'] = '5+ tầng';

$config['bds']['noithat']['1'] = 'Full đồ';
$config['bds']['noithat']['2'] = 'Cơ bản';
$config['bds']['noithat']['3'] = 'Trống';

$config['bds']['is_hot']['1'] = 'Thường';
$config['bds']['is_hot']['2'] = 'VIP';
$config['bds']['is_hot']['3'] = 'KIM CƯƠNG';

$config['bds']['juridical']['1'] = 'Sổ đỏ';
$config['bds']['juridical']['2'] = 'Sổ hồng';
$config['bds']['juridical']['3'] = 'Chưa rõ';

$config['bds']['price_type']['1'] = '';
$config['bds']['price_type']['2'] = '/m2';
$config['bds']['price_type']['3'] = '/tháng';
$config['bds']['price_type']['3ư4'] = '/m2/tháng';
