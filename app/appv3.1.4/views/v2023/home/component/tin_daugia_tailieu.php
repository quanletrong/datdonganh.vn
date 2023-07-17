<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item bg-transparent border-bottom border-3 border-danger" role="presentation" data-bs-target="#pills-news">
                        <button class="nav-link  bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab" type="button">Tin tức</button>
                    </li>
                    <li class="nav-item bg-transparent" role="presentation" data-bs-target="#pills-auction">
                        <button class="nav-link bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab" type="button">Đấu giá đất</button>
                    </li>
                    <li class="nav-item bg-transparent" role="presentation" data-bs-target="#pills-document">
                        <button class="nav-link bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab" type="button">Tài liệu</button>
                    </li>
                </ul>
                <a href="<?= LINK_TIN_TUC ?>" class="text-danger text-decoration-none d-none d-md-block">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <hr class="pt-0 mt-0">

            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-news" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-news" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-news" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($news as $id => $new) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap" style="padding: 5px 0;">
                                        <a href="<?= LINK_TIN_TUC . '/' . $new['slug'] . '-p' . $id ?>" class="hover-link-red"><?php echo $new['title']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-news" class="data-json" value="<?php echo htmlspecialchars(json_encode($news)); ?>" />
                </div>
                <div class="tab-pane" id="pills-auction" role="tabpanel" aria-labelledby="pills-auction-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-auction" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-auction" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-auction" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($auctions as $id => $auction) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap" style="padding: 5px 0;">
                                        <a href="<?= LINK_DAU_GIA . '/' . $auction['slug'] . '-p' . $id ?>" class="hover-link-red"><?php echo $auction['title']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-auction" class="data-json" value='<?php echo json_encode($auctions); ?>' />
                </div>
                <div class="tab-pane" id="pills-document" role="tabpanel" aria-labelledby="pills-law-land-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-document" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-document" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-document" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($documents as $id => $document) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap" style="padding: 5px 0;">
                                        <a href="<?= LINK_TAI_LIEU . '/' . $document['slug'] . '-p' . $id ?>" class="hover-link-red"><?php echo $document['title']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-document" class="data-json" value='<?php echo json_encode($documents); ?>' />
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-none d-lg-block" style="padding-top: 70px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.341205954743!2d105.84419217605658!3d21.138815383987925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135011d7bfab463%3A0xd34060d3d5076677!2zVsSDbiBwaMOybmcgxJDhuqRUIMSQw5RORyBBTkg!5e0!3m2!1svi!2s!4v1685347201600!5m2!1svi!2s" style="width:100%; height: 250px; border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <!-- 416 bằng kích thước fanpage khi render xong -->
            <!-- dùng js để build fanpage facebook vi cân set width -->
            <div id="box-social" style="height: 131px;">
                <Script>
                    $(document).ready(function() {
                        jQuery(window).on("load resize", function() {
                            var width = Math.round(jQuery('#box-social').width());

                            var html = `
                            <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100092471471801&amp;ref=embed_page" data-tabs="events" data-width="${width}" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100092471471801&amp;ref=embed_page" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100092471471801&amp;ref=embed_page">Đất Đông Anh - Datdonganh.vn</a></blockquote></div>`
                            // jQuery('#box-social').html(html);
                        });
                    })
                </Script>
            </div>
        </div>
    </div>
    <!-- <hr> -->
</div>
<script>
    $(function() {

        $("#pills-tab .nav-item").click(function(e) {
            $("#pills-tab .nav-item").removeClass("border-bottom border-3 border-danger");

            $(this).addClass("border-bottom border-3 border-danger");

            let tab = $(this).data("bs-target");
            $("#pills-tabContent .tab-pane").removeClass("active");
            $("#pills-tabContent " + tab).addClass("active");

            preview_article();
            $(".tab-pane.active").find("ul.list-group li").mouseover(function() {
                let id = $(this).data("id");
                preview_article(id);
            });

        });

        preview_article();
        $(".tab-pane.active").find("ul.list-group li").mouseover(function() {
            let id = $(this).data("id");
            preview_article(id);
        });

    });


    function preview_article(id = 0) {
        let data = $(".tab-pane.active").find("input.data-json").val();
        let id_tabactive = $(".tab-pane.active").attr("id");

        try {
            data = JSON.parse(data);
            id = id == 0 ? Object.keys(data)[Object.keys(data).length - 1] : id;

            $("#img-" + id_tabactive).attr("src", data[id].image_path);
            $("#name-" + id_tabactive).text(data[id].title);

            //get hour ngay gio hien tai - create_time tai viet
            const postDate = new Date(data[id].create_time);
            const timeElapsed = timeSince(postDate);
            $("#hour-" + id_tabactive + " span").text(timeElapsed + " trước");


        } catch (error) {
            console.log(error)
        }


    }

    function timeSince(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        let interval = Math.floor(seconds / 31536000);

        if (interval >= 1) {
            return interval + " năm";
        }
        interval = Math.floor(seconds / 2592000);
        if (interval >= 1) {
            return interval + " tháng";
        }
        interval = Math.floor(seconds / 86400);
        if (interval >= 1) {
            return interval + " ngày";
        }
        interval = Math.floor(seconds / 3600);
        if (interval >= 1) {
            return interval + " giờ";
        }
        interval = Math.floor(seconds / 60);
        if (interval >= 1) {
            return interval + " phút";
        }
        return Math.floor(seconds) + " giây";
    }
</script>