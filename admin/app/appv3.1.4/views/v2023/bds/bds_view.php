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
                <div class="col-sm-6 ">
                    <div class="float-sm-right">
                        <a href="<?= site_url('bds/add') ?>" type="button" class="btn btn-primary">
                            Đăng tin
                        </a>
                    </div>

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
                            <th class="text-center" style="min-width: 90px; width: 90px;">Xã</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Loại đất</th>
                            <th class="text-center" style="min-width: 90px; width: 90px;">Ảnh</th>
                            <th class="text-right" style="min-width: 90px; width: 90px;">Lượt xem</th>
                            <th class="text-center" style="width: fit-content;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_bds as $index => $bds) { ?>
                            <tr id="tr-<?= $bds['id_bds'] ?>">
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
                                <td class="text-right  align-middle">
                                    <?= number_format($bds['view']) ?>
                                </td>
                                <td class="text-center  align-middle">
                                    <div class="d-flex align-items-center">
                                        <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="mr-2" title="Sửa bài">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>

                                        <!-- Nút lưu trữ -->
                                        <?php if ($bds['status'] == '1') { ?>
                                            <i class="fas fa-trash text-danger mr-2" style="cursor: pointer;" title="Thùng rác" onclick="on_change_status(this, 0, <?= $bds['id_bds'] ?>)"></i>
                                        <?php } ?>


                                        <!-- Nút khôi phục -->
                                        <?php if ($bds['status'] == '0') { ?>
                                            <i class="fas fa-trash-restore text-success mr-2" style="cursor: pointer;" title="Khôi phục" onclick="on_change_status(this, 1, <?= $bds['id_bds'] ?>)"></i>
                                        <?php } ?>

                                        <!-- Nút Xóa hoàn toàn -->
                                        <?php if ($bds['status'] == '0') { ?>
                                            <i class="fas fa-times-circle text-danger mr-2" style="cursor: pointer;" title="Xóa khỏi hệ thống" onclick="on_change_delete(this, <?= $bds['id_bds'] ?>)"></i>
                                        <?php } ?>

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

    function on_change_status(e, new_status, id_bds) {
        let text_confirm = "";
        if(new_status) {
            text_confirm =  "Đưa tin này ra khỏi thùng rác. Người dùng sẽ nhìn thấy tin này"
        } else {
            text_confirm = "Chuyển tin này vào thùng rác! Người dùng sẽ không nhìn thấy tin này nữa. Bạn có thể khôi phục tin trong thùng rác.";
        }

        if (confirm(text_confirm) == true) {
            $(e).removeClass('fa-trash fa-trash-restore').addClass('fa-sync fa-spin');
            $.ajax({
                type: "POST",
                url: "<?= site_url('bds/ajax_update_status') ?>",
                data: {
                    'status': new_status,
                    'id_bds': id_bds,
                },
                success: function(res) {
                    try {
                        let resData = JSON.parse(res);
                        if (resData.status) {
                            $(`#tr-${id_bds}`).remove();
                            toasts_success(new_status ? 'Tin này đã được khôi phục' : 'Tin này đã chuyển vào thùng rác!');
                        } else {
                            toasts_danger(resData.data);
                        }
                    } catch (error) {
                        toasts_danger();
                    }
                }
            });
        }
    }

    function on_change_delete(e, id_bds) {

        if (confirm("Xóa khỏi hệ thống! Bạn không thể khôi phục tin đã xóa khỏi hệ thống.") == true) {
            $(e).removeClass('fa-times-circle').addClass('fa-sync fa-spin');
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
                            toasts_success('Tin này đã được xóa khỏi hệ thống.');
                        } else {
                            toasts_danger(resData.data);
                        }
                    } catch (error) {
                        toasts_danger();
                    }
                }
            });
        }
    }
</script>