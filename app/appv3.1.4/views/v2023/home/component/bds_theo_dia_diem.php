<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <div class="fw-bold fs-4">
        Bất động sản theo địa điểm
    </div>

    <div id="owl-dia-diem" class="owl-carousel owl-theme">
        <?php foreach ($commune_ward_and_num_bds_chunk3 as $index => $chunk) {  ?>
            <?php if (count($chunk) == 3) { ?>
                <div class="row g-1">
                    <?php if ($index % 2) { ?>
                        <div class="col-12">
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[0]['id_commune_ward'] ?>">
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
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[1]['id_commune_ward'] ?>">
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
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[2]['id_commune_ward'] ?>">
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
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[0]['id_commune_ward'] ?>">
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
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[1]['id_commune_ward'] ?>">
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
                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $chunk[2]['id_commune_ward'] ?>">
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

    <div id="owl-dia-diem-2" class="owl-carousel owl-theme mt-3">

        <?php foreach ($communes as $id => $comm) { ?>
            <span class="badge rounded-pill text-bg-secondary p-2"><a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $id ?>"><?php echo $comm['name']; ?></a></span>

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