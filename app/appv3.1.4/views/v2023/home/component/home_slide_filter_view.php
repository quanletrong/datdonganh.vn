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
            <div id="tab-filter">
                <div class="rounded-top text-light px-3 py-1" style="background-color: rgb(70, 11, 11, 0.8); width: fit-content;">
                    Nhà đất bán
                </div>
                <div id="body-filter" class="p-3 rounded-end rounded-bottom" style="background-color: rgb(70, 11, 11, 0.8); height: auto;">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-light dropdown-toggle bg-light text-dark p-3" style="border-right: 1px solid #ccc; background-color: #fff !important;" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-home"></i> Nhà đất
                            bán</button>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-danger" type="button"><i class="fas fa-search"></i> Tìm kiếm</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="dropdown mb-md-2">
                                <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Xã phương thị trấn
                                </button>
                                <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0" style="">
                                    <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                        <label for="exampleDataList" class="form-label">Xã phường thị trấn</label>
                                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Tìm xã phường thị trấn.">
                                        <datalist id="datalistOptions">
                                            <option value="San Francisco">
                                            </option><option value="New York">
                                            </option><option value="Seattle">
                                            </option><option value="Los Angeles">
                                            </option><option value="Chicago">
                                        </option></datalist>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                            </div>
                                            <button class="btn btn-danger btn-sm">Áp dụng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="dropdown mb-md-2">
                                <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Mức giá
                                </button>
                                <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0" style="">
                                    <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <input type="text" class="w-50 form-control" value="0">
                                            <div>đến</div>
                                            <input type="text" class="w-50 form-control" value="2000">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <input type="range" class="form-range" min="0" max="50000" step="500" id="customRange3" value="0">
                                            <div> - </div>
                                            <input type="range" class="form-range" min="0" max="50000" step="500" id="customRange3" value="2000">
                                        </div>
                                        <!--  -->
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="firstRadio" checked="">
                                                <label class="form-check-label" for="firstRadio">Tất cả  mức giá</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="secondRadio">
                                                <label class="form-check-label" for="secondRadio">Dưới 500 triệu</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="thirdRadio">
                                                <label class="form-check-label" for="thirdRadio">500 - 800 triệu</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="fourRadio">
                                                <label class="form-check-label" for="fourRadio">800 triệu - 1 tỷ triệu</label>
                                            </li>
                                        </ul>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                            </div>
                                            <button class="btn btn-danger btn-sm">Áp dụng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="dropdown mb-md-2">
                                <button class="btn dropdown-toggle w-100 text-light border border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Diện tích
                                </button>
                                <div class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0" style="">
                                    <div class="px-2 py-3 bg-light rounded shadow border border-light" style="min-width: 400px;">
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <input type="text" class="w-50 form-control" value="0">
                                            <div>đến</div>
                                            <input type="text" class="w-50 form-control" value="50">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <input type="range" class="form-range" min="0" max="500" step="5" id="customRange3" value="0">
                                            <div> - </div>
                                            <input type="range" class="form-range" min="0" max="500" step="5" id="customRange3" value="500">
                                        </div>
                                        <!--  -->
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="firstRadio" checked="">
                                                <label class="form-check-label" for="firstRadio">Tất cả  diện tích</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="secondRadio">
                                                <label class="form-check-label" for="secondRadio">30 - 50 m²</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="thirdRadio">
                                                <label class="form-check-label" for="thirdRadio">50 - 80 m²</label>
                                            </li>
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="listGroupRadio" value="" id="thirdRadio">
                                                <label class="form-check-label" for="thirdRadio">80 - 100 m²</label>
                                            </li>
                                        </ul>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                            </div>
                                            <button class="btn btn-danger btn-sm">Áp dụng</button>
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
                                <div id="filter_loc_them" class="dropdown-menu w-100 bg-transparent border-0 p-0 m-0" style="">
                                    <div class="px-2 py-3 bg-light rounded shadow" style="min-width: 400px;">
                                        Hướng nhà
                                        <div>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Đông</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Tây</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Nam</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Bắc</span>
                                            <br>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Đông - Bắc</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Tây - Bắc</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Tây - Nam</span>
                                            <span class="badge rounded-pill text-bg-secondary fw-light">Đông - Nam</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <i class="fa-solid fa-rotate text-dark"></i> Đặt lại
                                            </div>
                                            <button class="btn btn-danger btn-sm">Áp dụng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>