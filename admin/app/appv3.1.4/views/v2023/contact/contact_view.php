<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đăng ký nhận tư vấn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Đăng ký nhận tư vấn</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-danger">
                    <tr>
                        <th class="text-center" width="50">STT</th>
                        <th class="text-center" width="120">Ngày tạo</th>
                        <th width="150">Tên</th>
                        <th width="150">Email</th>
                        <th width="120">Phone</th>
                        <th>Content</th>
                        <th class="text-center" style="width: 90px; min-width: 90px;">Trạng thái</th>
                        <th width="100">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($list_contact as $id_contact => $ct) { ?>
                        <tr>
                            <td class="align-middle text-center"><?= $index++ ?></td>
                            <td class="align-middle" onclick="$('.time_since, .time_date').toggleClass('d-none');" style="cursor: pointer;">
                                <div class="time_since">
                                    <?= timeSince($ct['create_time']) ?> trước
                                </div>
                                <div class="time_date d-none">
                                    <?= date('H:s- d/m/Y', strtotime($ct['create_time'])) ?>
                                </div>
                            </td>
                            k
                            <td class="align-middle"><?= $ct['fullname'] ?></td>
                            <td class="align-middle"><?= $ct['email'] ?></td>
                            <td class="align-middle"><?= $ct['phonenumber'] ?></td>
                            <td class="align-middle">
                                <div style="white-space: pre-line;"><?= $ct['content'] ?></div>
                            </td>
                            <td class="align-middle text-center">

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="drop_change_status_<?= $id_contact ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php if ($ct['status'] == '1') { ?>
                                            <span class="text-success">Đã phản hồi</span>
                                        <?php } else { ?>
                                            <span class="text-danger">Chưa phản hồi</span>
                                        <?php } ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="drop_change_status_<?= $id_contact ?>">
                                        <button class="dropdown-item" type="button" onclick="drop_change_status(1, <?= $id_contact ?>)">Đã phản hồi</button>
                                        <button class="dropdown-item" type="button" onclick="drop_change_status(0, <?= $id_contact ?>)">Chưa phản hổi</button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"><?= $ct['ip_address'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    })

    function drop_change_status(status, id_contact) {
        $('#drop_change_status_' + id_contact).html('<i class="fas fa-sync fa-spin "></i>');

        $.ajax({
            type: "POST",
            url: "<?= site_url('contact/ajax_update_status') ?>",
            data: {
                'status': status,
                'id_contact': id_contact,
            },
            success: function(res) {
                try {
                    let resData = JSON.parse(res);
                    if (resData.status) {

                        if (status) {
                            $('#drop_change_status_' + id_contact).html('<span class="text-success">Đã phản hồi</span>');
                        } else {
                            $('#drop_change_status_' + id_contact).html('<span class="text-danger">Chưa phản hồi</span>');

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