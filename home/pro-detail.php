<div class="container-fluid" style="background-color:#fff">
    <div class="container pro-detail-con">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pro-detail-box">
                <div class="box">
                    <?php
                        $sql="SELECT PD.id,PD.name,PD.img,PD.description,PU.en_name,PU.kh_name,PT.en_name,PT.kh_name FROM 
                            ((product AS PD INNER JOIN product_using AS PU ON PD.pro_using_id = PU.id)
                            INNER JOIN product_type AS PT ON PD.pro_type_id = PT.id) 
                            WHERE PD.id = $pro_id";
                        $rs=$cn->query($sql);
                        $row=$rs->fetch_array();

                        $sql_view="UPDATE product SET view = view + 1 WHERE id =$pro_id";
                        $cn->query($sql_view);
                        ?>
                            <div class="img-box">
                                <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[2]; ?>" alt="">
                            </div>
                            <div class="txt-box">
                                <h1 class="title1"><?php echo $row[1]; ?></h1>
                                <?php 
                                    echo $row[3];
                                ?>
                                <div class="row product-feature">
                                    <div class="col-xl-6 col-lg-6">
                                    <?php
                                        if($pheasa=="en"){
                                            $title="Using";
                                        }else{
                                            $title="ប្រើប្រាស់";
                                        }
                                    ?>
                                        <h1 class="title2"><?php echo $title; ?></h1>
                                        <span style="font-family: 'Hanuman', serif;"><?php echo $row[$lang+3] ?></span>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                    <?php
                                        if($pheasa=="en"){
                                            $title="Product Types";
                                        }else{
                                            $title="ប្រភេទថ្នាំ";
                                        }
                                    ?>
                                        <h1 class="title2"><?php echo $title; ?></h1>
                                        <span style="font-family: 'Hanuman', serif;"><?php echo $row[$lang+5] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 img-sponser">
                                        <h1 class="title1">Supported</h1>
                                        <img src="https://www.toacambodia.com/home/img/product/6392dff1adeb0_sponser-02.jpg" alt="6392dff1adeb0_sponser-02.jpg">
                                    </div>
                                </div> 
                            </div>
                        <?php
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="background-color: #eee;margin-bottom:10px">
    <div class="container title">
        <div class="row">
            <div class="col-xl-12 head-title">
                <h1>Our Product</h1>
            </div>
        </div>
    </div>
    <div class="container product-container">
        <div class="row">
            <?php
                $sql="SELECT PD.name,PU.en_name,PU.kh_name,PD.img,PD.id,PD.cate_id,PD.name_link FROM product AS PD 
                    INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
                    ORDER BY PD.od DESC LIMIT 0,16";
                $rs=$cn->query($sql);
                while($row=$rs->fetch_array()){
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 product-box">
                        <div class="product" data-id="<?php echo $row[4]; ?>" data-name="<?php echo $row[0]; ?>" data-img="<?php echo $row[3]; ?>">
                            <a href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo $menu_name; ?>/<?php echo $row[5];?>/<?php echo $row[4]; ?>/<?php echo $row[6]; ?>">
                                <div class="img-box">
                                    <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[3]; ?>" alt="">
                                    <span class="pcode"> Code: </span>
                                </div>
                                <div class="txt-box">
                                    <h2><?php echo $row[$lang]; ?></h2>
                                    <h1><?php echo $row[0]; ?></h1>
                                </div>
                            </a>
                            <div class="shop"><i class="fa-solid fa-cart-plus"></i></div>
                            <div class="fb"><i class="fa-brands fa-square-facebook"></i></div>
                            <div class="link-cp"><i class="fa-solid fa-link"></i></div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
