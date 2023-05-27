<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <div class="fw-bold fs-4">
        Tin tức bất động sản
    </div>
    <div id="owl-tin-tuc" class="owl-carousel owl-theme mt-3 owl-loaded owl-drag">
        <?php
        $i = 1;
        foreach ($news2 as $id => $new) {
        ?>
            <a href="<?=LINK_TIN_TUC.'/'.$new['slug'].'-p'.$id?>">
                <div class="rounded border border-1 border-muted">
                    <img src="<?php echo $new['image_path'] ?>" class="img-alive rounded-top img-fluid w-100" alt="">
                    <div class="p-3 d-flex gap-3 align-items-center">
                        <span class="fw-bold fs-1 text-secondary">0<?php echo $i; ?></span>
                        <span class="fw-semibold text-truncate text-wrap" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <?php echo $new['title'] ?>
                        </span>
                    </div>
                </div>
            </a>

        <?php
            $i++;
        }
        ?>
    </div>
    <script>
        $(document).ready(function() {
            $("#owl-tin-tuc").owlCarousel({
                // center: true,
                // loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 10,
                responsiveClass: true,
                // nav:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 4
                    }
                }
            });
        });
    </script>
</div>