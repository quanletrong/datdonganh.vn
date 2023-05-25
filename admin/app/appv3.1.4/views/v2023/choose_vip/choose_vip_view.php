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
                    <h1>Chọn tin vip ra trang chủ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Chọn tin vip ra trang chủ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Danh sách
                        <span class="badge bg-warning">
                            TIN VIP
                        </span>
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select id="list_vip" class="duallistbox" multiple="multiple" style="height: 500px;">
                                    <?php foreach ($list_bds_vip as $id_bds => $bds) { ?>
                                        <option value="<?= $id_bds ?>" <?=$bds['is_home_vip'] ? 'selected' : '' ?>>
                                            - <?= $bds['title'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-danger" onclick="update()"> Cập nhật</button>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(function() {
        $('.duallistbox').bootstrapDualListbox();
    });

    function update() {
        let list_selected = $('#list_vip option:selected').map(function() {
            return this.value
        }).get()
        let list_unselected = $('#list_vip option:not(:selected)').map(function() {
            return this.value
        }).get()

        if (list_selected.length == 0) {
            alert('Bạn chưa chọn tin VIP nào.');
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?= site_url('choose_vip/ajax_update') ?>",
            data: {
                'list_selected': list_selected,
                'list_unselected' : list_unselected
            },
            success: function(res) {
                if (res == 'ok') {
                    toasts_success();
                } else {
                    toasts_danger();
                }
            }
        });

    }
</script>