<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item bg-transparent border-bottom border-3 border-danger" role="presentation" data-bs-target="#pills-news">
                        <button class="nav-link  bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab"   type="button" >Tin tức</button>
                    </li>
                    <li class="nav-item bg-transparent" role="presentation" data-bs-target="#pills-auction">
                        <button class="nav-link bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab"   type="button" >Đấu giá đất</button>
                    </li>
                    <li class="nav-item bg-transparent" role="presentation" data-bs-target="#pills-document">
                        <button class="nav-link bg-transparent fs-4 fw-bold text-dark" id="pills-news-pin-tab"  type="button" >Tài liệu luật</button>
                    </li>
                </ul>
                <a href="" class="text-danger text-decoration-none">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <hr class="pt-0 mt-0">

            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab" tabindex="0"> 
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-news" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-news" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-news" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($news as $id => $new) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap"><a href=""><?php echo $new['title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-news" class="data-json" value="<?php echo htmlspecialchars(json_encode($news)); ?>" />
                </div>
                <div class="tab-pane" id="pills-auction" role="tabpanel" aria-labelledby="pills-auction-tab" tabindex="0"> 
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-auction" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-auction" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-auction" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($auctions as $id => $auction) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap"><a href=""><?php echo $auction['title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-auction" class="data-json" value='<?php echo json_encode($auctions); ?>' />
                </div>
                <div class="tab-pane" id="pills-document" role="tabpanel" aria-labelledby="pills-law-land-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="" class="text-decoration-none ">
                                <img id="img-pills-document" src="https://img.iproperty.com.my/angel/610x342-crop/wp-content/uploads/sites/7/2023/02/20230322210912-c7c2_wm.jpg" alt="" class="img-alive rounded img-fluid w-100">
                                <p id="name-pills-document" class="fs-5 fw-bold text-dark"></p>
                                <p id="hour-pills-document" class="text-secondary"><i class="fa-solid fa-clock"></i> <span>1 giờ trước</span></p>
                            </a>

                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush list-group-numbered">
                                <?php foreach ($documents as $id => $document) { ?>
                                    <li data-id="<?php echo $id; ?>" class="list-group-item text-truncate text-wrap"><a href=""><?php echo $document['title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="data-pills-document" class="data-json" value='<?php echo json_encode($documents); ?>' />
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-md-none d-lg-block">
            <img src="https://tpc.googlesyndication.com/simgad/14633594877313808409" width="250" height="250" class="mb-3 float-end">
            <img src="https://tpc.googlesyndication.com/simgad/11569454017793019783" width="250" height="250" class="float-end">
        </div>
    </div>
</div>

<script>
$(function(){
    preview_article();
    $("#pills-tab .nav-item").click(function(e){
        $("#pills-tab .nav-item").removeClass("border-bottom border-3 border-danger");

        $(this).addClass("border-bottom border-3 border-danger");

        let tab = $(this).data("bs-target");
        $("#pills-tabContent .tab-pane").removeClass("active");
        $("#pills-tabContent "+tab).addClass("active");
        
        preview_article();
        
        $(".tab-pane.active").find("ul.list-group li").mouseover(function(){
            let id = $(this).data("id");
            preview_article(id);
        });
        
    });
});

    
function preview_article(id = 0){
    let data = $(".tab-pane.active").find("input.data-json").val();
    let id_tabactive = $(".tab-pane.active").attr("id");

    try {
        data = JSON.parse(data);
        console.log(data);
        id = id == 0 ? Object.keys(data)[Object.keys(data).length-1] : id;

        $("#img-"+id_tabactive).attr("src", data[id].image_path);
        $("#name-"+id_tabactive).text(data[id].title);
        
        //get hour ngay gio hien tai - create_time tai viet
        const postDate = new Date(data[id].create_time);
        const timeElapsed = timeSince(postDate);
        $("#hour-"+id_tabactive +" span").text(timeElapsed + " trước");
    } catch (error) {
        console.log(error)
    }
    
    
}

function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);
    let interval = Math.floor(seconds / 31536000);

    if (interval >= 1) {
      return interval + " năm";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval >= 1) {
      return interval + " tháng";
    }
    interval = Math.floor(seconds / 86400);
    if (interval >= 1) {
      return interval + " ngày";
    }
    interval = Math.floor(seconds / 3600);
    if (interval >= 1) {
      return interval + " giờ";
    }
    interval = Math.floor(seconds / 60);
    if (interval >= 1) {
      return interval + " phút";
    }
    return Math.floor(seconds) + " giây";
}

</script>