<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Choose_vip extends MY_Controller
{

    function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();

        if (!$this->_isLogin()) {
            if ($this->input->is_ajax_request()) {
                echo 'unlogin';
                die();
            }
            $currUrl = getCurrentUrl();
            dbClose();
            redirect(site_url('login/?url=' . urlencode($currUrl), $this->_langcode));
            die();
        }

        // model
        $this->load->model('street/Street_model');
        $this->load->model('commune/Commune_model');
        $this->load->model('bds/Bds_model');
        $this->load->model('tag/Tag_model');
        $this->load->model('tag_assign/Tag_assign_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $uid = $this->_session_uid();
        $role = $this->_session_role();

        $category        = '';
        $id_commune_ward = '';
        $id_street       = '';
        $id_project      = '';
        $id_user         = $role == SUPERADMIN ? '' : $uid;
        $status          = 1;
        $type            = '';
        $title           = '';
        $f_price         = '';
        $t_price         = '';
        $price_type      = '';
        $f_acreage       = '';
        $t_acreage       = '';
        $direction       = '';
        $floor           = '';
        $toilet          = '';
        $bedroom         = '';
        $noithat         = '';
        $road_surface    = '';
        $juridical       = '';
        $is_vip          = 1;
        $is_home_vip     = '';
        $f_expired       = '';
        $t_expired       = '';
        $f_create        = '';
        $t_create        = '';
        $orderby         = 'is_home_vip';
        $sort            = 'DESC';
        $limit           = 1000;
        $offset          = 0;

        $list_bds_vip = $this->Bds_model->get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset);

        $data['list_bds_vip'] = $list_bds_vip;
        $header = [
            'title' => 'Chọn tin vip ra trang chủ',
            'header_page_css_js' => 'bds_choose_vip'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'choose_vip/choose_vip_view', $data);
        $this->_loadFooter();
    }

    function ajax_update()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $list_selected = $this->input->post('list_selected');
        $list_unselected = $this->input->post('list_unselected');

        // TODO: VALIDATE POST

        $excu1 = true;
        if (!empty($list_selected)) {
            $str_selected = implode(',', $list_selected);
            $excu1 = $this->Bds_model->update_vip_to_home(1, $str_selected);
        }

        $excu2 = true;
        if (!empty($list_unselected)) {
            $str_unselected = implode(',', $list_unselected);
            $excu2 = $this->Bds_model->update_vip_to_home(0, $str_unselected);
        }

        echo $excu1 && $excu2 ? 'ok' : 'error';
    }
}
