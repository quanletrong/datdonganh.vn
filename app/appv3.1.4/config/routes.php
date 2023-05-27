<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home/home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route[LINK_NHA_DAT_BAN]                = 'bds/bds/list_ban';           // danh sach bat dong san bán
$route[LINK_NHA_DAT_THUE]               = 'bds/bds/list_thue';          // danh sach bat dong san thuê
$route['(:any)-p(:num)']                = 'bds/bds/index/$1/$2';        // chi tiet bat dong san
$route[LINK_TIN_TUC]                    = 'news/news/index/';           // danh sach tin tuc
$route[LINK_TIN_TUC.'/(:any)-p(:num)']  = 'news/news/detail/';          // chi tiet tin tuc
$route[LINK_DAU_GIA]                    = 'auction/auction/index/';     // danh sach lich dau gia dat
$route[LINK_DAU_GIA.'/(:any)-p(:num)']  = 'auction/auction/detail/';    // chi tiet lich dau gia dat
$route[LINK_TAI_LIEU]                   = 'document/document/index/';   // danh sach tai lieu
$route[LINK_TAI_LIEU.'/(:any)-p(:num)'] = 'document/document/detail/';  // chi tiet tai lieu
$route[LINK_USER_LOGIN]                 = 'login/login/index';
$route[LINK_USER_LOGIN.'/auth']         = 'login/login/auth';