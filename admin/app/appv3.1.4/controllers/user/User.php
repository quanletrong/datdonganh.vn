<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
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
        $this->load->model('user/User_model');
    }

    function index()
    {
        $data = [];
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }
        $header = [
            'title' => 'Quản lý người dùng',
            'header_page_css_js' => 'user'
        ];

        // SUBMIT FORM (nếu có)
        // if (isset($_POST['action'])) {
        //     $commune_name   = $this->input->post('commune_name');
        //     $commune_type   = $this->input->post('commune_type');
        //     $commune_status = $this->input->post('commune_status');
        //     $commune_image  = $this->input->post('commune_image');
        //     $id_commune     = $this->input->post('id_commune');
        //     $id_commune     = is_numeric($id_commune) && $id_commune > 0 ? $id_commune : 0;


        //     // TẠO MỚI 
        //     if ($_POST['action'] == 'add') {

        //         // TODO: validate dữ liệu submit
        //         //END validate

        //         $copy = copy_image_from_file_manager_to_public_upload($commune_image, date('Y'), date('m'));
        //         if ($copy['status']) {
        //             $exc = $this->Commune_model->add($commune_name, $commune_type, $commune_status, $copy['basename'], $this->_session_uid());
        //             $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
        //         } else {
        //             $msg = $copy['error'];
        //         }
        //         $this->session->set_flashdata('flsh_msg', $msg);
        //         redirect('commune');
        //     }

        //     // CẬP NHẬT
        //     if ($_POST['action'] == 'edit') {

        //         // TODO: validate dữ liệu submit
        //         //END validate

        //         $commune_info   = $this->Commune_model->get_info($id_commune);
        //         if (empty($commune_info)) {
        //             $msg = 'Lưu không thành công vui lòng thử lại!';
        //         } else {
        //             $image_name_post = basename($commune_image);
        //             if ($image_name_post == $commune_info['image']) {
        //                 $exc = $this->Commune_model->edit($id_commune, $commune_name, $commune_type, $commune_status, $commune_image);
        //                 $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
        //             } else {
        //                 $year = date('Y', strtotime($commune_info['create_time']));
        //                 $monthe = date('m', strtotime($commune_info['create_time']));
        //                 $copy = copy_image_from_file_manager_to_public_upload($commune_image, $year, $monthe);
        //                 if ($copy['status']) {
        //                     $exc = $this->Commune_model->edit($id_commune, $commune_name, $commune_type, $commune_status, $copy['basename']);
        //                     $msg = $exc ? 'OK' : 'Lưu không thành công vui lòng thử lại!';
        //                 } else {
        //                     $msg = $copy['error'];
        //                 }
        //             }
        //         }
        //         $this->session->set_flashdata('flsh_msg', $msg);
        //         redirect('commune');
        //     }

        //     // DELETE
        //     if ($_POST['action'] == 'delete') {
        //         $commune_info   = $this->Commune_model->get_info($id_commune);
        //         if (empty($commune_info)) {
        //             $msg = 'Xóa không thành công vui lòng thử lại!!';
        //         } else {
        //             $exc = $this->Commune_model->delete($id_commune);
        //             $msg = $exc ? 'OK' : 'Xóa không thành công vui lòng thử lại!';
        //         }
        //         $this->session->set_flashdata('flsh_msg', $msg);
        //         redirect('commune');
        //     }
        // }

        $list_user =  $this->User_model->get_list();
        $data['list_user'] = $list_user;

        $this->_loadHeader($header);
        $this->load->view($this->_template_f . 'user/user_view', $data);
        $this->_loadFooter();
    }

    function ajax_update_status(){

        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            resError('not_permit_func');
        }

        $status = removeAllTags($this->input->post('status'));
        $id     = removeAllTags($this->input->post('id'));

        if (in_array($status, ['0', '1'])) {
            $info = $this->User_model->get_info($id);
            if (!empty($info)) {
                $this->User_model->update_status($status, $id);
                resSuccess('ok');
            } else {
                resError('not_permit_bds');
            }
        } else {
            resError('error_status');
        }

        resSuccess('ok');
    }

    function ajax_update_role(){

        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            resError('not_permit_func');
        }

        $role = removeAllTags($this->input->post('role'));
        $id   = removeAllTags($this->input->post('id'));

        if (in_array($role, [ADMIN, SALE, USER])) {
            $info = $this->User_model->get_info($id);
            if (!empty($info)) {
                $this->User_model->update_role($role, $id);
                resSuccess('ok');
            } else {
                resError('not_permit_user');
            }
        } else {
            resError('error_role');
        }

        resSuccess('ok');
    }
}
