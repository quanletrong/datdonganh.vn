<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Request_contact extends MY_Controller
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
        $this->load->model('contact/Contact_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Yêu cầu liên hệ lại',
            'header_page_css_js' => 'commune'
        ];

        $fullname   = removeAllTags($this->input->post('fullname'));
        $phone      = removeAllTags($this->input->post('phone'));
        $email      = removeAllTags($this->input->post('email'));
        $content    = removeAllTags($this->input->post('content'));
        $status     = removeAllTags($this->input->post('status'));
        $id_contact = removeAllTags($this->input->post('id_contact'));

        $status     = in_array($status, [0, 1]) ? $status : '';
        $id_contact = isIdNumber($id_contact) ? $id_contact : 0;
        $id_user = $this->_session_role() == SUPERADMIN ? '' : $this->_session_uid(); // super admin xem dc all
        $list_contact =  $this->Contact_model->get_list_yclhl($fullname, $phone, $email, $content, $status, REQUEST_CONTACT, $id_user);

        $data['list_contact'] = $list_contact;
        $data['cf_commune'] = $this->config->item('commune');

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'request_contact/request_contact_view', $data);
        $this->_loadFooter();
    }

    function ajax_update_status()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            resError('Không có quyền truy cập');
        }

        $status   = removeAllTags($this->input->post('status'));
        $id_contact   = removeAllTags($this->input->post('id_contact'));

        if (in_array($status, ['0', '1'])) {
            $info = $this->Contact_model->get_info($id_contact);
            if (!empty($info)) {
                $this->Contact_model->update_status($status, $id_contact);
                resSuccess('ok');
            } else {
                resError('Không tìm thấy yêu cầu');
            }
        } else {
            resError('Dữ liệu không hợp lệ');
        }
    }
}
