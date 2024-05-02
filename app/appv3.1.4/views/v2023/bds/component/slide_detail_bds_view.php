<script src="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.umd.min.js" integrity="sha512-VNk0UJk87TUyZyWXUFuTk6rUADFyTsVpVGaaFQQIgbEXAMAdGpYaFWmguyQzEQ2cAjCEJxR2C++nSm0r2kOsyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/5.0.36/fancybox/fancybox.min.css" integrity="sha512-s4DOVHc73MjMnsueMjvJSnYucSU3E7WF0UVGRQFd/QDzeAx0D0BNuAX9fbZSLkrYW7V2Ly0/BKHSER04bCJgtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    #slide-image * {
        box-sizing: border-box
    }

    #slide-image {
        font-family: Verdana, sans-serif;
        margin: 0
    }

    #slide-image .mySlides {
        cursor: pointer;
        display: none;
        background-size: contain;
        width: 100%;
        height: 600px;
        background-repeat: no-repeat;
        background-position: 50% 50%;
        background-color: gray;
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
        font-size: 2rem;
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
        border: 2px solid transparent;
    }

    #slide-image .slide-image-dot img {
        width: 5rem;
        aspect-ratio: 4/3;
        object-fit: cover;
        cursor: pointer;
        border-radius: 3px;
    }

    #slide-image .slideractive {
        border: 2px solid green;
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
<div class="d-flex">
    <div class="btn btn-danger btn-sm" style="border-radius: 0; margin-right: 2px;" onclick="$('#slide-video').hide();$('#slide-image').show();">Hình ảnh</div>
    <div class="btn btn-danger btn-sm" style="border-radius: 0;" onclick="$('#slide-video').show();$('#slide-image').hide();">Video</div>
</div>
<div id="slide-image" style="display: block;">
    <div class="slideshow-container">

        <?php $i = 1;
        foreach ($imgs as $img) { ?>
            <?php $bg_img = "background-image: url(" . get_path_image($bdsInfo['create_time'], $img) . ");" ?>
            <a href="<?= get_path_image($bdsInfo['create_time'], $img) ?>" data-fancybox="gallery">
                <div class="mySlides fadeSlideImage" style="<?= $bg_img ?>">
                    <div class="numbertext"><?php echo $i . ' / ' . count($imgs) ?></div>
                    <div class="text"></div>
                </div>
            </a>
        <?php $i++;
        } ?>


        <div class="prev" onclick="plusSlides(-1)">❮</div>
        <div class="next" onclick="plusSlides(1)">❯</div>

    </div>
    <br>

    <div style="text-align:center">
        <div id="owl-image-thumb" class="owl-carousel">
            <?php $i = 1;
            foreach ($imgs as $img) { ?>
                <div class="slide-image-dot" onclick="currentSlide(<?php echo $i; ?>)">
                    <img src="<?php echo get_path_image($bdsInfo['create_time'], $img); ?>" alt="<?=$img?>">
                </div>
            <?php $i++;
            } ?>

        </div>
    </div>
</div>

<div id="slide-video" style="display: none;">
    <?php if($bdsInfo['videos'] != ''){?>
        <iframe style="width: 100%;" height="480px" src="<?= $bdsInfo['videos'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen allowscriptaccess="always"></iframe>
    <?php } ?>
</div>
<script>
    $(document).ready(function() {
        $("#owl-image-thumb").owlCarousel({
            dots: false,
            autoWidth: true,
            nav: false,
            autoplay: false,
            margin: <?php echo count($imgs); ?>,
        });

        Fancybox.bind('[data-fancybox="gallery"]', {
            // Your custom options
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
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
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