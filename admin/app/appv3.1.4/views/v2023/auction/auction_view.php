<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách lịch đấu giá</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách lịch đấu giá</li>
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
                                <h3 class="card-title">Danh sách lịch đấu giá</h3>
                                <a href="auction/add" class="btn btn-primary">
                                    Thêm mới
                                </a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Tiêu đề</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Ngày tạo</th>
                                        <th class="text-center">Cập nhật</th>
                                        <th>Bởi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $id_articles => $articles) { ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $id_articles ?></td>
                                            <td class="align-middle"><?= $articles['title'] ?></td>
                                            <td class="align-middle text-center"><img src='<?= $articles['image_path'] ?>' width="100" class="rounded"></td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if ($articles['status'] === '1') {
                                                    echo '<span class="badge bg-primary">Đang hiển thị</span>';
                                                } else {
                                                    echo '<span class="badge bg-warning">Ngừng hiển thị</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= date('H:i d/m/Y', strtotime($articles['create_time'])) ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?= strtotime($articles['update_time']) > 0 ? date('H:i d/m/Y', strtotime($articles['update_time'])) : '' ?>
                                            </td>
                                            <td class="align-middle"><?= $articles['username'] ?></td>
                                            <td class="align-middle text-center">
                                                <a href="auction/edit/<?= $id_articles ?>" class="btn btn-sm btn-primary mb-1">
                                                    Sửa
                                                </a>
                                                <a href="" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#modal-delete" data-title="<?= $articles['title'] ?>" data-id="<?= $id_articles ?>">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Tiêu đề</th>
                                        <th class="text-center">Ảnh</th>
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
<div class="modal fade" id="modal-delete" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Cảnh báo xóa bài</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <p>
                            <h5 id="name_for_warning_model">...</h5> sẽ chuyển vào khu vực <span class="badge bg-warning">lưu trữ</span> bạn chắc chắn muốn điều đó?
                        <p><a href="#" class="btn btn-sm btn-warning shadow">Danh sách bài lưu trữ</a></p>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                    <a href="" class="btn btn-outline-light" id="btn_xoa">Vẫn xóa</a>
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
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#modal-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var id_article = button.data('id');
            $('#name_for_warning_model').text(title);
            $('#btn_xoa').attr('href', `<?= site_url('auction/delete') ?>/${id_article}`);

        });
    });
</script>