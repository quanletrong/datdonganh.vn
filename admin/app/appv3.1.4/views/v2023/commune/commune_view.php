<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách xã phường thị trấn trên địa bàn Huyện Đông Anh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý xã phường thị trấn</li>
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
                                <h3 class="card-title">Danh sách xã phường thị trấn</h3>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-commune">
                                    Thêm mới
                                </button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Tên</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Loại</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Ngày cập nhật</th>
                                        <th>Người tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_commune as $index => $cmn) { ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $index + 1 ?></td>
                                            <td class="align-middle"><?= $cmn['name'] ?></td>
                                            <td class="align-middle text-center"><img src='<?= $cmn['image'] ?>' width="100" class="rounded"></td>
                                            <td class="align-middle text-center"><span class="badge bg-primary"><?= $cf_commune['list'][$cmn['type']] ?></span></td>
                                            <th class="align-middle text-center">
                                                <?= $cmn['status'] ? '<span class="badge bg-primary">Hoạt đồng</span>' : '<span class="badge bg-warning">Ngừng hoạt đồng</span>' ?>
                                            </th>
                                            <td class="align-middle text-center"><?= $cmn['create_time'] ?></td>
                                            <td class="align-middle text-center"><?= $cmn['update_time'] ?></td>
                                            <td class="align-middle"><?= $cmn['username'] ?></td>
                                            <td class="align-middle text-center">
                                                <a href="commune/edit/<?= $cmn['id_commune_ward'] ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".modal-edit-commune" data-commune="<?= htmlentities(json_encode($cmn)) ?>">
                                                    Sửa
                                                </a>
                                                <a href="commune/delete/<?= $cmn['id_commune_ward'] ?>" class="btn btn-sm btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Tên</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Loại</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Ngày cập nhật</th>
                                        <th>Người tạo</th>
                                        <th></th>
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

<!-- modal add -->
<div class="modal fade" id="modal-add-commune" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm xã phường thị trấn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_commune" method="post" action="<?= site_url('commune') ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="commune_name">Nhập tên</label>
                                    <input type="text" class="form-control" id="commune_name" name="commune_name" placeholder="Nhập tên">
                                </div>

                                <div class="mb-1">
                                    <label>Chọn loại</label>
                                </div>
                                <div class="form-group d-flex" style="gap:20px">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_xa" name="commune_type" value="1">
                                        <label for="commune_type_xa" class="custom-control-label">Xã</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_phuong" name="commune_type" value="2">
                                        <label for="commune_type_phuong" class="custom-control-label">Phường</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_tt" name="commune_type" value="3">
                                        <label for="commune_type_tt" class="custom-control-label">Thị trấn</label>
                                    </div>
                                </div>
                                <label>Nhập ảnh nổi bật</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="<?= ROOT_DOMAIN ?>/filemanager/filemanager/dialog.php?type=1&field_id=commune_image" class="btn btn-primary iframe-btn">Chọn ảnh</a>
                                    </div>
                                    <input type="text" class="form-control" id="commune_image" name="commune_image" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <img src="" id="commune_image_pre" class="rounded img-fluid w-100 shadow" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal edit -->
<div class="modal fade modal-edit-commune" id="" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa thông tin xã phường thị trấn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_commune" method="post" action="<?= site_url('commune') ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="commune_name">Nhập tên</label>
                                    <input type="text" class="form-control" id="commune_name" name="commune_name" placeholder="Nhập tên">
                                </div>

                                <div class="mb-1">
                                    <label>Chọn loại</label>
                                </div>
                                <div class="form-group d-flex" style="gap:20px">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_xa" name="commune_type" value="1">
                                        <label for="commune_type_xa" class="custom-control-label">Xã</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_phuong" name="commune_type" value="2">
                                        <label for="commune_type_phuong" class="custom-control-label">Phường</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_tt" name="commune_type" value="3">
                                        <label for="commune_type_tt" class="custom-control-label">Thị trấn</label>
                                    </div>
                                </div>
                                <label>Nhập ảnh nổi bật</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="<?= ROOT_DOMAIN ?>/filemanager/filemanager/dialog.php?type=1&field_id=commune_image" class="btn btn-primary iframe-btn">Chọn ảnh</a>
                                    </div>
                                    <input type="text" class="form-control" id="commune_image" name="commune_image" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <img src="" id="commune_image_pre" class="rounded img-fluid w-100 shadow" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('.iframe-btn').fancybox({
            'type': 'iframe',
            'autoScale': true,
            'iframe': {
                'css': {
                    'width': '1024px',
                    'height': '800px'
                }
            }
        });

        const cf_commune = <?= json_encode($cf_commune) ?>;
        $('#frm_commune').validate({
            submitHandler: function(form) {
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                form.submit();
            },
            rules: {
                commune_name: {
                    required: cf_commune.name.rq,
                    minlength: 5,
                    maxlength: cf_commune.name.max
                },
                commune_image: {
                    required: cf_commune.image.rq
                }
            },
            messages: {
                commune_name: {
                    required: "Tên không được bỏ trống",
                    minlength: "Tên tối thiểu 5 ký tự",
                    maxlength: "Tên tối đa " + cf_commune.name.max + " ký tự"
                },
                commune_image: {
                    required: "Ảnh không được bỏ trống",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group, .input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('.modal-edit-commune').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var commune = button.data('commune') // Extract info from data-* attributes
            console.log(commune)
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)
        })
    });

    function responsive_filemanager_callback(field_id) {
        var url = jQuery('#' + field_id).val();
        $('#commune_image_pre').attr('src', url).show();
        // $('#commune_image_name').text(url.match(/.*\/(.*)$/)[1])
    }
</script>