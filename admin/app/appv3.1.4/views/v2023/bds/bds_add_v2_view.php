<?php ?>
<style>
    .error.invalid-feedback {
        margin-left: 25%;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đăng bài bất động sản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('bds') ?>">Quản lý bđs</a></li>
                        <li class="breadcrumb-item active">Đăng bài bất động sản</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <form id="frm_bds" action="<?= site_url('bds/add_submit') ?>" method="post">
                <!-- ĐĂNG MỚI TIN RAO -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ĐĂNG MỚI TIN RAO</h3>
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
                                    <textarea class="form-control" style="width:75%" name="title" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Địa chỉ <span class="text-danger">*</span></label>
                                    </div>
                                    <textarea class="form-control" style="width:75%" name="address" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Hình thức <span class="text-danger">*</span></label>
                                    </div>
                                    <select class="select2" style="width: 75%;" name="category">
                                        <option value="0">Vui lòng chọn</option>
                                        <option value="1">Mua bán nhà đất</option>
                                        <option value="2">Cho thuê</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Loại hình <span class="text-danger">*</span></label>
                                    </div>
                                    <select class="select2" style="width:75%" name="type">
                                        <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Xã <span class="text-danger">*</span></label>
                                    </div>
                                    <select class="select2" style="width:75%" name="commune">
                                        <?php foreach ($list_commune as $cmn) { ?>
                                            <option value="<?= $cmn['id_commune_ward'] ?>"><?= $cmn['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Đường <span class="text-danger">*</span></label>
                                    </div>
                                    <select class="select2" style="width:75%" name="street">
                                        <?php foreach ($list_street as $street) { ?>
                                            <option value="<?= $street['id_street'] ?>"><?= $street['name'] ?></option>
                                        <?php } ?>
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
                                        <label class="m-0 p-0 pr-1">Diện tích <span class="text-danger">*</span></label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="acreage">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Giá <span class="text-danger">*</span></label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Đơn vị</label>
                                    </div>
                                    <select class="select2" style="width:75%" name="price_type">
                                        <option value="1">VNĐ</option>
                                        <option value="2">VNĐ/m2</option>
                                        <option value="3">VNĐ/tháng</option>
                                        <option value="4">VNĐ/m2/tháng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Bằng chữ</label>
                                    </div>
                                    <input type="text" class="form-control text-danger" style="width:75%" name="price" readonly disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.ĐĂNG MỚI TIN RAO -->

                <!-- THÔNG TIN MÔ TẢ -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN MÔ TẢ</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea id="content" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /. THÔNG TIN MÔ TẢ-->

                <!-- THONG TIN KHAC -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN KHÁC</h3>

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
                                    <input type="text" class="form-control" style="width:75%" name="facades">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Đường vào</label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="road_surface">
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
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Diện tích SD</label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="acreage">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Sô tầng</label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="floor">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Phòng ngủ</label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="room">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Số toilet</label>
                                    </div>
                                    <input type="text" class="form-control" style="width:75%" name="toilet">
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
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. THONG TIN KHAC-->

                <!--VIDEO HÌNH ẢNH -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">HÌNH ẢNH VIDEO</h3>

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
                                <div class="form-group">
                                    <label for="">Thêm ảnh</label> <br>
                                    <button type="button" class="btn btn-sm btn-primary iframe-btn">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        Thêm ảnh cho tin đăng</button>
                                    <input type="hidden" id="image" name="image">
                                </div>


                                <div class="d-flex w-100 flex-wrap">
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <img id="image_<?= $i ?>_pre" class="img-responsive m-1 p-1 rounded shadow" style="width: 31%; height: fit-content; display: none; cursor: pointer;" src="" data-toggle="modal" data-target="#modal-image-delete" data-image="#image_<?= $i ?>" />
                                    <?php } ?>
                                </div>
                                <hr class="d-block d-md-none">
                            </div>


                            <!-- video -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Thêm video</label>
                                    <textarea id="video" class="form-control" name="video" rows="3" placeholder="Nhập link video embed youtube" aria-invalid="true"></textarea>
                                </div>

                                <a class="btn btn-danger btn-sm" onclick="remove_video()">Xóa video</a>

                                <p>
                                    <small>Video không bắt buộc nhập</small><br>
                                    <small>Nếu không xem được link vừa nhập có thể nguyên nhân do link nhập không chính xác hoặc video để chế độ riêng tư.</small>
                                </p>

                                <div class="w-100">
                                    <iframe id="videp_pre" style="width: 100%; display: none;" height="200" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen allowscriptaccess="always"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.VIDEO HÌNH ẢNH-->

                <!--THÔNG TIN LIÊN HỆ -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÔNG TIN LIÊN HỆ</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-wrap">
                        <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                            <div class="me-2 w-25" style="text-align: end;">
                                <label class="m-0 p-0 pr-1">Tôi là <span class="text-danger">*</span></label>
                            </div>
                            <select class="select2" style="width:75%" name="contacttype">
                                <option value="1">Môi giới</option>
                                <option value="2">Chính chủ</option>>
                            </select>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                            <div class="me-2 w-25" style="text-align: end;">
                                <label class="m-0 p-0 pr-1">Tên liên hệ <span class="text-danger">*</span></label>
                            </div>
                            <input type="text" class="form-control" style="width:75%" name="contactname">
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                            <div class="me-2 w-25" style="text-align: end;">
                                <label class="m-0 p-0 pr-1">Địa chỉ <span class="text-danger">*</span></label>
                            </div>
                            <input type="text" class="form-control" style="width:75%" name="contactaddress">
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                            <div class="me-2 w-25" style="text-align: end;">
                                <label class="m-0 p-0 pr-1">Điện thoại <span class="text-danger">*</span></label>
                            </div>
                            <input type="text" class="form-control" style="width:75%" name="contactphone">
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between flex-wrap mb-2 w-50">
                            <div class="me-2 w-25" style="text-align: end;">
                                <label class="m-0 p-0 pr-1">Email <span class="text-danger">*</span></label>
                            </div>
                            <input type="text" class="form-control" style="width:75%" name="contactemail">
                        </div>
                    </div>
                </div>
                <!-- /.THÔNG TIN LIÊN HỆ -->

                <!-- LỊCH ĐĂNG TIN -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LỊCH ĐĂNG TIN</h3>

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
                                        <label class="m-0 p-0 pr-1">Ngày bắt đầu <span class="text-danger">*</span></label>
                                    </div>
                                    <input type="text" class="form-control text-danger" style="width:75%" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2 w-25" style="text-align: end;">
                                        <label class="m-0 p-0 pr-1">Ngày hết hạn</label>
                                    </div>
                                    <input type="text" class="form-control text-danger" style="width:75%" value="Tin không hết hạn" readonly disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. LỊCH ĐĂNG TIN-->

                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-danger btn-lg" type="submit">Tôi đã kiểm tra lại nội dung và đồng ý đăng bài này!</button>
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
                <h4 class="modal-title text-center">Thêm tag</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nhập tên tag" id="tag-add" onkeyup="checkTagAdd(this.value)">
                <span id="tag-add-error" class="error invalid-feedback" style="display: none;">...</span>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Quay lại</button>
                <button type="button" id="model_btn_xoa_anh" class="btn btn-primary" onclick="ajax_add_tag()">Thêm tag</button>
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
<!-- modal tag add -->
<script>
    $(function() {

        $('.select2').select2();

        $('[data-mask]').inputmask();

        $('input[name="price"]').inputmask(
            'integer', {
                radixPoint: '.',
                digits: 2,
                autoGroup: true,
                groupSeparator: ",",
                rightAlign: false,
            }
        );

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

        $('#modal-image-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var image_id = button.data('image');
            var url_anh = $(image_id).val();

            $('#modal_image_pre').attr('src', url_anh);
            $('#model_btn_xoa_anh').attr('onclick', `remove_image("${image_id}")`)

        });

        tinymce.init({
            selector: '#content',
            height: "400",
            relative_urls: false,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'help', 'link', 'responsivefilemanager'
            ],
            toolbar: 'responsivefilemanager | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menubar: 'favs file edit view insert format tools table help',
            external_filemanager_path: "<?= ROOT_DOMAIN ?>filemanager/filemanager/",
            filemanager_title: "Thư viện ảnh",
            external_plugins: {
                // "responsivefilemanager": "<?= ROOT_DOMAIN ?>filemanager/filemanager/plugin.min.js",
                "filemanager": "<?= ROOT_DOMAIN ?>filemanager/filemanager/plugin.min.js"
            },
            setup: function(ed) {
                ed.on('change', function(e) {
                    $('#content').val(ed.getContent())
                    $('#content_pre').html(ed.getContent())
                });
            }
        });

        // them rule kiem tra khi nhap link youtube
        jQuery.validator.addMethod('valid_embed_youtube', function(value) {
            if (value.length > 0) {
                var regex = /^https:\/\/www\.youtube\.com\/embed\/\S*$/;
                if (value.trim().match(regex)) {
                    $('#videp_pre').attr('src', value).show();
                    return true;
                } else {
                    $('#videp_pre').attr('src', '').hide();
                    return false;
                }
            } else {
                $('#videp_pre').attr('src', '').hide();
                return true;
            }
        });

        jQuery.validator.addMethod('valid_expired', function(value) {
            let expired = moment(value, 'DD/MM/YYYY');
            if (expired.isValid() && expired > new Date()) {
                return true;
            } else {
                return false;
            }
        });

        jQuery.validator.addMethod('valid_price', function(value) {
            const regex = /,/ig;
            value = parseInt(value.replaceAll(regex, ''));
            if (value > 0 && value < 100000000) {
                return false;
            } else {
                return true;
            }
        });

        $('#frm_bds').validate({
            submitHandler: function(form) {

                // ẩn nút submit
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                $(form).find('.image').attr('disabled', 'disabled');

                // check ảnh bất động sản
                let count_total_image = $(form).find('.image_input').filter(function() {
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
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                },
                sapo: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                },
                content: {
                    required: true,
                    minlength: 5,
                    maxlength: 5000
                },
                price: {
                    required: false,
                    number: true,
                    valid_price: true
                },
                acreage: {
                    required: true,
                    number: true,
                    min: 30 //30m2
                },
                road_surface: {
                    required: false,
                    number: true,
                    min: 1
                },
                expired: {
                    required: true,
                    valid_expired: true,
                },
                video: {
                    valid_embed_youtube: true
                }
            },
            messages: {
                title: {
                    required: "Tiêu đề bất động sản không được bỏ trống",
                    minlength: "Tiêu đề tối thiểu 5 ký tự",
                    maxlength: "Tiêu đề tối đa 256 ký tự"
                },
                sapo: {
                    required: "Nội dung mô tả ngắn không được bỏ trống",
                    minlength: "Nội dung tối thiểu 5 ký tự",
                    maxlength: "Nội dung tối đa 256 ký tự"
                },
                content: {
                    required: "Nội dung mô tả không được bỏ trống",
                    minlength: "Nội dung tối thiểu 5 ký tự",
                    maxlength: "Nội dung tối đa 5000 ký tự"
                },
                price: {
                    number: 'Giá phải là số',
                    valid_price: 'Giá nhỏ nhất là 100 triệu'
                },
                acreage: {
                    required: "Diện tích không được để trống",
                    number: "Diện tích phải là số",
                    min: 'Diện tích nhỏ nhất 30m2'
                },
                road_surface: {
                    number: 'Vui lòng nhập dữ liệu dạng số',
                    min: 'Đường vào tối thiểu 1m'
                },
                expired: {
                    required: 'Ngày hết hạn không được bổ trống',
                    valid_expired: 'Ngày hết hạn phải lớn hơn ngày hiện tại',
                },
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



    });

    function responsive_filemanager_callback(field_id) {
        var url = jQuery('#' + field_id).val();
        $(`#${field_id}_pre`).attr('src', url).show();
        $('#image-error').hide();
        // $('#commune_image_name').text(url.match(/.*\/(.*)$/)[1])
    }

    function count_total_image() {
        return
    }

    function remove_image(image_id) {
        $(image_id).val('');
        $(image_id + '_pre').attr('src', '').hide();

        let count_total_image = $('#frm_bds').find('.image_input').filter(function() {
            return this.value.trim() !== '';
        }).length;

        if (count_total_image) {
            $('#image-error').hide();
        } else {
            $('#image-error').show().focus();
        }
    }

    function remove_video() {
        $('#video').val('');
        $('#videp_pre').attr('src', '').hide();
    }
</script>