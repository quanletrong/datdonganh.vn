<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container">
    <div class="fw-bold fs-4 d-none">
        Bất động sản dành cho bạn
    </div>
    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="fw-bold fs-4">
                        Tin vip
                    </div>
                    <div class="row">
                        <?php foreach ($home_vip as $id_bds => $bds) { ?>
                            <div class="col-md-6 col-lg-12">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>.html">
                                    <div class="rounded border border-1 border-danger mb-3 shadow ">
                                        <div class="position-relative">
                                            <img src="<?= $bds['image_path'] ?>" class="rounded-top img-fluid" alt="" style="aspect-ratio: 2/1; object-fit: cover;">
                                            <div class="position-absolute bg-danger text-white px-2 rounded-end" style="left: 0; top: 1rem">Tin
                                                VIP</div>
                                        </div>

                                        <div class="p-2">
                                            <div class="fw-semibold text-truncate text-wrap hover-link-red" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.5rem;"><?= $bds['title'] ?></div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text-danger fw-bold">
                                                    <?= $bds['price_view'] ?>
                                                    <?= $bds['price_unit'] === '1' ? 'trăm triệu' : 'tỷ' ?>
                                                </div>
                                                <div class="mb-1">·</div>
                                                <div class="text-danger fw-bold">
                                                    <?= $bds['price_total'] / $bds['acreage'] / PRICE_ONE_MILLION ?> tr/m²
                                                </div>
                                                <div class="mb-1">·</div>
                                                <div class="text-danger  fw-bold"><?= $bds['acreage'] ?> m²</div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-secondary">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <?= $communes[$bds['id_commune_ward']]['name'] ?>
                                                </div>

                                                <?php if ($bds['direction'] > 0) { ?>
                                                    <div class="text-secondary">
                                                        Hướng: <?= $cf_bds['direction'][$bds['direction']] ?>
                                                    </div>
                                                <?php } ?>

                                                <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center d-none">
                                                <div class="d-flex align-items-center" style="gap:10px">
                                                    <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.0;">
                                                        K
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold" style="font-size: 0.7rem;">Kim Dung</div>
                                                        <div class="text-muted" style="font-size: 0.7rem;">Hôm nay</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);"><i class="fa-solid fa-phone-volume"></i> 0936 030 966</button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <hr class="d-block d-lg-none">
                <div class="col-12 col-lg-8">
                    <div class="fw-bold fs-4">
                        Tin mới nhất
                    </div>
                    <div class="row">
                        <?php foreach ($bdss as $id_bds => $bds) { ?>
                            <div class="col-md-6">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>.html">
                                    <div class="rounded border border-1 border-muted mb-3 shadow">
                                        <div class="position-relative">
                                            <img src="<?= $bds['image_path'] ?>" class="rounded-top img-fluid" alt="" style="aspect-ratio: 2/1; object-fit: cover;">
                                        </div>

                                        <div class="p-2">
                                            <div class="fw-semibold text-truncate text-wrap hover-link-red" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.5rem;"><?= $bds['title'] ?></div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text-danger fw-bold">
                                                    <?= $bds['price_view'] ?>
                                                    <?= $bds['price_unit'] === '1' ? 'trăm triệu' : 'tỷ' ?>
                                                </div>
                                                <div class="mb-1">·</div>
                                                <div class="text-danger fw-bold">
                                                    <?= $bds['price_total'] / $bds['acreage'] / PRICE_ONE_MILLION ?> tr/m²
                                                </div>
                                                <div class="mb-1">·</div>
                                                <div class="text-danger  fw-bold"><?= $bds['acreage'] ?> m²</div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-secondary">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <?= $communes[$bds['id_commune_ward']]['name'] ?>
                                                </div>

                                                <?php if ($bds['direction'] > 0) { ?>
                                                    <div class="text-secondary">
                                                        Hướng: <?= $cf_bds['direction'][$bds['direction']] ?>
                                                    </div>
                                                <?php } ?>

                                                <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center d-none">
                                                <div class="d-flex align-items-center" style="gap:10px">
                                                    <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.0;">
                                                        K
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold" style="font-size: 0.7rem;">Kim Dung</div>
                                                        <div class="text-muted" style="font-size: 0.7rem;">Hôm nay</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);"><i class="fa-solid fa-phone-volume"></i> 0936 030 966</button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="nha-dat-ban">
                    <button class="btn btn-outline-secondary">Xem thêm</button>
                </a>
            </div>

        </div>
        <div class="col-12 col-lg-2 d-none d-lg-block">
            <div class="fw-bold fs-4">
                &nbsp;
            </div>
            <div class="card mt-1">
                <div class="card-body p-2">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Giá</span>
                    <div class="d-flex flex-column">
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-tu-duoi-1-ty">Dưới 1 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-1--1.5-ty">1 → 1,5 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-1.5--2-ty">1,5 → 2 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-2.5--3-ty">2,5 → 3 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-3--4-ty">3 → 4 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-4--5-ty">4 → 5 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-5--6-ty">5 → 6 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-6--8-ty">6 → 8 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-8--10-ty">8 → 10 tỷ (123)</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/gia-tren-10-ty">Trên 10 tỷ (123)</a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body p-2">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Diện tích</span>
                    <div class="d-flex flex-column">
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">30 - 50 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">50 - 80 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">80 - 100 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">100 - 150 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">150 - 200 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">200 - 300 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">300 - 500 m²</a>
                        <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/dien-tich-30m2-50m2">Trên 500 m²</a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body p-2">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Khu vực</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($commune_ward_and_num_bds as $id_commune => $item) { ?>
                            <?php if ($item['num_bds']) { ?>
                                <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/<?= @$item['slug'] ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body p-2">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Đường</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($street_and_num_bds as $id_street => $item) { ?>
                            <?php if ($item['num_bds']) { ?>
                                <a class="text-decoration-none text-dark py-1 hover-link-red" href="nha-dat-ban/<?= @$item['slug'] ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>