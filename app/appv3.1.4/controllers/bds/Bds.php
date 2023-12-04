<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds extends MY_Controller
{

    function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->load->model('articles/Articles_model');
        $this->load->model('bds/Bds_model');
        $this->load->model('commune/Commune_model');
        $this->load->model('street/Street_model');
        $this->load->model('tag/Tag_model');
    }

    // chi tiết bất động sản
    function index($name_bds, $id_bds)
    {
        $id_bds = isIdNumber($id_bds) ? $id_bds : 0;
        $bdsInfo = $this->Bds_model->get_info($id_bds);

        if (empty($bdsInfo)) {
            redirect(site_url("/"));
            die;
        }

        if ($bdsInfo['slug_title'] != $name_bds) {
            redirect(site_url($bdsInfo['slug_title'] . '-p' . $bdsInfo['id_bds']));
            die;
        }

        $data = [];

        $data['cf_bds'] = $this->config->item('bds');
        // tiền + đơn vị tiền
        if ($bdsInfo['price_total']  < PRICE_ONE_BILLION) {
            $bdsInfo['price_unit'] = PRICE_UNIT_TRIEU;
            $bdsInfo['price_view'] = $bdsInfo['price_total'] / PRICE_ONE_MILLION;
        } else {
            $bdsInfo['price_unit'] = PRICE_UNIT_TY;
            $bdsInfo['price_view'] = $bdsInfo['price_total'] / PRICE_ONE_BILLION;
        }
        $bdsInfo['direction_name'] = isset($data['cf_bds']['direction'][$bdsInfo['direction']]) ? $data['cf_bds']['direction'][$bdsInfo['direction']] : "";
        $data['bdsInfo'] = $bdsInfo;

        $data['imgs'] = json_decode($bdsInfo['images'], true);
        $cf_bds = $this->config->item('bds');
        $data['cf_direction'] = $cf_bds['direction'];
        $data['cf_floor'] = $cf_bds['floor'];
        $data['cf_juridical'] = $cf_bds['juridical'];

        //top 10 bds cung khu vuc
        $bds_palace_area = $this->Bds_model->get_list_by_top(0, 0, $bdsInfo['id_commune_ward'], 10, 0);
        $data['bds_palace_area'] = $bds_palace_area;

        //top 10 bds noi bat
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward(10);

        //get all tag 
        $data['tags'] = $this->Bds_model->get_all_tag_by(TAG_BDS, $bdsInfo['id_bds']);

        // get num_bds by contact name
        $data['get_num_bds_by_contact_name'] = $this->Bds_model->get_num_bds_by_contact_name($bdsInfo['contactname']);

        $data['list_commune'] = $this->Commune_model->get_list(1);

        $header = [
            'title' => $bdsInfo['title'],
            'og_image' => get_path_image($bdsInfo['create_time'], $data['imgs'][1]),
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];

        if ($this->_isLogin()) {
            if ($this->_session_uid() == $bdsInfo['id_user'] || $this->_session_role() == SUPERADMIN) {
                $header['edit_link'] = 'admin/bds/edit/' . $id_bds;
            }
        }

        $this->_loadHeader($header);

        $this->load->view($this->_template_f . 'bds/bds_view', $data);

        $this->_loadFooter();
    }

    // danh sách bất động sản bán
    function list_ban()
    {
        $data = [];


        $category        = 1;
        $id_commune_ward = $this->input->get('id_commune_ward');

        $id_street       = trim($this->input->get('id_street'));
        $id_project      = '';
        $id_user         = '';
        $status          = '1';
        $type            = trim($this->input->get('type'));
        $title           = trim($this->input->get('title'));
        $f_price         = trim($this->input->get('f_price'));
        $f_price_unit    = trim($this->input->get('f_price_unit'));
        $t_price         = trim($this->input->get('t_price'));
        $t_price_unit    = PRICE_UNIT_TY;
        $price_type      = PRICE_TYPE_TOTAL;
        $f_acreage       = trim($this->input->get('f_acreage'));
        $t_acreage       = trim($this->input->get('t_acreage'));
        $direction       = trim($this->input->get('direction'));
        $floor           = '';
        $toilet          = '';
        $bedroom         = '';
        $noithat         = '';
        $road_surface    = '';
        $juridical       = '';
        $is_vip          = trim($this->input->get('is_vip'));
        $moi_gioi        = trim($this->input->get('moi-gioi'));
        $is_home_vip     = '';
        $f_expired       = '';
        $t_expired       = '';
        $f_create        = '';
        $t_create        = '';
        $orderby         = trim($this->input->get('orderby'));
        $sort            = trim($this->input->get('sort'));
        $page            = trim($this->input->get('page'));
        $limit           = 10;

        // validate dư liệu input
        $id_commune_ward = is_array($id_commune_ward) ? $id_commune_ward : [];
        $page            = is_numeric($page) && $page > 0 ? $page : 1;
        $offset = ($page - 1) * $limit;
        //end validate input

        // du lieu tim kiem
        $data['id_commune_ward'] = $id_commune_ward;
        $data['id_street'] = $id_street;
        $data['type']            = $type;
        $data['title']           = $title;
        $data['f_price']         = $f_price;
        $data['t_price']         = $t_price;
        $data['f_acreage']       = $f_acreage;
        $data['t_acreage']       = $t_acreage;
        $data['direction']       = $direction;
        $data['moi_gioi']        = $moi_gioi;
        $data['is_vip']          = $is_vip;
        $data['orderby']         = $orderby;
        $data['sort']            = $sort;
        $data['page']            = $page;
        $data['limit']           = $limit;

        // check du lieu
        if ($f_price != '') {
            $f_price = $f_price_unit == PRICE_UNIT_TRIEU ? $f_price * PRICE_ONE_MILLION : $f_price * PRICE_ONE_BILLION;
        }

        if ($t_price != '') {
            $t_price = $t_price_unit == PRICE_UNIT_TRIEU ? $t_price * PRICE_ONE_MILLION : $t_price * PRICE_ONE_BILLION;
        }

        $orderby = $orderby == '' ? 'is_vip' : $orderby;
        $sort = $sort == '' ? 'DESC' : $sort;
        // end check du lieu

        $list_bds = $this->Bds_model->get_list($category, implode(',', $id_commune_ward), $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $moi_gioi, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset);
        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        $data['list_bds'] = $list_bds['list'];
        $data['total'] = $list_bds['total'];
        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward();
        $data['street_and_num_bds'] = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price'] = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage'] = $this->Bds_model->get_num_bds_by_acreage();
        $data['all_tag'] = $this->Tag_model->get_list(TAG_BDS);

        // làm tiêu đề SEO
        $seo_title = "Bất động sản Đông Anh";
        if ($moi_gioi != '') {
            $seo_title .= ", của " . htmlentities($moi_gioi);
        }
        if ($id_commune_ward != []) {
            $dia_diem = [];
            foreach ($id_commune_ward as $id) {
                isset($list_commune[$id]) && $list_commune[$id]['name'] != ''
                    ? $dia_diem[] = htmlentities($list_commune[$id]['name'])
                    : '';
            }
            $seo_title .=  ", xã " . implode(', ', $dia_diem);
        }
        if ($id_street != '') {
            $seo_title .=  ", đường " . htmlentities($list_street[$id_street]['name']);
        }
        if ($data['f_price'] != '' || $data['t_price'] != '') {
            $seo_title .=  $data['f_price'] != '' ? ", giá từ " . $data['f_price'] . " tỷ" : "";
            $seo_title .=  $data['t_price'] != '' ? " - " . $data['t_price'] . " tỷ" : "";
        }
        if ($f_acreage != '' || $t_acreage != '') {
            $seo_title .=  $f_acreage != '' ? ", diện tích từ $f_acreage m²" : "";
            $seo_title .=  $t_acreage != '' ? " - $t_acreage m² " : "";
        }
        $data['seo_title'] = $seo_title;

        $header = [
            'title' => $seo_title,
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];

        $this->_loadHeader($header);

        $this->load->view($this->_template_f . 'bds/list/bds_list_view.php', $data);

        $this->_loadFooter();
    }

    function ajx_heart()
    {
        if ($this->input->is_ajax_request()) {
            if (!$this->_islogin()) {
                echo 'not_login';
                die;
            }
            //bds_id
            $pid = trim($this->input->post("pid"));
            $pid = isIdNumber($pid) ? $pid : 0;

            //1: add, 0: remove
            $type = trim($this->input->post("type"));
            $type = in_array($type, ['1', '0']) ? $type : '0';

            $uid = $this->_session_uid();


            //all favorite bds by user
            $favorite_bds = $this->Bds_model->get_all_favorite_bds_by_user($uid);
            $favorite_ids = $favorite_bds['ids'];
            if ($type == '1' && !in_array($pid, $favorite_ids)) {
                $this->Bds_model->add_bds_favorite($pid, $uid);
            } else if ($type == '0' && in_array($pid, $favorite_ids)) {
                $this->Bds_model->delete_bds_favorite($pid, $uid);
            }

            $favorite_bds = $this->Bds_model->get_all_favorite_bds_by_user($uid);
            echo count($favorite_bds['ids']);
            die;
        }
    }

    function ajax_tang_luot_xem_bds($id_bds)
    {
        $id_bds = isIdNumber($id_bds) ? $id_bds : 0;
        $bdsInfo = $this->Bds_model->get_info($id_bds);
        if (!empty($bdsInfo)) {
            $old_view = $bdsInfo['view'];
            $new_view = $old_view + 1;
            $this->Bds_model->tang_luot_xem_bds($new_view, $id_bds);
            echo 'ok';
        }
    }
}
