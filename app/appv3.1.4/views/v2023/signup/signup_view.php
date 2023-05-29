<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    
</head>
<style>
    .line-or-ct{
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
            font-family: Roboto;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            color: rgb(153, 153, 153);
        }
        .btn-or-ct{
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
<body style="background-color: #eeeeee;">
    <div class="container h-50 d-flex justify-content-center">
        <div class="card shadow my-auto" style="width: 100%; max-width: 500px;">
            <div class="card-body ">
                <form>
                    <h4 class="text-center text-danger">Tạo tài khoản</h4>
                    

                    <div class="form-outline mb-4">
                        <input type="email" id="form3Example3cg" class="form-control form-control-lg">
                        <label class="form-label" for="form3Example3cg" style="margin-left: 0px;">Email</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 40px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <input type="email" id="form3Example3cg" class="form-control form-control-lg">
                        <label class="form-label" for="form3Example3cg" style="margin-left: 0px;">Số điện thoại</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 85px;"></div><div class="form-notch-trailing"></div></div></div>

                    
                    <div class="form-outline mb-4 mt-3">
                        <input type="text" id="form3Example1cg" class="form-control form-control-lg">
                        <label class="form-label" for="form3Example1cg" style="margin-left: 0px;">Username</label>
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 71.2px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                    </div>
                    
                    
                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example4cg" class="form-control form-control-lg">
                        <label class="form-label" for="form3Example4cg" style="margin-left: 0px;">Password</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg">
                        <label class="form-label" for="form3Example4cdg" style="margin-left: 0px;">Nhập lại password</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 112px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg">
                      <label class="form-check-label" for="form2Example3g">
                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                      </label>
                    </div>

                    <div class="d-flex justify-content-center">
                      <input type="submit" class="btn btn-danger w-100" value="Đăng ký">
                    </div>

                     <div class="line-or-ct mt-2">
                        <div class="line-ct"></div>
                        <div class="or-ct">
                            <div type="tertiary" class="sc-crrsfI fmnTOX">Hoặc</div>  
                        </div>  
                    </div>
                    
                    <div class="d-flex justify-content-around mt-1 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-or-ct"><i class="fa-brands fa-facebook"></i> Facebook</button> 
                        <a href="">
                            <button type="button" class="btn btn-outline-danger btn-or-ct"><i class="fa-brands fa-google"></i> Google</button> 
                        </a>
                    </div>  

                  </form>
            </div>
        </div>
    </div>
</body>

</html>