<form method="GET" action="bds">
    <div class="rounded px-2 pt-2 pb-0 mb-2" style="background-color: #dee2e6;">
        <div class="row">
            <!-- từ khóa -->
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control" placeholder="Tìm bài viết theo tiêu đề" value="<?= @$_GET['title'] ?>" name="title" autocomplete="off">
            </div>

            <!-- Giá -->
            <div class="col-md-6 mb-2">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">Giá</div>
                    </div>
                    <input type="number" min=1 step="0.01" class="form-control " name="f_price" value="<?= @$_GET['f_price'] ?>" autocomplete="off">
                    <select class="form-control" name="f_price_unit" style="max-width: 85px;">
                        <option value="1" <?= @$_GET['f_price_unit'] == '1' ? 'selected' : '' ?>>Triệu</option>
                        <option value="2" <?= @$_GET['f_price_unit'] == '2' ? 'selected' : '' ?>>Tỷ</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text p-0">đến</div>
                    </div>
                    <input type="number" min=1 step="0.01" class="form-control" name="t_price" value="<?= @$_GET['t_price'] ?>" autocomplete="off">
                    <select class="form-control " name="t_price_unit" style="max-width: 85px;">
                        <option value="1" <?= @$_GET['t_price_unit'] == '1' ? 'selected' : '' ?>>Triệu</option>
                        <option value="2" <?= @$_GET['t_price_unit'] == '2' ? 'selected' : '' ?>>Tỷ</option>
                    </select>
                </div>
            </div>

            <!-- ngày -->
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <input type="text" class="form-control daterange-btn" placeholder="Nhập khoảng ngày" id="create_time" value="">
                    <input type="hidden" name="f_create" value="<?= @$_GET['f_create'] ?>">
                    <input type="hidden" name="t_create" value="<?= @$_GET['t_create'] ?>">
                    <div class="input-group-append daterange-btn" id="">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <!-- Loại đất -->
            <div class="col-md-3 mb-2">
                <select class="select2" name="type" data-minimum-results-for-search="Infinity">
                    <option value="">Tất cả loại đất</option>
                    <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                        <option value="<?= $id ?>" <?= @$_GET['type'] == $id ? 'selected' : '' ?>><?= $name ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Đơn vị -->
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text px-1">Đơn vị</div>
                    </div>
                    <select class="form-control" name="price_type">
                        <option value="1" <?= @$_GET['price_type'] == '1' ? 'selected' : '' ?>>VNĐ</option>
                        <option value="2" <?= @$_GET['price_type'] == '2' ? 'selected' : '' ?>>VNĐ/m2</option>
                        <option value="3" <?= @$_GET['price_type'] == '3' ? 'selected' : '' ?>>VNĐ/tháng</option>
                        <option value="4" <?= @$_GET['price_type'] == '4' ? 'selected' : '' ?>>VNĐ/m2/tháng</option>
                    </select>
                </div>
            </div>

            <!-- Diện tích -->
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">S</div>
                    </div>
                    <input type="number" min=30 class="form-control " name="f_acreage" value="<?= @$_GET['f_acreage'] ?>" autocomplete="off">

                    <div class="input-group-append">
                        <div class="input-group-text p-0">đến</div>
                    </div>
                    <input type="number" min=30 class="form-control" name="t_acreage" value="<?= @$_GET['t_acreage'] ?>" autocomplete="off">
                </div>
            </div>


            <!-- Đất bán thuê -->
            <div class="col-md-2 mb-2">
                <select class="select2" name="category" data-minimum-results-for-search="Infinity">
                    <option value="">Đất bán và thuê</option>
                    <option value="1" <?= @$_GET['category'] == '1' ? 'selected' : '' ?>>Nhà đất bán</option>
                    <option value="2" <?= @$_GET['category'] == '2' ? 'selected' : '' ?>>Nhà đất thuê</option>
                </select>
            </div>
            <!-- xã -->
            <div class="col-md-2 mb-2">
                <select class="select2" name="id_commune_ward">
                    <option value="">Tất cả xã</option>
                    <?php foreach ($list_commune as $cmn) { ?>
                        <option value="<?= $cmn['id_commune_ward'] ?>" <?= @$_GET['id_commune_ward'] == $cmn['id_commune_ward'] ? 'selected' : '' ?>><?= $cmn['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <!-- đường -->
            <div class="col-md-2 mb-2">
                <select class="select2" name="id_street">
                    <option value="">Tất cả đường</option>
                    <?php foreach ($list_street as $cmn) { ?>
                        <option value="<?= $cmn['id_street'] ?>" <?= @$_GET['id_street'] == $cmn['id_street'] ? 'selected' : '' ?>><?= $cmn['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <!-- loại vip thường -->
            <div class="col-md-2 mb-2">
                <select class="select2" name="is_vip" data-minimum-results-for-search="Infinity">
                    <option value="">VIP và Thường</option>
                    <option value="1" <?= @$_GET['is_vip'] == '1' ? 'selected' : '' ?>>Tin vip</option>
                    <option value="0" <?= @$_GET['is_vip'] == '0' ? 'selected' : '' ?>>Tin thường</option>
                </select>
            </div>
            <!-- chế độ cong khai riêng tu -->
            <div class="col-md-2 mb-2">
                <select class="select2" name="status" data-minimum-results-for-search="Infinity">
                    <option value="1" <?= @$_GET['status'] == '1' ? 'selected' : '' ?>>Công khai</option>
                    <option value="0" <?= @$_GET['status'] == '0' ? 'selected' : '' ?>>Thùng rác</option>
                </select>
            </div>

            <!-- search -->
            <div class="col-md-2 mb-2 d-flex" style="gap:5px">
                <button type="submit" class="btn btn-primary w-75" title="Tìm kiếm"><i class="fas fa-search"></i> Tìm kiếm</button>
                <a href="/admin" class="btn btn-danger w-25" title="Làm mới bộ lọc"><i class="fas fa-sync-alt"></i></a>
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