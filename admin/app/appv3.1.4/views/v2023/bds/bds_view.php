<?php ?>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th style="min-width: 200px;">Tiêu đề</th>
                                        <th class="text-center">Tài nguyên</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="" style="min-width: 120px;">Vị trí</th>
                                        <th class="" style="min-width: 140px;">Đặc điểm</th>
                                        <th style="min-width: 120px;">Người đăng</th>
                                        <th class="text-center">Lượt xem</th>
                                        <th class="text-center" style="width: 62px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_bds as $index => $bds) { ?>
                                        <tr>
                                            <td class=" text-center"><?= $index ?></td>
                                            <td class="" style="width: 200px;">
                                                <strong><?= $bds['title'] ?></strong><br><br>

                                                Loại đất: <?= $cf_bds['type'][$bds['type']] ?> <br>
                                                Hết hạn: <?= date('d-m-Y', strtotime($bds['expired'])) ?> <br>
                                                Loại tin: <?= $cf_bds['is_hot'][$bds['is_vip']] ?> <br>
                                            </td>
                                            <td class=" text-center">
                                                Ảnh/Video
                                            </td>
                                            <td class=" text-center">
                                                <span class="badge bg-primary">
                                                    <?= $cf_bds['status'][$bds['status']] ?>
                                                </span>
                                            </td>
                                            <td class="" style="width: 100px;">
                                                <strong><?= $bds['commune'] ?></strong> <br>
                                                <?= $bds['street'] ?> <br>
                                            </td>

                                            <td class="">
                                                <strong>Diện tích: <?= $bds['acreage'] ?> m²</strong> <br>
                                                <strong>Giá:<?= $bds['price'] == 0 ? 'Thương lượng' : $bds['price'] ?></strong> <br>
                                                Hướng nhà: <?= @$cf_bds['direction'][$bds['direction']] ?> <br>
                                                Đường vào: <?= @$bds['road_surface'] ?> mét </br>
                                                Sô tầng: <?= @$cf_bds['floor'][$bds['floor']] ?> <br>
                                                Phòng ngủ: <?= @$cf_bds['bedroom'][$bds['bedroom']] ?> <br>
                                                Toilet: <?= @$cf_bds['toilet'][$bds['toilet']] ?> <br>
                                                Nội thất: <?= @$cf_bds['noithat'][$bds['noithat']] ?> <br>
                                                Pháp lý: <?= @$cf_bds['juridical'][$bds['juridical']] ?>
                                            </td>

                                            <td class="">
                                                Đăng bởi: <br>
                                                <strong><?= $bds['username'] ?></strong> <br>
                                                Ngày đăng: <br>
                                                <?= date('H:i d/m/Y', strtotime($bds['create_time'])) ?> <br>
                                                Cập nhật cuối: <br>
                                                <?= strtotime($bds['update_time']) > 0 ? date('H:i d/m/Y', strtotime($bds['update_time'])) : '' ?>
                                            </td>

                                            <td class="text-center">
                                                0
                                            </td>
                                            <td class="text-center" style="width: 50px;">
                                                <a href="<?= site_url('bds/edit/' . $bds['id_bds']) ?>" class="w-100 btn btn-sm btn-primary mb-1">
                                                    Sửa bài
                                                </a> <br>
                                                <a href="" class="w-100  btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#modal-bds-archive" data-bds="<?= htmlentities(json_encode($bds)) ?>">Lưu trữ</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th style="min-width: 200px;">Tiêu đề</th>
                                        <th class="text-center">Tài nguyên</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="" style="min-width: 120px;">Vị trí</th>
                                        <th class="" style="min-width: 140px;">Đặc điểm</th>
                                        <th style="min-width: 120px;">Người đăng</th>
                                        <th class="text-center">Lượt xem</th>
                                        <th class="text-center" style="width: 50px;">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                    <h4 class="modal-title text-center">Cảnh báo lưu trữ</h4>
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
                            Bài viết này sẽ chuyển vào khu vực <span class="badge bg-warning">lưu trữ</span> <br>
                            Người dùng không nhìn thấy bài đăng này nữa.
                            <br>
                            <br>
                            <a href="#" class="btn btn-sm btn-warning shadow">Danh sách lưu trữ</a>

                        </p>
                    </div>
                    <!-- /.card-body -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                    <button type="submit" class="btn btn-outline-light">Vẫn lưu trữ</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
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
</script>