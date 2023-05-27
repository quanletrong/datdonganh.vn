<div class="container mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách BĐS</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="fw-bold fs-4">
        Danh sách bất động sản đang bán
    </div>

    <div class="d-flex justify-content-between mt-3">
        <span class="">Hiện có <?= number_format(count($list_bds)) ?> bất động sản.</span>
        <select class="form-select-sm border border-secondary" aria-label="Default select example">
            <option selected>Thông thường</option>
            <option value="1">Giá cáo xuống thấp</option>
            <option value="2">Giá thấp lên cao</option>
            <option value="3">Tin mới nhất</option>
            <option value="4">Diện tích lớn đến bé</option>
            <option value="5">Diện tích bé đến lớn</option>
            <option value="6">Tin mới nhất</option>
        </select>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-12 col-lg-9">
            <?php foreach ($list_bds as $id_bds => $bds) { ?>
                <div class="card mt-3">
                    <div class="card-body p-0">
                        <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>.html">
                            <div style="width: 100%;display: flex; position: relative;">
                                <div style="width: calc(4/6*100%)">
                                    <img src="<?= $bds['list_img'][0] ?>" class="w-100 ratio ratio-16x9 object-fit-cover" alt="" style="aspect-ratio: 2/1;object-fit: cover;padding-right: 3px;border-top-left-radius: 0.375rem;">
                                </div>
                                <div style="width: calc(2/6*100%)">
                                    <div style="width: 100%;display: flex;flex-wrap: wrap;">
                                        <div style="width: calc(6/6*100%)">
                                            <img src="<?= $bds['list_img'][1] ?>" class="w-100 ratio ratio-16x9 object-fit-cover" alt="" style="aspect-ratio: 2/1;object-fit: cover;padding-bottom: 3px;border-top-right-radius: 0.375rem;">
                                        </div>
                                        <div style="width: calc(3/6*100%)">
                                            <img src="<?= $bds['list_img'][2] ?>" class="w-100 ratio ratio-1x1 object-fit-cover" alt="" style="aspect-ratio: 1;object-fit: cover;padding-right: 3px;">
                                        </div>
                                        <div style="width: calc(3/6*100%)">
                                            <img src="<?= $bds['list_img'][3] ?>" class="w-100 ratio ratio-1x1 object-fit-cover" alt="" style="aspect-ratio: 1;object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                                <div class="position-absolute bg-danger text-white px-3 fs-5 rounded-end <?= $bds['is_vip'] ? '' : 'd-none' ?>" style="left: 0; top: 1rem">Tin VIP</div>
                            </div>
                        </a>

                        <div class="mx-3 my-1">
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>.html">
                                <span class="fw-bold text-uppercase">
                                    <?= $bds['title'] ?>
                                </span>
                            </a>

                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>.html">
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <div class="text-danger fw-bold">
                                            <?= $bds['price_view'] ?>
                                            <?= $bds['price_unit'] === '1' ? 'trăm triệu' : 'tỷ' ?>
                                        </div>
                                        <div class="mb-1">.</div>
                                        <div class="text-danger fw-bold"><?= $bds['acreage'] ?> m²</div>
                                        <div class="mb-1">.</div>
                                        <div class="text-danger fw-bold">
                                            <?= $bds['price_total'] / $bds['acreage'] / PRICE_ONE_MILLION ?> tr/m²
                                        </div>
                                    </div>
                                </a>

                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <?php if ($bds['direction'] > 0) { ?>
                                        <div class="text-secondary">
                                            Hướng: <?= $cf_bds['direction'][$bds['direction']] ?>
                                        </div>
                                        <div class="mb-1">.</div>
                                    <?php } ?>

                                    <div class="text-secondary">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <?= $bds['commune'] ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" style="gap:10px">
                                <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.0;">
                                    <?= $bds['contactname'][0] ?? null ?>

                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size: 0.9rem;"><?= $bds['contactname'] ?></div>
                                    <div class="text-muted" style="font-size: 0.8rem;">Đăng <?php echo timeSince($bds['create_time']) ?> trước</div>
                                </div>
                            </div>
                            <div>
                                <a href="tel:<?= $bds['contactphone'] ?>">
                                    <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);"><i class="fa-solid fa-phone-volume"></i> <?= $bds['contactphone'] ?></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- PAGING -->
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-3">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- TỪ KHÓA LIÊN QUAN -->
            <div class="mt-5">
                <a class="fw-bold fs-6" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Từ khóa liên quan
                </a>

                <div class="mt-3">
                    @@for (var i = 1; i <= 20; i++) { <span class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn
                        đông anh</span>
                        }
                </div>

                <p class="mt-5">
                    Hàng nghìn tin đăng <strong>mua bán nhà đất tại Việt Nam</strong> được rao trên
                    <strong>Batdongsan.com.vn</strong> với đầy đủ các tiêu chí tìm kiếm của người mua và bán. Các thông tin
                    mua bán nhà đất khu vực Việt Nam được tổng hợp từ các nguồn tin rao về nhà đất bao gồm tin đăng chính
                    chủ và tin đăng qua môi giới, giúp đa dạng nguồn thông tin và sự lựa chọn đối với bất động sản đang quan
                    tâm.
                </p>
                <p>
                    Bằng những tiện ích mà Batdongsan.com.vn mang đến cho người dùng, bạn có thể dễ dàng thao tác và tìm
                    kiếm thông tin bất động sản bạn đang quan tâm chỉ trong vài click chuột. Batdongsan.com.vn sẽ là cầu nối
                    giúp bạn tương tác và trao đổi với nhà cung cấp bất động sản bằng việc cung cấp thông tin chính xác,
                    nhanh chóng..., cùng với đó là đội ngũ nhân viên tư vấn chuyên nghiệp. Chắc chắn bạn sẽ thực sự hài lòng
                    về kênh thông tin và dịch vụ của <strong>Batdongsan.com.vn</strong>!
                </p>
            </div>
        </div>
        <div class="d-md-none d-lg-block col-lg-3">
            <div class="card mt-3">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Lọc theo khoảng giá</p>
                    <div class="d-flex flex-column">
                        <a class="text-decoration-none text-dark py-1">Thỏa thuận</a>
                        <a class="text-decoration-none text-dark py-1">Dưới 500 triệu</a>
                        <a class="text-decoration-none text-dark py-1">500 triệu đến 800 triệu</a>
                        <a class="text-decoration-none text-dark py-1">800 triệu đến 1 tỷ</a>
                        @@for (var i = 1; i <= 10; i++) { <a class="text-decoration-none text-dark py-1">`+i+` đến `+(i+1)+`
                            tỷ </a>
                            }
                            <a class="text-decoration-none text-dark py-1">Trên 11 tỷ</a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Lọc theo diện tích</p>
                    <div class="d-flex flex-column">
                        <a class="text-decoration-none text-dark py-1">Dưới 30 m²</a>
                        <a class="text-decoration-none text-dark py-1">30 - 50 m²</a>
                        <a class="text-decoration-none text-dark py-1">50 - 80 m²</a>
                        <a class="text-decoration-none text-dark py-1">80 - 100 m²</a>
                        <a class="text-decoration-none text-dark py-1">100 - 150 m²</a>
                        <a class="text-decoration-none text-dark py-1">150 - 200 m²</a>
                        <a class="text-decoration-none text-dark py-1">200 - 300 m²</a>
                        <a class="text-decoration-none text-dark py-1">300 - 500 m²</a>
                        <a class="text-decoration-none text-dark py-1">Trên 500 m²</a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Lọc theo xã/phường</p>
                    <div class="d-flex flex-column">
                        @@for (var i = 1; i <= 24; i++) { <a class="text-decoration-none text-dark py-1">Thị trấn Đông Anh
                            (1000)</a>
                            }
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Lọc theo đường</p>
                    <div class="d-flex flex-column">
                        @@for (var i = 1; i <= 24; i++) { <a class="text-decoration-none text-dark py-1">Đường Bắc Thăng
                            Long (1000)</a>
                            }
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>