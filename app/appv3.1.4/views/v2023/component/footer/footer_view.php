<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container my-5">
    <img src="https://tpc.googlesyndication.com/simgad/16381994165507055885" class="w-100 img-fluid">
</div>
<!-- FOOTER -->
<div class="contaier-fluid" style="background: #f2f2f2;">
    <div class="container py-5">
        
        <div class="row">
            <div class="col-md-6 col-lg-4 mt-5">
                <div class="fs-6 fw-bold">VĂN PHÒNG GIAO DỊCH <br />BẤT ĐỘNG SẢN ĐẤT ĐÔNG ANH</div>
                <div class="w-100 mt-3">

                    <div class="mt-2">
                        <i class="fa-solid fa-location-dot"></i>
                        <a href="https://www.google.com/maps?ll=21.13881,105.846767&z=15&t=m&hl=vi&gl=US&mapclient=embed&cid=15222273203440674423" target="_blank">
                            153A -Tổ 4 - TT Đông Anh - Đông Anh - Hà Nội
                        </a>
                    </div>
                    <div class="mt-2">
                        <i class="fa-solid fa-globe"></i>
                        <a href="https://datdonganh.vn">
                            www.datdonganh.vn
                        </a>
                    </div>
                    <!-- <div class="mt-2">
                        <i class="fa-solid fa-mobile-retro"></i>
                        <a href="tel:0962 542 998" class="text-decoration-none text-dark">0962 542 998</a>
                    </div>
                    <div class="mt-2">
                        <i class="fa-solid fa-mobile-retro"></i>
                        <a href="tel:0974 98 6336" class="text-decoration-none text-dark">0974 98 6336</a>
                    </div>

                    <div class="mt-2">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <a href="mailto:abc@gmail.com" class="text-decoration-none text-dark">contact@datdonganh.vn</a>
                    </div>

                    <hr>
                    <div class="mt-2">
                        Chịu trách nhiệm nội dung ông Nguyễn Quốc Huy <br>
                        Email: <a href="contact@datdonganh.vn" class="text-decoration-none text-dark">contact@datdonganh.vn</a> <br>
                        Phone: <a href="tel:0974 98 6336">0974 98 6336</a>
                    </div> -->
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mt-5">
                <div class="fs-6 fw-bold">VỀ CHÚNG TÔI</div>
                <div class="mt-3">
                    <div class="w-100"><a href="" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Trang chủ</a></div>
                    <div class="w-100 mt-2"><a href="<?= LINK_NHA_DAT_BAN ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Bất động sản Đông Anh</a>
                    </div>
                    <div class="w-100 mt-2"><a href="<?= LINK_DAU_GIA ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Đấu giá đất</a>
                    </div>
                    <div class="w-100 mt-2"><a href="<?= LINK_TIN_TUC ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Tin tức bất động sản</a></div>
                    <div class="w-100 mt-2"><a href="<?= LINK_TAI_LIEU ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Luật đất đai</a>
                    </div>
                    <div class="w-100 mt-2"><a href="<?= LINK_LIEN_HE ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Liên hệ</a></div>
                    <div class="w-100 mt-2"><a href="<?= LINK_USER_REGISTER ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Đăng ký</a></div>
                    <div class="w-100 mt-2"><a href="<?= LINK_USER_LOGIN ?>" class="text-decoration-none text-dark"><i class="fa-solid fa-angle-right"></i> Đăng nhập</a></div>
                </div>
            </div>

            <div class="col-md-12 col-lg-5 mt-5">
                <div class="fs-6 fw-bold">ĐĂNG KÝ NHẬN TIN TƯ VẤN</div>
                <div class="w-100 mt-3">
                    <input type="text" class="form-control w-100" placeholder="Họ và tên">
                    <div class="hstack gap-3 mt-2">
                        <input type="text" class="form-control" placeholder="Số điện thoại">
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                    <textarea name="" id="" cols="30" rows="5" class="form-control mt-2" placeholder="Nhập nội dung cần tư vấn"></textarea>

                    <button class="btn btn-danger mt-3">Gửi yêu cầu</button>
                </div>
            </div>
        </div>
        <hr class="mt-5">
        <p class="text-center">Bản quyền © <a href="/">www.datdonganh.vn</a> | Bất Động Sản Đông Anh</p>
    </div>
</div>

<script>
    $(function() {
        $("button.btn-heart").on("click", function() {
            const type = $(this).hasClass("btn-outline-danger") ? '1' : '0';
            const pid = $(this).data("id");

            if (type == '1') {
                $(this).removeClass("btn-outline-danger");
                $(this).addClass("btn-danger");
            } else {
                $(this).addClass("btn-outline-danger");
                $(this).removeClass("btn-danger");
            }

            $.ajax({
                url: '<?php echo site_url("bds/ajx_heart", $langcode) ?>',
                type: 'POST',
                data: {
                    pid,
                    type
                },
                success: function(res) {
                    if (res == 'not_login') {
                        window.location = "<?php echo site_url(LINK_USER_LOGIN, $langcode) ?>";
                    } else {
                        $("#count-favorite").text(res);

                    }
                },
                error: function(data) {

                }
            });
        });
    });
</script>