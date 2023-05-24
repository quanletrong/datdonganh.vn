<?php
class Tag extends MY_Controller
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
        $this->load->model('tag/Tag_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // SUBMIT FORM (nếu có)
        if (isset($_POST['action'])) {
            $name   = $this->input->post('name');
            $status = $this->input->post('status');
            $id_tag     = $this->input->post('id_tag');
            $id_tag     = is_numeric($id_tag) && $id_tag > 0 ? $id_tag : 0;


            // TẠO MỚI 
            if ($_POST['action'] == 'add') {

                // TODO: validate dữ liệu submit
                //END validate

                $exc = $this->Tag_model->add($name, $status, $this->_session_uid());
                $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('tag');
            }

            // CẬP NHẬT
            if ($_POST['action'] == 'edit') {

                // TODO: validate dữ liệu submit
                //END validate

                $info   = $this->Tag_model->get_info($id_tag);
                if (empty($info)) {
                    $msg = 'Lưu không thành công vui lòng thử lại!';
                } else {
                    $exc = $this->Tag_model->edit($id_tag, $name, $status);
                    $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
                }
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('tag');
            }

            // CẬP NHẬT
            if ($_POST['action'] == 'delete') {

                // TODO: validate dữ liệu submit
                //END validate

                $info   = $this->Tag_model->get_info($id_tag);
                if (empty($info)) {
                    $msg = 'Xóa không thành công vui lòng thử lại!!';
                } else {
                    $exc = $this->Tag_model->delete($id_tag);
                    $msg = $exc ? 'OK' : 'Xóa không thành công vui lòng thử lại!';
                }
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('tag');
            }
        }

        $status = '';
        $name = '';
        $list_tag =  $this->Tag_model->get_list($status, $name);
        $data['list_tag'] = $list_tag;
        $data['cf_tag'] = $this->config->item('tag');

        $header = [
            'title' => 'Quản lý tag',
            'header_page_css_js' => 'tag'
        ];

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'tag/tag_view', $data);
        $this->_loadFooter();
    }

    function add()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        $tag   = removeAllTags($this->input->post('tag'));
        $info_by_name = $this->Tag_model->get_info_by_name($tag);

        if (empty($info_by_name)) {
            $status = 1;
            $newid = $this->Tag_model->add($tag, $status, $this->_session_uid());
            echo $newid;
            die;
        } else {
            echo 'exits';
            die;
        }
    }
}
