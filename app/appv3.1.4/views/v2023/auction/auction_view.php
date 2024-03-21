<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    img.img-alive {
        aspect-ratio: 16/9;
    }

    @keyframes placeHolderShimmer {
        0% {
            background-position: -800px 0
        }

        100% {
            background-position: 800px 0
        }
    }

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

    @keyframes loading-animation {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>
    <div class="mt-5 d-flex justify-content-center align-items-center flex-column">
        <h2>
            <?= $title ?> bất động sản mới nhất
        </h2>
        <p class="my-2 w-50 fw-semibold d-none d-lg-block" style="font-size: 16px;">
            Thông tin mới, đầy đủ, hấp dẫn về thị trường bất động sản Đông Anh thông qua dữ liệu lớn về giá, giao
            dịch, nguồn cung - cầu và khảo sát thực tế của đội ngũ phóng viên, biên tập của <span class="text-danger">datdonganh.vn</sâpn>
        </p>
    </div>
</div>

<?php $this->load->view($template_f . 'auction/component/auction_new_view.php'); ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="mt-3">
                <div id="articles-load">

                </div>
                <center>
                    <input type="hidden" value="2" id="page" />
                    <button class="btn btn-outline-danger" onclick="get_data_more()">Xem Thêm</button>
                </center>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="sticky-lg-top" style="top:70px; z-index:auto">
                <div class="border rounded p-3">
                    <p class="fw-semibold" style="font-size: 1.125rem;"><?= $title ?> được xem nhiều nhất</p>

                    <?php $i = 1;
                    foreach ($article_view_top as $article) { ?>
                        <hr class="text-muted">
                        <div class="d-flex align-items-center" style="gap:10px">
                            <div class="d-flex align-items-center" style="gap:10px">
                                <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.1;">
                                    <?php echo $i; ?>
                                </div>
                            </div>
                            <div>
                                <a href="<?= LINK_DAU_GIA . '/' . $article['slug'] . '-p' . $article['id_articles'] ?>" class="hover-link-red">
                                    <?php echo $article['title']; ?>
                                </a>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>

                </div>

                <div class="border rounded p-3 mt-3">
                    <p class="fw-semibold" style="font-size: 1.125rem;"><?= $title ?> theo khu vực</p>

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
</div>

<script>
    get_data_more();

    function get_data_more() {

        let page = $.trim($("#page").val());

        $.ajax({
            url: '<?php echo site_url(LINK_DAU_GIA . "/ajx", $langcode) ?>',
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
                    var date = new Date(val.create_time_set);
                    var year = date.getFullYear();
                    var month = String(date.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
                    var day = String(date.getDate()).padStart(2, '0');
                    var hours = String(date.getHours()).padStart(2, '0');
                    var minutes = String(date.getMinutes()).padStart(2, '0');

                    var formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;

                    let item_html = `
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <a href="<?= LINK_DAU_GIA ?>/${val.slug}-p${val.id_articles}">
                                    <div class="position-relative">
                                        <img src="${val.image_path}"
                                            alt="" class="w-100 rounded" style="aspect-ratio: 16/9; object-fit: cover;">
                                        <div class="position-absolute bg-secondary text-light px-2 rounded-end fw-semibold hover-link-red"
                                            style="top:10px; font-size: 0.625rem;"><?= $title ?></div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-12 col-lg-8">
                                <a href="<?= LINK_DAU_GIA ?>/${val.slug}-p${val.id_articles}">
                                    <div class="text-muted" style="font-size: 0.875rem;">${formattedDate} • <?= $title ?></div>
                                    <div class="fw-bold mt-1 hover-link-red" style="font-size: 1.125rem; line-height: 1.4;">
                                        ${val.title}
                                    </div>
                                    <p class="mt-2">${val.sapo}</p>
                                </a>
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