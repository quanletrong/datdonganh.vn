<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Document extends MY_Controller
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
        $this->load->model('articles/Articles_model');
        $this->load->model('tag/Tag_model');
        $this->load->model('tag_assign/Tag_assign_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // TODO: validate dư liệu tìm kiếm
        //END validate

        $status   = '';
        $type     = DOCUMENT;
        $title    = '';
        $id_user  = '';
        $f_create = '';
        $t_create = '';
        $limit    = 50;
        $offset   = 0;

        $list = $this->Articles_model->get_list($status, $type, $title, $id_user, $f_create, $t_create, $limit, $offset);

        $data['list'] = $list;
        $header = [
            'title' => 'Quản lý tài liệu',
            'header_page_css_js' => 'news'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'document/document_view', $data);
        // pages/examples/invoice.html TODO: sau chuyển giao diện
        $this->_loadFooter();
    }



    function add()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $status_tag = 1;
        $name_tag = '';
        $list_tag =  $this->Tag_model->get_list($status_tag, $name_tag);
        $data['list_tag'] = $list_tag;

        $header = [
            'title' => 'Thêm tài liệu',
            'header_page_css_js' => 'news_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'document/document_add_view', $data);
        $this->_loadFooter();
    }

    function add_submit()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $title   = $this->input->post('title');                 // check length + rq
        $image   = $this->input->post('image');                 // check lưu
        $sapo    = $this->input->post('sapo');                  // check db + rq
        $content = $this->input->post('content', false);        // check length regx
        $origin  = $this->input->post('origin');
        $tag     = $this->input->post('tag');                   // check db

        $id_user     = $this->_session_uid();
        $create_time = date('Y-m-d H:i:s');

        // TODO: validate dữ liệu submit
        //END validate

        # lưu ảnh bài viết
        preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i', $content, $list_img_tmp);
        foreach (array_pop($list_img_tmp) as $img_tmp) {
            $copy = copy_image_to_public_upload($img_tmp, FOLDER_DOCUMENT);

            $img_link = $copy['status'] ? ROOT_DOMAIN . FOLDER_DOCUMENT . $copy['basename'] : '';
            $content = str_replace($img_tmp, $img_link, $content);

            $basename = basename($img_tmp);
            @unlink($_SERVER["DOCUMENT_ROOT"] . '/' . TMP_UPLOAD_PATH . $basename);
        }

        # lưu ảnh chính
        $copy_main = copy_image_from_file_manager_to_public_upload($image, date('Y'), date('m'));

        // LƯU DỮ LIỆU
        if ($copy_main['status']) {

            // dữ liệu bổ sung
            $type        = DOCUMENT;
            $slug        = create_slug($title);
            $status      = 1;
            $is_hot      = 1;                      //1 hot 0 thường
            $id_user     = $this->_session_uid();
            $create_time = date('Y-m-d H:i:s');

            $content_db = (htmlentities(htmlspecialchars($content))); //xss
            $newid = $this->Articles_model->add($status, $type, $slug, $title, $copy_main['basename'], $sapo, $content_db, $origin, $is_hot, $id_user, $create_time);

            if ($newid) {
                # update tag
                $msg = 'OK';
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $newid, TAG_DOCUMENT, $id_user, $create_time);
                }
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('document');
    }

    function edit($id_article)
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_article     = is_numeric($id_article) && $id_article > 0 ? $id_article : 0;
        $info   = $this->Articles_model->get_info($id_article);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('document');
        }
        //end check right

        //conver json image => arr image
        $year = date('Y', strtotime($info['create_time']));
        $monthe = date('m', strtotime($info['create_time']));
        $image_path = url_image($info['image'], PUBLIC_UPLOAD_PATH . '/' . $year . '/' . $monthe . '/');
        $info['image_path'] = $image_path;
        //end

        $list_tag =  $this->Tag_model->get_list(TAG_STATUS_RUN);
        $data['list_tag'] = $list_tag;

        $tag_assign   = $this->Tag_assign_model->get_tag_assign($id_article, TAG_DOCUMENT);

        $data['info'] = $info;
        $data['tag_assign'] = $tag_assign;

        $header = [
            'title' => 'Chỉnh sửa tài liệu',
            'header_page_css_js' => 'news_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'document/document_edit_view', $data);
        $this->_loadFooter();
    }

    function edit_submit($id_article)
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $id_article = isIdNumber($id_article) ? $id_article : 0;
        $info   = $this->Articles_model->get_info($id_article);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', 'Sửa không thành công vui lòng thử lại!!');
            redirect('document');
        }

        $status      = $this->input->post('status');                // check length + rq
        $title       = $this->input->post('title');                 // check length + rq
        $image       = $this->input->post('image');                 // check lưu
        $sapo        = $this->input->post('sapo');                  // check db + rq
        $content     = $this->input->post('content', false);        // check length regx
        $origin      = $this->input->post('origin');
        $tag         = $this->input->post('tag');                   // check db
        $update_time = date('Y-m-d H:i:s');
        $create_time_set = $this->input->post('create_time_set'); // check time hợp lệ

        // TODO: validate dữ liệu submit
        # check create_time_set
        $create_time_set = strtotime($create_time_set) === false ? $info['create_time_set'] : $create_time_set;
        //END validate

        # nếu là ảnh mới thì copy ảnh
        $yearFolder  = date('Y', strtotime($info['create_time']));
        $monthFolder = date('m', strtotime($info['create_time']));
        $la_anh_moi  = strpos($image, ROOT_DOMAIN . TMP_UPLOAD_PATH);

        if ($la_anh_moi !== false) {
            $copy = copy_image_from_file_manager_to_public_upload($image, $yearFolder, $monthFolder);
            if ($copy['status']) {
                $image = $copy['basename'];
            }
        } else {
            $image = basename($image);
        }

        # loại bỏ những ảnh đã xóa ra khỏi hệ thống (tránh rác)
        preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i', $content, $list_img_new);
        preg_match_all('/<img[^>]*src=([\'"])(?<src>.+?)\1[^>]*>/i', html_entity_decode(htmlspecialchars_decode($info['content'])), $list_img_old);
        $list_img_new = array_pop($list_img_new);
        $list_img_old = array_pop($list_img_old);

        foreach ($list_img_old as $key => $item) {
            $list_img_old[$key] = str_replace(ROOT_DOMAIN, '/', $item);
        }

        $list_img_remove = array_diff($list_img_old, $list_img_new);
        foreach ($list_img_remove as $img_removed) {
            $basename = basename($img_removed);
            @unlink($_SERVER["DOCUMENT_ROOT"] . '/' . FOLDER_DOCUMENT . $basename);
        }

        # chuyển ảnh mới từ TMP sang FOLDER_DOCUMENT
        $list_img_tmp = array_diff($list_img_new, $list_img_old);
        foreach ($list_img_tmp as $img_tmp) {
            $copy = copy_image_to_public_upload($img_tmp, FOLDER_DOCUMENT);

            $img_link = $copy['status'] ? ROOT_DOMAIN . FOLDER_DOCUMENT . $copy['basename'] : '';
            $content = str_replace($img_tmp, $img_link, $content);

            $basename = basename($img_tmp);
            @unlink($_SERVER["DOCUMENT_ROOT"] . '/' . TMP_UPLOAD_PATH . $basename);
        }

        // LƯU DỮ LIỆU
        if ($image != '') {
            $slug       = create_slug($title);
            $content_db = htmlentities(htmlspecialchars($content)); // xss
            $newid = $this->Articles_model->edit($status, $slug, $title, $image, $sapo, $content_db, $origin, $update_time, $create_time_set, $id_article);

            if ($newid) {
                # update tag
                $this->Tag_assign_model->delete_tag_assign($id_article, TAG_DOCUMENT);
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $id_article, TAG_DOCUMENT, $this->_session_uid(), date('Y-m-d H:i:s'));
                }
                $msg = 'OK';
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('document');
    }

    function delete($id_article = 0)
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $id_article = isIdNumber($id_article) ? $id_article : 0;
        $info   = $this->Articles_model->get_info($id_article);
        if (empty($info)) {
            $msg = 'Xóa không thành công vui lòng thử lại!!';
        } else {
            $exc = $this->Articles_model->delete($id_article);
            $msg = $exc ? 'OK' : 'Xóa không thành công vui lòng thử lại!';
        }
        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('document');
    }
}
