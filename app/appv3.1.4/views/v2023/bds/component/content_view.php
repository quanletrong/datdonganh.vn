<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <?php $this->load->view($template_f . 'bds/component/slide_detail_bds_view.php') ?>
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= LINK_NHA_DAT_BAN ?>" class="text-secondary">Tất cả BĐS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết bđs</li>
                </ol>
            </nav>

            <h1 class="fw-bold fs-4">
                <?php echo $bdsInfo['title']; ?>
            </h1>

            <p>
                <?php echo $bdsInfo['address']; ?>
            </p>
            <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom border-top py-3">
                <div class="d-flex flex-wrap align-items-center" style="gap:20px">
                    <div>
                        <div class="text-muted">Mức giá</div>
                        <div class="fw-bold fs-6 text-danger">
                            <?php echo getPrice($bdsInfo['price_total']); ?>
                        </div>
                    </div>
                    <div>
                        <div class="text-muted">Diện tích</div>
                        <div class="fw-bold fs-6 text-danger"><?php echo $bdsInfo['acreage']; ?>m²</div>
                    </div>

                    <div>
                        <div class="text-muted">Giá/m²</div>
                        <div class="fw-bold fs-6 text-danger"> <?= getPriceM2($bdsInfo['price_total'], $bdsInfo['acreage']) ?></div>

                    </div>

                    <?php if ($bdsInfo['facades'] > 0) { ?>
                        <div>
                            <div class="text-muted">Mặt tiền</div>
                            <div class="fw-bold fs-6 text-danger"><?php echo $bdsInfo['facades']; ?>m</div>
                        </div>
                    <?php } ?>
                </div>
                <div class="mt-sm-2 d-none d-md-block">
                    <div class="d-flex" style="gap:15px">
                        <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);">
                            <a href="tel:<?php echo $bdsInfo['phonenumber'] ?>"><i class="fa-solid fa-phone-volume"></i> <?php echo $bdsInfo['phonenumber'] ?></a>
                        </button>

                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-share-nodes"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="copy_url()"><i class="fa-solid fa-link"></i> Copy url</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="share_fb()"><i class="fa-brands fa-facebook"></i> Share FB</a></li>
                            </ul>
                        </div>

                        <button data-id="<?php echo $bdsInfo['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bdsInfo['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>
                    </div>

                </div>
            </div>

            <!-- Thông tin mô tả -->
            <div class="mt-3">
                <div class="fw-semibold fs-5">Thông tin mô tả</div>
                <div class="mt-3">
                    <?php echo $bdsInfo['content']; ?>

                </div>
                <div class="mt-3 d-flex" style="gap:15px">
                    <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);">
                        <a href="tel:<?php echo $bdsInfo['phonenumber'] ?>"><i class="fa-solid fa-phone-volume"></i> <?php echo $bdsInfo['phonenumber'] ?></a>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="copy_url()"><i class="fa-solid fa-link"></i> Copy url</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="share_fb()"><i class="fa-brands fa-facebook"></i> Share FB</a></li>
                        </ul>
                    </div>
                    <button data-id="<?php echo $bdsInfo['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bdsInfo['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>
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
                        <a href="<?= LINK_NHA_DAT_BAN ?>?tag=<?= $tag['id_tag'] ?>">
                            <div class="badge rounded-pill text-bg-secondary p-2 mb-2"><?php echo $tag['name'] ?></div>
                        </a>

                    <?php } ?>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center border-bottom border-top py-2 mt-5">
                <div class="d-flex align-items-center" style="gap:50px">
                    <div>
                        <div class="text-muted">Ngày đăng</div>
                        <div class="fw-semibold"><?php echo date("d/m/Y", strtotime($bdsInfo['create_time_set'])); ?></div>
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
                <div class="fw-bold fs-5">Bất động sản cùng khu vực</div>

                <div id="owl-noi-bat" class="owl-carousel owl-theme mt-3">

                    <?php foreach ($bds_palace_area as $id_bds => $bds) { ?>
                        <div class="rounded border border-1 mb-3 shadow ">
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                <div class="position-relative">
                                    <img src="<?= $bds['image_path'] ?>" class="rounded-top img-fluid" alt="<?= basename($bds['image_path']) ?>" style="aspect-ratio: 2/1; object-fit: cover;">
                                </div>
                            </a>
                            <div class="p-2">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                    <div class="fw-semibold text-truncate text-wrap hover-link-red" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.5rem;"><?= $bds['title'] ?></div>
                                </a>
                                <div class="d-flex justify-content-between">
                                    <div class="text-danger  fw-bold"><?= $bds['acreage'] ?> m²</div>
                                    <div class="mb-1">·</div>
                                    <div class="text-danger fw-bold">
                                        <?= getPriceM2($bds['price_total'], $bds['acreage']) ?>
                                    </div>
                                    <div class="mb-1">·</div>
                                    <div class="text-danger fw-bold">
                                        <?= getPrice($bds['price_total']) ?>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-secondary">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <?php echo $bds['commune']; ?>
                                    </div>

                                    <?php if ($bds['direction'] > 0) { ?>
                                        <div class="text-secondary">
                                            Hướng: <?= $cf_bds['direction'][$bds['direction']] ?>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-secondary" style="font-size: 0.8rem;">Đăng <?php echo timeSince($bds['create_time']) ?> trước</span>
                                    <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bds['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#owl-noi-bat").owlCarousel({
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            margin: 10,
                            responsiveClass: true,
                            nav: false,
                            dots: true,
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

        </div>
        <div class="col-lg-4">
            <div class="" style="z-index: auto; top:70px">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="<?= $bdsInfo['avatar'] != '' ? url_image($bdsInfo['avatar'], FOLDER_AVATAR) : 'images/avatar-default.png' ?> " class="rounded-circle w-25" alt="<?php echo $bdsInfo['fullname']; ?>" style=" aspect-ratio: 1; object-fit: cover;">
                        <div class="text-muted mt-2" style="font-size: 0.875rem;">Được đăng bởi</div>
                        <div class="fw-semibold fs-5 text-truncate"><?php echo $bdsInfo['fullname']; ?></div>
                        <a href="<?= LINK_NHA_DAT_BAN . '?moi-gioi=' . urlencode($bdsInfo['id_user']) ?>">
                            <div class="">Xem thêm <?= $get_num_bds_by_user ?> tin khác</div>
                        </a>

                        <button class="btn text-light mt-2 w-100" style="background-color: rgb(7 152 83);">
                            <a href="tel:<?php echo $bdsInfo['phonenumber'] ?>"><i class="fa-solid fa-phone-volume"></i> <?php echo $bdsInfo['phonenumber'] ?></a>
                        </button>

                        <a href="mailto:<?= $bdsInfo['email'] ?>" class="mt-2 w-100">
                            <button class="btn btn-outline-secondary w-100">Gửi email</button>
                        </a>

                        <button class="btn btn-outline-secondary mt-2 w-100" data-bs-toggle="modal" data-bs-target="#modal_yclhl">Yêu cầu liên hệ lại</button>
                    </div>
                </div>

                <!-- Đặc điểm bất động sản -->
                <div class="card mt-3" style="background-color: #f7f7f7; color: #585858">
                    <div class="card-body">
                        <div class="fw-semibold fs-5">Đặc điểm bất động sản</div>
                        <div class="row mt-3">
                            <div class="col-12">
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
                                <div class="border-top d-flex py-2">
                                    <div class="fw-semibold w-50">Số tầng</div>
                                    <div><?php echo isset($cf_floor[$bdsInfo['floor']]) ? $cf_floor[$bdsInfo['floor']] : "" ?> tầng</div>
                                </div>
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
                                    <div><?php // echo isset($cf_direction[$bdsInfo['direction']]) ? $cf_direction[$bdsInfo['direction']] : ""  
                                            ?></div>
                                </div>
                                <div class="border-top d-flex py-2">
                                    <div class="fw-semibold w-50">Pháp lý</div>
                                    <div><?php echo isset($cf_juridical[$bdsInfo['juridical']]) ? $cf_juridical[$bdsInfo['juridical']] : "" ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3" style="background-color: #f7f7f7;">
                    <div class="card-body">
                        <p class="fw-semibold" style="font-size: 1.125rem;">Bất động sản nổi bật</p>
                        <div class="d-flex flex-column">
                            <?php foreach ($commune_ward_and_num_bds as $id_commune => $item) { ?>
                                <?php if ($item['num_bds']) { ?>
                                    <a class="text-decoration-none text-dark py-1 hover-link-red" href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward[]=' . $id_commune ?>"><?= $item['name'] ?> (<?= $item['num_bds'] ?>)</a>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal yêu cầu liên hệ lại -->
<div class="modal fade" id="modal_yclhl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yêu cầu liên hệ lại</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="w-100 mt-3">
                    <input type="text" class="form-control w-100 fullname" placeholder="Họ và tên">
                    <div class="hstack gap-3 mt-2">
                        <input type="text" class="form-control phone" placeholder="Số điện thoại">
                        <input type="text" class="form-control email" placeholder="Email">
                        <input type="hidden" class="form-control id_bds" value="<?= $bdsInfo['id_bds'] ?>">
                    </div>
                    <textarea name="" id="" cols="30" rows="5" class="form-control mt-2 content" placeholder="Nội dung cần tư vấn"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex" style="justify-content: space-between;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-danger" onclick="ajax_yclhl(this)" style="width: 120px;">Gửi yêu cầu</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal yêu cầu liên hệ lại -->

<script>
    set_bds_watched();
    get_bds_watched();


    function set_bds_watched() {
        const bds_watched = localStorage.getItem("BDS_WATCHED");
        if (bds_watched == null) {
            // neu localStorage BDS_WATCHED == null thì set binh thuong
            let bds = {};
            bds[<?php echo $bdsInfo['id_bds'] ?>] = {
                'title': '<?php echo $bdsInfo['title'] ?>',
                'image_path': '<?php echo !empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                'title': '<?php echo $bdsInfo['title'] ?>',
                'price_view': '<?php echo $bdsInfo['price_view'] ?>',
                'price_unit': '<?php echo $bdsInfo['price_unit'] ?>',
                'price_total': '<?php echo $bdsInfo['price_total']; ?>',
                'acreage': '<?php echo $bdsInfo['acreage']; ?> m²',
                'commune': '<?php echo $bdsInfo['commune_name']; ?>',
                'direction': '<?php echo $bdsInfo['direction_name']; ?>',
                'create_time': 'Đăng <?php echo timeSince($bds['create_time_set']) ?> trước',
                'slug_title': '<?php echo $bdsInfo['slug_title']; ?>',
                'is_vip': '<?php echo $bdsInfo['is_vip']; ?>'
            }
            localStorage.setItem("BDS_WATCHED", JSON.stringify(bds));
        } else {
            // neu localStorage BDS_WATCHED != null
            const id_bds_watched = <?php echo $bdsInfo['id_bds'] ?>;
            let obj_bds_watched = JSON.parse(bds_watched);
            if (obj_bds_watched.hasOwnProperty(id_bds_watched)) {
                //neu bds dang xem ton tai trong object BDS_WATCHED
                // thi xoa key bds trong object BDS_WATCHED đi
                //và lay bds dang xem lên đầu object BDS_WATCHED

                delete obj_bds_watched[id_bds_watched];
                let bds = {
                    'image_path': '<?php echo !empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                    'title': '<?php echo $bdsInfo['title'] ?>',
                    'price_view': '<?php echo $bdsInfo['price_view'] ?>',
                    'price_unit': '<?php echo $bdsInfo['price_unit'] ?>',
                    'price_total': '<?php echo $bdsInfo['price_total']; ?>',
                    'acreage': '<?php echo $bdsInfo['acreage']; ?> m²',
                    'commune': '<?php echo $bdsInfo['commune_name']; ?>',
                    'direction': '<?php echo $bdsInfo['direction_name']; ?>',
                    'create_time': 'Đăng <?php echo timeSince($bds['create_time_set']) ?> trước',
                    'slug_title': '<?php echo $bdsInfo['slug_title']; ?>',
                    'is_vip': '<?php echo $bdsInfo['is_vip']; ?>'
                }

                obj_bds_watched = {
                    [<?php echo $bdsInfo['id_bds'] ?>]: bds,
                    ...obj_bds_watched
                };

            } else {

                //neu bds dang xem khong ton tai trong object BDS_WATCHED
                // thi them bds vào vị trí đâu tien cua object BDS_WATCHED

                let bds = {
                    'image_path': '<?php echo !empty($imgs) ? get_path_image($bdsInfo['create_time'], $imgs[1]) : "" ?>',
                    'title': '<?php echo $bdsInfo['title'] ?>',
                    'price_view': '<?php echo $bdsInfo['price_view'] ?>',
                    'price_unit': '<?php echo $bdsInfo['price_unit'] ?>',
                    'price_total': '<?php echo $bdsInfo['price_total']; ?>',
                    'acreage': '<?php echo $bdsInfo['acreage']; ?> m²',
                    'commune': '<?php echo $bdsInfo['commune_name']; ?>',
                    'direction': '<?php echo $bdsInfo['direction_name']; ?>',
                    'create_time': 'Đăng <?php echo timeSince($bds['create_time_set']) ?> trước',
                    'slug_title': '<?php echo $bdsInfo['slug_title']; ?>',
                    'is_vip': '<?php echo $bdsInfo['is_vip']; ?>',
                }
                obj_bds_watched = {
                    [id_bds_watched]: bds,
                    ...obj_bds_watched
                };
            }

            //chỉ lây 10 bds trong object BDS_WATCHED
            obj_bds_watched = limitObjectSize(obj_bds_watched, 10);

            localStorage.setItem("BDS_WATCHED", JSON.stringify(obj_bds_watched));
        }

    }

    function get_bds_watched() {

        $("#owl-bds-da-xem").html();
        const PRICE_ONE_MILLION = <?php echo PRICE_ONE_MILLION; ?>;
        const bds_watched = localStorage.getItem("BDS_WATCHED");
        const obj_bds_watched = JSON.parse(bds_watched);
        const hearts = '<?php echo json_encode($hearts) ?>';
        for (const [id, val] of Object.entries(obj_bds_watched)) {
            let temp =
                `
                    <div class="rounded border border-1 mb-3 shadow ">
                        <a href="${val.slug_title}-p${id}">
                            <div class="position-relative ${val.is_vip ? 'ribbon-vip' : ''}">
                                <img src="${val.image_path}" class="rounded-top img-fluid ratio" alt="${val.title}" style="aspect-ratio: 2/1; object-fit: cover;">
                            </div>
                        </a>
                        <div class="p-2">
                            <a href="${val.slug_title}-p${id}">        
                                <div class="fw-semibold text-truncate text-wrap hover-link-red" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.5rem;">${val.title}</div>
                            </a>
                            <div class="d-flex justify-content-between">
                                <div class="text-danger  fw-bold">${val.acreage}</div>
                                <div class="mb-1">·</div>
                                <div class="text-danger fw-bold">
                                    ${ (parseInt(val.price_total) / parseInt(val.acreage) / parseInt(PRICE_ONE_MILLION)).toFixed(2)} tr/m²
                                </div>
                                <div class="mb-1">·</div>
                                <div class="text-danger fw-bold">
                                    ${val.price_view}
                                    ${val.price_unit == '1' ? 'triệu' : 'tỷ' }
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-secondary">
                                    <i class="fa-solid fa-location-dot"></i>
                                    ${val.commune}
                                </div>

                                ${
                                    (val.direction != "") ?
                                    `
                                        <div class="text-secondary">
                                            Hướng: ${val.direction}
                                        </div>
                                    ` : ``
                                }
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary" style="font-size: 0.8rem;">${val.create_time}</span>
                                <button data-id="${id}" class="btn btn-heart btn-sm ${ (hearts.hasOwnProperty(id)) ? 'btn-danger' : 'btn-outline-danger' } "><i class="fa-regular fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
         
            `;
            $("#owl-bds-da-xem").append(temp);
        }

        $("#owl-bds-da-xem").owlCarousel({
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            margin: 10,
            responsiveClass: true,
            nav: false,
            dots: true,
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

    // tang luot xem
    setTimeout(() => {
        $.ajax({
            url: "<?= site_url('bds/ajax_tang_luot_xem_bds/' . $bdsInfo['id_bds']) ?>",
            success: function(res) {}
        });
    }, 10000);

    function copy_url() {
        var dummy = document.createElement('input');
        document.body.appendChild(dummy);
        dummy.value = window.location.href;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);

        $.toast({
            text: 'Đã copy link',
            position: 'top-right',
        })
    }

    function share_fb() {
        let url = window.location.href;
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, '', 'height=500,width=300');
    }

    function ajax_yclhl(btn) {
        let form = $('#modal_yclhl');
        let fullname = form.find('.fullname').val();
        let phone = form.find('.phone').val();
        let email = form.find('.email').val();
        let content = form.find('.content').val();
        let id_bds = form.find('.id_bds').val();
        let type = <?= REQUEST_CONTACT ?>; // yêu cầu liên hệ lại

        if (fullname == '' || phone == '' || email == '' || content == '') {
            $.toast({
                heading: 'Thông báo lỗi',
                text: 'Các trường thông tin không được bỏ trống',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',
                hideAfter: 15000
            })
            return;
        }

        //show loading
        $(btn).html(`<div class="spinner-border spinner-border-sm text-light"><span class="visually-hidden">Loading...</span></div>`);
        $(btn).attr('disabled', true)
        //ajax
        $.ajax({
            url: '<?= LINK_DANG_KY_NHAN_THONG_TIN ?>',
            type: 'POST',
            data: {
                fullname,
                phone,
                email,
                content,
                id_bds,
                type
            },
            success: function(res) {
                try {
                    let kq = JSON.parse(res);
                    if (kq.status) {
                        $.toast({
                            heading: 'Thành công',
                            text: 'Yêu cầu của bạn đã được gửi đến người đăng tin. Chúng tôi sẽ sớm liên hệ lại với bạn. Xin cảm ơn!',
                            showHideTransition: 'fade',
                            icon: 'success',
                            position: 'top-right',
                            hideAfter: 15000
                        })

                        // close modal
                        var myModalEl = document.getElementById('modal_yclhl');
                        var modal = bootstrap.Modal.getInstance(myModalEl)
                        modal.hide();
                    } else {
                        $.toast({
                            heading: 'Thông báo lỗi',
                            text: kq.error,
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right',
                            hideAfter: 15000
                        })
                    }
                } catch (error) {

                }
                $(btn).html(`Gửi yêu cầu`);
                $(btn).attr('disabled', false)
            },
            error: function(data) {

            }
        });
    }
</script>