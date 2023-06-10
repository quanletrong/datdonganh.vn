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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý bài đăng bất động sản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý bài đăng bất động sản</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Danh sách bài đăng</h3>
                                <a href="<?= site_url('bds/add') ?>" type="button" class="btn btn-primary">
                                    Thêm mới
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <!-- tim kiem -->
                            <?php $this->load->view('v2023/bds/bds_view_tim_kiem'); ?>
                            <!-- /.tim kiem -->

                            <!-- table data -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th style="min-width: 300px;">Bất động sản</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Xã</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Loại đất</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Ảnh</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Chế độ</th>
                                        <th class="text-right" style="min-width: 90px; width: 90px;">Lượt xem</th>
                                        <th class="text-center" style="width: fit-content;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_bds as $index => $bds) { ?>
                                        <tr>
                                            <td class=" text-center  align-middle"><?= $index ?></td>
                                            <td class=" align-middle  align-middle">
                                                <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="mr-2" title="Sửa bài">
                                                    <?php if ($bds['is_vip']) { ?>
                                                        <span class="badge bg-warning">
                                                            TIN VIP
                                                        </span>
                                                    <?php } ?>
                                                    <?= $bds['title'] ?>
                                                </a>
                                            </td>
                                            <td class=" text-center  align-middle">
                                                <?= $bds['commune'] ?>
                                            </td>
                                            <td class=" text-center  align-middle">
                                                <?= $cf_bds['type'][$bds['type']] ?>
                                            </td>
                                            <td class=" text-center  align-middle">
                                                <img src="<?= $bds['main_img'] ?>" alt="" class="img-fluid">
                                            </td>
                                            <td class=" text-center align-middle">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" id="drop_change_status_<?= $bds['id_bds'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php if ($bds['status'] == '1') { ?>
                                                            <i class="fas fa-globe-europe text-success" title="Công khai"></i>
                                                        <?php } else { ?>
                                                            <i class="fas fa-lock text-secondary" title="Riêng tư"></i>
                                                        <?php } ?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="drop_change_status_<?= $bds['id_bds'] ?>">
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(1, <?= $bds['id_bds'] ?>)">Công khai</button>
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(0, <?= $bds['id_bds'] ?>)">Riêng tư</button>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-right  align-middle">
                                                <?= number_format($bds['view']) ?>
                                            </td>
                                            <td class="text-center  align-middle">
                                                <div class="d-flex">
                                                    <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="mr-2" title="Sửa bài">
                                                        <i class="fas fa-edit text-warning"></i>
                                                    </a>
                                                    <a href="" class="mr-2" data-toggle="modal" data-target="#modal-bds-archive" data-bds="<?= htmlentities(json_encode($bds)) ?>" title="Xóa bài">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                    <a href="#" title="Xem bài đăng">
                                                        <i class="fas fa-external-link-square-alt"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th style="min-width: 100px;">Bất động sản</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Xã</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Loại đất</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Ảnh</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Chế độ</th>
                                        <th class="text-right" style="min-width: 90px; width: 90px;">Lượt xem</th>
                                        <th class="text-center" style="width: fit-content;"></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- /.table data -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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
            <form id="frm_bds_delete" method="post" action="<?= site_url('bds/delete') ?>">
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
            "lengthChange": true,
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

    function drop_change_status(status, id_bds) {
        $('#drop_change_status_'+id_bds).html('<i class="fas fa-sync fa-spin "></i>');
        
        $.ajax({
            type: "POST",
            url: "<?= site_url('bds/ajax_update_status') ?>",
            data: {
                'status': status,
                'id_bds': id_bds,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (status) {
                            $('#drop_change_status_'+id_bds).html('<i class="fas fa-globe-europe text-success" title="Công khai"></i>');
                        } else {
                            $('#drop_change_status_'+id_bds).html('<i class="fas fa-lock text-secondary" title="Riêng tư"></i>');

                        }
                        toasts_success();
                    } else {
                        toasts_danger(resData.data);
                    }
                } catch (error) {
                    toasts_danger();
                }
            }
        });
    }
</script>