<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <div class="fw-bold fs-4">
        Bất động sản theo địa điểm
    </div>

    <div id="owl-dia-diem" class="owl-carousel owl-theme">
        <div class="row">
  
            <?php 
            if(isset($commune_ward_and_num_bds[0])){ 
                $it = $commune_ward_and_num_bds[0];
            ?>
            <div class="col-12 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            
            <?php 
            if(isset($commune_ward_and_num_bds[1])){ 
                $it = $commune_ward_and_num_bds[1];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[2])){ 
                $it = $commune_ward_and_num_bds[2];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            
            <?php 
            if(isset($commune_ward_and_num_bds[3])){ 
                $it = $commune_ward_and_num_bds[3];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[4])){ 
                $it = $commune_ward_and_num_bds[4];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[5])){ 
                $it = $commune_ward_and_num_bds[5];
            ?>
            <div class="col-12 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php 
            if(isset($commune_ward_and_num_bds[6])){ 
                $it = $commune_ward_and_num_bds[6];
            ?>
            <div class="col-12 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            
            <?php 
            if(isset($commune_ward_and_num_bds[7])){ 
                $it = $commune_ward_and_num_bds[7];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[8])){ 
                $it = $commune_ward_and_num_bds[8];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="row">
            <?php 
            if(isset($commune_ward_and_num_bds[9])){ 
                $it = $commune_ward_and_num_bds[9];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[10])){ 
                $it = $commune_ward_and_num_bds[10];
            ?>
            <div class="col-6 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
            if(isset($commune_ward_and_num_bds[11])){ 
                $it = $commune_ward_and_num_bds[11];
            ?>
            <div class="col-12 mt-3">
                <div class="position-relative">
                    <div style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
                    border-radius: 4px;
                    transform: rotate(-180deg); position: absolute; top: 0; left: 0; width: 100%; height: 50%;"></div>
                    <img class="img-alive" src="<?php echo $it['image_path'] ?>"
                        class="rounded img-fluid w-100" alt="">
                    <div class="position-absolute" style="top:10px; left: 10px;">
                        <div class="text-light fs-5 fw-bold"><?php echo $it['name'] ?></div>
                        <div class="text-light fw-bold"><?php echo number_format($it['num_bds']); ?> tin đăng</div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div id="owl-dia-diem-2" class="owl-carousel owl-theme mt-3">
        
        <?php foreach($communes as $comm){ ?>
            <span class="badge rounded-pill text-bg-secondary p-2"><a href=""><?php echo $comm['name']; ?></a></span>

        <?php } ?>

    </div>

    <script>
        $(document).ready(function () {
            $("#owl-dia-diem").owlCarousel({
                dots: false,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 20,
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
                nav:false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 20,
            });
        });
    </script>
</div>