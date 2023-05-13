<?php ?>
<style>
    #content_pre img,
    #content_pre iframe,
    #content_pre table {
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
                    <h1>Đăng tài liệu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('document') ?>">Quản lý tài liệu</a></li>
                        <li class="breadcrumb-item active">Đăng bài tài liệu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <form id="frm_document" action="<?= site_url('document/add_submit') ?>" method="post">

                <!-- Mô tả  -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mô tả bài viết</h3>

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
                                    <label>Tiêu đề bài viết</label>
                                    <textarea class="form-control" rows=2 placeholder="Nhập tiêu đề " name="title"></textarea>
                                    <small>Tiêu đề được dùng để làm link SEO trên công cụ tìm kiếm như Google, Bing...</small>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows=3 placeholder="Nhập mô tả ngắn" name=sapo></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Nguồn bài viết</label>
                                    <input class="form-control" placeholder="Nhập tiêu đề" name="origin" />
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

                                <div>
                                    <label>Chọn ảnh:</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="<?= ROOT_DOMAIN ?>/filemanager/filemanager/dialog.php?type=1&field_id=image" class="btn btn-primary iframe-btn">Chọn ảnh</a>
                                    </div>
                                    <input type="text" class="form-control image_input" id="image" name="image" readonly>
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-image-delete" data-image="#image">Xóa</button>
                                    </div>
                                    <!-- <span id="image-error" class="error invalid-feedback">Ảnh chính không được trống</span> -->
                                </div>
                                <img id="image_pre" class="img-fluid m-1 p-1 rounded shadow" style="max-height: 300px; display: none; cursor: pointer;" src="" data-toggle="modal" data-target="#modal-image-delete" data-image="#image" />
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. Mô tả -->

                <!-- Nội dung  -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mô tả bài viết</h3>

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
                                    <textarea id="content" name="content">Nội dung bài viết</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div id="content_pre" style="font-family: Lexend">

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /. Nội dung  -->

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

        $('#frm_document').validate({
            ignore: [],
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    maxlength: 256
                },
                sapo: {
                    required: true,
                    minlength: 5,
                },
                content: {
                    required: true,
                    minlength: true,
                },
                image: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: "Tiêu đề  không được bỏ trống",
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
                },
                image: {
                    required: 'Ảnh chính không được trống'
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

        tinymce.init({
            selector: '#content',
            height: "800",
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
    });
    // end jquery

    function responsive_filemanager_callback(field_id) {
        var url = jQuery('#' + field_id).val();
        $(`#${field_id}_pre`).attr('src', url).show();

        $(`#${field_id}`).removeClass('is-invalid');
        $('#image-error').hide();
    }

    function remove_image(image_id) {
        $(image_id).val('');
        $(image_id + '_pre').attr('src', '').hide();

        let count_total_image = $('#frm_document').find('.image_input').filter(function() {
            return this.value.trim() !== '';
        }).length;

        if (count_total_image) {
            $('#image-error').hide();
            $(image_id).removeClass('is-invalid');
        } else {
            $('#image-error').show();
            $(image_id).addClass('is-invalid');
        }
    }
</script>