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
        $this->load->model('account/Account_model');
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
        $bds_palace_area = $this->Bds_model->get_list_by_top('', '', $bdsInfo['id_commune_ward'], 10, 0);
        $data['bds_palace_area'] = $bds_palace_area;

        //top 10 bds noi bat
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward(10);

        //get all tag 
        $data['tags'] = $this->Bds_model->get_all_tag_by(TAG_BDS, $bdsInfo['id_bds']);

        // get num_bds by user
        $data['user'] = $this->Account_model->get_user_info_by_uid($bdsInfo['id_user']);
        $data['get_num_bds_by_user'] = $this->Bds_model->get_num_bds_by_user($bdsInfo['id_user']);

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
        $id_street       = removeAllTags($this->input->get('id_street'));
        $id_project      = '';
        $id_user         = '';
        $status          = '1';
        $type            = removeAllTags($this->input->get('type'));
        $title           = removeAllTags($this->input->get('title'));
        $f_price         = removeAllTags($this->input->get('f_price'));
        $f_price_unit    = removeAllTags($this->input->get('f_price_unit'));
        $t_price         = removeAllTags($this->input->get('t_price'));
        $t_price_unit    = PRICE_UNIT_TY;
        $price_type      = PRICE_TYPE_TOTAL;
        $f_acreage       = removeAllTags($this->input->get('f_acreage'));
        $t_acreage       = removeAllTags($this->input->get('t_acreage'));
        $direction       = removeAllTags($this->input->get('direction'));
        $floor           = '';
        $toilet          = '';
        $bedroom         = '';
        $noithat         = '';
        $road_surface    = '';
        $juridical       = '';
        $is_vip          = removeAllTags($this->input->get('is_vip'));
        $moi_gioi        = removeAllTags($this->input->get('moi-gioi'));
        $is_home_vip     = '';
        $f_expired       = '';
        $t_expired       = '';
        $f_create        = '';
        $t_create        = '';
        $orderby         = removeAllTags($this->input->get('orderby'));
        $sort            = removeAllTags($this->input->get('sort'));
        $page            = removeAllTags($this->input->get('page'));
        $limit           = 10;
        $tag             = removeAllTags($this->input->get('tag'));

        // CHECK DU LIEU INPUT

        $cf           = $this->config->item('bds');
        $all_tag      = $this->Tag_model->get_list(TAG_BDS);
        $list_street  = $this->Street_model->get_list(1);
        $list_commune = $this->Commune_model->get_list(1);

        $f_price_ok = 0;
        if ($f_price != '') {
            $f_price_ok = $f_price_unit == PRICE_UNIT_TRIEU ? $f_price * PRICE_ONE_MILLION : $f_price * PRICE_ONE_BILLION;
        }

        $t_price_ok = 0;
        if ($t_price != '') {
            $t_price_ok = $t_price_unit == PRICE_UNIT_TRIEU ? $t_price * PRICE_ONE_MILLION : $t_price * PRICE_ONE_BILLION;
        }

        $id_commune_ward = is_array($id_commune_ward) ? $id_commune_ward : [];
        if (is_array($id_commune_ward)) {
            foreach ($id_commune_ward as $idcw) {
                if (!isIdNumber($idcw)) {
                    $id_commune_ward = [];
                    break;
                }

                if (!isset($list_commune[$idcw])) {
                    $id_commune_ward = [];
                    break;
                }
            }
        } else {
            $id_commune_ward = [];
        }

        $tag       = isset($all_tag[$tag]) ? $tag : '';
        $id_street = isset($list_street[$id_street]) ? $id_street : '';
        $type      = isset($cf['type'][$type]) ? $type : '';
        $f_acreage = is_numeric($f_acreage) && $f_acreage > 0 ? $f_acreage : '';
        $t_acreage = is_numeric($t_acreage) && $t_acreage > 0 ? $t_acreage : '';
        $direction = is_numeric($direction) && $direction > 0 ? $direction : '';
        $page      = is_numeric($page) && $page > 0 ? $page : 1;
        $is_vip    = in_array($is_vip, [BDS_VIP, BDS_THUONG]) ? $is_vip : '';
        $orderby   = in_array($orderby, ['price_total', 'acreage', 'id_bds']) ? $orderby : 'create_time_set';
        $sort      = in_array($sort, ['DESC', 'ASC']) ? $sort : 'DESC';
        $offset    = ($page - 1) * $limit;
        // END CHECK DU LIEU INPUT

        // CALL DB
        $list_bds = $this->Bds_model->get_list($category, implode(',', $id_commune_ward), $id_street, $id_project, $id_user, $status, $type, $title, $f_price_ok, $t_price_ok, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $moi_gioi, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset, $tag);
        // END CALL DB

        // GÁN DU LIEU RA VIEW
        $data['list_bds']                 = $list_bds['list'];
        $data['total']                    = $list_bds['total'];
        $data['cf_bds']                   = $this->config->item('bds');
        $data['list_street']              = $list_street;
        $data['list_commune']             = $list_commune;
        $data['all_tag']                  = $all_tag;
        $data['commune_ward_and_num_bds'] = $this->Bds_model->get_num_bds_by_commune_ward();
        $data['street_and_num_bds']       = $this->Bds_model->get_num_bds_by_street();
        $data['get_num_bds_by_price']     = $this->Bds_model->get_num_bds_by_price();
        $data['get_num_bds_by_acreage']   = $this->Bds_model->get_num_bds_by_acreage();

        // du lieu tim kiem
        $data['id_commune_ward'] = $id_commune_ward;
        $data['id_street']       = $id_street;
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
        $data['tag']             = $tag;

        // làm tiêu đề SEO
        $seo_title = "Bất động sản Đông Anh";
        if ($moi_gioi != '') {
            $info_moi_gioi = $this->Account_model->get_user_info_by_uid($moi_gioi);
            $seo_title .= ", của " . htmlentities(@$info_moi_gioi['fullname']);
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
        if ($tag != '') {
            $seo_title .=  ", từ khóa '" . $all_tag[$tag]['name'] . "'";
        }
        $data['seo_title'] = $seo_title;
        // END GÁN DU LIEU RA VIEW

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
