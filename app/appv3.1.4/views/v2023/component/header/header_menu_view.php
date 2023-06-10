<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<nav class="navbar sticky-top navbar-expand-lg bg-light" style="box-shadow: 1px 1px 3px 0px #c1c1c1; padding: 0;">
    <div class="container-fluid">
        <a class="navbar-brand p-0" href="#">
            <!-- <img src="https://placehold.co/160x48/f44336/31343C?text=LOGO" alt="" class="img-fluid"> -->
            <!-- <img src="images/logo.png" alt="" class="img-fluid"> -->
            <img src="images/logo-ngang.png" alt="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LINK_NHA_DAT_BAN ?>">BĐS Đông Anh</a>
                    <div></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LINK_DAU_GIA ?>">Lịch Đấu Giá Đất</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LINK_TIN_TUC ?>">Tin Tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LINK_TAI_LIEU ?>">Tài Liệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LINK_LIEN_HE ?>">Liên Hệ</a>
                </li>
            </ul>
            
            <style>
                .login-avatar img{
                    width: 32px;
                    height: 32px;
                    border-radius: 32px;
                    background: #FFECEB;
                    text-align: center;
                }
                .login-icon {
                    cursor: pointer;
                    box-sizing: border-box;
                }
                ul.re__dropdown-art {
                    border-radius: 8px;
                    padding-top: 8px;
                    padding-bottom: 8px;
                    box-shadow: 0px 8px 20px rgba(182,182,182,0.3);
                    background: #fff;
                    list-style: none;
                    top: 30px;
                    left: -25px;
                    width: 195px;
                    display: none;
                }
                ul.re__dropdown-art li:not(.re__border-b){
                    padding: 6px 0 6px 15px;
                }
                ul.re__dropdown-art li.re__border-b{
                    border-bottom: 1px solid #ccc;
                }
                ul.navbar-nav li.it-user:hover ul.re__dropdown-art{
                    display: block;
                }
                .count-num{
                    color: rgb(255, 255, 255);
                    background: rgb(218, 16, 48);
                    width: 18px;
                    height: 18px;
                    border-radius: 6px;
                    text-align: center;
                    line-height: 18px;
                }
            </style>
            <ul class="navbar-nav me-right mb-2 mb-lg-0 align-items-center">
                <?php if($isLogin){ ?>
                    <?php if($edit_link !='') { ?>
                        <li class="nav-item ">
                            <a class="nav-link text-danger" href="<?=$edit_link ?>" target="_blank"><i class="fa-solid fa-pen-to-square"></i> Sửa bài</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item position-relative it-user">
                        <div class="box-info d-flex justify-content-between align-items-center">
                            <div class="login-avatar me-3">
                                <?php if($avatar != ""){ ?>
                                <img class="w-100" src="<?php echo $avatar; ?>" />
                                <?php }else{ ?>
                                <i class="fa-solid fa-circle-user" style="font-size:30px"></i>
                                <?php } ?>
                            </div>
                            <div class="login-info me-3">
                                <a href="/trang-ca-nhan" rel="nofollow"><?php echo $fullname != "" ? $fullname : $username; ?></a>
                            </div>
                            <div class="login-icon me-3">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        
                        <ul class="re__dropdown-art position-absolute ps-0">
                            <li>
                                <a href="/trang-ca-nhan" class="re__content d-flex align-items-center">
                                    <i class="fa-solid fa-heart me-1"></i> Tin đã lưu 
                                    <div class="count-num ms-2" id="count-favorite">
                                        <?php echo $count_favorite; ?>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="/trang-ca-nhan/uspg-changeinfo" class="re__content">
                                    <i class="fa-solid fa-user"></i> Thông tin cá nhân
                                </a>
                            </li>
                            <li>
                                <a href="/trang-ca-nhan/uspg-changepass" class="re__content ">
                                    <i class="fa-solid fa-lock"></i> Thay đổi mật khẩu
                                </a>
                            </li>
                            <li class="re__border-b pt-1"></li>
                            <li>
                                <a href="<?php echo site_url(LINK_USER_LOGOUT) ?>" class="re__content" rel="nofollow">
                                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= LINK_USER_LOGIN ?>">Đăng nhập</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= LINK_USER_REGISTER ?>">Đăng ký</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>