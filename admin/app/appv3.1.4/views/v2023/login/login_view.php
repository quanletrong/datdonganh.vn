<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <!-- bootstrap 5.3.3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- js jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- js bootstrap 5.3.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- js tinyMCE -->
    <!-- <script src="js/v2023/tinymce/tinymce.min.js"></script> -->
    <!-- <script src="js/v2023/tinymce_4.2.7/tinymce.min.js"></script> -->
    <script src="js/v2023/tinymce-5-8-2/tinymce.min.js"></script>

    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body style="background-color: #eeeeee;">
    <div class="container h-50 d-flex justify-content-center">
        <div class="card shadow my-auto" style="width: 100%; max-width: 1000px;">
            <div class="card-body">
                <form class="d-none" action="<?php echo site_url('login/auth?url=' . $currUrl) ?>" method="post">
                    <h4 class="text-center text-danger">Đăng nhập hệ thống</h4>
                    <?php if ($login_fail != '') { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $login_fail ?>
                        </div>
                    <?php } ?>

                    <input type="text" class="form-control mb-3" name="username" placeholder="Nhập tên đăng nhập">
                    <input type="password" class="form-control mb-3" name="password" placeholder="Nhập mật khẩu">
                    <input type="submit" class="btn btn-danger" value="Đăng nhập">
                </form>

                <h1><?= ROOT_DOMAIN ?></h1>
                <form method="post">
                    <textarea id="mytextarea">Hello, World!</textarea>
                </form>

                <script>
                    // tinymce.init({
                    //     selector: "#mytextarea",
                    //     plugins: [
                    //         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    //         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    //         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                    //     ],
                    //     toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    //     toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                    //     image_advtab: true,

                    //     external_filemanager_path: "<?= ROOT_DOMAIN ?>filemanager/filemanager/",
                    //     filemanager_title: "Responsive Filemanager",
                    //     external_plugins: {
                    //         "filemanager": "<?= ROOT_DOMAIN ?>filemanager/filemanager/plugin.min.js"
                    //     }
                    // });
                    tinymce.init({
                        selector: '#mytextarea',
                        plugins: [
                            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                            'table', 'emoticons', 'template', 'help', 'link', 'responsivefilemanager'
                        ],
                        toolbar: 'responsivefilemanager | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                            'forecolor backcolor emoticons | help',
                        menubar: 'favs file edit view insert format tools table help',
                        external_filemanager_path: "<?= ROOT_DOMAIN ?>filemanager/filemanager/",
                        filemanager_title: "Thư viện ảnh",
                        external_plugins: {
                            // "responsivefilemanager": "<?= ROOT_DOMAIN ?>filemanager/filemanager/plugin.min.js",
                            "filemanager": "<?= ROOT_DOMAIN ?>filemanager/filemanager/plugin.min.js"
                        },

                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>