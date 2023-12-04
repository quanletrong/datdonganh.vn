<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller
{

    function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->load->model('contact/Contact_model');
    }

    function ajax_dang_ky_nhan_thong_tin()
    {

        $fullname = removeAllTags($this->input->post('fullname'));
        $phone    = removeAllTags($this->input->post('phone'));
        $email    = removeAllTags($this->input->post('email'));
        $content  = removeAllTags($this->input->post('content'));
        $id_bds   = removeAllTags($this->input->post('id_bds'));
        $type     = removeAllTags($this->input->post('type'));


        if ($fullname == '' || $phone == '' || $email == '' || $content == '') {
            resError('Các trường thông tin không được bỏ trống');
        }

        if($id_bds != '' && !isIdNumber($id_bds)) {
            resError('Bất động sản không tồn tại');
        }

        if(!in_array($type, [CONTACT, REQUEST_CONTACT])) {
            resError('Dữ liệu không hợp lệ');
        }

        $newid = $this->Contact_model->add_thong_tin_dang_ky($fullname, $phone, $email, $content, $id_bds, $type);

        $newid ? resSuccess('ok') : resError('Có lỗi xảy ra. Vui lòng thử lại!');
    }
}
