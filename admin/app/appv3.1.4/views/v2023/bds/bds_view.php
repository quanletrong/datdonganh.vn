<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(function() {

        <?php if ($this->session->flashdata('flsh_msg') != 'OK' && $this->session->flashdata('flsh_msg') != FALSE) { ?>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Thất bại',
                subtitle: '',
                body: '<?= $this->session->flashdata('flsh_msg') ?>'
            })
        <?php } ?>

        <?php if ($this->session->flashdata('flsh_msg') == 'OK') { ?>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Thành công',
                subtitle: '',
                body: 'Cập nhật thành công!'
            })
        <?php } ?>
    })
</script>