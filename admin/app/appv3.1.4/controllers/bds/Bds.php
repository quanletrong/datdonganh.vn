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
        $this->load->model('tag/Tag_model');
        $this->load->model('tag_assign/Tag_assign_model');
        $this->load->model('account/Account_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // TODO: validate dư liệu tìm kiếm
        //END validate

        $category        = trim($this->input->get('category'));
        $id_commune_ward = trim($this->input->get('id_commune_ward'));
        $id_street       = trim($this->input->get('id_street'));
        $id_project      = trim($this->input->get('id_project'));
        // $id_user         = trim($this->input->get('id_user'));
        $status          = trim($this->input->get('status'));
        $type            = trim($this->input->get('type'));
        $title           = trim($this->input->get('title'));
        $f_price         = trim($this->input->get('f_price'));
        $f_price_unit    = trim($this->input->get('f_price_unit'));
        $t_price         = trim($this->input->get('t_price'));
        $t_price_unit    = trim($this->input->get('t_price_unit'));
        $price_type      = trim($this->input->get('price_type'));
        $f_acreage       = trim($this->input->get('f_acreage'));
        $t_acreage       = trim($this->input->get('t_acreage'));
        $direction       = trim($this->input->get('direction'));
        $floor           = trim($this->input->get('floor'));
        $toilet          = trim($this->input->get('toilet'));
        $bedroom         = trim($this->input->get('bedroom'));
        $noithat         = trim($this->input->get('noithat'));
        $road_surface    = trim($this->input->get('road_surface'));
        $juridical       = trim($this->input->get('juridical'));
        $is_vip          = trim($this->input->get('is_vip'));
        $is_home_vip     = trim($this->input->get('is_home_vip'));
        $f_expired       = trim($this->input->get('f_expired'));
        $t_expired       = trim($this->input->get('t_expired'));
        $f_create        = trim($this->input->get('f_create'));
        $t_create        = trim($this->input->get('t_create'));
        $orderby         = 'is_vip';
        $sort            = 'DESC';
        $limit           = 1000;
        $offset          = 0;

        if ($f_price != '') {
            $f_price = $f_price_unit == PRICE_UNIT_TRIEU ? $f_price * PRICE_ONE_MILLION : $f_price * PRICE_ONE_BILLION;
        }

        if ($t_price != '') {
            $t_price = $t_price_unit == PRICE_UNIT_TRIEU ? $t_price * PRICE_ONE_MILLION : $t_price * PRICE_ONE_BILLION;
        }

        // neu la super admin thi cho xem all
        if($this->_session_role() === SUPERADMIN) {
            $id_user = '';
        } else {
            $id_user = $this->_session_uid();
        }
        
        $list_bds = $this->Bds_model->get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset);
        $list_street =  $this->Street_model->get_list(1);
        $list_commune =  $this->Commune_model->get_list(1);

        $data['list_bds'] = $list_bds;
        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;
        $header = [
            'title' => 'Quản lý bài đăng bất động sản',
            'header_page_css_js' => 'bds'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_view', $data);
        // pages/examples/invoice.html TODO: sau chuyển giao diện
        $this->_loadFooter();
    }

    function add()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $list_street  = $this->Street_model->get_list(1);
        $list_commune = $this->Commune_model->get_list(1);
        $status_tag   = 1;
        $name_tag     = '';
        $list_tag     = $this->Tag_model->get_list($status_tag, $name_tag);

        $data['cf_bds'] = $this->config->item('bds');
        $data['list_street'] = $list_street;
        $data['list_commune'] = $list_commune;
        $data['list_tag'] = $list_tag;
        $data['uinfo'] = $this->Account_model->get_info($this->_session_uid());

        $header = [
            'title' => 'Đăng thêm bất động sản',
            'header_page_css_js' => 'bds_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_add_v2_view', $data);
        $this->_loadFooter();
    }

    function add_submit()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $id_commune_ward = $this->input->post('commune');         // check db + rq
        $id_street       = $this->input->post('street');          // check db + rq
        $id_project      = $this->input->post('project');         // check db
        $category        = $this->input->post('category');        // check db
        $status          = $this->input->post('status');          // check db
        $type            = $this->input->post('type');            // check cf + rq
        $title           = $this->input->post('title');           // check length + rq
        $address         = $this->input->post('address');         // check length 
        // $maps            = $this->input->post('maps', false);        // check length regx
        // $maps            = (htmlentities(htmlspecialchars($maps)));  // to save db // var_dump (html_entity_decode(htmlspecialchars_decode($maps))); // to render
        // $sapo            = $this->input->post('sapo');               // check length + rq
        $content         = $this->input->post('content');         // check length + rq
        $image           = $this->input->post('image');           // check lưu
        $videos          = $this->input->post('video');           // check regx
        $price           = $this->input->post('price');           // check number > 0
        $price_unit      = $this->input->post('price_unit');      // check number > 0
        $price_type      = $this->input->post('price_type');      // check number > 0
        $acreage         = $this->input->post('acreage');         // check số + lớn 30
        $facades         = $this->input->post('facades');         // check số + lớn 30
        $direction       = $this->input->post('direction');       // check cf
        $floor           = $this->input->post('floor');           // check cf
        $toilet          = $this->input->post('toilet');          // check cf
        $bedroom         = $this->input->post('room');            // check cf
        $noithat         = $this->input->post('noithat');            // check cf
        $road_surface    = $this->input->post('road_surface');    // check số + lớn 1
        $juridical       = $this->input->post('juridical');       // check cf
        $is_vip          = $this->input->post('is_vip');          // check cf
        $contacttype     = $this->input->post('contacttype');     // check cf
        $contactname     = $this->input->post('contactname');     // check cf
        $contactaddress  = $this->input->post('contactaddress');  // check cf
        $contactphone    = $this->input->post('contactphone');    // check cf
        $contactemail    = $this->input->post('contactemail');    // check cf

        $tag             = $this->input->post('tag');                // check db

        // TODO: validate dữ liệu submit
        $price = floatval(str_replace(',', '', $price));
        $price = $price_unit == PRICE_UNIT_TRIEU ? $price * PRICE_ONE_MILLION : $price * PRICE_ONE_BILLION;
        if ($price_type == PRICE_TYPE_TOTAL) {
            $price_m2 = $price / $acreage;
            $price_total = $price;
        } else if ($price_type == PRICE_TYPE_M2) {
            $price_total = $price * $acreage;
            $price_m2 = $price;
        }

        //END validate

        # lưu ảnh
        $image_db = [];
        $index = 1;
        foreach ($image as $url_image) {
            $copy = copy_image_from_file_manager_to_public_upload($url_image, date('Y'), date('m'));
            if ($copy['status']) {
                $image_db[$index++] = $copy['basename'];
                // unlink($url_image);
            }
        }

        // LƯU DỮ LIỆU
        if (!empty($image_db)) {

            // dữ liệu bổ sung
            $id_user     = $this->_session_uid();
            $status      = 1;
            $slug_title  = create_slug($title);
            $maps = '';
            $sapo = '';
            $images      = json_encode($image_db);
            $create_time = date('Y-m-d H:i:s');

            $newid = $this->Bds_model->add($id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $create_time);

            if ($newid) {
                # update tag
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $newid, TAG_BDS, $id_user, $create_time);
                }
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
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_bds     = is_numeric($id_bds) && $id_bds > 0 ? $id_bds : 0;
        $info   = $this->Bds_model->get_info($id_bds, $this->_session_uid());
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('bds');
        }
        //end check right

        $list_street  = $this->Street_model->get_list(1);
        $list_commune = $this->Commune_model->get_list(1);
        $list_tag     = $this->Tag_model->get_list(TAG_STATUS_RUN);
        $tag_assign   = $this->Tag_assign_model->get_tag_assign($id_bds, TAG_BDS);

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



        $data['list_tag']     = $list_tag;
        $data['info']         = $info;
        $data['tag_assign']   = $tag_assign;
        $data['cf_bds']       = $this->config->item('bds');
        $data['list_street']  = $list_street;
        $data['list_commune'] = $list_commune;

        $header = [
            'title' => 'Chỉnh sửa bài đăng',
            'header_page_css_js' => 'bds_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'bds/bds_edit_v2_view', $data);
        $this->_loadFooter();
    }

    function edit_submit($id_bds)
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_bds     = is_numeric($id_bds) && $id_bds > 0 ? $id_bds : 0;
        $info   = $this->Bds_model->get_info($id_bds, $this->_session_uid());
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('bds');
        }
        //end check right

        $id_commune_ward = $this->input->post('commune');         // check db + rq
        $id_street       = $this->input->post('street');          // check db + rq
        $id_project      = $this->input->post('project');         // check db
        $category        = $this->input->post('category');        // check db
        $status          = $this->input->post('status');          // check db
        $type            = $this->input->post('type');            // check cf + rq
        $title           = $this->input->post('title');           // check length + rq
        $address         = $this->input->post('address');         // check length 
        // $maps            = $this->input->post('maps', false);        // check length regx
        // $maps            = (htmlentities(htmlspecialchars($maps)));  // to save db // var_dump (html_entity_decode(htmlspecialchars_decode($maps))); // to render
        // $sapo            = $this->input->post('sapo');               // check length + rq
        $content         = $this->input->post('content');         // check length + rq
        $image           = $this->input->post('image');           // check lưu
        $videos          = $this->input->post('video');           // check regx
        $price           = $this->input->post('price');           // check number > 0
        $price_unit      = $this->input->post('price_unit');      // check number > 0
        $price_type      = $this->input->post('price_type');      // check number > 0
        $acreage         = $this->input->post('acreage');         // check số + lớn 30
        $facades         = $this->input->post('facades');         // check số + lớn 30
        $direction       = $this->input->post('direction');       // check cf
        $floor           = $this->input->post('floor');           // check cf
        $toilet          = $this->input->post('toilet');          // check cf
        $bedroom         = $this->input->post('room');            // check cf
        $noithat         = $this->input->post('noithat');            // check cf
        $road_surface    = $this->input->post('road_surface');    // check số + lớn 1
        $juridical       = $this->input->post('juridical');       // check cf
        $is_vip          = $this->input->post('is_vip');          // check cf
        $contacttype     = $this->input->post('contacttype');     // check cf
        $contactname     = $this->input->post('contactname');     // check cf
        $contactaddress  = $this->input->post('contactaddress');  // check cf
        $contactphone    = $this->input->post('contactphone');    // check cf
        $contactemail    = $this->input->post('contactemail');    // check cf
        $tag             = $this->input->post('tag');                // check db

        // TODO: validate dữ liệu submit
        $price = floatval(str_replace(',', '', $price));
        $price = $price_unit == PRICE_UNIT_TRIEU ? $price * PRICE_ONE_MILLION : $price * PRICE_ONE_BILLION;
        if ($price_type == PRICE_TYPE_TOTAL) {
            $price_m2 = $price / $acreage;
            $price_total = $price;
        } else if ($price_type == PRICE_TYPE_M2) {
            $price_total = $price * $acreage;
            $price_m2 = $price;
        }

        //END validate

        # lưu ảnh
        $image_db = [];
        $index = 1;
        $yearFolder = date('Y', strtotime($info['create_time']));
        $monthFolder = date('m', strtotime($info['create_time']));
        foreach ($image as $url_image) {
            if (@getimagesize($url_image)) {
                // kiểm tra ảnh upload có trong tmp
                $la_anh_moi = strpos($url_image, ROOT_DOMAIN . TMP_UPLOAD_PATH);
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
            // dữ liệu bổ sung
            $id_user     = $this->_session_uid();
            $slug_title  = create_slug($title);
            $maps = '';
            $sapo = '';
            $images      = json_encode($image_db);
            $update_time = date('Y-m-d H:i:s');

            $exc = $this->Bds_model->edit($id_bds, $id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $update_time);

            if ($exc) {
                # update tag
                $this->Tag_assign_model->delete_tag_assign($id_bds, TAG_BDS);
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $id_bds, TAG_BDS, $this->_session_uid(), date('Y-m-d H:i:s'));
                }
                $msg = 'OK';
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('bds/edit/' . $id_bds);
    }

    function ajax_update_status()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            resError('not_permit_func');
        }

        $status   = removeAllTags($this->input->post('status'));
        $id_bds   = removeAllTags($this->input->post('id_bds'));

        if (in_array($status, ['0', '1'])) {
            $info = $this->Bds_model->get_info($id_bds, $this->_session_uid());
            if (!empty($info)) {
                $this->Bds_model->update_status($status, $id_bds);
                resSuccess('ok');
            } else {
                resError('not_permit_bds');
            }
        } else {
            resError('error_status');
        }
    }
}
