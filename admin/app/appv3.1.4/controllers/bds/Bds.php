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
        // $this->_function = trim(strtolower(__FUNCTION__));

        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // TODO: validate dư liệu tìm kiếm
        //END validate

        $id_commune_ward = '';
        $id_street       = '';
        $id_project      = '';
        $id_user         = '';
        $status          = '';
        $type            = '';
        $title           = '';
        $f_price         = '';
        $t_price         = '';
        $f_acreage       = '';
        $t_acreage       = '';
        $direction       = '';
        $floor           = '';
        $toilet          = '';
        $bedroom         = '';
        $noithat         = '';
        $road_surface    = '';
        $juridical       = '';
        $is_vip          = '';
        $f_expired       = '';
        $t_expired       = '';
        $f_create        = '';
        $t_create        = '';
        $orderby         = 'id_bds';
        $sort            = 'DESC';
        $limit           = 1000;
        $offset          = 0;

        $list_bds = $this->Bds_model->get_list($id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset);
        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        $data['list_bds'] = $list_bds;
        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;
        $header = [
            'title' => 'Quản lý bài đăng bất động sản',
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        // pages/examples/invoice.html TODO: sau chuyển giao diện
        $this->_loadFooter();

        
    }

    function add()
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;

        $header = [
            'title' => 'Đăng thêm bất động sản',
            'active_link' => 'index',
            'active_sub_link' => 'add',
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

        // TODO: validate dữ liệu submit
        //END validate


        // TODO: validate dữ liệu trước khi save

        // TODO: validate dữ liệu trước khi save
        $expired = str_replace('/', '-', $expired);
        $expired = date('Y-m-d', strtotime($expired));

        # lưu ảnh
        $image_db = [];
        $index = 1;
        foreach ($image as $url_image) {
            $copy = copy_image_from_file_manager_to_public_upload($url_image, date('Y'), date('m'));
            if ($copy['status']) {
                $image_db[$index++] = $copy['basename'];
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

    function edit($id_bds)
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_bds     = is_numeric($id_bds) && $id_bds > 0 ? $id_bds : 0;
        $info   = $this->Bds_model->get_info($id_bds);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('bds');
        }
        //end check right

        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        //conver json image => arr image
        $arr_image = json_decode($info['images'], true);
        $year = date('Y', strtotime($info['create_time']));
        $monthe = date('m', strtotime($info['create_time']));
        $info['images_path'] = [];
        foreach ($arr_image as $id_img => $name_img) {
            $path_img = ROOT_DOMAIN . '/' . PUBLIC_UPLOAD_PATH . '/' . $year . '/' . $monthe . '/' . $name_img;
            $info['images_path'][$id_img] = $path_img;
        }
        //end

        $data['info'] = $info;
        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;

        $header = [
            'title' => 'Chỉnh sửa bài đăng',
            'active_link' => 'bds_add',
            'header_page_css_js' => 'bds_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_edit_view', $data);
        $this->_loadFooter();
    }

    function edit_submit($id_bds)
    {
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_bds     = is_numeric($id_bds) && $id_bds > 0 ? $id_bds : 0;
        $info   = $this->Bds_model->get_info($id_bds);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('bds');
        }
        //end check right

        $status          = $this->input->post('status');             // check cf + rq
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

        // TODO: validate dữ liệu submit
        //END validate


        // TODO: validate dữ liệu trước khi save

        // TODO: validate dữ liệu trước khi save
        $expired = str_replace('/', '-', $expired);
        $expired = date('Y-m-d', strtotime($expired));

        # lưu ảnh
        $image_db = [];
        $index = 1;
        $yearFolder = date('Y', strtotime($info['create_time']));
        $monthFolder = date('m', strtotime($info['create_time']));
        foreach ($image as $url_image) {
            if (@getimagesize($url_image)) {
                // kiểm tra ảnh upload có trong '/filemanager/source'
                $la_anh_moi = strpos($url_image, ROOT_DOMAIN . 'filemanager/source');
                // nếu là ảnh mới thì copy ảnh
                if ($la_anh_moi !== false) {
                    $copy = copy_image_from_file_manager_to_public_upload($url_image, $yearFolder, $monthFolder);
                    if ($copy['status']) {
                        $image_db[$index++] = $copy['basename'];
                    }
                }
                // là ảnh cũ thì giữ nguyên
                else {
                    $image_db[$index++] = basename($url_image);
                }
            }
        }

        // LƯU DỮ LIỆU
        if (!empty($image_db)) {

            // dữ liệu bổ sung
            $images      = json_encode($image_db);
            $slug_title  = create_slug($title);
            $update_time = date('Y-m-d H:i:s');

            $exc = $this->Bds_model->edit($id_bds, $id_commune_ward, $id_street, $id_project, $status, $type, $title, $slug_title, $maps, $sapo, $content, $images, $videos, $price, $acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $expired, $update_time);

            if ($exc) {
                # update tag
                $msg = 'OK';
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('bds/edit/'.$id_bds);
    }
}
