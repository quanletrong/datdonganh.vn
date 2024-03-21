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
                                <thead class="thead-danger">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Tiêu đề</th>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center" style="min-width: 90px; width: 90px;">Trạng thái</th>
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
                                            <td class="align-middle"><a href="auction/edit/<?= $id_articles ?>"><?= $articles['title'] ?></a></td>
                                            <td class="align-middle text-center"><img src='<?= $articles['image_path'] ?>' width="100" class="rounded"></td>
                                            <td class="align-middle text-center">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" id="drop_change_status_<?= $id_articles ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php if ($articles['status'] == '1') { ?>
                                                            <i class="fas fa-globe-europe text-success" title="Công khai"></i>
                                                        <?php } else { ?>
                                                            <i class="fas fa-lock text-secondary" title="Riêng tư"></i>
                                                        <?php } ?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="drop_change_status_<?= $id_articles ?>">
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(1, <?= $id_articles ?>)">Công khai</button>
                                                        <button class="dropdown-item" type="button" onclick="drop_change_status(0, <?= $id_articles ?>)">Riêng tư</button>
                                                    </div>
                                                </div>
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

        $('#modal-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var id_article = button.data('id');
            $('#name_for_warning_model').text(title);
            $('#btn_xoa').attr('href', `<?= site_url('auction/delete') ?>/${id_article}`);

        });
    });

    function drop_change_status(status, id_article) {
        $('#drop_change_status_'+id_article).html('<i class="fas fa-sync fa-spin "></i>');
        
        $.ajax({
            type: "POST",
            url: "<?= site_url('auction/ajax_update_status') ?>",
            data: {
                'status': status,
                'id_article': id_article,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (status) {
                            $('#drop_change_status_'+id_article).html('<i class="fas fa-globe-europe text-success" title="Công khai"></i>');
                        } else {
                            $('#drop_change_status_'+id_article).html('<i class="fas fa-lock text-secondary" title="Riêng tư"></i>');

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