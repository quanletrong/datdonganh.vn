<?php ?>
<style>
    .error.invalid-feedback {
        margin-left: 25%;
    }

    #content-error {
        margin-left: 0;
    }

    .input-group .error.invalid-feedback {
        margin-left: 0;
        margin-bottom: 10px;
    }

    /* // XX-Large devices (larger desktops, 1400px and up) */
    .box-item {
        width: 100%;
    }

    .box-item .card {
        height: 97%;
    }

    @media (min-width: 1600px) {
        .box-item {
            width: 49.5%;
        }

        .list-image>li {
            width: 31% !important;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $info['title'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('bds') ?>">Quản lý bđs</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa bất động sản</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <form id="frm_bds" action="<?= site_url('bds/edit_submit/' . $info['id_bds']) ?>" method="post" class="d-flex flex-wrap justify-content-between">
                <!-- ĐĂNG MỚI TIN RAO -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">ĐĂNG MỚI TIN RAO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Tiêu đề <span class="text-danger">*</span></label>
                                        </div>
                                        <textarea class="form-control" style="width:75%" name="title" rows="3"><?= $info['title'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Địa chỉ <span class="text-danger">*</span></label>
                                        </div>
                                        <textarea class="form-control" style="width:75%" name="address" rows="3"><?= $info['address'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Hình thức <span class="text-danger">*</span></label>
                                        </div>
                                        <select class="select2" style="width: 75%;" name="category" data-minimum-results-for-search="Infinity">
                                            <option value="1" <?= $info['category'] == '1' ? 'selected' : '' ?>>Mua bán nhà đất</option>
                                            <option value="2" <?= $info['category'] == '2' ? 'selected' : '' ?>>Cho thuê</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Loại hình <span class="text-danger">*</span></label>
                                        </div>
                                        <select class="select2" style="width:75%" name="type">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                                <option value="<?= $id ?>" <?= $info['type'] == $id ? 'selected' : '' ?>><?= $name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Diện tích <span class="text-danger">*</span></label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="acreage" value="<?= $info['acreage'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Xã <span class="text-danger">*</span></label>
                                        </div>
                                        <select class="select2" style="width:75%" name="commune">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($list_commune as $cmn) { ?>
                                                <option value="<?= $cmn['id_commune_ward'] ?>" <?= $info['id_commune_ward'] == $cmn['id_commune_ward'] ? 'selected' : '' ?>><?= $cmn['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Giá</label>
                                        </div>
                                        <div class="input-group" style="width:75%">
                                            <input type="text" class="form-control w-75" name="price" value="<?= $info['price_view'] ?>">
                                            <select class="form-control w-25" name="price_unit">
                                                <option value="1" <?= $info['price_unit'] == '1' ? 'selected' : '' ?>>Triệu</option>
                                                <option value="2" <?= $info['price_unit'] == '2' ? 'selected' : '' ?>>Tỷ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Đường <span class="text-danger">*</span></label>
                                        </div>
                                        <select class="select2" style="width:75%" name="street">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($list_street as $street) { ?>
                                                <option value="<?= $street['id_street'] ?>" <?= $info['id_street'] == $street['id_street'] ? 'selected' : '' ?>><?= $street['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Đơn vị</label>
                                        </div>
                                        <select class="select2" style="width:75%" name="price_type">
                                            <option value="1" <?= $info['price_type'] == '1' ? 'selected' : '' ?>>VNĐ</option>
                                            <option value="2" <?= $info['price_type'] == '2' ? 'selected' : '' ?>>VNĐ/m2</option>
                                            <!-- <option value="3" <?= $info['price_type'] == '3' ? 'selected' : '' ?>>VNĐ/tháng</option> -->
                                            <!-- <option value="4" <?= $info['price_type'] == '4' ? 'selected' : '' ?>>VNĐ/m2/tháng</option> -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Dự án</label>
                                        </div>
                                        <select class="select2" style="width:75%" name="project">
                                            <option value="0">Vui lòng chọn</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Bằng chữ</label>
                                        </div>
                                        <textarea type="text" class="form-control text-danger" style="width:75%" id="price_word" readonly disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Từ khóa</label>
                                        </div>
                                        <select class="select2" id="tag" name="tag[]" multiple="multiple" data-placeholder="Chọn từ khóa có sẵn" style="width: 75%">
                                            <?php foreach ($list_tag as $id_tag => $tag) { ?>
                                                <option value="<?= $id_tag ?>" <?= isset($tag_assign[$id_tag]) ? 'selected' : '' ?>><?= $tag['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" class="btn btn-warning btn-sm mt-2" style="margin-left: 25%;" data-toggle="modal" data-target="#modal-tag-add">Thêm từ khóa mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.ĐĂNG MỚI TIN RAO -->

                <!-- THÔNG TIN MÔ TẢ -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">THÔNG TIN MÔ TẢ</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="content" name="content"><?= htmlentities($info['content']) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. THÔNG TIN MÔ TẢ-->

                <!-- THONG TIN KHAC -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">THÔNG TIN KHÁC</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Mặt tiền</label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="facades" value="<?= $info['facades'] == '0' ? '' : $info['facades'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Đường vào</label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="road_surface" value="<?= $info['road_surface'] == '0' ? '' : $info['road_surface'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Hướng nhà</label>
                                        </div>
                                        <select class="select2" style="width:75%" name="direction">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($cf_bds['direction'] as $id => $name) { ?>
                                                <option value="<?= $id ?>" <?= $info['direction'] == $id ? 'selected' : '' ?>><?= $name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Nội thất</label>
                                        </div>
                                        <select class="select2" style="width:75%" name="noithat">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($cf_bds['noithat'] as $id => $name) { ?>
                                                <option value="<?= $id ?>" <?= $id == $info['noithat'] ? 'selected' : '' ?>><?= $name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Sô tầng</label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="floor" value="<?= $info['floor'] == '0' ? '' : $info['floor'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Phòng ngủ</label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="room" value="<?= $info['bedroom'] == '0' ? '' : $info['bedroom'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Số toilet</label>
                                        </div>
                                        <input type="text" class="form-control" style="width:75%" name="toilet" value="<?= $info['toilet'] == '0' ? '' : $info['toilet'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-25" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Pháp lý</label>
                                        </div>
                                        <select class="select2" style="width:75%" name="juridical">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php foreach ($cf_bds['juridical'] as $id => $name) { ?>
                                                <option value="<?= $id ?>" <?= $id == $info['juridical'] ? 'selected' : '' ?>><?= $name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. THONG TIN KHAC-->

                <!--VIDEO HÌNH ẢNH -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">HÌNH ẢNH VIDEO</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- ảnh -->
                                <div class="col-md-7">
                                    <label for="">Thêm ảnh</label>
                                    <div class="d-flex" style="align-items: center; gap:20px">
                                        <button type="button" class="btn btn-sm btn-warning quanlt-upload" data-target="">
                                            <i class="fas fa-upload"></i> Thêm ảnh cho tin đăng
                                        </button>
                                        <div>
                                            <input type="checkbox" id="quanlt-upload_chen-logo">
                                            <label for="quanlt-upload_chen-logo" class="m-0">Chèn logo</label>
                                        </div>

                                    </div>
                                    <span id="image-error" class="invalid-feedback" style="font-size: 80%; color: red;">
                                        Tin này cần tối thiểu 1 ảnh.
                                    </span>

                                    <ul id="sortable" class="d-flex w-100 flex-wrap list-image" style="gap:10px; list-style: none; padding: 0;">
                                        <?php $images = json_decode($info['images'], true); ?>
                                        <?php foreach ($images as $image_name) { ?>
                                            <li class="ui-state-default" style="width: 23%; height: fit-content; cursor: pointer; position: relative; border: none;">
                                                <img src="<?= fullPathImage($image_name, $info['year'], $info['month']) ?>" class="img-fluid p-1 rounded shadow" style="aspect-ratio: 1; object-fit: cover;" />
                                                <i class="fas fa-trash" style="position:absolute; right: 10px; top: 15px; color: red" onclick="$(this).parent().remove()"></i>
                                                <i class="fas fa-search-plus" style="position:absolute; right: 35px; top: 15px; color: red"></i>
                                                <input type="hidden" name="image[]" value="<?= fullPathImage($image_name, $info['year'], $info['month']) ?>" />
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <hr class="d-block d-md-none">
                                </div>


                                <!-- video -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Thêm video</label>
                                        <textarea id="video" class="form-control" name="video" rows="3" placeholder="Nhập link video embed youtube" aria-invalid="true"><?= $info['videos'] ?></textarea>
                                    </div>

                                    <a class="btn btn-danger btn-sm" onclick="remove_video()">Xóa video</a>

                                    <p>
                                        <small>Video không bắt buộc nhập</small><br>
                                        <small>Nếu không xem được link vừa nhập có thể nguyên nhân do link nhập không chính xác hoặc video để chế độ riêng tư.</small>
                                    </p>

                                    <div class="w-100">
                                        <iframe id="videp_pre" style="width: 100%; <?= $info['videos'] == '' ? 'display: none;' : '' ?>" height="200" src="<?= $info['videos'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen allowscriptaccess="always"></iframe>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.VIDEO HÌNH ẢNH-->

                <!--THÔNG TIN LIÊN HỆ -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">THÔNG TIN LIÊN HỆ</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Tôi là <span class="text-danger">*</span></label>
                                    </div>
                                    <select class="select2" style="width:75%" name="contacttype">
                                        <option value="1" <?= $info['contacttype'] == '1' ? 'selected' : '' ?>>Môi giới</option>
                                        <option value="2" <?= $info['contacttype'] == '2' ? 'selected' : '' ?>>Chính chủ</option>>
                                    </select>
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Tên liên hệ <span class="text-danger">*</span></label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="contactname" value="<?= $info['contactname'] ?>">
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Địa chỉ </label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="contactaddress" value="<?= $info['contactaddress'] ?>">
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Điện thoại <span class="text-danger">*</span></label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="contactphone" value="<?= $info['contactphone'] ?>">
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Email </label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="contactemail" value="<?= $info['contactemail'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.THÔNG TIN LIÊN HỆ -->

                <!-- LỊCH ĐĂNG TIN -->
                <div class="box-item">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="display: contents;">LỊCH ĐĂNG TIN</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-50" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Hiển thị <span class="text-danger">*</span></label>
                                        </div>
                                        <select class="select2" style="width:50%" name="is_vip" data-minimum-results-for-search="Infinity">
                                            <option value="1" <?= $info['is_vip'] == '1' ? 'selected' : '' ?>>Tin VIP</option>
                                            <option value="0" <?= $info['is_vip'] == '0' ? 'selected' : '' ?>>Tin thường</option>>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-50" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Hết hạn</label>
                                        </div>
                                        <input type="text" class="form-control text-danger" style="width:50%" value="Admin không hết hạn" readonly disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="me-2 w-50" style="text-align: end;">
                                            <label class="m-0 p-0 pr-1">Sửa ngày tạo</label>
                                        </div>
                                        <input type="text" class="form-control w-50" id="create_time_set" />
                                        <input type="hidden" name="create_time_set" id="hidden_create_time_set" value="<?=date("Y-m-d", strtotime($info['create_time_set']));
?>"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. LỊCH ĐĂNG TIN-->

                <div style="margin: 0 auto; margin-top: 10px;">
                    <button type="submit" class="btn btn-danger btn-lg" type="submit">Tôi đã kiểm tra lại nội dung. Lưu lại!</button>
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<!-- modal delete image -->
<div class="modal fade" id="modal-image-delete" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Cảnh báo xóa ảnh</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modal_image_pre" src="" class="rounded img-fluid w-100 shadow p-1" alt="">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                <button type="button" id="model_btn_xoa_anh" class="btn btn-danger" onclick="" data-dismiss="modal">Vẫn xóa</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- modal tag add -->
<div class="modal fade" id="modal-tag-add" style="display: none" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Từ khóa mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nhập tên từ khóa" id="tag-add" onkeyup="checkTagAdd(this.value)">
                <span id="tag-add-error" class="error invalid-feedback" style="display: none;">...</span>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                <button type="button" id="model_btn_xoa_anh" class="btn btn-primary" onclick="ajax_add_tag()">Thêm từ khóa mới</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <script>
        function checkTagAdd(tag) {
            if (tag.length >= 5 && tag.length <= 30) {
                $("#tag-add").removeClass('is-invalid')
                $("#tag-add-error").hide().html('');
                return true;
            } else {
                $("#tag-add").addClass('is-invalid')
                $("#tag-add-error").show().html('Tag tối thiểu 5 ký tự tối đa 25 ký tự');
                return false;
            }
        }

        function ajax_add_tag() {
            let tag = $("#tag-add").val().trim();
            if (checkTagAdd(tag)) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('tag/add') ?>",
                    data: {
                        'tag': tag
                    },
                    success: function(new_tag) {
                        if (new_tag == 'exits') {
                            $("#tag-add").addClass('is-invalid')
                            $("#tag-add-error").show().html(`Tag <strong>${tag}</strong> đã tồn tại`);
                        } else if (new_tag > 0) {
                            var data = {
                                id: new_tag,
                                text: tag
                            };
                            var newOption = new Option(data.text, data.id, false, true);
                            $('#tag').append(newOption).trigger('change');
                            $("#tag-add").val('');
                            $("#tag-add").removeClass('is-invalid')
                            $("#tag-add-error").hide().html('');

                            // thông báo thành công
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Thành công',
                                subtitle: '',
                                body: 'Cập nhật thành công!'
                            })
                        } else {
                            $("#tag-add").addClass('is-invalid')
                            $("#tag-add-error").show().html('Có lỗi xảy ra vui lòng thử lại!');
                        }
                    }
                });
            }
        }
    </script>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal tag add -->

<!-- upload anh -->
<form id="frm_files" enctype="multipart/form-data" action="upload" method="post">
    <input type="file" id="fileButton" name="file[]" accept="image/*" multiple hidden />
    <script>
        $(function() {

            $('.quanlt-upload').click(function() {
                let callback = $(this).data('callback');
                let target = $(this).data('target');
                $('#fileButton').click();
            })

            $("#frm_files").on('change', '#fileButton', function(e) {
                e.preventDefault();
                var formData = new FormData($(this).parents('form')[0]);

                let checked_logo = $('#quanlt-upload_chen-logo').is(":checked") ? 1 : 0;
                $.ajax({
                    url: 'upload?logo=' + checked_logo,
                    type: 'POST',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    beforeSend: function() {
                        $('.list-image').append(`<li id="placeholder-quanlt-upload" class="m-1 p-1 rounded shadow" style="width: 23%;aspect-ratio: 1;display: flex;align-items: center;justify-content: center;">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </li>`);
                    },
                    success: function(response) {
                        $('#placeholder-quanlt-upload').remove();
                        callback_upload_image_bds(response);
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                });
                return false;
            });
        })
    </script>
</form>
<!-- /.upload anh -->

<script>
    $(function() {

        $("#sortable").sortable();
        $('.select2').select2();
        $('.select2').on('change', function() {
            let list_required = ['commune', 'street', 'type'];
            let select_current_name = $(this).attr('name');
            if (list_required.includes(select_current_name)) {
                validobj.element(`select[name="${select_current_name}"]`);
            }
        })

        $('input, textarea').focusout(function() {
            let list_required = ['title', 'address', 'price', 'acreage', 'content', 'contactname', 'contactphone'];
            let select_current_name = $(this).attr('name');
            if (list_required.includes(select_current_name)) {
                validobj.element(`*[name="${select_current_name}"]`);
            }
        })

        // giá bằng chữ
        render_price_red();

        $('input[name="price"], input[name="acreage"]').on('keyup', function() {
            render_price_red()
        })

        $('select[name="price_unit"], select[name="price_type"]').change(function() {
            render_price_red()
        })

        function render_price_red() {
            let unit = $('select[name="price_unit"]').find(":selected").val();
            let price_type = $('select[name="price_type"]').find(":selected").val();
            let acreage = parseFloat($.trim($('input[name="acreage"]').val()));
            let price = $.trim($('input[name="price"]').val());
            const regex = /,/ig;
            price = parseFloat(price.replaceAll(regex, ''));

            if (isNaN(acreage) || isNaN(price)) {
                $('#price_word').val('');
            } else {

                if (price === 0 || isNaN(price)) {
                    $('#price_word').val('');
                } else {
                    let price_red = 0;

                    // tính giá
                    if (price_type === '1') {
                        price_red = price / acreage; // show giá/m2 nếu price_type là VNĐ
                    } else if (price_type === '2') {
                        price_red = price * acreage; // show tổng giá nếu price_type là VNĐ/m2
                    }

                    // nhân đơn vị
                    if (unit == '1') {
                        price_red = price_red * 1000000;
                    } else {
                        price_red = price_red * 1000000000;
                    }

                    // làm tròn
                    if (price_red >= 1000000000) {
                        price_red = Math.round(parseFloat((price_red / 1000000000).toFixed(3)) * 1000000000);
                    } else {
                        price_red = Math.round(parseFloat((price_red / 1000000).toFixed(1)) * 1000000);
                    }

                    $('#price_word').val(VNnum2words(price_red) + `${price_type === '1' ? '/m2' : ' VND'}`);
                }
            }
        }

        tinymce.init({
            selector: '#content',
            height: "400",
            relative_urls: false,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'help', 'link', 'autoresize'
            ],
            toolbar_sticky: true,
            toolbar: 'undo redo | formatselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link  emoticons | help',
            menubar: 'favs file edit view insert format tools table help',
            setup: function(ed) {
                ed.on('change', function(e) {
                    $('#content').val(ed.getContent())
                    $('#content_pre').html(ed.getContent())
                });
            }
        });

        $.validator.addMethod('valid_run_date', function(value) {
            let expired = moment(value, 'DD/MM/YYYY');
            if (expired.isValid() && expired > new Date()) {
                return true;
            } else {
                return false;
            }
        }, "Ngày bắt đầu hiển thị phải lớn hơn ngày hiện tại");

        var validobj = $('#frm_bds').validate({
            submitHandler: function(form) {

                // ẩn nút submit
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                $(form).find('.image').attr('disabled', 'disabled');

                // check ảnh bất động sản
                let count_total_image = $(form).find('input[name="image[]"]').filter(function() {
                    return this.value.trim() !== '';
                }).length;

                //

                if (count_total_image == 0) {
                    $('#image-error').show();
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#image-error").offset().top
                    }, 2000);
                    $(form).find('button[type="submit"]').attr('disabled', false);
                } else {
                    form.submit();
                }
            },
            ignore: [],
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                },
                address: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                },
                commune: "select_required",
                type: "select_required",
                street: "select_required",
                content: {
                    required: true,
                    minlength: 5,
                    maxlength: 5000
                },
                // price: {
                //     number: true,
                //     valid_price: true
                // },
                facades: {
                    number: true,
                    min: 1
                },
                floor: {
                    number: true,
                    min: 1
                },
                room: {
                    number: true,
                    min: 1
                },
                toilet: {
                    number: true,
                    min: 1
                },
                acreage: {
                    required: true,
                    number: true,
                    min: 30 //30m2
                },
                road_surface: {
                    number: true,
                    min: 1
                },
                video: {
                    valid_embed_youtube: true
                },
                contactname: "required",
                contactphone: "required",

            },
            messages: {
                video: {
                    valid_embed_youtube: "Link youtube không hợp lệ. Vi dụ: https://www.youtube.com/embed/SEt2hZzkOiY"
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

        $(function() {
            $('#create_time_set').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": true,
                "startDate": "<?= date("d/m/Y", strtotime($info['create_time_set'])) ?>",
                "endDate": "<?= date("d/m/Y", strtotime($info['create_time_set'])) ?>",
                "locale": {
                    "format": 'DD/MM/YYYY',
                }
            }, function(start, end, label) {
                console.log(start.format('YYYY-MM-D'))
                $('#hidden_create_time_set').val(start.format('YYYY-MM-D'));
            });
        });
    });

    function callback_upload_image_bds(response, target = '') {
        try {
            response = JSON.parse(response);

            if (response.status) {

                if (Object.keys(response.data).length) {
                    for (const [key, value] of Object.entries(response.data)) {
                        if (value.status) {

                            if (target != '') {
                                console.log(target)

                            } else {
                                let image = `
                                    <li style="width: 23%; height: fit-content; cursor: pointer; position: relative; border: none;" >
                                        <img src="${value.link}" class="img-fluid m-1 p-1 rounded shadow" style="aspect-ratio: 1; object-fit: cover;"/>
                                        <i class="fas fa-trash" style="position:absolute; right: 10px; top: 15px; color: red" onclick="$(this).parent().remove()"></i>
                                        <i class="fas fa-search-plus" style="position:absolute; right: 35px; top: 15px; color: red"></i>
                                        <input type="hidden" name="image[]" value="${value.link}" />
                                    </li>
                                `;

                                $('.list-image').append(image);
                                $('#image-error').hide();
                            }

                        } else {
                            let error_text = '';
                            for (const [key, error] of Object.entries(value.error)) {
                                error_text += '- ' + error + '<br/>';
                            }
                            toasts_danger(`${error_text} Ảnh: ${value.name} `, 'Thất bại')
                        }
                    }
                } else {
                    toasts_danger('Xin lỗi, không lưu được ảnh', 'Thất bại')
                }

            } else {
                toasts_danger(response.error, 'Thất bại')
            }

        } catch (error) {
            console.log(error)
            toasts_danger('Xin lỗi, upload ảnh đang gặp vấn đề!', 'Thất bại')
        }
    }

    function remove_video() {
        $('#video').val('');
        $('#videp_pre').attr('src', '').hide();
    }
</script>