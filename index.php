<?php
    include('_config_inc.php');
    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $current_url="";
    $s=0;
    $e=21;
    $lang=1;
    $menu_name="";
    $total_item=0;
    $base_url=BASE_URL;
    $base_path=BASE_PATH;
    $pro_id=0;
    $top=0;
    $padding=0;
    $item_id=5;
    $pheasa="en";
    if(isset($_GET['lang'])){
        $pheasa=$_GET['lang'];
        if($pheasa=="en"){
            $lang=1;
        }else{
            $lang=2;
        }
    }

    if(isset($_GET['item-id'])){
        $item_id=$_GET['item-id'];
    }
    if(isset($_GET['pro-id'])){
        $pro_id=$_GET['pro-id'];
    }
    if(isset($_GET['cate-id']) & !isset($_GET['pro-id'])){
        $cate_id=$_GET['cate-id'];
        $sql_count="SELECT COUNT(*) FROM product WHERE cate_id = $cate_id";
        $rs_count=$cn->query($sql_count);
        $row_count=$rs_count->fetch_array();
        $total_item=$row_count[0];
        $total_item=$total_item-$e;
    }else if(!isset($_GET['cate-id'])){
        $cate_id=0;
        $sql_count="SELECT COUNT(*) FROM product";
        $rs_count=$cn->query($sql_count);
        $row_count=$rs_count->fetch_array();
        $total_item=$row_count[0];
        $total_item=$total_item-$e;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
            if(isset($_GET['name'])){
                echo $_GET['name'];
            }else if(isset($_GET['menu'])){
                echo $_GET['menu'];
            }else{
                echo "TOA Costing (Cambodia) Co,Ltd";
            }
        ?>
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <link rel="icon" href="<?php echo $base_url; ?>home/css/file.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>home/css/home.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>home/css/product.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>home/css/dis.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>
<body>
    <?php
        include($base_path.'home/layouts/bar.php');
        if(isset($_GET['option'])){
            if($_GET['option']=="order"){
                include($base_path.'home/order.php');
            }else if($_GET['option']=="mytoa"){
                include($base_path.'home/my-toa.php');
            }
        }elseif(isset($_GET['menu'])){
            $top="100px";
            $padding="20px";
            $menu_name = $_GET['menu'];
            if(isset($_GET['item-id'])){
                include($base_path.'home/knowledge-detail.php');
            }else if(isset($_GET['pro-id'])){
                include($base_path.'home/pro-detail.php');
            }else if($menu_name=="Product"){
                include($base_path.'home/product.php');
            }else if($menu_name=="Distibutor"){
                include($base_path.'home/distributor.php');
            }else if($menu_name=="Video"){
                include($base_path.'home/videos.php');
            }else if($menu_name=="Knowledge"){
                include($base_path.'home/knowledge.php');
            }else if($menu_name=="Jobs"){
                include($base_path.'home/jobs.php');
            }else if($menu_name=="Project Refference"){
                include($base_path.'home/project-refference.php');
            }else if($menu_name=="Contact Us"){
                include($base_path.'home/contact-us.php');
            }
        }else{
            $top=0;
            include($base_path.'home/slide.php');
            include($base_path.'home/category-slide.php');
            include($base_path.'home/home-page-product.php');
            include($base_path.'home/videos.php');
            include($base_path.'home/knowledge.php');
            include($base_path.'home/project-refference.php');
            include($base_path.'home/jobs.php');
            include($base_path.'home/contact-us.php');
        }
        include($base_path.'home/layouts/footer.php');
    ?>
</body>
<script>
    var menu = "<?php echo $menu_name; ?>";
    var cate_id = <?php echo $cate_id; ?>;
    var pro_id = <?php echo $pro_id; ?>;
    var total_data = <?php echo $total_item; ?>;
    var top = "<?php echo  $top; ?>";
    var padding = "<?php echo  $padding; ?>";
    var base_url = "<?php echo $base_url; ?>";
    var pheasa = "<?php echo $pheasa; ?>";
    var  current_url = "<?php echo $current_url?>";
</script>
<script src="<?php echo $base_url; ?>home/js/home.js"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
        slidesPerGroup: 2,
        loop: true,
        loopFillGroupWithBlank: true,
        // autoplay: {
        //     delay: 3000,
        //     disableOnInteraction: false,
        // },
        // pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        // },
        navigation: {
            nextEl: ".next-cate",
            prevEl: ".back-cate",
        },
        breakpoints: {
            // when window width is <= 1200px
            1200: {
                slidesPerView: 4,
                spaceBetween: 20,
                slidesPerGroup: 2,
                loop: true,
                loopFillGroupWithBlank: true,
                // autoplay: {
                //     delay: 2500,
                //     disableOnInteraction: false,
                // },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".next-cate",
                    prevEl: ".back-cate",
                },
            },
            // when window width is <= 992px
            992: {
                slidesPerView: 6.5,
                spaceBetween: 20,
                slidesPerGroup: 3,
                loop: true,
                loopFillGroupWithBlank: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".next-cate",
                    prevEl: ".back-cate",
                },
            },
            // when window width is <= 768px
            768: {
                slidesPerView: 5.5,
                spaceBetween: 20,
                slidesPerGroup: 3,
                loop: true,
                loopFillGroupWithBlank: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".next-cate",
                    prevEl: ".back-cate",
                },
            },
            // when window width is <= 576px
            576: {
                slidesPerView: 4.5,
                spaceBetween: 20,
                slidesPerGroup: 2,
                loop: true,
                loopFillGroupWithBlank: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".next-cate",
                    prevEl: ".back-cate",
                },
            },
            // when window width is <= 300px
            300: {
                slidesPerView: 3.5,
                spaceBetween: 20,
                slidesPerGroup: 1,
                loop: true,
                loopFillGroupWithBlank: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".next-cate",
                    prevEl: ".back-cate",
                },
            },
        },   
    });
</script>
</html>