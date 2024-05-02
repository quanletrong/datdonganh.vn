<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <!-- bootstrap 5.3.3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        .input-group-ct {
            display: block;
            background-color: #fff;
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .line-or-ct {
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            position: relative;
            width: 100%;
            height: 30px;
        }

        .line-ct {
            width: 100%;
            height: 1px;
            background-color: rgb(242, 242, 242);
        }

        .or-ct {
            position: absolute;
            top: 0px;
            left: calc(50% - 24px);
            height: 24px;
            width: 49px;
            padding: 4px 8px;
            background-color: rgb(255, 255, 255);
        }

        .or-ct div {
            font-size: 13px;
            line-height: 20px;
            font-weight: 400;
            color: rgb(153, 153, 153);
        }

        .btn-or-ct {
            display: inline-block;
            border-radius: 8px;
            cursor: pointer;
            white-space: nowrap;
            width: fit-content;
            padding: 14px 0;
            width: 180px;
            opacity: 1;
        }
    </style>
</head>

<body style="background-color: #eeeeee;">
    <div class="container" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);">
        <div class="card shadow mx-auto" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <form action="<?php echo site_url('login/auth?url=' . $currUrl) ?>" method="post">
                    <h4 class="text-center text-danger">Đăng nhập datdonganh.vn</h4>
                    <?php if ($login_fail != '') { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $login_fail ?>
                        </div>
                    <?php } ?>

                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-ct"><i class="fa-solid fa-user"></i></div>
                        </div>
                        <input type="text" class="form-control " name="username" placeholder="Nhập tên đăng nhập">
                    </div>



                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-ct"><i class="fa-solid fa-lock"></i></div>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                    </div>
                    <input type="submit" class="btn btn-danger w-100" value="Đăng nhập">

                    <div class="line-or-ct mt-2">
                        <div class="line-ct"></div>
                        <div class="or-ct">
                            <div type="tertiary" class="sc-crrsfI fmnTOX">Hoặc</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around mt-1 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-or-ct"><i class="fa-brands fa-facebook"></i> Facebook</button>
                        <a href="<?php echo $loginUrlgg; ?>">
                            <button type="button" class="btn btn-outline-danger btn-or-ct"><i class="fa-brands fa-google"></i> Google</button>
                        </a>
                    </div>

                    <div class="p-3 ps-4 d-flex justify-content-between">
                        <small>
                            <a href="<?= site_url() ?>" style="text-decoration: none;">
                                ← Trang chủ
                            </a>
                        </small>
                        <small><a href="quen-mat-khau" style="text-decoration: none;">Bạn quên mật khẩu?</a></small>
                        <small>
                            <a href="<?= site_url('dang-ky') ?>" style="text-decoration: none;">
                                Đăng ký →
                            </a>
                        </small>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>