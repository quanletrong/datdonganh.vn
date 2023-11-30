<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    #main-owl-dia-diem {
        position: relative;
    }
    #main-owl-dia-diem .owl-theme .custom-nav {
        position: absolute;
        top: 40%;
        left: 0;
        right: 0;
    }
    #main-owl-dia-diem .owl-theme .custom-nav .owl-prev, #main-owl-dia-diem .owl-theme .custom-nav .owl-next {
        position: absolute;
        height: 100px;
        color: inherit;
        background: none;
        border: none;
        z-index: 100;
    }
    #main-owl-dia-diem .owl-theme .custom-nav .owl-prev i, #main-owl-dia-diem .owl-theme .custom-nav .owl-next i {
        font-size: 5rem;
        color: #cecece;
    }
    #main-owl-dia-diem .owl-theme .custom-nav .owl-prev {
        left: -70px;
    }
    #main-owl-dia-diem .owl-theme .custom-nav .owl-next {
        right: -70px;
    }

    @media (max-width: 991.98px) {

        #main-owl-dia-diem .owl-theme .custom-nav .owl-prev i, #main-owl-dia-diem .owl-theme .custom-nav .owl-next i {
            font-size: 3rem;
            color: #cecece;
        }
        
        #main-owl-dia-diem .owl-theme .custom-nav .owl-prev {
            left: 0;
        }
        #main-owl-dia-diem .owl-theme .custom-nav .owl-next {
            right: 0;
        }
    }



</style>
<div class="container mt-5">
    <div class="fw-bold fs-4">
        Bất động sản theo địa điểm
    </div>
    <div id="main-owl-dia-diem" style="position: relative;">
        <div id="owl-dia-diem" class="owl-carousel owl-theme">
            <?php foreach ($commune_ward_and_num_bds_chunk3 as $index => $chunk) {  ?>
                <?php if (count($chunk) == 3) { ?>
                    <div class="row g-1">
                        <?php if ($index % 2) { ?>
                            <div class="col-12">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[0]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                                border-radius: 4px;
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[0]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[0]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[0]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[1]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[1]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[1]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[1]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[2]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[2]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[2]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[2]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } else { ?>

                            <div class="col-6">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[0]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[0]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[0]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[0]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[1]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[1]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[1]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[1]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-12 mt-1">
                                <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $chunk[2]['id_commune_ward'] ?>">
                                    <div class="position-relative">
                                        <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);;
                                transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                                        <img class="img-alive" src="<?php echo $chunk[2]['image_path'] ?>" class=" w-100" alt="">
                                        <div class="position-absolute" style="top:10px; left: 10px;">
                                            <div class="text-light fs-5 fw-bold"><?php echo $chunk[2]['name'] ?></div>
                                            <div class="text-light fw-bold"><?php echo number_format($chunk[2]['num_bds']); ?> tin đăng</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="owl-theme">
            <div class="owl-controls">
                <div class="custom-nav owl-nav"></div>
            </div>
        </div>
    </div>
    

    <div id="owl-dia-diem-2" class="owl-carousel owl-theme mt-3">

        <?php foreach ($communes as $id => $comm) { ?>
            <span class="badge rounded-pill text-bg-secondary p-2"><a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $id ?>"><?php echo $comm['name']; ?></a></span>

        <?php } ?>

    </div>

    <script>
        $(document).ready(function() {
            $("#owl-dia-diem").owlCarousel({
                dots: false,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 5,
                responsiveClass: true,

                nav: true,
                navText: [
                    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                    '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                ],
                navContainer: '#main-owl-dia-diem .custom-nav',
                
                responsive: {
                    0: {
                        items: 1
                    },
                    992: {
                        items: 2
                    }
                }
            });
            $("#owl-dia-diem-2").owlCarousel({
                dots: false,
                autoWidth: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 20,
            });
        });
    </script>
</div>