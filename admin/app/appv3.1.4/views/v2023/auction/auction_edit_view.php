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
                    <h1>Sửa lịch đấu giá</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('auction') ?>">Quản lý lịch đấu giá</a></li>
                        <li class="breadcrumb-item active">sửa lịch đấu giá</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <form id="frm_auction" action="<?= site_url('auction/edit_submit/' . $info['id_articles']) ?>" method="post">

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

                                <div class="form-group d-flex w-100" style="gap:50px">
                                    <label>Trạng thái</label>
                                    <div class="d-flex" style="gap:30px">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="status_1" name="status" value="1" <?= $info['status'] ? 'checked' : '' ?>>
                                            <label for="status_1" class="custom-control-label">Hiển thị</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="status_0" name="status" value="0" <?= !$info['status'] ? 'checked' : '' ?>>
                                            <label for="status_0" class="custom-control-label">Ngừng hiển thị</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Tiêu đề bài viết</label>
                                    <textarea class="form-control" rows=2 placeholder="Nhập tiêu đề " name="title"><?= $info['title'] ?></textarea>
                                    <small>Tiêu đề được dùng để làm link SEO trên công cụ tìm kiếm như Google, Bing...</small>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows=3 placeholder="Nhập mô tả ngắn" name=sapo><?= $info['sapo'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Nguồn bài viết</label>
                                    <input class="form-control" placeholder="Nhập tiêu đề" name="origin" value="<?= $info['origin'] ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Chọn thẻ:</label>
                                    <select class="select2" id="tag" name="tag[]" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%">
                                        <?php foreach ($list_tag as $id_tag => $tag) { ?>
                                            <option value="<?= $id_tag ?>" <?= isset($tag_assign[$id_tag]) ? 'selected' : '' ?>><?= $tag['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#modal-tag-add">Thêm tag</button>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div>
                                    <label>Chọn ảnh:</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-sm btn-warning" onclick="quanlt_upload(this);" data-callback="cb_upload_image_main_article" data-target="#image">
                                            <i class="fas fa-upload"></i> chọn ảnh
                                        </button>
                                    </div>
                                    <input type="text" class="form-control image_input" id="image" name="image" readonly value="<?= $info['image_path'] ?>">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-image-delete" data-image="#image">Xóa</button>
                                    </div>
                                    <!-- <span id="image-error" class="error invalid-feedback">Ảnh chính không được trống</span> -->
                                </div>
                                <img id="image_pre" class="img-fluid m-1 p-1 rounded shadow" style="max-height: 300px;cursor: pointer;" src="<?= $info['image_path'] ?>" data-toggle="modal" data-target="#modal-image-delete" data-image="#image" />
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="content" name="content"><?= html_entity_decode(htmlspecialchars_decode($info['content'])) ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 d-none">
                                <div id="content_pre" style="font-family: Lexend">
                                    <?= html_entity_decode(htmlspecialchars_decode($info['content'])) ?>
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
        $('[data-mask]').inputmask()

        $('#modal-image-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var image_id = button.data('image');
            var url_anh = $(image_id).val();

            $('#modal_image_pre').attr('src', url_anh);
            $('#model_btn_xoa_anh').attr('onclick', `remove_image("${image_id}")`)

        });

        $('#frm_auction').validate({
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
            file_picker_types: 'image',
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'help', 'link', 'autoresize'
            ],
            toolbar_sticky: true,
            toolbar: 'undo redo | formatselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image emoticons | help',
            menubar: 'favs file edit view insert format tools table help',
            image_title: true,
            relative_urls: false,
            images_upload_handler: example_image_upload_handler,
            setup: function(ed) {
                ed.on('change', function(e) {
                    $('#content').val(ed.getContent())
                    $('#content_pre').html(ed.getContent())
                    tinymce.activeEditor.dom.setAttrib(tinymce.activeEditor.dom.select('img'), 'height', 'auto');
                    tinymce.activeEditor.dom.setAttrib(tinymce.activeEditor.dom.select('img'), 'width', '100%');
                });
            }
        });

        function example_image_upload_handler(blobInfo, success, failure, progress) {

            let logo = 0;
            if(confirm('Bạn muốn chèn logo vào ảnh này không? Bấm OK để chèn.')) {
                logo = 1;
            }

            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'upload/tinymce?logo='+logo);

            xhr.upload.onprogress = function(e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, {
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || json.data.status == false) {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.data.link);
            };

            xhr.onerror = function() {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        };
    });
    // end jquery

    function remove_image(image_id) {
        $(image_id).val('');
        $(image_id + '_pre').attr('src', '').hide();

        let count_total_image = $('#frm_auction').find('.image_input').filter(function() {
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

    function cb_upload_image_main_article(link, target, name) {
        $(target).removeClass('is-invalid');
        $('#image_pre').attr('src', link).show();
        $('#image-error').hide();
    }
</script>