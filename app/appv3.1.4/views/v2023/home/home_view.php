<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=496850024134978&autoLogAppEvents=1" nonce="mZsx0XH9"></script>
<style>
    img.img-alive {
        aspect-ratio: 16/9;
    }
</style>
<?php $this->load->view($template_f . 'home/component/home_slide_filter_view.php'); ?>

<?php $this->load->view($template_f . 'home/component/tin_daugia_tailieu.php'); ?>



<?php //$this->load->view($template_f . 'home/component/bds_danh_cho_ban.php'); 
?>
<?php $this->load->view($template_f . 'home/component/bds_vip_thuong_filter_left.php'); ?>


<?php //$this->load->view($template_f . 'home/component/du_an_noi_bat.php'); 
?>


<?php $this->load->view($template_f . 'home/component/bds_theo_dia_diem.php'); ?>

<?php $this->load->view($template_f . 'home/component/tin_tuc_bds.php'); ?>