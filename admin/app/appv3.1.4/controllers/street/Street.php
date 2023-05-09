<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Street extends MY_Controller
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
    }

    function index()
    {
        $data = [];
        if ($this->_session_role() != ADMIN) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Quản lý danh sách đường',
            'active_link' => 'street',
            'header_page_css_js' => 'street'
        ];

        // SUBMIT FORM (nếu có)
        if (isset($_POST['action'])) {
            $name   = $this->input->post('name');
            $status = $this->input->post('status');
            $id_street     = $this->input->post('id_street');
            $id_street     = is_numeric($id_street) && $id_street > 0 ? $id_street : 0;


            // TẠO MỚI 
            if ($_POST['action'] == 'add') {

                // TODO: VALIDATION
                $exc = $this->Street_model->add($name, $status, $this->_session_uid());
                $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('street');
            }

            // CẬP NHẬT
            if ($_POST['action'] == 'edit') {

                // TODO: VALIDATION
                $info   = $this->Street_model->get_info($id_street);
                if (empty($info)) {
                    $msg = 'Lưu không thành công vui lòng thử lại!';
                } else {
                    $exc = $this->Street_model->edit($id_street, $name, $status);
                    $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
                }
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('street');
            }

            // CẬP NHẬT
            if ($_POST['action'] == 'delete') {

                // TODO: VALIDATION
                $info   = $this->Street_model->get_info($id_street);
                if (empty($info)) {
                    $msg = 'Xóa không thành công vui lòng thử lại!!';
                } else {
                    $exc = $this->Street_model->delete($id_street);
                    $msg = $exc ? 'OK' : 'Xóa không thành công vui lòng thử lại!';
                }
                $this->session->set_flashdata('flsh_msg', $msg);
                redirect('street');
            }
        }

        $list_street =  $this->Street_model->get_list();
        $data['list_street'] = $list_street;
        $data['cf_street'] = $this->config->item('street');

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'street/street_view', $data);
        $this->_loadFooter();
    }
}
