<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auction extends MY_Controller
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
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // TODO: validate dư liệu tìm kiếm
        //END validate

        $status   = '';
        $type     = AUCTION; // auction
        $title    = '';
        $id_user  = '';
        $f_create = '';
        $t_create = '';
        $limit    = 50;
        $offset   = 0;

        $list = $this->Articles_model->get_list($status, $type, $title, $id_user, $f_create, $t_create, $limit, $offset);

        $data['list'] = $list;
        $header = [
            'title' => 'Quản lý lịch đấu giá',
            'header_page_css_js' => 'news'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'auction/auction_view', $data);
        // pages/examples/invoice.html TODO: sau chuyển giao diện
        $this->_loadFooter();
    }



    function add()
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $header = [
            'title' => 'Thêm lịch đấu giá',
            'header_page_css_js' => 'news_add'
        ];

        $status_tag = 1;
        $name_tag = '';
        $list_tag =  $this->Tag_model->get_list($status_tag, $name_tag);
        $data['list_tag'] = $list_tag;

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'auction/auction_add_view', $data);
        $this->_loadFooter();
    }

    function add_submit()
    {
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $title   = $this->input->post('title');                 // check length + rq
        $image   = $this->input->post('image');                 // check lưu
        $sapo    = $this->input->post('sapo');                  // check db + rq
        $content = $this->input->post('content', false);        // check length regx
        $content = (htmlentities(htmlspecialchars($content)));  // render var_dump(html_entity_decode(htmlspecialchars_decode($maps)))
        $origin  = $this->input->post('origin');
        $tag     = $this->input->post('tag');                   // check db

        $id_user     = $this->_session_uid();
        $create_time = date('Y-m-d H:i:s');

        // TODO: validate dữ liệu submit
        //END validate

        # lưu ảnh
        $copy = copy_image_from_file_manager_to_public_upload($image, date('Y'), date('m'));
        if ($copy['status']) {
            $image = $copy['basename'];
        }
        // LƯU DỮ LIỆU
        if ($image != '') {

            // dữ liệu bổ sung
            $type        = AUCTION; // auction
            $slug  = create_slug($title);
            $status      = 1;
            $is_hot      = 1;                                     //1 hot 0 thường
            $id_user     = $this->_session_uid();
            $create_time = date('Y-m-d H:i:s');

            // echo (html_entity_decode(htmlspecialchars_decode($content)));die;
            $newid = $this->Articles_model->add($status, $type, $slug, $title, $image, $sapo, $content, $origin, $is_hot, $id_user, $create_time);

            if ($newid) {
                # update tag
                $msg = 'OK';
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $newid, TAG_AUCTION, $id_user, $create_time);
                }
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('auction');
    }

    function edit($id_article)
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // check right
        $id_article     = is_numeric($id_article) && $id_article > 0 ? $id_article : 0;
        $info   = $this->Articles_model->get_info($id_article);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', "Không tồn tại bài đăng vừa truy cập");
            redirect('auction');
        }
        //end check right

        //conver json image => arr image
        $year = date('Y', strtotime($info['create_time']));
        $monthe = date('m', strtotime($info['create_time']));
        $image_path = ROOT_DOMAIN . '/' . PUBLIC_UPLOAD_PATH . '/' . $year . '/' . $monthe . '/' . $info['image'];
        $info['image_path'] = $image_path;
        //end

        $list_tag =  $this->Tag_model->get_list(TAG_STATUS_RUN);
        $data['list_tag'] = $list_tag;

        $tag_assign   = $this->Tag_assign_model->get_tag_assign($id_article, TAG_AUCTION);

        $data['info'] = $info;
        $data['tag_assign'] = $tag_assign;
        $header = [
            'title' => 'Chỉnh sửa lịch đấu giá',
            'header_page_css_js' => 'news_add'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'auction/auction_edit_view', $data);
        $this->_loadFooter();
    }

    function edit_submit($id_article)
    {
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $id_article = isIdNumber($id_article) ? $id_article : 0;
        $info   = $this->Articles_model->get_info($id_article);
        if (empty($info)) {
            $this->session->set_flashdata('flsh_msg', 'Sửa không thành công vui lòng thử lại!!');
            redirect('auction');
        }

        $status      = $this->input->post('status');                // check length + rq
        $title       = $this->input->post('title');                 // check length + rq
        $image       = $this->input->post('image');                 // check lưu
        $sapo        = $this->input->post('sapo');                  // check db + rq
        $content     = $this->input->post('content', false);        // check length regx
        $content     = (htmlentities(htmlspecialchars($content)));  // render var_dump(html_entity_decode(htmlspecialchars_decode($maps)))
        $origin      = $this->input->post('origin');
        $tag         = $this->input->post('tag');                   // check db
        $update_time = date('Y-m-d H:i:s');

        // TODO: validate dữ liệu submit
        //END validate

        # lưu ảnh
        $yearFolder = date('Y', strtotime($info['create_time']));
        $monthFolder = date('m', strtotime($info['create_time']));
        // kiểm tra ảnh upload có trong 'uploads/filemanager/source'
        $la_anh_moi = strpos($image, ROOT_DOMAIN . 'uploads/filemanager/source');

        // nếu là ảnh mới thì copy ảnh
        if ($la_anh_moi !== false) {
            $copy = copy_image_from_file_manager_to_public_upload($image, $yearFolder, $monthFolder);
            if ($copy['status']) {
                $image = $copy['basename'];
            }
        }
        // là ảnh cũ thì giữ nguyên
        else {
            $image = basename($image);
        }

        // LƯU DỮ LIỆU
        if ($image != '') {

            $slug  = create_slug($title);
            $newid = $this->Articles_model->edit($status, $slug, $title, $image, $sapo, $content, $origin, $update_time, $id_article);

            if ($newid) {
                # update tag
                $this->Tag_assign_model->delete_tag_assign($id_article, TAG_AUCTION);
                foreach ($tag as $id_tag) {
                    $this->Tag_assign_model->add($id_tag, $id_article, TAG_AUCTION, $this->_session_uid(), date('Y-m-d H:i:s'));
                }
                $msg = 'OK';
            } else {
                $msg = 'Lưu không thành công vui lòng thử lại!';
            }
        } else {
            $msg = 'Không lưu được ảnh!';
        }

        $this->session->set_flashdata('flsh_msg', $msg);
        redirect('auction');
    }

    function delete($id_article = 0)
    {
        if ($this->_session_role() != ADMIN) {
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
        redirect('auction');
    }
}
