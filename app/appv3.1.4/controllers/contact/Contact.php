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
        $phone = removeAllTags($this->input->post('phone'));
        $email = removeAllTags($this->input->post('email'));
        $content = removeAllTags($this->input->post('content'));

        if ($fullname == '' || $phone == '' || $email == '' || $content == '') {
            resError('Các trường thông tin không được bỏ trống');
        }

        $newid = $this->Contact_model->add_thong_tin_dang_ky($fullname, $phone, $email, $content);

        $newid ? resSuccess('ok') : resError('Có lỗi xảy ra. Vui lòng thử lại!');
    }
}
