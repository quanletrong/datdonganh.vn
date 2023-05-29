<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    #slide-image * {
        box-sizing: border-box
    }

    #slide-image {
        font-family: Verdana, sans-serif;
        margin: 0
    }

    #slide-image .mySlides {
        display: none
    }

    #slide-image img {
        vertical-align: middle;
    }

    /* Slideshow container */
    #slide-image .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Next & previous buttons */
    #slide-image .prev,
    #slide-image .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    #slide-image .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    #slide-image .prev:hover,
    #slide-image .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
    #slide-image .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    #slide-image .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    #slide-image .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    #slide-image .slide-image-dot {
        border: 1px solid transparent;
    }
    #slide-image .slide-image-dot img {
        width: 5rem;
        aspect-ratio: 4/3;
        object-fit: cover;
        cursor: pointer;
        border-radius: 3px;
    }

    #slide-image .slideractive{
        border: 1px solid red;
    }

    /* Fading animation */
    #slide-image .fadeSlideImage {
        animation-name: fadeSlideImage;
        animation-duration: 0.5s;
    }

    @keyframes fadeSlideImage {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {

        #slide-image .prev,
        #slide-image .next,
        #slide-image .text {
            font-size: 11px
        }
    }
</style>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <div id="slide-image">
                <div class="slideshow-container">

                    <?php $i = 1;
                    foreach ($imgs as $img) { ?>
                        <div class="mySlides fadeSlideImage">
                            <div class="numbertext"><?php echo $i . ' / ' . count($imgs) ?></div>
                            <img src="<?php echo get_path_image($bdsInfo['create_time'], $img); ?>"
                                 style="width:100%;aspect-ratio: 16/9; object-fit: cover;">
                            <div class="text"></div>
                        </div>
                        <?php $i++;} ?>


                    <div class="prev" onclick="plusSlides(-1)">❮</div>
                    <div class="next" onclick="plusSlides(1)">❯</div>

                </div>
                <br>

                <div style="text-align:center">
                    <div id="owl-image-thumb" class="owl-carousel">
                        <?php $i = 1;
                        foreach ($imgs as $img) { ?>
                            <div class="slide-image-dot" onclick="currentSlide(<?php echo $i; ?>)">
                                <img src="<?php echo get_path_image($bdsInfo['create_time'], $img); ?>">
                            </div>
                        <?php $i++;} ?>

                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $("#owl-image-thumb").owlCarousel({
                        dots: false,
                        autoWidth: true,
                        nav:false,
                        autoplay: false,
                        margin: <?php echo count($imgs); ?>,
                    });
                });
            </script>



            <script>
                let slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("slide-image-dot");
                    if (n > slides.length) { slideIndex = 1 }
                    if (n < 1) { slideIndex = slides.length }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" slideractive", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " slideractive";
                }
            </script>
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?=LINK_NHA_DAT_BAN?>" class="text-secondary">Tất cả BĐS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết bđs</li>
                </ol>
            </nav>

            <h1 class="fw-bold fs-4">
                <?php echo $bdsInfo['title']; ?>
            </h1>

            <p>
                <?php echo $bdsInfo['address']; ?>
            </p>
            <div class="d-flex justify-content-between align-items-center border-bottom border-top py-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 me-md-5">
                        <div class="text-muted">Mức giá</div>
                        <div class="fw-bold fs-5">
                            <?php echo getPrice($bdsInfo['price_total']); ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?>
                        </div>
                    </div>
                    <div class="me-3 me-md-5">
                        <div class="text-muted">Diện tích</div>
                        <div class="fw-bold fs-5"><?php echo $bdsInfo['acreage']; ?> m²</div>

                    </div>

                    <?php if ($bdsInfo['facades'] > 0) { ?>
                        <div>
                            <div class="text-muted">Mặt tiền</div>
                            <div class="fw-bold fs-5">Mặt tiền <?php echo $bdsInfo['facades']; ?> m</div>
                        </div>
                    <?php } ?>
                </div>
                <div>
                    <i class="fa-solid fa-share-nodes me-1 me-md-3 fs-4"></i>
                    <i class="fa-solid fa-triangle-exclamation me-1 me-md-3 fs-4"></i>
                    <i class="fa-regular fa-heart me-1 me-md-3 fs-4"></i>
                </div>
            </div>

            <!-- Thông tin mô tả -->
            <div class="mt-3">
                <div class="fw-semibold fs-5">Thông tin mô tả</div>
                <div class="mt-3">
                    <?php echo $bdsInfo['content']; ?>

                </div>
                <div class="mt-3">
                    <button class="btn btn-sm text-light me-2" style="background-color: rgb(7 152 83);">
                        <a href="tel:<?php echo $bdsInfo['contactphone'] ?>"><i class="fa-solid fa-phone-volume"></i> <?php echo $bdsInfo['contactphone'] ?></a>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                </div>
            </div>

            <!-- Đặc điểm bất động sản -->
            <div class="mt-5">
                <div class="fw-semibold fs-5">Đặc điểm bất động sản</div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6">
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Diện tích</div>
                            <div><?php echo $bdsInfo['acreage']; ?> m²</div>
                        </div>
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Mặt tiền</div>
                            <div><?php echo $bdsInfo['facades']; ?> m</div>
                        </div>
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Hướng nhà</div>
                            <div><?php echo isset($cf_direction[$bdsInfo['direction']]) ? $cf_direction[$bdsInfo['direction']] : "" ?></div>
                        </div>
                        <div class="border-top border-bottom d-flex py-2">
                            <div class="fw-semibold w-50">Số tầng</div>
                            <div><?php echo isset($cf_floor[$bdsInfo['floor']]) ? $cf_floor[$bdsInfo['floor']] : "" ?> tầng</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Mức giá</div>
                            <div><?php echo getPrice($bdsInfo['price_total']); ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?></div>
                        </div>
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Đường vào</div>
                            <div><?php echo $bdsInfo['road_surface']; ?> m</div>
                        </div>
                        <div class="border-top d-flex py-2">
                            <div class="fw-semibold w-50">Hướng ban công</div>
                            <div><?php // echo isset($cf_direction[$bdsInfo['direction']]) ? $cf_direction[$bdsInfo['direction']] : ""  ?></div>
                        </div>
                        <div class="border-top border-bottom d-flex py-2">
                            <div class="fw-semibold w-50">Pháp lý</div>
                            <div><?php echo isset($cf_juridical[$bdsInfo['juridical']]) ? $cf_juridical[$bdsInfo['juridical']] : "" ?></div>
                        </div>
                    </div>
                </div>
            </div>

                <?php if ($bdsInfo['maps'] != "") { ?>
                <!-- Xem trên bản đồ -->
                <div class="mt-5">
                    <div class="fw-semibold fs-5 mb-3">Xem trên bản đồ</div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29768.399307311087!2d105.82663151782567!3d21.15041182879494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135011877263c29%3A0xfed63a1860e09572!2zdHQuIMSQw7RuZyBBbmgsIMSQw7RuZyBBbmgsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1685287293812!5m2!1svi!2s" style="width: 100%; height: 240px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <?php } ?>

            <!-- Từ khóa liên quan -->
            <div class="mt-5">
                <div class="fw-semibold fs-5 mb-3">Từ khóa liên quan</div>
                <div class="mt-3">
                <?php foreach ($tags as $tag) { ?>
                    <div class="badge rounded-pill text-bg-secondary p-2 mb-2"><?php echo $tag['name'] ?></div>
                <?php } ?>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center border-bottom border-top py-2 mt-5">
                <div class="d-flex align-items-center" style="gap:50px">
                    <div>
                        <div class="text-muted">Ngày đăng</div>
                        <div class="fw-semibold"><?php echo date("d/m/Y", strtotime($bdsInfo['create_time'])); ?></div>
                    </div>
                    <div>
                        <div class="text-muted">Ngày hết hạn</div>
                        <div class="fw-semibold"><?php echo $bdsInfo['expired'] != "0000-00-00" ? date("d/m/Y", strtotime($bdsInfo['expired'])) : "&nbsp;"; ?> </div>
                    </div>
                    <div>
                        <div class="text-muted">Loại tin</div>
                        <div class="fw-semibold"><?php echo $bdsInfo['is_vip'] == 0 ? 'Tin thường' : 'Tin VIP'; ?> </div>
                    </div>
                    <!--                    <div>
                                            <div class="text-muted">Mã tin</div>
                                            <div class="fw-semibold">123456</div>
                                        </div>-->
                </div>
            </div>

            <!-- Bất động sản dành cho bạn -->
            <div class="mt-5">
                <div class="fw-bold fs-5">Bất động sản dành cho bạn</div>

                <div id="owl-noi-bat" class="owl-carousel owl-theme mt-3">

                    <?php foreach ($bdss as $bds) { ?>
                        <div class="rounded border border-1 border-muted">
                            <img src="<?php echo $bds['image_path']; ?>"
                                 class="rounded-top img-fluid w-100 img-alive" alt="">
                            <div class="p-3">
                                <p class="fw-semibold text-truncate text-wrap"
                                   style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    <?php echo $bds['title']; ?>
                                </p>
                                <div class="d-flex gap-2">
                                    <div class="text-danger fw-bold"><?php echo getPrice($bds['price_total']) ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?></div>
                                    <div class="mb-1">.</div>
                                    <div class="text-danger  fw-bold"><?php echo $bds['acreage']; ?> m²</div>
                                </div>
                                <div class="text-secondary mt-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <?php echo $bds['commune']; ?>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="text-secondary" style="font-size: 0.8rem;">Đăng <?php echo timeSince($bds['create_time']) ?> trước</span>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <script>
                    $(document).ready(function () {
                        $("#owl-noi-bat").owlCarousel({
                            autoplay:true,
                            autoplayTimeout:4000,
                            autoplayHoverPause:true,
                            margin: 10,
                            responsiveClass: true,
                            nav:false,
                            dots: false,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                768: {
                                    items: 2
                                },
                                992: {
                                    items: 3
                                }
                            }
                        });
                    });
                </script>
            </div>

            <!-- Tin đăng đã xem -->
            <div class="mt-5">
                <div class="fw-bold fs-5">Tin đăng đã xem</div>

                <div id="owl-bds-da-xem" class="owl-carousel owl-theme mt-3">

                </div>

            </div>

            <!--  -->
            <hr class="text-muted mt-5">
            <div class="mt-2">
                Quý vị đang xem nội dung tin rao "<strong style="font-weight: bold">Chỉ từ 6.9 tỷ - Sở hữu ngay mảnh đất cực đẹp tại thị trấn Đông Anh. LH: 0969 640 ***</strong> - <strong style="font-weight: bold">Mã tin 123456</strong>.
                Mọi thông tin, nội dung liên quan tới tin rao này là do người đăng tin đăng tải và chịu trách nhiệm.
                Batdongsan.com.vn luôn cố gắng để các thông tin được hữu ích nhất cho quý vị tuy nhiên Batdongsan.com.vn không đảm bảo và không chịu trách nhiệm về bất kỳ thông tin, nội dung nào liên quan tới tin rao này.
                Trường hợp phát hiện nội dung tin đăng không chính xác, Quý vị hãy thông báo và cung cấp thông tin cho Ban quản trị Batdongsan.com.vn theo <strong style="font-weight: bold">Hotline 19001881</strong> để được hỗ trợ nhanh và kịp thời nhất.
            </div>


        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <img src="https://file4.batdongsan.com.vn/resize/200x200/2023/03/31/20230331171327-a131.jpg" class="rounded-circle w-25" alt="">
                    <div class="text-muted mt-2" style="font-size: 0.875rem;">Được đăng bởi</div>
                    <div class="fw-semibold fs-5 text-truncate"><?php echo $bdsInfo['contactname']; ?></div>
                    <div class="">Xem thêm <?=$get_num_bds_by_contact_name?> tin khác</div>

                    <button class="btn text-light mt-2 w-100" style="background-color: rgb(7 152 83);">
                        <a href="tel:<?php echo $bdsInfo['contactphone'] ?>"><i class="fa-solid fa-phone-volume"></i> <?php echo $bdsInfo['contactphone'] ?></a>
                    </button>

                    <button class="btn btn-outline-secondary mt-2 w-100">Gửi email</button>

                    <button class="btn btn-outline-secondary mt-2 w-100">Yêu cầu liên hệ lại</button>

                </div>
            </div>

            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Bất động sản cùng khu vực</p>
                    <div class="d-flex flex-column">

                        <?php foreach($bds_palace_area as $palace_area){ ?>
                        <a class="text-decoration-none text-dark py-1 hover-link-red cursor-poiter"><?php echo $palace_area['title']; ?></a>
                        <?php } ?>

      
                    </div>
                </div>
            </div>

            <div class="card mt-3" style="background-color: #f7f7f7;">
                <div class="card-body">
                    <p class="fw-semibold" style="font-size: 1.125rem;">Bất động sản nổi bật</p>
                    <div class="d-flex flex-column">
                        <?php foreach($commune_ward_and_num_bds as $vip){ ?>
                        <a class="text-decoration-none text-dark py-1">
                           Bán nhà tại <?php echo $vip['name']; ?>
                        </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    set_bds_watched();
    get_bds_watched();
    
    
    function set_bds_watched(){
        const bds_watched = localStorage.getItem("BDS_WATCHED");
        if(bds_watched == null){ 
            // neu localStorage BDS_WATCHED == null thì set binh thuong
            let bds = {};
            bds[<?php echo $bdsInfo['id_bds'] ?>] = {
                'image_path' : '<?php echo!empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                'title'      : '<?php echo $bdsInfo['title'] ?>',
                'price_total'      : '<?php echo getPrice($bdsInfo['price_total']); ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?>',
                'acreage'    : '<?php echo $bdsInfo['acreage']; ?> m²',
                'commune'    : '<?php echo $bdsInfo['commune_name']; ?>',
                'create_time': 'Đăng <?php echo timeSince($bds['create_time']) ?> trước' 
            }
            localStorage.setItem("BDS_WATCHED", JSON.stringify(bds));
        }else{
            // neu localStorage BDS_WATCHED != null
            const id_bds_watched = <?php echo $bdsInfo['id_bds'] ?>;
            let obj_bds_watched = JSON.parse(bds_watched);
            if(obj_bds_watched.hasOwnProperty(id_bds_watched)){
                //neu bds dang xem ton tai trong object BDS_WATCHED
                // thi xoa key bds trong object BDS_WATCHED đi
                //và lay bds dang xem lên đầu object BDS_WATCHED
        
                delete obj_bds_watched[id_bds_watched]; 
                let bds = {
                    'image_path' : '<?php echo!empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                    'title'      : '<?php echo $bdsInfo['title'] ?>',
                    'price_total'      : '<?php echo getPrice($bdsInfo['price_total']); ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?>',
                    'acreage'    : '<?php echo $bdsInfo['acreage']; ?> m²',
                    'commune'    : '<?php echo $bdsInfo['commune_name']; ?>',
                    'create_time': 'Đăng <?php echo timeSince($bds['create_time']) ?> trước' 
                }
                obj_bds_watched = { [id_bds_watched]: bds, ...obj_bds_watched };
            }else{
                
                //neu bds dang xem khong ton tai trong object BDS_WATCHED
                // thi them bds vào vị trí đâu tien cua object BDS_WATCHED
                
                let bds = {
                    'image_path' : '<?php echo!empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                    'title'      : '<?php echo $bdsInfo['title'] ?>',
                    'price_total'      : '<?php echo getPrice($bdsInfo['price_total']); ?><?php echo isset($price_type[$bdsInfo['price_type']]) ? $price_type[$bdsInfo['price_type']] : ''; ?>',
                    'acreage'    : '<?php echo $bdsInfo['acreage']; ?> m²',
                    'commune'    : '<?php echo $bdsInfo['commune_name']; ?>',
                    'create_time': 'Đăng <?php echo timeSince($bds['create_time']) ?> trước' 
                }
                obj_bds_watched = { [id_bds_watched]: bds, ...obj_bds_watched };
            }
            
            //chỉ lây 10 bds trong object BDS_WATCHED
            obj_bds_watched = limitObjectSize(obj_bds_watched, 10);
            
            localStorage.setItem("BDS_WATCHED", JSON.stringify(obj_bds_watched));
        }
        
    }
    
    function get_bds_watched(){
    
        $("#owl-bds-da-xem").html();
        const bds_watched = localStorage.getItem("BDS_WATCHED");
        const obj_bds_watched = JSON.parse(bds_watched);
        for (const [id, val] of Object.entries(obj_bds_watched)) {
            let temp = 
            `
                <div class="rounded border border-1 border-muted">
                    <img src="${val.image_path}"
                         class="rounded-top img-fluid img-alive w-100" alt="">
                    <div class="p-3">
                        <p class="fw-semibold text-truncate text-wrap"
                           style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                           ${val.title}
                        </p>
                        <div class="d-flex gap-2">
                            <div class="text-danger fw-bold">${val.price_total}</div>
                            <div class="mb-1">.</div>
                            <div class="text-danger  fw-bold">${val.acreage}</div>
                        </div>
                        <div class="text-secondary mt-2">
                            <i class="fa-solid fa-location-dot"></i>
                            ${val.commune}
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-secondary" style="font-size: 0.8rem;">${val.create_time}</span>
                            <button class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $("#owl-bds-da-xem").append(temp);
        }
        
        $("#owl-bds-da-xem").owlCarousel({
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            margin: 10,
            responsiveClass: true,
            nav:false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    }
    
    function limitObjectSize(obj, num) {
        const keys = Object.keys(obj); // Lấy danh sách các key trong object
        if (keys.length > num) { // Kiểm tra số lượng key có vượt quá num hay không
            const limitedKeys = keys.slice(0, num); // Cắt bớt danh sách key chỉ còn num phần tử
            const limitedObject = {};
            for (const key of limitedKeys) {
              limitedObject[key] = obj[key]; // Gán giá trị tương ứng từ object gốc vào object mới
            }
            return limitedObject;
        }
        return obj; // Trả về object ban đầu nếu số lượng key không vượt quá num
    }
</script>