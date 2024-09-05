<?php ?>
<style>
    .select2 {
        width: 100% !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div style="display: flex; justify-content: space-between;">
                <h1>Quản lý bất động sản</h1>
                <div class="float-sm-right">
                    <a href="<?= site_url('bds/add') ?>" type="button" class="btn btn-primary">
                        Đăng tin
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="table-responsive">
                <!-- tim kiem -->
                <?php $this->load->view('v2023/bds/bds_view_tim_kiem'); ?>
                <!-- /.tim kiem -->

                <!-- table data -->
                <table id="example1" class="table table-bordered table-striped" style="background: white;">
                    <thead class="thead-danger">
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th style="min-width: 300px;">Bất động sản</th>
                            <th class="text-right" style="min-width: 90px; width: 90px;">Giá</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Loại Tin</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Xã</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Loại đất</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Ảnh</th>
                            <th class="text-right" style="min-width: 90px; width: 90px;">Lượt xem</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_bds as $index => $bds) { ?>
                            <tr id="tr-<?= $bds['id_bds'] ?>">
                                <td class=" text-center  align-middle"><?= $index ?></td>
                                <td class=" align-middle  align-middle">
                                    <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="mr-2" title="Sửa bài">
                                        <?= $bds['title'] ?>
                                    </a>
                                </td>
                                <td class=" text-right  align-middle">
                                    <?= getPrice($bds['price_total']) ?>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="drop_loai_tin_<?= $bds['id_bds'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            <?php if ($bds['status'] == 0) { ?>
                                                <span class="badge bg-danger">TIN ĐANG HẠ</span>
                                            <?php } else if ($bds['is_vip'] == '1') { ?>
                                                <span class="badge bg-warning">TIN VIP</span>
                                            <?php } else if ($bds['is_vip'] == '0') { ?>
                                                <span class="badge bg-secondary">TIN THƯỜNG</span>
                                            <?php } ?>

                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="drop_loai_tin_<?= $bds['id_bds'] ?>">

                                            <?php if ($bds['status'] == 0) { ?>
                                                <button class="dropdown-item" type="button" onclick="drop_khoi_phuc_tin(<?= $bds['id_bds'] ?>, <?= $bds['is_vip'] ?>)">KHÔI PHỤC TIN</button>
                                            <?php } else { ?>
                                                <button class="dropdown-item" type="button" onclick="drop_change_vip(1, <?= $bds['id_bds'] ?>)">TIN VIP</button>
                                                <button class="dropdown-item" type="button" onclick="drop_change_vip(0, <?= $bds['id_bds'] ?>)">TIN THƯỜNG</button>
                                                <button class="dropdown-item" type="button" onclick="drop_ha_tin(<?= $bds['id_bds'] ?>, <?= $bds['is_vip'] ?>)">HẠ TIN</button>
                                            <?php } ?>

                                            <button class="dropdown-item" type="button" onclick="drop_xoa_vinh_vien(<?= $bds['id_bds'] ?>)">XÓA VĨNH VIỄN</button>

                                        </div>
                                    </div>
                                </td>
                                <td class=" text-center  align-middle">
                                    <?= $bds['commune'] ?>
                                </td>
                                <td class=" text-center  align-middle">
                                    <?= $cf_bds['type'][$bds['type']] ?>
                                </td>
                                <td class=" text-center  align-middle">
                                    <img alt="" class="img-fluid lazy" data-src='<?= $bds['main_img'] ?>'>
                                </td>
                                <td class="text-right  align-middle">
                                    <?= number_format($bds['view']) ?>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="mr-2" title="Sửa bài">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>

                                        <a href="<?= ROOT_DOMAIN . $bds['slug_title'] . '-p' . $bds['id_bds'] ?>" title="Xem bài đăng" target="_blank">
                                            <i class="fas fa-external-link-square-alt"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table data -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- modal delete -->
