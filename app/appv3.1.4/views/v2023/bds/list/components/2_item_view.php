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
        <select class="form-select-sm border border-secondary" aria-label="Default select example" onchange="sort(this)">
            <option value="0" data-orderby=order_reset>Thông thường</option>
            <option value="1" data-orderby=price_total data-sort=DESC <?= $orderby == 'price_total' && $sort == 'DESC' ? 'selected' : '' ?>>Giá cao hiện trước</option>
            <option value="3" data-orderby=price_total data-sort=ASC <?= $orderby == 'price_total' && $sort == 'ASC' ? 'selected' : '' ?>>Giá thấp hiện trước</option>
            <option value="4" data-orderby=acreage data-sort=DESC <?= $orderby == 'acreage' && $sort == 'DESC' ? 'selected' : '' ?>>Diện tích lớn hiện trước</option>
            <option value="5" data-orderby=acreage data-sort=ASC <?= $orderby == 'acreage' && $sort == 'ASC' ? 'selected' : '' ?>>Diện tích bé hiện trước</option>
            <option value="6" data-orderby=id_bds data-sort=DESC <?= $orderby == 'id_bds' && $sort == 'DESC' ? 'selected' : '' ?>>Tin mới hiện trước</option>
            <option value="7" data-orderby=id_bds data-sort=ASC <?= $orderby == 'id_bds' && $sort == 'ASC' ? 'selected' : '' ?>>Tin cũ hiện trước</option>
        </select>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-12 col-lg-9">
            <?php foreach ($list_bds as $id_bds => $bds) { ?>
                <div class="card mt-3">
                    <div class="card-body p-0">
                        <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
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
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                <span class="fw-bold text-uppercase">
                                    <?= $bds['title'] ?>
                                </span>
                            </a>

                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
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
                                            Hướng: <a href="<?= LINK_NHA_DAT_BAN . '?direction=' . $bds['direction'] ?>"><?= $cf_bds['direction'][$bds['direction']] ?></a>
                                        </div>
                                        <div class="mb-1">.</div>
                                    <?php } ?>

                                    <div class="text-secondary">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $bds['id_commune_ward'] ?>"><?= $bds['commune'] ?></a>
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
            <div class="d-flex justify-content-center d-none">
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
                    <?php foreach ($all_tag as $id => $tag) { ?>
                        <span class="badge rounded-pill text-bg-secondary p-2 mb-2"><a href="<?= LINK_NHA_DAT_BAN . '?id_tag=' . $id ?>"><?php echo $tag['name']; ?></a></span>
                    <?php } ?>
                </div>

                <p class="mt-5">
                    Hàng nghìn tin đăng <strong>mua bán nhà đất tại Đông Anh</strong> được rao trên
                    <strong>Datdonganh.vn</strong> với đầy đủ các tiêu chí tìm kiếm của người mua và bán. Các thông tin
                    mua bán nhà đất khu vực Việt Nam được tổng hợp từ các nguồn tin rao về nhà đất bao gồm tin đăng chính
                    chủ và tin đăng qua môi giới, giúp đa dạng nguồn thông tin và sự lựa chọn đối với bất động sản đang quan
                    tâm.
                </p>
                <p>
                    Bằng những tiện ích mà <strong>Datdonganh.vn</strong> mang đến cho người dùng, bạn có thể dễ dàng thao tác và tìm
                    kiếm thông tin bất động sản bạn đang quan tâm chỉ trong vài click chuột. <strong>Datdonganh.vn</strong> sẽ là cầu nối
                    giúp bạn tương tác và trao đổi với nhà cung cấp bất động sản bằng việc cung cấp thông tin chính xác,
                    nhanh chóng..., cùng với đó là đội ngũ nhân viên tư vấn chuyên nghiệp. Chắc chắn bạn sẽ thực sự hài lòng
                    về kênh thông tin và dịch vụ của <strong>Datdonganh.vn</strong>!
                </p>
            </div>
        </div>
        <div class="d-md-none d-lg-block col-lg-3">
            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Khoảng giá</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($cf_bds['price_list'] as $it) { ?>
                            <?php $num_bds = @$get_num_bds_by_price[$it['from'].'-'.$it['to']]?>
                            <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= $it['link'] ?>"><?= $it['name'] ?> (<?=$num_bds?>)</a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Diện tích</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($cf_bds['acreage_list'] as $it) { ?>
                            <?php $num_bds = @$get_num_bds_by_acreage[$it['from'].'-'.$it['to']]?>
                            <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= $it['link'] ?>"><?= $it['name'] ?> (<?=$num_bds?>)</a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Khu vực</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($commune_ward_and_num_bds as $id_commune => $item) { ?>
                            <?php if ($item['num_bds']) { ?>
                                <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= LINK_NHA_DAT_BAN . '/' . @$item['slug'] ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <span class="fw-semibold" style="font-size: 1.125rem;">Đường</span>
                    <div class="d-flex flex-column">
                        <?php foreach ($street_and_num_bds as $id_street => $item) { ?>
                            <?php if ($item['num_bds']) { ?>
                                <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= LINK_NHA_DAT_BAN . '/' . @$item['slug'] ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function sort(e) {

        let orderby = $(e).find(":selected").data('orderby');
        let sort = $(e).find(":selected").data('sort');
        let url = new URL(window.location.href);
        let search_params = url.searchParams;

        search_params.delete('orderby');
        search_params.delete('sort');

        if (orderby != 'order_reset') {
            search_params.set('orderby', orderby);
            search_params.set('sort', sort);
        }

        url.search = search_params.toString();
        let new_url = url.toString();
        window.location.href = new_url;
    }

    function insertParamAndReload(key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);

        // kvp looks like ['key1=value1', 'key2=value2', ...]
        var kvp = document.location.search.substr(1).split('&');
        let i = 0;

        for (; i < kvp.length; i++) {
            if (kvp[i].startsWith(key + '=')) {
                let pair = kvp[i].split('=');
                pair[1] = value;
                kvp[i] = pair.join('=');
                break;
            }
        }

        if (i >= kvp.length) {
            kvp[kvp.length] = [key, value].join('=');
        }

        // can return this or...
        let params = kvp.join('&');

        // reload page with new params
        document.location.search = params;
    }
</script>