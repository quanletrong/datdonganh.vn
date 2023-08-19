<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    .loading-area {
        animation-duration: 2s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        animation-name: placeHolderShimmer;
        animation-timing-function: linear;
        background-color: #f2f2f2;
        background: linear-gradient(to right, #eeeeee 8%, #d0d0d0 18%, #eeeeee 33%);
        background-size: 800px 104px;
        position: relative;

    }
</style>
<div class="container">
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-secondary"><?= $page ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $info['title'] ?></li>
        </ol>
    </nav>
    <h1 class="mt-5 fs-4 fw-semibold "><?= $info['title'] ?></h1>

    <div class="author d-flex align-items-center mt-3" style="gap:10px">

        <div class="text-danger fs-5" style="height: 35px;width: 35px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 1.7;">
            A
        </div>
        <div>
            <div>Được đăng bởi <strong><?= $info['fullname'] ?></strong></div>
            <div>Cập nhật lần cuối vào <?php echo timeSince($info['update_time']) ?> trước • Đọc trong khoảng <span id="time_read_articles">1</span> phút</div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="sapo mt-3">
                <strong><?= $info['sapo'] ?></strong>
            </div>
            <!-- <hr class="text-muted"> -->
            <div id="content-archive" class="content-archive mt-3" style="font-family: Lexend !important">
                <?= html_entity_decode(htmlspecialchars_decode($info['content'])) ?>
                <script>
                    $(document).ready(function() {
                        $('.content-archive img').addClass('img-fluid');
                        $('.content-archive *').css({
                            'width': 'auto',
                            'height': 'auto'
                        });

                        $('#time_read_articles').text(time_read_article('content-archive'));
                    })
                </script>
            </div>
            <!-- NGUỒN -->
            <div class="text-muted mt-5">
                Nguồn: <?= $info['origin'] ?>
            </div>


        </div>
        <div class="col-12 col-lg-4">
            <div class="sticky-lg-top border rounded p-3" style="top:100px; z-index:1019 !important">
                <p class="fw-semibold" style="font-size: 1.125rem;"><?= $page ?> được xem nhiều nhất</p>

                <?php $i = 1;
                foreach ($article_view_top as $id => $article) { ?>
                    <hr class="text-muted">
                    <div class="d-flex align-items-center" style="gap:10px">
                        <div class="d-flex align-items-center" style="gap:10px">
                            <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.0;">
                                <?= $i++ ?>
                            </div>
                        </div>
                        <div>
                            <a href="<?= LINK_TIN_TUC . '/' . $article['slug'] . '-p' . $article['id_articles'] ?>">
                                <?= $article['title'] ?>
                            </a>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Bất động sản liên quan khu vực -->
<div class="container">
    <div class="mt-5">
        <div class="fw-bold fs-5">Bất động sản liên quan <?= $page ?></div>

        <div id="owl-noi-bat" class="owl-carousel owl-theme mt-3">
            <?php foreach ($list_bds_by_commune as $id_bds => $bds) { ?>
                <div class="rounded border border-1 border-muted">
                    <a href="<?= $bds['slug_title'] . '-p' . $bds['id_bds'] ?>">
                        <img src="<?= $bds['main_img'] ?>" class="rounded-top img-fluid w-100" alt="">
                    </a>
                    <div class="p-3">
                        <a href="<?= $bds['slug_title'] . '-p' . $bds['id_bds'] ?>">
                            <p class="fw-semibold text-truncate text-wrap" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                <?= $bds['title'] ?>
                            </p>
                        </a>
                        <div class="d-flex gap-2">
                            <div class="text-danger fw-bold"><?= getPrice($bds['price_total']) ?></div>
                            <div class="mb-1">.</div>
                            <div class="text-danger  fw-bold"><?= getPriceM2($bds['price_total'], $bds['acreage']) ?></div>
                            <div class="mb-1">.</div>
                            <div class="text-danger  fw-bold"><?= $bds['acreage'] ?> m²</div>
                        </div>
                        <div class="text-secondary mt-2">
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $bds['id_commune_ward'] ?>">
                                <i class="fa-solid fa-location-dot"></i>
                                <?= $bds['commune'] ?>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-secondary" style="font-size: 0.8rem;"><?= timeSince($bds['create_time_set']) ?> trước</span>
                            <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bds['id_bds'], $hearts) ? 'btn-danger' :'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>

        <script>
            $(document).ready(function() {
                $("#owl-noi-bat").owlCarousel({
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
                    margin: 10,
                    responsiveClass: true,
                    nav: false,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        }
                    }
                });
            });
        </script>
    </div>
