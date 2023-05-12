<?php ?>
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
                <!-- Vị trí bất động sản -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Vị trí bất động sản</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Đường</label>
                                    <select class="select2" style="width: 100%;" name="street">
                                        <?php foreach ($list_street as $street) { ?>
                                            <option value="<?= $street['id_street'] ?>"><?= $street['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Xã:</label>
                                    <select class="select2" style="width: 100%;" name="commune">
                                        <?php foreach ($list_commune as $cmn) { ?>
                                            <option value="<?= $cmn['id_commune_ward'] ?>"><?= $cmn['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- TODO: chưa code validate map -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vị trí trên bản đồ</label>
                                    <textarea class="form-control" rows=6 name=maps><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4825.356742861158!2d105.84504333777906!3d21.15802374866306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135011877263c29%3A0xfed63a1860e09572!2zdHQuIMSQw7RuZyBBbmgsIMSQw7RuZyBBbmgsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1683618045321!5m2!1svi!2s" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Hiển thị vị trí</label>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4825.356742861158!2d105.84504333777906!3d21.15802374866306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135011877263c29%3A0xfed63a1860e09572!2zdHQuIMSQw7RuZyBBbmgsIMSQw7RuZyBBbmgsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1683618045321!5m2!1svi!2s" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /. Vị trí bất động sản -->

                <!-- Mô tả bất động sản -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mô tả bất động sản</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nằm trong dự án bất động sản</label>
                                    <select class="select2" style="width: 100%;" name="project">
                                        <option value="0">Chọn</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Loại hình bất động sản:</label>
                                    <select class="select2" style="width: 100%;" name="type">
                                        <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tiêu đề bất động sản</label>
                                    <small>Tiêu đề được dùng để làm link SEO trên công cụ tìm kiếm như Google, Bing...</small>
                                    <textarea class="form-control" rows=2 placeholder="Nhập tiêu đề bất động sản" name="title"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Chọn thẻ:</label>
                                    <select class="select2" name="tag[]" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%;">
                                        <option value="1">TAG 1</option>
                                        <option value="2">TAG 2</option>
                                        <option value="3">TAG 3</option>
                                        <option value="4">TAG 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows=3 placeholder="Nhập mô tả ngắn" name=sapo></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" rows=8 placeholder="Nhập mô tả" name="content"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. Mô tả bất động sản-->

                <!-- Đặc điểm bất động sản -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Đặc điểm bất động sản</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giá</label>
                                    <input class="form-control" type="text" name="price" value="0">
                                    <small>1 triệu nhập vào là 1, bỏ trống là giá thương lượng</small>
                                </div>

                                <div class="form-group">
                                    <label>Hướng nhà:</label>
                                    <select class="select2" style="width: 100%;" name="direction">
                                        <option value="0">Chọn</option>
                                        <?php foreach ($cf_bds['direction'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Số toilet:</label>
                                    <select class="select2" style="width: 100%;" name="toilet">
                                        <option value="0">Chọn</option>
                                        <?php foreach ($cf_bds['toilet'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Số tầng:</label>
                                    <select class="select2" style="width: 100%;" name="floor">
                                        <option value="0">Chọn</option>
                                        <?php foreach ($cf_bds['floor'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày hết hạn:</label>
                                    <input class="form-control" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="expired">
                                    <small>Người dùng vẫn có thể xem được bài đăng hết hạn</small>
                                </div>
                                <div class="form-group">
                                    <label>Diện tích (m2):</label>
                                    <input class="form-control" type="text" name="acreage" value="0">
                                </div>
                                <div class="form-group">
                                    <label>Đường vào (mét):</label>
                                    <input class="form-control" type="text" name="road_surface" value="0">
                                </div>

                                <div class="form-group">
                                    <label>Phòng ngủ:</label>
                                    <select class="select2" style="width: 100%;" name="bedroom">
                                        <option value="0">Chọn</option>
                                        <?php foreach ($cf_bds['bedroom'] as $id => $name) { ?>
                                            <option value="<?= $id ?>"><?= $name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group d-flex">
                                    <label class="d-flex w-25">Loại tin</label>
                                    <div class="d-flex w-100">
                                        <?php foreach ($cf_bds['is_hot'] as $id => $name) { ?>
                                            <div class="custom-control custom-radio" style="width: 30%;">
                                                <input class="custom-control-input" type="radio" id="is_hot_<?= $id ?>" name="is_hot" value="<?= $id ?>" <?= $id == 1 ? 'checked' : '' ?>>
                                                <label for="is_hot_<?= $id ?>" class="custom-control-label"><?= $name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group d-flex">
                                    <label class="w-25">Nội thất</label>
                                    <div class="d-flex w-100">
                                        <?php foreach ($cf_bds['noithat'] as $id => $name) { ?>
                                            <div class="custom-control custom-radio" style="width: 30%;">
                                                <input class="custom-control-input" type="radio" id="noithat_<?= $id ?>" name="noithat" value="<?= $id ?>" <?= $id == 1 ? 'checked' : '' ?>>
                                                <label for="noithat_<?= $id ?>" class="custom-control-label"><?= $name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group d-flex">
                                    <label class="w-25">Pháp lý</label>
                                    <div class="d-flex w-100">
                                        <?php foreach ($cf_bds['juridical'] as $id => $name) { ?>
                                            <div class="custom-control custom-radio" style="width: 30%;">
                                                <input class="custom-control-input" type="radio" id="juridical_<?= $id ?>" name="juridical" value="<?= $id ?>" <?= $id == 1 ? 'checked' : '' ?>>
                                                <label for="juridical_<?= $id ?>" class="custom-control-label"><?= $name ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. Đặc điểm bất động sản-->

                <!-- Hình ảnh bất động sản -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh bất động sản</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <a href="<?= ROOT_DOMAIN ?>/filemanager/filemanager/dialog.php?type=1&field_id=image_<?= $i ?>" class="btn btn-primary iframe-btn">Chọn ảnh</a>
                                        </div>
                                        <input type="text" class="form-control image_input" id="image_<?= $i ?>" name="image[]" readonly>
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-image-delete" data-image="#image_<?= $i ?>">Xóa</button>
                                        </div>
                                    </div>
                                <?php } ?>

                                <span id="image-error" class="invalid-feedback" style="font-size: 80%; color: red; display: none;">
                                    Bạn chưa chọn ảnh bất động sản hãy chọn tôi thiêu 1 ảnh.
                                </span>

                                <p>
                                    <small>Hình ảnh tối đa 10 ảnh, tối thiểu 1 ảnh</small>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex w-100 flex-wrap">
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <img id="image_<?= $i ?>_pre" class="img-responsive m-1 p-1 rounded shadow" style="width: 31%; height: fit-content; display: none; cursor: pointer;" src="" data-toggle="modal" data-target="#modal-image-delete" data-image="#image_<?= $i ?>" />
                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /. Hình ảnh bất động sản-->

                <!-- Video bất động sản -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Video bất động sản</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea id="video" class="form-control" name="video" rows="3" placeholder="Nhập link video embed youtube" aria-invalid="true"></textarea>
                                </div>

                                <a class="btn btn-danger btn-sm" onclick="remove_video()">Xóa video</a>

                                <p>
                                    <small>Video không bắt buộc nhập</small><br>
                                    <small>Nếu không xem được link vừa nhập có thể nguyên nhân do link nhập không chính xác hoặc video để chế độ riêng tư.</small>
                                </p>

                            </div>
                            <div class="col-md-6">
                                <div class="w-100">
                                    <iframe id="videp_pre" style="width: 100%; display: none;" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen allowscriptaccess="always"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. Video ảnh bất động sản-->

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
<script>
    $(function() {

        $('.select2').select2();
        $('[data-mask]').inputmask()

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
                    min: 100 //100 triệu
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
                    min: 'Giá nhỏ nhất là 100 triệu'
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