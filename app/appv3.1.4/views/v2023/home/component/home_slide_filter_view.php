<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
<div class="container-fluid g-0">

    <!-- FILTER MOBILE-->
    <!-- <div id="mobile-filter" class="d-none" style="width: 100%; display: flex; justify-content: center;">
        <div class="input-group mb-3 ps-3 pe-3">
            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text bg-red text-light bg-danger" id="basic-addon2">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div> -->

    <!-- SLIDE + FILTER PC -->

    <div style="position: relative;">
        <!-- box slide -->
        <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-bs-ride="true">
            <div class="carousel-inner">
                <!-- https://png.pngtree.com/thumb_back/fw800/back_our/20190621/ourmid/pngtree-atmospheric-real-estate-glory-opening-background-template-image_187009.jpg -->
                <!-- https://webmuanha.net/webs_image/uploads/website/banner-dich-vu-webmuanha-10.png -->
                <div class="carousel-item active">
                    <img src="images/banne-trong-suot.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="images/banne-trong-suot.png" class="d-block w-100" alt="">
                </div>
            </div>
        </div>

        <!-- box filter pc -->
        <div id="pc-filter" class="position-absolute my-3 " style="top:2rem;">

            <form method="get" action="<?= LINK_NHA_DAT_BAN ?>" id="form-search-bds">
                <div id="tab-filter">
                    <div class="d-flex" style="gap:0.7rem">
                        <div class="rounded-top text-light px-3 py-2" onclick="$('#s_category').val(1)" style="background-color: rgb(70, 11, 11, 0.8); width: fit-content; cursor: pointer;">
                            Nhà đất bán
                        </div>
                        <div class="rounded-top text-light px-3 py-2" onclick="//$('#s_category').val(2)" style="background-color: rgba(202, 202, 202, 0.8); width: fit-content; cursor: pointer;">
                            Nhà cho thuê
                        </div>
                        <input type="hidden" name="category" value="1" id="s_category" />
                    </div>

                    <div id="body-filter" class="p-3 rounded-end rounded-bottom" style="background-color: rgb(70, 11, 11, 0.8); height: auto;">
                        <div class="input-group mb-3" style="border-radius: 7px;background-color: white;align-items: center;">
                            <select name="type" class="form-select" aria-label="Example select with button addon" style="max-width: 200px;padding: 10px 10px;border: none;">
                                <option value="">Loại đất</option>
                                <?php foreach ($cf_bds['type'] as $id => $name) { ?>
                                    <option value="<?= $id ?>"><?= $name ?></option>
                                <?php } ?>
                            </select>

                            <input type="text" name="title" class="form-control" aria-label="Text input with dropdown button" style=" border: transparent; height: 52px; font-size: 1.3rem;">
                            <button class="btn btn-danger d-flex justify-content-between align-items-center" type="submit" style="height: fit-content;margin-right: 7px;border-radius: 5px;padding: 7px;"><i class="fas fa-search"></i> <span class="d-none d-md-block ms-1">Tìm kiếm</span></button>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div id="dropdown-commune" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Xã phương thị trấn
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
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
                            <div class="col-sm-12 col-md-6 col-lg-3 mb-1">
                                <div id="dropdown-price" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Mức giá
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div style="position: relative;">
                                                    <input type="text" name="f_price" class="w-100 form-control" value="">
                                                    <span style="position: absolute; top:6px; right:6px">tỷ</span>
                                                </div>
                                                <div>đến</div>
                                                <div style="position: relative;">
                                                    <input type="text" name="t_price" class="w-100 form-control" value="">
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
                                                        <input class="form-check-input me-1" type="radio" name="price" id="price_<?= $key ?>" data-start='<?= $price['from'] ?>' data-end='<?= $price['to'] ?>'>
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
                                <div id="dropdown-acreage" class="dropdown mb-md-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Diện tích
                                    </button>
                                    <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: fit-content;">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div style="position: relative;">
                                                    <input type="text" name="f_acreage" class="w-100 form-control" value="">
                                                    <span style="position: absolute; top:6px; right:6px">m²</span>
                                                </div>
                                                <div>đến</div>
                                                <div style="position: relative;">
                                                    <input type="text" name="t_acreage" class="w-100 form-control" value="">
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
                                                        <input class="form-check-input me-1" type="radio" name="acreage" id="acreage_<?= $key ?>" data-start='<?= $acreage['from'] ?>' data-end='<?= $acreage['to'] ?>'>
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
                                <div class="dropdown w-100 mb-md-2 d-flex align-items-center gap-2">
                                    <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lọc thêm
                                    </button>
                                    <div>
                                        <i class="fa-solid fa-rotate text-light"></i>
                                    </div>
                                    <div id="filter_loc_them" class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0">
                                        <div class="px-2 py-3 bg-light rounded shadow" style="min-width: fit-content;">
                                            Hướng nhà
                                            <div class="mb-2">
                                                <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_direction(this, '')">Tất cả</span>
                                                <?php foreach ($cf_bds['direction'] as $id => $name) { ?>
                                                    <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_direction(this, <?= $id ?>)"><?= $name ?></span>
                                                <?php } ?>
                                                <input type="hidden" name="direction" value="" id="direction" />
                                            </div>

                                            Loại tin
                                            <div>
                                                <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_is_vip(this, '')">Tất cả</span>
                                                <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_is_vip(this, 1)">Tin vip</span>
                                                <span class="badge rounded-pill text-bg-secondary fw-light cursor-poiter" onclick="search_is_vip(this, 0)">Tin thường</span>
                                                <input type="hidden" name="is_vip" value="" id="is_vip" />
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

        // QUAN TRỌNG
        position_pc_filter();
        $(window).resize(function() {
            position_pc_filter();
        });

        function position_pc_filter() {
            if ($(document).width() <= 576) {
                $('#pc-filter').removeClass('position-absolute'); // mobile
            } else {
                $('#pc-filter').addClass('position-absolute'); //tablet desktop
            }
        }
        // END QUAN TRỌNG

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

    function search_is_vip(e, id) {
        $(e).addClass('text-bg-danger').removeClass('text-bg-secondary');
        $(e).siblings().removeClass('text-bg-danger').addClass('text-bg-secondary')
        $('#is_vip').val(id);
    }
</script>