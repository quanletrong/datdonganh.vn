<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- jquery-validation -->
<script src="js/<?= VERSION ?>jquery-validation/jquery.validate.min.js"></script>
<script src="js/<?= VERSION ?>jquery-validation/additional-methods.js"></script>
<script src="js/<?= VERSION ?>jquery-validation/localization/messages_vi.min.js"></script>
<style>
    .account__header {
        box-shadow: inset 0px -2px 0px #0a9853;
        -webkit-box-shadow: inset 0px -2px 0px #0a9853;
        -moz-box-shadow: inset 0px -2px 0px #0a9853;
        display: flex;
        justify-content: center;
    }

    .account__header>.active {
        background: #0a9853;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        -webkit-border-top-left-radius: 6px;
        -webkit-border-top-right-radius: 6px;
        -webkit-border-bottom-right-radius: 0px;
        -webkit-border-bottom-left-radius: 0px;
        -moz-border-radius-topleft: 6px;
        -moz-border-radius-topright: 6px;
        -moz-border-radius-bottomright: 0px;
        -moz-border-radius-bottomleft: 0px;
    }

    .account__header>button {
        box-shadow: inset 0px -2px 0px #0a9853;
        -webkit-box-shadow: inset 0px -2px 0px #0a9853;
        -moz-box-shadow: inset 0px -2px 0px #0a9853;
        background: #fff;
        padding: 8px 15px;
        border: none;
    }

    .account__header>.active>span {
        color: #FFF;
        font-weight: 700;
    }

    .account__header>button>span {
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 28px;
        color: #999999;
    }

    .account__detail {
        background: #FFF;
        padding: 40px 22% 54px 22%;
    }

    .account__detail--avatar {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .account__detail--avatar>.img-avatar {
        width: 100px;
        height: 100px;
    }

    .account__detail--avatar>.img-avatar>label {
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .account__detail--avatar>.img-avatar>label>img {
        width: 100%;
        height: 100%;
        border-radius: 68px;
        -webkit-border-radius: 68px;
        -moz-border-radius: 68px;
    }

    .account__detail--title>label {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 28px;
        color: #1a1a1a;
    }

    .account__detail--title>label>span {
        color: #FF574E;
    }

    .account__detail--title>input {
        width: 100%;
        height: 40px;
        padding: 10px;
        background: #FFF;
        margin-top: 4px;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border: 1px solid #CCCCCC;
        box-sizing: border-box;
        transform: default;
        box-shadow: default;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 20px;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-secondary">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trang cá nhân</li>
        </ol>
    </nav>
    <h1 class="mt-5 fs-4 fw-semibold ">Trang cá nhân</h1>
</div>

<div class="container">
    <div class="account__header mt-3">
        <button type="button" class="<?= $tab == 'favoritebds' ? 'active' : '' ?>" data-account-head="favoritebds"><span>Tin đã lưu</span></button>
        <button type="button" class="<?= $tab == 'accountDetail' ? 'active' : '' ?>" data-account-head="accountDetail"><span>Thông tin tài khoản</span></button>
        <button type="button" class="<?= $tab == 'accountPassword' ? 'active' : '' ?>" data-account-head="accountPassword"><span>Đổi mật khẩu</span></button>
    </div>

    <div class="account__detail <?= $tab == 'favoritebds' ? '' : 'd-none' ?>" id="favoritebds">
        <div class="row">
            <div class="col-12">
                <?php foreach ($list_bds as $id_bds => $bds) { ?>
                    <div class="card mt-3">
                        <div class="card-body p-0">
                            <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                <div style="width: 100%;display: flex; position: relative;">
                                    <div style="width: calc(4/6*100%)">
                                        <img src="<?= $bds['list_img'][0] ?>" class="w-100 ratio ratio-16x9 object-fit-cover" alt="" style="aspect-ratio: 2/1;object-fit: cover;padding-right: 3px;border-top-left-radius: 0.375rem;">
                                    </div>
                                    <div style="width: calc(2/6*100%)">
                                        <div style="width: 100%;display: flex;flex-wrap: wrap;">
                                            <div style="width: calc(6/6*100%)">
                                                <img src="<?= $bds['list_img'][1] ?>" class="w-100 ratio ratio-16x9 object-fit-cover" alt="" style="aspect-ratio: 2/1;object-fit: cover;padding-bottom: 3px;border-top-right-radius: 0.375rem;">
                                            </div>
                                            <div style="width: calc(3/6*100%)">
                                                <img src="<?= $bds['list_img'][2] ?>" class="w-100 ratio ratio-1x1 object-fit-cover" alt="" style="aspect-ratio: 1;object-fit: cover;padding-right: 3px;">
                                            </div>
                                            <div style="width: calc(3/6*100%)">
                                                <img src="<?= $bds['list_img'][3] ?>" class="w-100 ratio ratio-1x1 object-fit-cover" alt="" style="aspect-ratio: 1;object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-absolute bg-danger text-white px-3 fs-5 rounded-end <?= $bds['is_vip'] ? '' : 'd-none' ?>" style="left: 0; top: 1rem">Tin VIP</div>
                                </div>
                            </a>

                            <div class="mx-3 my-1">
                                <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                    <span class="fw-bold text-uppercase">
                                        <?= $bds['title'] ?>
                                    </span>
                                </a>

                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="<?= $bds['slug_title'] . '-p' . $id_bds ?>">
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <div class="text-danger fw-bold">
                                                <?= $bds['price_view'] ?>
                                                <?= $bds['price_unit'] === '1' ? 'trăm triệu' : 'tỷ' ?>
                                            </div>
                                            <div class="mb-1">.</div>
                                            <div class="text-danger fw-bold"><?= $bds['acreage'] ?> m²</div>
                                            <div class="mb-1">.</div>
                                            <div class="text-danger fw-bold">
                                                <?= $bds['price_total'] / $bds['acreage'] / PRICE_ONE_MILLION ?> tr/m²
                                            </div>
                                        </div>
                                    </a>

                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <?php if ($bds['direction'] > 0) { ?>
                                            <div class="text-secondary">
                                                Hướng: <a href="<?= LINK_NHA_DAT_BAN . '?direction=' . $bds['direction'] ?>"><?= $cf_bds['direction'][$bds['direction']] ?></a>
                                            </div>
                                            <div class="mb-1">.</div>
                                        <?php } ?>

                                        <div class="text-secondary">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <a href="<?= LINK_NHA_DAT_BAN . '?id_commune_ward=' . $bds['id_commune_ward'] ?>"><?= $bds['commune'] ?></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center" style="gap:10px">
                                    <div class="text-danger" style="height: 30px;width: 30px;background-color: #bbb;border-radius: 50%;display: inline-block; text-align: center; font-weight: bold; line-height: 2.0;">
                                        <?= $bds['contactname'][0] ?? null ?>

                                    </div>
                                    <div>
                                        <div class="fw-semibold" style="font-size: 0.9rem;"><?= $bds['contactname'] ?></div>
                                        <div class="text-muted" style="font-size: 0.8rem;">Đăng <?php echo timeSince($bds['create_time']) ?> trước</div>
                                    </div>
                                </div>
                                <div>
                                    <a href="tel:<?= $bds['contactphone'] ?>">
                                        <button class="btn btn-sm text-light" style="background-color: rgb(7 152 83);"><i class="fa-solid fa-phone-volume"></i> <?= $bds['contactphone'] ?></button>
                                    </a>
                                    <button data-id="<?php echo $bds['id_bds']; ?>" class="btn btn-heart btn-sm <?php echo in_array($bds['id_bds'], $hearts) ? 'btn-danger' : 'btn-outline-danger' ?>"><i class="fa-regular fa-heart"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="account__detail <?= $tab == 'accountDetail' ? '' : 'd-none' ?>" id="accountDetail">

        <form action="<?php echo site_url('ajax-edit-uinfo') ?>" method="POST" id="form_edit_uinfo">
            <div class="account__detail--avatar">
                <div class="img-avatar">
                    <input type="file" id="accountAvatar" class="d-none" onchange="change_account_avatar();">
                    <label for="accountAvatar"><img src="images/avatar-default.png" id="imgAccountAvatar"></label>
                </div>
            </div>
            <div class="account__detail--title">
                <label><span>*</span> Họ và tên</label>
                <input type="text" name="fullname" id="fullname" value="<?= $uinfo['fullname'] ?>" required>
            </div>
            <div class="account__detail--title mt-3">
                <label><span>*</span> Email</label>
                <input type="email" name="email" value="<?= $uinfo['email'] ?>" id="inp_email" required>
            </div>
            <div class="account__detail--title mt-3">
                <label><span>*</span> Số điện thoại</label>
                <input type="tel" name="phonenumber" value="<?= $uinfo['phonenumber'] ?>" id="inp_phone_number" required>
            </div>
            <div class="btn-title-head d-flex flex-row justify-content-center mt-3">
                <button type="submit" class="btn btn-danger">Lưu thay đổi</button>
            </div>
        </form>
    </div>

    <div class="account__detail <?= $tab == 'accountPassword' ? '' : 'd-none' ?>" id="accountPassword">

    </div>
</div>

<script>
    $(function() {

        $('.account__header > button').click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            $('.account__header').siblings().addClass('d-none');
            $('#' + $(this).data('account-head')).removeClass('d-none');
        });

        $('#form_edit_uinfo').validate({
            submitHandler: function(form) {

                // ẩn nút submit
                // show loading
                $(form).find('button[type="submit"]').attr('disabled', true);
                $(form).find('button[type="submit"]').html(`Lưu thay đổi <div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>`);

                $.ajax({
                        type: $(form).attr('method'),
                        url: $(form).attr('action'),
                        data: $(form).serialize(),
                        dataType: 'json'
                    })
                    .done(function(response) {
                        if (response.success == true) {
                            toasts_success();
                        } else {
                            toasts_danger();
                        }
                        $(form).find('button[type="submit"]').attr('disabled', false);
                        $(form).find('button[type="submit"]').html(`Lưu thay đổi`);
                    });
                return false;
            },
            ignore: [],
            rules: {},
            messages: {},
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.parent().append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    })
</script>