<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="position-relative" id="preview-header">
                <a href="" id="link-preview">
                    <img id="img-preview" src="" class="w-100 img-fluid img-alive" alt="" style="aspect-ratio: 16/9; object-fit: cover;">

                    <div class="position-absolute" style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%); border-radius: 4px; transform: rotate(0); position: absolute; bottom: 0; width: 100%; height: 50%;">
                    </div>
                    <div class="position-absolute" style="bottom: 2rem; left: 2rem;">
                        <div class="text-light" id="date-preview">28/04/2023 11:10 • <?= $title ?></div>
                        <div class="fw-bold fs-4 text-light" id="title-preview" style="font-size: 1rem; line-height: 1.2;">CÁC NGÂN HÀNG LỚN
                            THỐNG NHẤT GIẢM LÃI SUẤT HUY ĐỘNG
                        </div>
                        <div class="fw-semibold text-light" id="sapo-preview">Các ngân hàng lớn thống nhất giảm lãi suất huy động
                        </div>
                    </div>
                </a>

            </div>

        </div>
        <div class="col-12 col-lg-4" id="list-news-header">
            <?php foreach ($article_new as $article) { ?>
                <div class="py-3 mb-2 news-header" data-id="<?php echo $article['id_articles']; ?>">
                    <div class="text-muted" style="font-size: 0.875rem;"><?php echo date('d/m/Y h:i', strtotime($article['create_time_set'])) ?> • <?= $title ?></div>
                    <a href="<?= LINK_TAI_LIEU . '/' . $article['slug'] . '-p' . $article['id_articles'] ?>" class="hover-link-red">
                        <div class="fw-bold" style="font-size: 1rem; line-height: 1.2;">
                            <?php echo $article['title'] ?>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<input type="hidden" id="data-news-header" value="<?php echo htmlspecialchars(json_encode($article_new)); ?>" />
<script>
    $(function() {
        preview_article();
        $("#list-news-header .news-header").mouseover(function() {
            let id = $(this).data("id");
            preview_article(id);
        });
    });

    function preview_article(id = 0) {
        let data = $("#data-news-header").val();
        try {
            data = JSON.parse(data);

            id = id == 0 ? Object.keys(data)[Object.keys(data).length - 1] : id;
            console.log(data[id].image_path)
            $("#preview-header #img-preview").attr("src", data[id].image_path);
            $("#preview-header #title-preview").text(data[id].title);
            $("#preview-header #sapo-preview").text(data[id].sapo);
            $("#preview-header #link-preview").attr("href", `<?= LINK_TAI_LIEU ?>/${data[id].slug}-p${data[id].id_articles}`);


            var date = new Date(data[id].create_time_set);

            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
            var day = String(date.getDate()).padStart(2, '0');
            var hours = String(date.getHours()).padStart(2, '0');
            var minutes = String(date.getMinutes()).padStart(2, '0');

            var formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;
            $("#date-preview").text(formattedDate);

        } catch (error) {
            console.log(error);
        }


    }
</script>