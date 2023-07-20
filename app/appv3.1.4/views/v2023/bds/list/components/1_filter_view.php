<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }
</style>
<div class="container-fluid py-3 px-0" style="background: #dedede;">
    <div class="container">

        <!-- FILTER MOBILE-->
        <!-- <div id="mobile-filter" class="d-lg-none" style="width: 100%; display: flex; justify-content: center;">
            <div class="input-group mb-3 ps-3 pe-3">
                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text bg-red text-light bg-danger" id="basic-addon2">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div> -->

        <!-- SLIDE + FILTER PC -->

        <!-- box filter pc -->
        <div id="pc-filter">
            <form method="get" action="<?= LINK_NHA_DAT_BAN ?>" id="form-search-bds">
                <div id="tab-filter">
                    <div class="d-flex" style="gap:0.7rem">
                        <div class="rounded-top text-light px-3 py-1" style="background-color: #611815; width: fit-content; cursor: pointer;" onclick="$('#s_category').val(1)">
                            Nhà đất bán
                        </div>
                        <div class="rounded-top text-light px-3 py-1" style="background-color: rgba(202, 202, 202, 0.8); color: black; width: fit-content; cursor: pointer;">
                            Nhà cho thuê
                        </div>
                        <input type="hidden" name="category" value="1" id="s_category" />
                    </div>

                    <div id="body-filter" class="p-2 rounded-end rounded-bottom" style="background-color: #611815; height: auto;">
                        <div class="input-group mb-2" style="border-radius: 7px;background-color: white;align-items: center;">
                            <select name="type" class="form-select" aria-label="Example select with button addon" style="max-width: 200px;padding: 10px 10px;border: none;">
                                <option value="">Loại đất</option>
                                <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                    <option value="<?= $id ?>" <?= $id == $type ? 'selected' : '' ?>><?= $name ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" name="title" class="form-control" aria-label="Text input with dropdown button" style="border: transparent;height: 40px;" value="<?= htmlentities($title) ?>">
                            <button class="btn btn-danger d-flex justify-content-between align-items-center" type="submit" style="height: fit-content;margin-right: 7px;border-radius: 5px;padding: 3px 8px;"><i class="fas fa-search"></i> <span class="d-none d-md-block ms-1">Tìm kiếm</span></button>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div id="dropdown-commune" class="dropdown mb-md-1">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 3px;">
                                        <?= isset($list_commune[$id_commune_ward]) != '' ? $list_commune[$id_commune_ward]['name'] : 'Xã phường thị trấn' ?>
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
                                            <label class="form-label"> Xã phường thị trấn</label>
                                            <select name="id_commune_ward" id="id_commune_ward" class="form-select select2" style="width: 100%;" data-placeholder="Chọn khu vực">
                                                <option value="">Tất cả</option>
                                                <?php foreach ($list_commune as $id => $it) { ?>
                                                    <option value="<?= $id ?>" <?= $id == $id_commune_ward ? 'selected' : '' ?>><?= $it['name'] ?></option>
                                                <?php } ?>
                                            </select>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-sm">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div id="dropdown-price" class="dropdown mb-md-1">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 3px;">
                                        <?php
                                        if ($f_price == '' && $t_price == '') {
                                            echo 'Tất cả mức giá';
                                        } else if ($f_price != '' && $t_price != '') {
                                            echo $f_price . ' tỷ - ' . $t_price . ' tỷ';
                                        } else {
                                            echo 'Trên ' . $f_price . ' tỷ';
                                        }
                                        ?>

                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div style="position: relative;">
                                                    <input type="text" name="f_price" class="w-100 form-control" value="<?= $f_price ?>">
                                                    <span style="position: absolute; top:6px; right:6px">tỷ</span>
                                                </div>
                                                <div>đến</div>
                                                <div style="position: relative;">
                                                    <input type="text" name="t_price" class="w-100 form-control" value="<?= $t_price ?>">
                                                    <span style="position: absolute; top:6px; right:6px">tỷ</span>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <ul class="list-group mt-2">
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="all_price" data-start='' data-end='' checked>
                                                    <label class="form-check-label" for="all_price">Tất cả mức giá</label>
                                                </li>
                                                <?php foreach ($cf_bds['price_list'] as $key => $price) { ?>
                                                    <li class="list-group-item">
                                                        <input class="form-check-input me-1" type="radio" name="price" id="price_<?= $key ?>" data-start='<?= $price['from'] ?>' data-end='<?= $price['to'] ?>' <?= $f_price == $price['from'] && $t_price == $price['to'] ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="price_<?= $key ?>"><?= $price['name'] ?></label>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                                </div>
                                                <button class="btn btn-danger btn-sm" type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div id="dropdown-acreage" class="dropdown mb-md-1">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 3px;">
                                        <?php
                                        if ($f_acreage == '' && $t_acreage == '') {
                                            echo 'Tất cả diện tích';
                                        } else if ($f_acreage != '' && $t_acreage != '') {
                                            echo $f_acreage . ' - ' . $t_acreage . ' m²';
                                        } else {
                                            echo 'Trên ' . $f_acreage . ' m²';
                                        }

                                        ?>
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div style="position: relative;">
                                                    <input type="text" class="w-100 form-control" name="f_acreage" value="<?= $f_acreage ?>">
                                                    <span style="position: absolute; top:6px; right:6px">m²</span>
                                                </div>
                                                <div>đến</div>
                                                <div style="position: relative;">
                                                    <input type="text" class="w-100 form-control" name="t_acreage" value="<?= $t_acreage ?>">
                                                    <span style="position: absolute; top:6px; right:6px">m²</span>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <ul class="list-group mt-2">
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="all_acreage" data-start='' data-end='' checked>
                                                    <label class="form-check-label" for="all_acreage">Tất cả diện
                                                        tích</label>
                                                </li>
                                                <?php foreach ($cf_bds['acreage_list'] as $key => $acreage) { ?>
                                                    <li class="list-group-item">
                                                        <input class="form-check-input me-1" type="radio" name="acreage" id="acreage_<?= $key ?>" data-start='<?= $acreage['from'] ?>' data-end='<?= $acreage['to'] ?>' <?= $f_acreage == $acreage['from'] && $t_acreage == $acreage['to'] ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="acreage_<?= $key ?>"><?= $acreage['name'] ?></label>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                                </div>
                                                <button class="btn btn-danger btn-sm" type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div class="dropdown w-100 mb-md-1 d-flex align-items-center gap-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 3px;">
                                        Lọc thêm
                                    </button>
                                    <div>
                                        <i class="fa-solid fa-rotate text-light"></i>
                                    </div>
                                    <div id="filter_loc_them" class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow" style="min-width: fit-content;">
                                            Hướng nhà
                                            <div>
                                                <span class="badge rounded-pill <?= $direction == '' ? 'text-bg-danger' : 'text-bg-secondary' ?> fw-light cursor-poiter" onclick="search_direction(this, '')">Tất cả</span>
                                                <?php foreach ($cf_bds['direction'] as $id => $name) { ?>
                                                    <span class="badge rounded-pill <?= $id == $direction ? 'text-bg-danger' : 'text-bg-secondary' ?> fw-light cursor-poiter" onclick="search_direction(this, <?= $id ?>)"><?= $name ?></span>
                                                <?php } ?>
                                                <input type="hidden" name="direction" value="<?= $direction ?>" id="direction" />
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                                </div>
                                                <button class="btn btn-danger btn-sm" type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#id_commune_ward').select2({
            dropdownParent: $('#dropdown-commune .dropdown-menu ')
        });
        $('#id_commune_ward').on('change', function() {
            var data = $(this).find("option:selected").text();
            $("#dropdown-commune .dropdown-toggle").text(data)
        })

        // xử lý k ẩn dropdown-menu commune

        $(".dropdown-menu").click(function(event) {
            event.stopPropagation();
        });

        $("#dropdown-commune .dropdown-menu").click(function(event) {
            event.stopPropagation();
        });

        $('input:radio[name=price]').click(function() {
            let text = $(this).siblings('label').text();
            $("#dropdown-price .dropdown-toggle").text(text)
            $('input[name=f_price]').val($(this).data('start'));
            $('input[name=t_price]').val($(this).data('end'));
        });

        $('input:radio[name=acreage]').click(function() {
            let text = $(this).siblings('label').text();
            $("#dropdown-acreage .dropdown-toggle").text(text)
            $('input[name=f_acreage]').val($(this).data('start'));
            $('input[name=t_acreage]').val($(this).data('end'));
        });

        $('#form-search-bds').submit(function(e) {

            e.preventDefault();

            $(this)
                .find('input[name], select[name]')
                .filter(function() {
                    return !this.value;
                })
                .prop('name', '');

            $(this).unbind('submit').submit()
        });
    })

    function search_direction(e, id) {
        $(e).addClass('text-bg-danger').removeClass('text-bg-secondary');
        $(e).siblings().removeClass('text-bg-danger').addClass('text-bg-secondary')
        $('#direction').val(id);
    }
</script>