<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds extends MY_Controller
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
    }

    function index()
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Danh sách bài đăng bất động sản',
            'active_link' => 'bds',
            'header_page_css_js' => 'bds'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        $this->_loadFooter();
    }

    function add()
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }


        $list_street =  $this->Street_model->get_list('-1'); // đường đang hoạt động
        $id_commune_ward = '1';
        $id_street       = '3';
        $id_project      = '-1';
        $id_user         = '-1';
        $status          = '-1';
        $type            = '-1';
        $title           = '';
        $f_price         = '-1';
        $t_price         = '-1';
        $f_acreage       = '-1';
        $t_acreage       = '-1';
        $direction       = '-1';
        $floor           = '-1';
        $toilet          = '-1';
        $bedroom         = '-1';
        $noithat         = '-1';
        $road_surface    = '-1';
        $juridical       = '-1';
        $is_vip          = '-1';
        $f_expired       = '-1';
        $t_expired       = '-1';
        $f_create        = '-1';
        $t_create        = '-1';
        $orderby         = 'id_bds';
        $sort            = 'DESC';
        $limit           = 50;
        $offset          = 0;

        var_dump($this->Bds_model->get_list($id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset));die;
        $list_commune =  $this->Commune_model->get_list('1'); // đường đang hoạt động

        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;

        $header = [
            'title' => 'Danh sách bài đăng bất động sản',
            'active_link' => 'bds_add',
            'header_page_css_js' => 'bds_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_add_view', $data);
        $this->_loadFooter();
    }

    function add_submit()
    {
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $id_street       = $this->input->post('street');             // check db + rq
        $id_commune_ward = $this->input->post('commune');            // check db + rq
        $maps            = $this->input->post('maps', false);        // check length regx
        $maps            = (htmlentities(htmlspecialchars($maps)));  // to save db // var_dump(html_entity_decode(htmlspecialchars_decode($maps))); // to render
        $id_project      = $this->input->post('project');            // check db
        $type            = $this->input->post('type');               // check cf + rq
        $title           = $this->input->post('title');              // check length + rq
        $tag             = $this->input->post('tag');                // check db
        $sapo            = $this->input->post('sapo');               // check length + rq
        $content         = $this->input->post('content');            // check length + rq
        $price           = $this->input->post('price');              // check number > 0
        $direction       = $this->input->post('direction');          // check cf
        $toilet          = $this->input->post('toilet');             // check cf
        $floor           = $this->input->post('floor');              // check cf
        $expired         = $this->input->post('expired');            // check kiểu ngày + lớn hơn hiện tại
        $acreage         = $this->input->post('acreage');            // check số + lớn 30
        $road_surface    = $this->input->post('road_surface');       // check số + lớn 1
        $bedroom         = $this->input->post('bedroom');            // check cf
        $is_vip          = $this->input->post('is_hot');             // check cf
        $noithat         = $this->input->post('noithat');            // check cf
        $juridical       = $this->input->post('juridical');          // check cf
        $image           = $this->input->post('image');              // check lưu
        $videos          = $this->input->post('video');              // check regx

       
        // TODO: validate dữ liệu trước khi save
        $expired = str_replace('/', '-', $expired);
        $expired = date('Y-m-d', strtotime($expired));

        # lưu ảnh
        $image_db = [];
        foreach ($image as $url_image) {
            $copy = copy_image_from_file_manager_to_public_upload($url_image, date('Y'), date('m'));
            if ($copy['status']) {
                $image_db[] = $copy['basename'];
            }
        }

        // LƯU DỮ LIỆU
        if (!empty($image_db)) {

            // dữ liệu bổ sung
            $images      = json_encode($image_db);
            $slug_title  = create_slug($title);
            $status      = 1;
            $id_user     = $this->_session_uid();
            $create_time = date('Y-m-d H:i:s');

            $newid = $this->Bds_model->add($id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $slug_title, $maps, $sapo, $content, $images, $videos, $price, $acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $expired, $create_time);

            if ($newid) {
                # update tag
                $msg = 'OK';
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('bds');
    }
}