<div class="modal fade" id="modal-bds-archive" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form id="frm_bds_delete" method="post" action="<?= site_url('bds/archive') ?>">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Cảnh báo xóa bài</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_bds" value="">
                    <div class="card-body">
                        <p>
                            <!-- name_for_warning_model -->
                            Người dùng không nhìn thấy bài đăng này nữa.
                            <br>
                            <br>
                            <a href="#" class="btn btn-sm btn-warning shadow">Danh sách bài đã xóa</a>

                        </p>
                    </div>
                    <!-- /.card-body -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                    <button type="submit" class="btn btn-outline-light">Vẫn xóa</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(function() {

        $('.lazy').lazy();

        $('.select2').select2();
        $('.select2').on('change', function() {
            // if (this.value > 0) {
            //     $(this).siblings('.error').hide();
            // } else {
            //     $(this).siblings('.error').show();
            // }
        })

        $("#example1").DataTable({
            "paging": true,
            "pageLength": 100,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#modal-bds-archive').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            var bds = button.data('bds');
            $('#name_for_warning_model').text(bds.title);
            $('#frm_bds_delete input[name=id_bds]').val(bds.id_bds);

        });
    });

    function drop_xoa_vinh_vien(id_bds) {

        if (confirm("Tin sẽ bị xóa vĩnh viễn khỏi hệ thống. Vẫn tiếp tục?") == true) {
            let old_html = $('#drop_loai_tin_' + id_bds).html();
            $('#drop_loai_tin_' + id_bds).html('<i class="fas fa-sync fa-spin "></i>');
            $.ajax({
                type: "POST",
                url: "<?= site_url('bds/ajax_delete_bds') ?>",
                data: {
                    'id_bds': id_bds,
                },
                success: function(res) {
                    try {
                        let resData = JSON.parse(res);
                        if (resData.status) {
                            $(`#tr-${id_bds}`).remove();
                            toasts_success('Đã xóa vĩnh viễn.');
                        } else {
                            toasts_danger(resData.data);
                            $('#drop_loai_tin_' + id_bds).html(old_html);
                        }
                    } catch (error) {
                        toasts_danger();
                    }
                }
            });
        }
    }

    function drop_change_vip(vip, id_bds) {
        let old_html = $('#drop_loai_tin_' + id_bds).html();
        $('#drop_loai_tin_' + id_bds).html('<i class="fas fa-sync fa-spin "></i>');

        $.ajax({
            type: "POST",
            url: "<?= site_url('bds/ajax_update_vip') ?>",
            data: {
                'vip': vip,
                'id_bds': id_bds,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (vip) {
                            $('#drop_loai_tin_' + id_bds).html('<span class="badge bg-warning">TIN VIP</span>');
                        } else {
                            $('#drop_loai_tin_' + id_bds).html('<span class="badge bg-secondary">TIN THƯỜNG</span>');

                        }
                        toasts_success();
                    } else {
                        toasts_danger(resData.error);
                        $('#drop_loai_tin_' + id_bds).html(old_html);
                    }
                } catch (error) {
                    toasts_danger();
                }
            }
        });
    }

    function drop_khoi_phuc_tin(id_bds, vip_thuong) {
        if (confirm("Người dùng sẽ nhìn thấy tin này. Vẫn tiếp tục?") == true) {
            let old_html = $('#drop_loai_tin_' + id_bds).html();
            $('#drop_loai_tin_' + id_bds).html('<i class="fas fa-sync fa-spin "></i>');

            $.ajax({
                type: "POST",
                url: "<?= site_url('bds/ajax_update_status') ?>",
                data: {
                    'status': 1,
                    'id_bds': id_bds,
                },
                success: function(res) {
                    try {
                        let resData = JSON.parse(res);
                        if (resData.status) {

                            if (vip_thuong) {
                                $('#drop_loai_tin_' + id_bds).html('<span class="badge bg-warning">TIN VIP</span>');
                            } else {
                                $('#drop_loai_tin_' + id_bds).html('<span class="badge bg-secondary">TIN THƯỜNG</span>');
                            }

                            $(`#tr-${id_bds} .dropdown-menu`).html(`
                            <button class="dropdown-item" type="button" onclick="drop_change_vip(1, ${id_bds})">TIN VIP</button>
                            <button class="dropdown-item" type="button" onclick="drop_change_vip(0, ${id_bds})">TIN THƯỜNG</button>
                            <button class="dropdown-item" type="button" onclick="drop_ha_tin(${id_bds}, ${vip_thuong})">HẠ TIN</button>
                            <button class="dropdown-item" type="button" onclick="drop_xoa_vinh_vien(${id_bds})">XÓA VĨNH VIỄN</button>
                        `);

                        } else {
                            toasts_danger(resData.error);
                            $('#drop_loai_tin_' + id_bds).html(old_html);
                        }
                    } catch (error) {
                        toasts_danger();
                    }
                }
            });
        }
    }

    function drop_ha_tin(id_bds, vip_thuong) {
        if (confirm("Người dùng sẽ không nhìn thấy tin này nữa. Vẫn tiếp tục?") == true) {
            let old_html = $('#drop_loai_tin_' + id_bds).html();
            $('#drop_loai_tin_' + id_bds).html('<i class="fas fa-sync fa-spin "></i>');

            $.ajax({
                type: "POST",
                url: "<?= site_url('bds/ajax_update_status') ?>",
                data: {
                    'status': 0,
                    'id_bds': id_bds,
                },
                success: function(res) {
                    try {
                        let resData = JSON.parse(res);
                        if (resData.status) {

                            $('#drop_loai_tin_' + id_bds).html('<span class="badge bg-danger">TIN ĐANG HẠ</span>');

                            $(`#tr-${id_bds} .dropdown-menu`).html(`
                            <button class="dropdown-item" type="button" onclick="drop_khoi_phuc_tin(${id_bds}, ${vip_thuong})">KHÔI PHỤC TIN</button>
                            <button class="dropdown-item" type="button" onclick="drop_xoa_vinh_vien(${id_bds})">XÓA VĨNH VIỄN</button>
                        `);

                        } else {
                            toasts_danger(resData.error);
                            $('#drop_loai_tin_' + id_bds).html(old_html);
                        }
                    } catch (error) {
                        toasts_danger();
                    }
                }
            });
        }

    }
</script>