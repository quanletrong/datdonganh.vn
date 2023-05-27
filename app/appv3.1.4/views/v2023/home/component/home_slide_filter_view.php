<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid g-0">

    <!-- FILTER MOBILE-->
    <div id="mobile-filter" class="d-lg-none" style="width: 100%; display: flex; justify-content: center;">
        <div class="input-group mb-3 ps-3 pe-3">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text bg-red text-light bg-danger" id="basic-addon2">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    <!-- SLIDE + FILTER PC -->

    <div style="position: relative;">
        <!-- box slide -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://hoibatdongsan.com.vn/hinh-anh/w1700/sys/xacthuc.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://hoibatdongsan.com.vn/hinh-anh/w1700/sys/khuyenmai.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>

        <!-- box filter pc -->
        <div id="pc-filter" style="position: absolute; top:2rem;">

            <form method="get" action="<?= LINK_NHA_DAT_BAN ?>">
                <div id="tab-filter">
                    <div class="d-flex" style="gap:0.7rem">
                        <div class="rounded-top text-light px-5 py-2" onclick="$('#s_category').val(1)" style="background-color: rgb(70, 11, 11, 0.8); width: fit-content; cursor: pointer;">
                            Nhà đất bán
                        </div>
                        <div class="rounded-top text-light px-5 py-2" onclick="//$('#s_category').val(2)" style="background-color: rgba(202, 202, 202, 0.8); width: fit-content; cursor: pointer;">
                            Nhà cho thuê
                        </div>
                        <input type="hidden" name="category" value="1" id="s_category" />
                    </div>

                    <div id="body-filter" class="p-3 rounded-end rounded-bottom" style="background-color: rgb(70, 11, 11, 0.8); height: auto;">
                        <div class="input-group mb-3" style="border-radius: 7px;background-color: white;align-items: center;">
                            <select name="type" class="form-select" aria-label="Example select with button addon" style="max-width: 200px;padding: 10px 10px;border: none;">
                                <option value="">Tất cả loại đất</option>
                                <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                    <option value="<?= $id ?>"><?= $name ?></option>
                                <?php } ?>
                            </select>

                            <input type="text" name="title" class="form-control" aria-label="Text input with dropdown button" style=" border: transparent; height: 52px; font-size: 1.3rem;">
                            <button class="btn btn-danger" type="submit" style="height: fit-content;margin-right: 7px;border-radius: 5px;padding: 10px;"><i class="fas fa-search"></i> Tìm kiếm</button>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div id="dropdown-commune" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Xã phương thị trấn
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                            <label for="exampleDataList" class="form-label">Xã phường thị trấn</label>
                                            <select name="id_commune_ward" id="id_commune_ward" class="form-select select2" style="width: 100%;" data-placeholder="Chọn khu vực">
                                                <option value=""></option>
                                                <?php foreach ($communes as $id => $it) { ?>
                                                    <option value="<?= $id ?>"><?= $it['name'] ?></option>
                                                <?php } ?>
                                            </select>

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
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div id="dropdown-price" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Mức giá
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div style="position: relative;">
                                                    <input type="text" name="f_price" class="w-100 form-control" value="0">
                                                    <span style="position: absolute; top:6px; right:6px">tỷ</span>
                                                </div>
                                                <div>đến</div>
                                                <div style="position: relative;">
                                                    <input type="text" name="t_price" class="w-100 form-control" value="0">
                                                    <span style="position: absolute; top:6px; right:6px">tỷ</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <input type="range" class="form-range" min="0" max="50000" step="500" id="customRange3" value="0">
                                            </div>
                                            <!--  -->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="all_price" data-start='' data-end='' checked>
                                                    <label class="form-check-label" for="all_price">Tất cả mức giá</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="0_1_price" data-start='' data-end='1'>
                                                    <label class="form-check-label" for="0_1_price">Dưới 1 tỷ</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="1_1.5_price" data-start='1' data-end='1.5'>
                                                    <label class="form-check-label" for="1_1.5_price">1 tỷ - 1,5 tỷ</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="1.5_2_price" data-start='1.5' data-end='2'>
                                                    <label class="form-check-label" for="1.5_2_price">1,5 tỷ - 2 tỷ</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="price" id="2+_price" data-start='2' data-end=''>
                                                    <label class="form-check-label" for="2+_price">trên 2 tỷ</label>
                                                </li>
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
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div id="dropdown-acreage" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Diện tích
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <input type="text" class="w-50 form-control" value="0">
                                                <div>đến</div>
                                                <input type="text" class="w-50 form-control" value="50">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <input type="range" class="form-range" min="0" max="500" step="5" id="customRange3" value="0">
                                            </div>
                                            <!--  -->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="all_acreage" data-start='' data-end='' checked>
                                                    <label class="form-check-label" for="all_acreage">Tất cả diện
                                                        tích</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="30_50_acreage" data-start=30 data-end=50>
                                                    <label class="form-check-label" for="30_50_acreage">30 - 50 m²</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="50_80_acreage" data-start=50 data-end=80>
                                                    <label class="form-check-label" for="50_80_acreage">50 - 80 m²</label>
                                                </li>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="80_100_acreage" data-start=80 data-end=100>
                                                    <label class="form-check-label" for="80_100_acreage">80 - 100 m²</label>
                                                </li>

                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="acreage" id="100_limit_acreage" data-start=100 data-end=''>
                                                    <label class="form-check-label" for="100_limit_acreage">trên 100 m²</label>
                                                </li>
                                            </ul>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <input type="hidden" name="f_acreage" />
                                                <input type="hidden" name="t_acreage" />
                                                <div>
                                                    <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                                </div>
                                                <button class="btn btn-danger btn-sm" type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="dropdown w-100 mb-md-2 d-flex align-items-center gap-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lọc thêm
                                    </button>
                                    <div>
                                        <i class="fa-solid fa-rotate text-light"></i>
                                    </div>
                                    <style>
                                        #filter_loc_them {
                                            inset: 0px auto auto -210px !important;
                                        }
                                    </style>
                                    <div id="filter_loc_them" class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow" style="min-width: 400px;">
                                            Hướng nhà
                                            <div>
                                                <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_direction(this, '')">Tất cả</span>
                                                <?php foreach ($cf_bds['direction'] as $id => $name) { ?>
                                                    <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_direction(this, <?= $id ?>)"><?= $name ?></span>
                                                <?php } ?>
                                                <input type="hidden" name="direction" value="" id="direction" />
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
    })

    function search_direction(e, id) {
        $(e).addClass('text-bg-danger').removeClass('text-bg-secondary');
        $(e).siblings().removeClass('text-bg-danger').addClass('text-bg-secondary')
        $('#direction').val(id);
    }
</script>