<form method="GET" action="bds">
    <div class="rounded p-2 mb-2" style="background-color: #dee2e6;">
        <div class="row">
            <!-- từ khóa -->
            <div class="col-md-8 mb-2">
                <input type="text" class="form-control" placeholder="Tìm bài viết theo tiêu đề" value="<?= @$_GET['title'] ?>" name="title" autocomplete="off">
            </div>

            <!-- search -->
            <div class="col-md-4 d-flex justify-content-end" style="gap:5px; align-items: baseline;">
                <button type="submit" class="btn btn-primary w-50" title="Tìm kiếm"><i class="fas fa-search"></i> Tìm kiếm</button>
                <a href="/admin" class="btn btn-danger w-25" title="Làm mới bộ lọc">Xóa Lọc</a>
                <button type="button" class="btn btn-danger w-25" title="Xem thêm bộ lọc" onclick="$('#more-filter').slideToggle()">Mở rộng</button>
            </div>
        </div>

        <div id="more-filter" style="display: none;" class="mt-2">
            <!-- Giá -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Giá bán</div>
                <div class="input-group" style="width: 100%; max-width: 500px;">
                    <input type="number" min=1 step="0.01" class="form-control " name="f_price" value="<?= @$_GET['f_price'] ?>" autocomplete="off">
                    <select class="form-control" name="f_price_unit" style="max-width: 85px; padding-left: 2px; font-size:12px">
                        <option value="1" <?= @$_GET['f_price_unit'] == '1' ? 'selected' : '' ?>>Triệu</option>
                        <option value="2" <?= @$_GET['f_price_unit'] == '2' ? 'selected' : '' ?>>Tỷ</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text p-0">đến</div>
                    </div>
                    <input type="number" min=1 step="0.01" class="form-control" name="t_price" value="<?= @$_GET['t_price'] ?>" autocomplete="off">
                    <select class="form-control " name="t_price_unit" style="max-width: 85px; padding-left: 2px; font-size:12px">
                        <option value="1" <?= @$_GET['t_price_unit'] == '1' ? 'selected' : '' ?>>Triệu</option>
                        <option value="2" <?= @$_GET['t_price_unit'] == '2' ? 'selected' : '' ?>>Tỷ</option>
                    </select>
                </div>
            </div>

            <!-- Diện tích -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Diện tích</div>
                <div class="input-group" style="width: 100%; max-width: 500px;">
                    <input type="number" min=30 class="form-control " name="f_acreage" value="<?= @$_GET['f_acreage'] ?>" autocomplete="off">

                    <div class="input-group-append">
                        <div class="input-group-text p-0">đến</div>
                    </div>
                    <input type="number" min=30 class="form-control" name="t_acreage" value="<?= @$_GET['t_acreage'] ?>" autocomplete="off">
                </div>
            </div>

            <!-- ngày -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Ngày đăng</div>
                <div class="input-group" style="width: 100%; max-width: 500px;">
                    <input type="text" class="form-control daterange-btn" placeholder="Nhập khoảng ngày" id="create_time" value="">
                    <input type="hidden" name="f_create" value="<?= @$_GET['f_create'] ?>">
                    <input type="hidden" name="t_create" value="<?= @$_GET['t_create'] ?>">
                    <div class="input-group-append daterange-btn" id="">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <!-- Loại đất -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Loại đất</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="type" data-minimum-results-for-search="Infinity">
                        <option value="">Tất cả loại đất</option>
                        <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                            <option value="<?= $id ?>" <?= @$_GET['type'] == $id ? 'selected' : '' ?>><?= $name ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <!-- Đơn vị -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Đơn vị</div>
                <div class="input-group" style="width: 100%; max-width: 500px;">
                    <select class="form-control" name="price_type">
                        <option value="1" <?= @$_GET['price_type'] == '1' ? 'selected' : '' ?>>VNĐ</option>
                        <option value="2" <?= @$_GET['price_type'] == '2' ? 'selected' : '' ?>>VNĐ/m2</option>
                        <option value="3" <?= @$_GET['price_type'] == '3' ? 'selected' : '' ?>>VNĐ/tháng</option>
                        <option value="4" <?= @$_GET['price_type'] == '4' ? 'selected' : '' ?>>VNĐ/m2/tháng</option>
                    </select>
                </div>
            </div>

            <!-- Đất bán thuê -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;">Hình thức</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="category" data-minimum-results-for-search="Infinity">
                        <option value="">Đất bán và thuê</option>
                        <option value="1" <?= @$_GET['category'] == '1' ? 'selected' : '' ?>>Nhà đất bán</option>
                        <option value="2" <?= @$_GET['category'] == '2' ? 'selected' : '' ?>>Nhà đất thuê</option>
                    </select>
                </div>
            </div>
            <!-- xã -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Xã/phường</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="id_commune_ward">
                        <option value="">Tất cả xã</option>
                        <?php foreach ($list_commune as $cmn) { ?>
                            <option value="<?= $cmn['id_commune_ward'] ?>" <?= @$_GET['id_commune_ward'] == $cmn['id_commune_ward'] ? 'selected' : '' ?>><?= $cmn['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- đường -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Tên đường</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="id_street">
                        <option value="">Tất cả đường</option>
                        <?php foreach ($list_street as $cmn) { ?>
                            <option value="<?= $cmn['id_street'] ?>" <?= @$_GET['id_street'] == $cmn['id_street'] ? 'selected' : '' ?>><?= $cmn['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- loại vip thường -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Loại tin</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="is_vip" data-minimum-results-for-search="Infinity">
                        <option value="">Tất cả loại tin</option>
                        <option value="1" <?= @$_GET['is_vip'] == '1' ? 'selected' : '' ?>>Tin vip</option>
                        <option value="0" <?= @$_GET['is_vip'] == '0' ? 'selected' : '' ?>>Tin thường</option>
                    </select>
                </div>

            </div>

            <!-- loại trạng thái -->
            <div class="mb-2 d-flex align-items-center justify-content-end">
                <div style="width: 100px;"> Trạng thái tin</div>
                <div style="width: 100%; max-width: 500px;">
                    <select class="select2" name="status" data-minimum-results-for-search="Infinity">
                        <option value="" <?= @$_GET['status'] == '' ? 'selected' : '' ?>>Tất cả trạng thái</option>
                        <option value="1" <?= @$_GET['status'] == '1' ? 'selected' : '' ?>>Đang hiển thị</option>
                        <option value="0" <?= @$_GET['status'] == '0' ? 'selected' : '' ?>>Đang hạ</option>
                    </select>
                </div>

            </div>
            <!-- search -->
            <div class="d-flex align-items-center justify-content-end">
                <div style="width: 100%; max-width: 500px; display: flex; gap:5px">
                    <button type="submit" class="btn btn-primary w-50" title="Tìm kiếm">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                    <a href="/admin" class="btn btn-danger w-25" title="Làm mới bộ lọc">Xóa lọc</a>
                    <button type="button" class="btn btn-danger w-25" title="Xem thêm bộ lọc" onclick="$('#more-filter').slideToggle()">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(function() {

        //Set mặc định ngày
        let startDate = moment().subtract(29, 'days');
        let endDate = moment();
        try {
            <?php if (isset($_GET['f_create']) &&  $_GET['f_create'] != '') { ?>
                startDate = moment('<?= $_GET['f_create'] ?>');
            <?php } ?>

            <?php if (isset($_GET['t_create']) &&  $_GET['t_create'] != '') { ?>
                endDate = moment('<?= $_GET['t_create'] ?>');
            <?php } ?>
        } catch (error) {
            console.log(error);
        }

        console.log(startDate, endDate)
        //Date range as a button
        $('.daterange-btn').daterangepicker({
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                },
                startDate: startDate,
                endDate: endDate
            },
            function(start, end) {
                $('#create_time').val(start.format('D/MM/YYYY') + ' đến ' + end.format('D/MM/YYYY'))
                $('input[name="f_create"]').val(start.format('YYYY-MM-D'))
                $('input[name="t_create"]').val(end.format('YYYY-MM-D'))
            }
        )
    })
</script>