</div>

<!-- Tin tức khác giành cho bạn -->
<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="mt-5">
                <div class="fw-bold fs-5">Các <?= $page ?> khác giành cho bạn</div>

                <div class="mt-3" id="articles-load">

                </div>
                <center>
                    <input type="hidden" value="1" id="page" />
                    <button class="btn btn-outline-danger" onclick="get_data_more()">Xem Thêm</button>
                </center>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="sticky-lg-top border rounded p-3 mt-5" style="top:100px; z-index:1019 !important">
                <p class="fw-semibold" style="font-size: 1.125rem;"><?= $page ?> theo khu vực</p>

                <?php foreach ($get_num_article_by_commune_ward as $id => $commune) { ?>
                    <hr class="text-muted">
                    <div class="d-flex align-items-center" style="gap:10px">
                        <img src="<?= $commune['image_path'] ?>" style="width: 50px; aspect-ratio: 16/9; object-fit: cover;" class="rounded" alt="">
                        <div style="font-size: 1rem;">
                            <?= $commune['name'] ?> (<?= $commune['num_articles'] ?>)
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    get_data_more();

    function get_data_more() {

        let page = $.trim($("#page").val());

        $.ajax({
            url: '<?php echo site_url(LINK_TIN_TUC . "/ajx", $langcode) ?>',
            type: 'POST',
            data: {
                page
            },
            beforeSend: function() {

                let loading = `
                <div class="row" id="loading-area">
                    <div class="col-12 col-lg-4">
                        <div class="position-relative loading-area" style="height: 160px;">
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="text-muted loading-area" style="font-size: 0.875rem;height: 21px;"></div>
                        <div class="fw-bold loading-area mt-1" style="font-size: 1.125rem; line-height: 1.4;height: 52px;">

                        </div>
                        <p class="mt-2 loading-area" style="height: 65px;"></p>
                    </div>
                    <hr class="text-muted mt-2">
                </div> 
            `;

                $("#articles-load").append(loading);
            },
            success: function(res) {
                $("#articles-load #loading-area").remove();
                $("#page").val(parseInt(page) + 1);
                res = JSON.parse(res);
                for (const [id, val] of Object.entries(res)) {

                    //get date
                    var date = new Date(val.update_time != "" ? val.update_time : val.create_time);
                    var year = date.getFullYear();
                    var month = String(date.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
                    var day = String(date.getDate()).padStart(2, '0');
                    var hours = String(date.getHours()).padStart(2, '0');
                    var minutes = String(date.getMinutes()).padStart(2, '0');

                    var formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;

                    let item_html = `
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="position-relative">
                                <a href="<?= LINK_TIN_TUC ?>/${val.slug}-p${val.id_articles}">
                                    <img src="${val.image_path}" alt="" class="w-100 rounded" style="aspect-ratio: 16/9; object-fit: cover;">
                                    <div class="position-absolute bg-secondary text-light px-2 rounded-end fw-semibold" style="top:10px; font-size: 0.625rem;"><?= strtoupper($page) ?></div>
                                </a>
                            </div>

                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="text-muted" style="font-size: 0.875rem;">${formattedDate} • <?= $page ?></div>
                            <div class="fw-bold mt-1" style="font-size: 1.125rem; line-height: 1.4;">
                                <a href="<?= LINK_TIN_TUC ?>/${val.slug}-p${val.id_articles}">
                                    ${val.title}
                                </a>
                            </div>
                            <p class="mt-2"> ${val.sapo}</p>
                        </div>
                        <div class="col-12">
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn đông anh</div>
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn đông anh</div>
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn đông anh</div>
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn đông anh</div>
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2">Thị trấn đông anh</div>
                        </div>
                        <hr class="text-muted mt-2">
                    </div>
                `;
                    $("#articles-load").append(item_html);
                }
            },
            error: function(data) {

            }
        });
    }
</script>