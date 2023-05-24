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
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <input type="text" class="form-control" placeholder="Tìm bài viết theo tiêu đề">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select class="select2" name="category" data-minimum-results-for-search="Infinity">
                                        <option value="">Tất cả hình thức</option>
                                        <option value="1">Mua bán nhà đất</option>
                                        <option value="2">Cho thuê</option>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <select class="select2" name="commune">
                                        <option value="">Tất cả xã</option>
                                        <?php foreach ($list_commune as $cmn) { ?>
                                            <option value="<?= $cmn['id_commune_ward'] ?>"><?= $cmn['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select class="select2" name="street">
                                        <option value="">Tất cả đường</option>
                                        <?php foreach ($list_street as $cmn) { ?>
                                            <option value="<?= $cmn['id_street'] ?>"><?= $cmn['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select class="select2" name="is_vip" data-minimum-results-for-search="Infinity">
                                        <option value="">Tất cả loại tin</option>
                                        <option value="1">Khu vip</option>
                                        <option value="0">Khu thường</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <select class="select2" name="status" data-minimum-results-for-search="Infinity">
                                        <option value="">Tất cả chế độ</option>
                                        <option value="1">Công khai</option>
                                        <option value="0">Riêng tư</option>
                                    </select>
                                </div>
                                <!-- ngày -->
                                <div class="col-md-4 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Ngày bắt đầu">
                                        <input type="text" class="form-control" placeholder="Ngày kết thúc">
                                    </div>
                                </div>
                                <!-- Giá -->
                                <div class="col-md-4 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Giá bắt đầu">
                                        <input type="text" class="form-control" placeholder="Giá kết thúc">
                                    </div>
                                </div>
                                <!-- search -->
                                <div class="col-md-2 mb-3">
                                    <button type="button" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th style="min-width: 300px;">Bất động sản</th>
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
                                                <img src="<?= $bds['main_img'] ?>" alt="" class="img-fluid">
                                            </td>
                                            <td class=" text-center align-middle">
                                                <?php if ($bds['status'] == '1') { ?>
                                                    <i class="fas fa-globe-europe text-success" title="Công khai"></i>
                                                <?php } else { ?>
                                                    <i class="fas fa-lock text-secondary" title="Riêng tư"></i>
                                                <?php } ?>
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
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Ảnh</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Chế độ</th>
                                        <th class="text-right" style="min-width: 90px; width: 90px;">Lượt xem</th>
                                        <th class="text-center" style="width: fit-content;"></th>
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