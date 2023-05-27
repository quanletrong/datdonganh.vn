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

$route['([a-zA-Z0-9-_]+)-p([0-9]+).html'] = 'bds/bds/index/$1/$2/$3';
//$route['([a-zA-Z0-9-_]+)/([a-zA-Z0-9-_]+)-p([0-9]+).html'] = 'bds/bds/index/$1/$2/$3';
//vi du:  http://dat.dev.vn/tin-tuc/man-city-dai-chien-chelsea-2-dai-gia-lam-tien-so-ke-ai-hon-ai-p48.html

$route['(nha-dat-ban|nha-dat-thue).html'] = 'bds/bds/list/$1';

$route['login'] = 'login/login/index';
$route['login/auth'] = 'login/login/auth';

//tìm kiếm bds
// $route['dat-nen-du-an/(xa|thi-tran|duong|huong)-([a-zA-Z0-9-_]+)'] = 'bds/search?$=$2&';


//tìm kiếm bds
// datdonganh.vn/{dat-nen-du-an}/xa-{hai-boi}/duong-{van-noi}/gia-{1.5}-ty-{2}-ty/dien-tich-{30}m2-{50}m2/huong-{dong}

// datdonganh.vn/[LOAI_ĐẤT]/[Xã]/[ĐƯỜNG]/gia-[TU_GIA]-[ĐẾN_GIÁ]/[DIEN_TICH]/[HUONG] = 'bds/search/$1/$2/$3/$4/$5/$6'
