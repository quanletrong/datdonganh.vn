<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                                <h3 class="card-title">Danh sách người dùng</h3>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-user" data-type="add">
                                    Tạo tài khoản
                                </button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-danger">
                                    <tr>
                                        <th>Tài khoản</th>
                                        <th>Tên hiển thị</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Quyền</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th>Người tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_user as $index => $cmn) { ?>
                                        <tr>
                                            <td class="align-middle"> <?= $cmn['username'] ?> </td>
                                            <td class="align-middle"><?= $cmn['fullname'] ?></td>
                                            <td class="align-middle text-center"><img src='' width="100" class="rounded"></td>
                                            <td class="align-middle text-center">
                                                <!-- Quyền -->
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle pl-0" type="button" id="drop_change_role_<?= $cmn['id_user'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php if ($cmn['role'] == '2') { ?>
                                                            <span class="text-danger">ADMIN</span>
                                                        <?php } else if ($cmn['role'] == '3') { ?>
                                                            <span class="text-warning">SALER</span>
                                                        <?php } else if ($cmn['role'] == '4') { ?>
                                                            <span class="">KHÁCH</span>
                                                        <?php } ?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="drop_change_role_<?= $cmn['id_user'] ?>">
                                                        <button class="dropdown-item" type="button" onclick="drop_change_role(2, <?= $cmn['id_user'] ?>)">
                                                            <span class="text-danger">ADMIN</span></button>
                                                        <button class="dropdown-item" type="button" onclick="drop_change_role(3, <?= $cmn['id_user'] ?>)">
                                                            <span class="text-warning">SALER</span></button>
                                                        <button class="dropdown-item" type="button" onclick="drop_change_role(4, <?= $cmn['id_user'] ?>)">
                                                            <span class="">KHÁCH</span></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <!-- TRạng thái -->
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" id="drop_change_status_<?= $cmn['id_user'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php if ($cmn['status'] == '1') { ?>
                                                            <i class="fas fa-globe-europe text-success" title="Hoạt động"></i>
                                                        <?php } else { ?>
                                                            <i class="fas fa-lock text-secondary" title="Khóa"></i>
                                                        <?php } ?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="drop_change_status_<?= $cmn['id_user'] ?>">
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(1, <?= $cmn['id_user'] ?>)">
                                                            <i class="fas fa-globe-europe text-success" title="Hoạt động"></i> Hoạt động</button>
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(0, <?= $cmn['id_user'] ?>)">
                                                            <i class="fas fa-lock text-secondary" title="Khóa"></i> Khóa</button>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center">
                                                <?= date('d/m/Y', strtotime($cmn['create_time'])) ?>
                                            </td>
                                            <td class="align-middle"><?= @$list_user['id_user_create'] ?></td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#modal-user" data-type="edit" data-user="<?= htmlentities(json_encode($cmn)) ?>">
                                                    Sửa</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tài khoản</th>
                                        <th>Tên hiển thị</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Quyền</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Ngày tạo</th>
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

<!-- modal edit -->
<div class="modal fade" id="modal-user" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post" action="<?= site_url('user') ?>">
                    <input type="hidden" name="action" value="">
                    <input type="hidden" name="id_user" value="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="username">Tài khoản</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên">
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Tên hiển thị</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập tên">
                                </div>

                                <div class="mb-1">
                                    <label>Chọn loại</label>
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Sô điện thoại</label>
                                    <input type="tel" class="form-control" id="phonenumber" name="phonenumber" placeholder="số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="số điện thoại">
                                </div>

                                <div class="mb-1">
                                    <label>Chọn trạng thái</label>
                                </div>
                                <div class="form-group d-flex" style="gap:20px">
                                    ....
                                </div>

                                <label>Ảnh đại diện</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="<?= ROOT_DOMAIN ?>/filemanager/filemanager/dialog.php?type=1&field_id=avatar" class="btn btn-primary iframe-btn">Chọn ảnh</a>
                                    </div>
                                    <input type="text" class="form-control" id="avatar" name="avatar" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <img src="" id="avatar_pre" class="rounded img-fluid w-100 shadow" />
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
            "paging": true,
            "pageLength": 100,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // $('#form').validate({
        //     submitHandler: function(form) {
        //         $(form).find('button[type="submit"]').attr('disabled', 'disabled');
        //         form.submit();
        //     },
        //     rules: {
        //         fullname: {
        //             required: cf_commune.name.rq,
        //             minlength: 5,
        //             maxlength: cf_commune.name.max
        //         },
        //         avatar: {
        //             required: cf_commune.image.rq
        //         }
        //     },
        //     messages: {
        //         fullname: {
        //             required: "Tên không được bỏ trống",
        //             minlength: "Tên tối thiểu 5 ký tự",
        //             maxlength: "Tên tối đa " + cf_commune.name.max + " ký tự"
        //         },
        //         avatar: {
        //             required: "Ảnh không được bỏ trống",
        //         },
        //     },
        //     errorElement: 'span',
        //     errorPlacement: function(error, element) {
        //         error.addClass('invalid-feedback');
        //         element.closest('.form-group, .input-group').append(error);
        //     },
        //     highlight: function(element, errorClass, validClass) {
        //         $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         $(element).removeClass('is-invalid');
        //     }
        // });


        $('#modal-user').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            if (type == 'edit') {
                var user = button.data('user');
                $('#form input[name=action]').val('edit');
                $('#form input[name=id_user]').val(user.id_user);
                modal.find('.modal-title').text(`Sửa thông tin - ${user.fullname}`);
                modal.find('.modal-body #username').val(user.username);
                modal.find('.modal-body #fullname').val(user.fullname);
                modal.find('.modal-body #avatar').val(user.avatar);
                modal.find('.modal-body #email').val(user.email);
                modal.find('.modal-body #phonenumber').val(user.phonenumber);
                modal.find(`.modal-body input:radio[name=user_status][value=${user.status}]`).prop('checked', true);
                modal.find('.modal-body #avatar_pre').attr('src', user.image_path);
            } else {
                $('#form input[name=action]').val('add');
                $('#form input[name=id_user]').val('');
                modal.find('.modal-title').text(`Thêm tài khoản`);
                modal.find('.modal-body #fullname').val('');
                modal.find('.modal-body #avatar').val('');
                modal.find('.modal-body #avatar_pre').attr('src', '');
                modal.find(`.modal-body input:radio[name=commune_type][value=1]`).prop('checked', true);
                modal.find(`.modal-body input:radio[name=commune_status][value=1]`).prop('checked', true);
            }

        })

        $('#modal-user-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            var commune = button.data('commune');
            $('#name_for_warning_model').text(commune.name);
            $('#form_delete input[name=id_user]').val(commune.id_user_ward);

        });
    });

    function drop_change_status(status, id) {
        $('#drop_change_status_' + id).html('<i class="fas fa-sync fa-spin "></i>');

        $.ajax({
            type: "POST",
            url: "<?= site_url('user/ajax_update_status') ?>",
            data: {
                'status': status,
                'id': id,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (status) {
                            $('#drop_change_status_' + id).html('<i class="fas fa-globe-europe text-success" title="Hoạt động"></i>');
                        } else {
                            $('#drop_change_status_' + id).html('<i class="fas fa-lock text-secondary" title="Khóa"></i>');

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

    function drop_change_role(role, id) {
        $('#drop_change_role_' + id).html('<i class="fas fa-sync fa-spin "></i>');

        $.ajax({
            type: "POST",
            url: "<?= site_url('user/ajax_update_role') ?>",
            data: {
                'role': role,
                'id': id,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (role === 2) {
                            $('#drop_change_role_' + id).html('<span class="text-danger">ADMIN</span>');
                        } else if (role === 3) {
                            $('#drop_change_role_' + id).html('<span class="text-warning">SALER</span>');
                        } else if (role === 4) {
                            $('#drop_change_role_' + id).html('<span class="">KHÁCH</span>');
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