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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-commune" data-type="add">
                                    Thêm mới
                                </button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-danger">
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Tên</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Loại</th>
                                        <th class="text-center" style="width: 90px; min-width: 90px;">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Cập nhật</th>
                                        <th>Bởi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_commune as $index => $cmn) { ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $index + 1 ?></td>
                                            <td class="align-middle"><?= $cmn['name'] ?></td>
                                            <td class="align-middle text-center"><img src='<?= $cmn['image_path'] ?>' width="100" class="rounded"></td>
                                            <td class="align-middle text-center"><span class="badge bg-primary"><?= $cf_commune['list'][$cmn['type']] ?></span></td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if ($cmn['status'] === '1') {
                                                    echo '<span class="badge bg-primary">Hoạt động</span>';
                                                } else {
                                                    echo '<span class="badge bg-warning">Ngừng hoạt động</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= date('H:i d/m/Y', strtotime($cmn['create_time'])) ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= strtotime($cmn['update_time']) > 0 ? date('H:i d/m/Y', strtotime($cmn['update_time'])) : '' ?>
                                            </td>
                                            <td class="align-middle"><?= $cmn['username'] ?></td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#modal-commune" data-type="edit" data-commune="<?= htmlentities(json_encode($cmn)) ?>">
                                                    Sửa
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger mb-1 d-none" data-toggle="modal" data-target="#modal-commune-delete" data-commune="<?= htmlentities(json_encode($cmn)) ?>">Xóa</a>
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
                                        <th class="text-center">Cập nhật</th>
                                        <th>Bởi</th>
                                        <th>Action</th>
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

<!-- modal edit -->
<div class="modal fade" id="modal-commune" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_commune" method="post" action="<?= site_url('commune') ?>">
                    <input type="hidden" name="action" value="">
                    <input type="hidden" name="id_commune" value="">
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
                                        <input class="custom-control-input" type="radio" id="commune_type_1" name="commune_type" value="1">
                                        <label for="commune_type_1" class="custom-control-label">Xã</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_2" name="commune_type" value="2">
                                        <label for="commune_type_2" class="custom-control-label">Phường</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_type_3" name="commune_type" value="3">
                                        <label for="commune_type_3" class="custom-control-label">Thị trấn</label>
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label>Chọn trạng thái</label>
                                </div>
                                <div class="form-group d-flex" style="gap:20px">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_status_1" name="commune_status" value="1">
                                        <label for="commune_status_1" class="custom-control-label">Hoạt động</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="commune_status_2" name="commune_status" value="2">
                                        <label for="commune_status_2" class="custom-control-label">Ngừng hoạt động</label>
                                    </div>
                                </div>

                                <label>Nhập ảnh nổi bật</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-sm btn-warning" onclick="quanlt_upload(this);" data-callback="cb_upload_image_commune" data-target="#commune_image">
                                            <i class="fas fa-upload"></i> chọn ảnh
                                        </button>
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
<!-- modal edit (tạm bỏ chức năng xóa xã)-->
<div class="modal fade" id="modal-commune-delete" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form id="frm_commune_delete" method="post" action="<?= site_url('commune') ?>">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Cảnh báo xóa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_commune" value="">
                    <div class="card-body">
                        <p>
                            Các bài đăng bất động sản liên quan đến địa danh <span class="badge bg-warning" id="name_for_warning_model">...</span> sẽ chuyển trạng thái sang <span class="badge bg-warning">lưu trữ</span> và không thể khôi phục được. <br>
                            Lời khuyên hãy đổi trạng thái sang <span class="badge bg-warning">ngừng hoạt động</span>!
                        <p><a href="#" class="btn btn-sm btn-warning shadow">Danh sách bài đăng bất động sản liên quan</a></p>
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

        $("#example1").DataTable({
            "order": [],
            "lengthChange": true,
            "pageLength": 50,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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


        $('#modal-commune').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            if (type == 'edit') {
                var commune = button.data('commune');
                $('#frm_commune input[name=action]').val('edit');
                $('#frm_commune input[name=id_commune]').val(commune.id_commune_ward);
                modal.find('.modal-title').text(`Sửa thông tin - ${commune.name}`);
                modal.find('.modal-body #commune_name').val(commune.name);
                modal.find('.modal-body #commune_image').val(commune.image);
                modal.find(`.modal-body input:radio[name=commune_type][value=${commune.type}]`).prop('checked', true);
                modal.find(`.modal-body input:radio[name=commune_status][value=${commune.status}]`).prop('checked', true);
                modal.find('.modal-body #commune_image_pre').attr('src', commune.image_path);
            } else {
                $('#frm_commune input[name=action]').val('add');
                $('#frm_commune input[name=id_commune]').val('');
                modal.find('.modal-title').text(`Thêm xã phường thị trấn`);
                modal.find('.modal-body #commune_name').val('');
                modal.find('.modal-body #commune_image').val('');
                modal.find('.modal-body #commune_image_pre').attr('src', '');
                modal.find(`.modal-body input:radio[name=commune_type][value=1]`).prop('checked', true);
                modal.find(`.modal-body input:radio[name=commune_status][value=1]`).prop('checked', true);
            }

        })

        $('#modal-commune-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            var commune = button.data('commune');
            $('#name_for_warning_model').text(commune.name);
            $('#frm_commune_delete input[name=id_commune]').val(commune.id_commune_ward);

        });
    });

    function cb_upload_image_commune(link, target, name) {
        $(target).removeClass('is-invalid');
        $('#commune_image').val(link);
        $('#commune_image_pre').attr('src', link).show();
        $('#image-error').hide();
    }
</script>