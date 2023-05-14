<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách Tag</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Quản tag</li>
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
                                <h3 class="card-title">Danh sách tag</h3>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tag" data-type="add">
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
                                        <th>Tên nhãn</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Cập nhật</th>
                                        <th>Bởi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_tag as $index => $cmn) { ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $index + 1 ?></td>
                                            <td class="align-middle"><?= $cmn['name'] ?></td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if ($cmn['status'] === '1') {
                                                    echo '<span class="badge bg-primary">Hiển thị</span>';
                                                } else {
                                                    echo '<span class="badge bg-warning">Ngừng hiển thị</span>';
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
                                                <a href="#" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#modal-tag" data-type="edit" data-tag="<?= htmlentities(json_encode($cmn)) ?>">
                                                    Sửa
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#modal-tag-delete" data-tag="<?= htmlentities(json_encode($cmn)) ?>">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Tên nhãn</th>
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
<div class="modal fade" id="modal-tag" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">...</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_tag" method="post" action="<?= site_url('tag') ?>">
                    <input type="hidden" name="action" value="">
                    <input type="hidden" name="id_tag" value="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nhập tên</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                                </div>

                                <div class="mb-1">
                                    <label>Chọn trạng thái</label>
                                </div>
                                <div class="form-group d-flex" style="gap:20px">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="status_1" name="status" value="1">
                                        <label for="status_1" class="custom-control-label">Hiển thị</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="status_2" name="status" value="2">
                                        <label for="status_2" class="custom-control-label">Tạm ngừng hiển thị</label>
                                    </div>
                                </div>
                                <small class="text-danger">LƯU Ý: Nếu chuyển sang <strong>Tạm ngừng hiển thị</strong> thì tag sẽ bị ẩn khỏi tất cả bài viết (bài đăng bđs, tin tức, lịch đấu giá đất, tài liệu đất) cho đến khi bạn chuyển sang <strong>Hiển thị</strong>.</small>
                            </div>
                            <div class="col-12 col-lg-6">

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
<div class="modal fade" id="modal-tag-delete" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form id="frm_tag_delete" method="post" action="<?= site_url('tag') ?>">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Cảnh báo xóa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_tag" value="">
                    <div class="card-body">
                        <p>
                            Nếu <strong>XÓA</strong> tag này tất cả bài viết (bài đăng bđs, tin tức, lịch đấu giá đất, tài liệu đất) sẽ không còn tag này nữa.
                        </p>
                        <p>
                            Lời khuyên hãy chuyển tag sang trạng thái <span class="badge bg-warning">tạm ngừng hiển thị</span>.
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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#frm_tag').validate({
            submitHandler: function(form) {
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                form.submit();
            },
            rules: {
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                }
            },
            messages: {
                name: {
                    required: "Tên không được bỏ trống",
                    minlength: "Tên tối thiểu 5 ký tự",
                    maxlength: "Tên tối đa 256 ký tự"
                }
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


        $('#modal-tag').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            if (type == 'edit') {
                var tag = button.data('tag');
                $('#frm_tag input[name=action]').val('edit');
                $('#frm_tag input[name=id_tag]').val(tag.id_tag);
                modal.find('.modal-title').text(`Sửa thông tin - ${tag.name}`);
                modal.find('.modal-body #name').val(tag.name);
                modal.find(`.modal-body input:radio[name=status][value=${tag.status}]`).prop('checked', true);
            } else {
                $('#frm_tag input[name=action]').val('add');
                $('#frm_tag input[name=id_tag]').val('');
                modal.find('.modal-title').text(`Thêm đường`);
                modal.find('.modal-body #name').val('');
                modal.find(`.modal-body input:radio[name=status][value=1]`).prop('checked', true);
            }

        })

        $('#modal-tag-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var modal = $(this);
            var tag = button.data('tag');
            $('#name_for_warning_model').text(tag.name);
            $('#frm_tag_delete input[name=id_tag]').val(tag.id_tag);

        });
    });
</script>