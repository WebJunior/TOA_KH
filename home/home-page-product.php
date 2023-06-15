<div class="container-fluid">
    <div class="container title">
        <div class="row">
            <div class="col-xl-12 head-title">
                <?php
                if($pheasa=="en"){
                    $title="Our Product";
                }else{
                    $title="ផលិតផលរបស់យើង";
                }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
    </div>
    <div class="container product-container">
        <div class="row">
            <?php
                $sql="SELECT PD.id,PU.en_name,PU.kh_name,PD.name,PD.img,PD.cate_id,PD.name_link FROM product AS PD 
                    INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
                    ORDER BY PD.od ASC LIMIT 0,16";
                $rs=$cn->query($sql);
                while($row=$rs->fetch_array()){
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 product-box">
                        <div class="product" data-id="<?php echo $row[0]; ?>" data-name="<?php echo $row[3]; ?>" data-img="<?php echo $row[4]; ?>">
                            <a href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo "Product" ?>/<?php echo $row[5];?>/<?php echo $row[0]; ?>/<?php echo $row[6]; ?>">
                                <div class="img-box">
                                    <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[4]; ?>" alt="">
                                    <span class="pcode"> Code: </span>
                                </div>
                                <div class="txt-box">
                                    <h2><?php echo $row[$lang]; ?></h2>
                                    <h1><?php echo $row[3]; ?></h1>
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