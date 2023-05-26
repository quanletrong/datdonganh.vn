<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    img.img-alive{
       aspect-ratio: 16/9;
    }
</style>
<?php $this->load->view($template_f . 'home/component/home_slide_filter_view.php'); ?>

<?php $this->load->view($template_f . 'home/component/tin_daugia_tailieu.php'); ?>



<?php //$this->load->view($template_f . 'home/component/bds_danh_cho_ban.php'); ?>
<?php $this->load->view($template_f . 'home/component/bds_vip_thuong_filter_left.php'); ?>


<?php //$this->load->view($template_f . 'home/component/du_an_noi_bat.php'); ?>


<?php $this->load->view($template_f . 'home/component/bds_theo_dia_diem.php'); ?>

<?php $this->load->view($template_f . 'home/component/tin_tuc_bds.php'); ?>


