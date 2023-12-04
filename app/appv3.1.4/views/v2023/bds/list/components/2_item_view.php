<div class="container mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách BĐS</li>
        </ol>
    </nav>
</div>

<div class="container">
    <h1 class="fw-bold fs-4">
        <?= $seo_title ?>
    </h1>

    <div class="d-flex justify-content-between mb-2">
        <span class="">Hiện có <?= number_format($total) ?> bất động sản.</span>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-9">
            <?php $i = ($page - 1) * $limit + 1 ?>
            <?php foreach ($list_bds as $id_bds => $bds) { ?>
                <!-- BOX TREN PC -->
                <div class="mb-3 shadow rounded d-none d-sm-block" style="border: 1px solid #dedede;">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                <div style="position: relative;">
                                    <img src="<?= $bds['list_img'][0] ?>" class="w-100 ratio ratio-4x3 object-fit-cover" alt="" style="aspect-ratio: 4/3;object-fit: cover; ">
                                    <!-- <div class="position-absolute bg-danger text-white px-2 fs-5 rounded-end fs-6 <?= $bds['is_vip'] ? '' : 'd-none' ?> " style="left: 0; top: 1rem">Tin VIP</div> -->

                                    <div class="p-2 w-100 fs-6 d-flex justify-content-end align-items-center gap-2" style="position: absolute; right: 0; bottom: 0; color: white; background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);">
                                        <i class="fa-solid fa-image"></i>
                                        <?= count($bds['list_img']) ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="p-2" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                    <div class="my-2">
                                        <h2 class="fs-6 fw-bold" style="color: #0c65ab;">
                                            <span style="color: #9f9f9f"><?= $i++ ?>.</span>
                                            <?= $bds['title'] ?>
                                        </h2>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <div class="text-danger fw-bold">
                                            <?= getPrice($bds['price_total']) ?>
                                        </div>
                                        <div>·</div>
                                        <div class="text-danger fw-bold"><?= $bds['acreage'] ?> m²</div>
                                        <div>·</div>
                                        <div class="text-danger fw-bold">
                                            <?= getPriceM2($bds['price_total'], $bds['acreage']) ?>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 text-secondary mt-2" style="align-items: center;">

                                        <i class="fa-solid fa-location-dot"></i>

                                        <?php if ($bds['direction'] > 0) { ?>
                                            <div>
                                                <?= $cf_bds['direction'][$bds['direction']] ?>
                                            </div>

                                            <div>·</div>

                                        <?php } ?>

                                        <div> <?= $bds['commune'] ?></div>
                                    </div>
                                </a>

                                <div class="d-none d-sm-block">
                                    <div class="d-flex justify-content-between align-items-center mt-2">

                                        <div class="text-muted" style="font-size: 0.85rem;">Đăng <?php echo timeSince($bds['create_time_set']) ?> trước</div>

                                        <div class="d-flex justify-content-between align-items-center gap-2">

                                            <a href="<?= LINK_NHA_DAT_BAN . '?moi-gioi=' . urlencode($bds['contactname']) ?>">
                                                <button class="btn btn-sm text-light" style="background-color: rgb(158 158 158); font-size: 0.85rem; padding: 3px;">
                                                    <?= $bds['contactname'] ?>
                                                </button>
                                            </a>

                                            <a href="tel:<?= $bds['contactphone'] ?>">
                                                <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83); font-size: 0.85rem; padding: 3px;"><i class="fa-solid fa-phone-volume"></i> <?= $bds['contactphone'] ?></button>
                                            </a>

                                            <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bds['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>" style=" font-size: 0.85rem; padding: 3px 5px"><i class="fa-regular fa-heart"></i></button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BOX TREN PC -->
                <!-- BOX TREN MOBILE-->
                <div class="mb-4 d-block d-sm-none">
                    <div class="rounded border border-1 border-muted mb-3 shadow">
                        <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                            <div class="position-relative">
                                <img src="<?= $bds['list_img'][0] ?>" class="rounded-top img-fluid" alt="" style="aspect-ratio: 2/1; object-fit: cover;width: 100%; height: 100%;">
                            </div>
                        </a>
                        <div class="p-2">
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                <div class="fw-semibold text-truncate text-wrap hover-link-red" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.6rem; line-height: 1.3rem;"><?= $bds['title'] ?></div>
                            </a>
                            <div class="d-flex justify-content-between">
                                <div class="text-danger fw-bold">
                                    <?= getPrice($bds['price_total']) ?>
                                </div>
                                <div class="mb-1">·</div>
                                <div class="text-danger fw-bold">
                                    <?= getPriceM2($bds['price_total'], $bds['acreage']) ?>
                                </div>
                                <div class="mb-1">·</div>
                                <div class="text-danger  fw-bold"><?= $bds['acreage'] ?> m²</div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-secondary">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?= $bds['commune'] ?>
                                </div>

                                <?php if ($bds['direction'] > 0) { ?>
                                    <div class="text-secondary">
                                        Hướng: <?= $cf_bds['direction'][$bds['direction']] ?>
                                    </div>
                                <?php } ?>

                                <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bds['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>
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
                                    <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm btn-outline-danger"><i class="fa-regular fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END BOX TREN MOBILE -->
            <?php } ?>

            <!-- PAGING -->
            <div class="mt-5 d-flex justify-content-center">
                <div id="paging"></div>
                <script type='text/javascript'>
                    $('#paging').bootstrapPaginator({
                        currentPage: <?= $page ?>,
                        totalPages: <?= ceil($total / $limit) ?>,
                        itemContainerClass: function(type, page, current) {
                            return (page === current) ? "active" : "pointer-cursor";
                        },
                        pageUrl: function(type, page, current) {

                            var url = new URL(window.location.href);
                            var search_params = url.searchParams;
                            search_params.set('page', page);
                            url.search = search_params.toString();
                            return url.toString();
                        }
                    });
                </script>
            </div>
            <!-- PAGING -->

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
            <div style="top:60px; z-index: auto;">
                <div>
                    <div>Sắp xếp theo</div>
                    <select class="form-select-sm border border-secondary" aria-label="Default select example" onchange="sort(this)" style="width: -webkit-fill-available;">
                        <option value="0" data-orderby=order_reset>Thông thường</option>
                        <option value="1" data-orderby=price_total data-sort=DESC <?= $orderby == 'price_total' && $sort == 'DESC' ? 'selected' : '' ?>>Giá cao hiện trước</option>
                        <option value="3" data-orderby=price_total data-sort=ASC <?= $orderby == 'price_total' && $sort == 'ASC' ? 'selected' : '' ?>>Giá thấp hiện trước</option>
                        <option value="4" data-orderby=acreage data-sort=DESC <?= $orderby == 'acreage' && $sort == 'DESC' ? 'selected' : '' ?>>Diện tích lớn hiện trước</option>
                        <option value="5" data-orderby=acreage data-sort=ASC <?= $orderby == 'acreage' && $sort == 'ASC' ? 'selected' : '' ?>>Diện tích bé hiện trước</option>
                        <option value="6" data-orderby=id_bds data-sort=DESC <?= $orderby == 'id_bds' && $sort == 'DESC' ? 'selected' : '' ?>>Tin mới hiện trước</option>
                        <option value="7" data-orderby=id_bds data-sort=ASC <?= $orderby == 'id_bds' && $sort == 'ASC' ? 'selected' : '' ?>>Tin cũ hiện trước</option>
                    </select>
                </div>
                <div class="card mt-3" style="background-color: #f7f7f7;">
                    <div class="card-body">
                        <span class="fw-semibold" style="font-size: 1.125rem;">Khoảng giá</span>
                        <div class="d-flex flex-column">
                            <?php foreach ($cf_bds['price_list'] as $it) { ?>
                                <?php $num_bds = @$get_num_bds_by_price[$it['from'] . '-' . $it['to']] ?>
                                <?php if ($num_bds > 0) { ?>
                                    <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= $it['link'] ?>"><?= $it['name'] ?> (<?= $num_bds ?>)</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="card mt-3" style="background-color: #f7f7f7;">
                    <div class="card-body">
                        <span class="fw-semibold" style="font-size: 1.125rem;">Diện tích</span>
                        <div class="d-flex flex-column">
                            <?php foreach ($cf_bds['acreage_list'] as $it) { ?>
                                <?php $num_bds = @$get_num_bds_by_acreage[$it['from'] . '-' . $it['to']] ?>
                                <?php if ($num_bds > 0) { ?>
                                    <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= $it['link'] ?>"><?= $it['name'] ?> (<?= $num_bds ?>)</a>
                                <?php } ?>
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
                                    <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $id_commune ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
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
                                    <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= LINK_NHA_DAT_BAN . '?id_street=' . $id_street ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
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