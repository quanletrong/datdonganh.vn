<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <div class="fw-bold fs-4">
        Bất động sản dành cho bạn
    </div>
    <div class="row">
        <?php foreach ($bdss as $bds) { ?>
            <div class="col-12 col-md-6 col-lg-3 mt-3">
                <div class="rounded border border-1 border-muted">
                    <img src="<?php echo $bds['image_path']; ?>" class="img-alive rounded-top img-fluid w-100" alt="">
                    <div class="p-3">
                        <p class="fw-semibold text-truncate text-wrap" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><?php echo $bds['title']; ?></p>
                        <div class="d-flex gap-2">
                            <div class="text-danger fw-bold"><?php echo getPrice($bds['price_total']) ?></div>
                            <div class="mb-1">.</div>
                            <div class="text-danger  fw-bold"><?php echo $bds['acreage']; ?> m²</div>
                        </div>
                        <div class="text-secondary mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo $bds['commune']; ?>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-secondary" style="font-size: 0.8rem;">Đăng <?php echo timeSince($bds['create_time_set']) ?> trước</span>
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
