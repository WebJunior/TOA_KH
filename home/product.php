<div class="container-fluid">
    <div class="container product-con">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12 filter">
                <div class="filter-box" id="cate">
                    <?php
                        if($pheasa=="en"){
                            $title="OUR CATEGORY";
                        }else{
                            $title="ប្រភេទផលិតផល";
                        }
                    ?>
                    <h1><?php echo $title; ?></h1>
                    <ul>
                        <?php
                            $sql="SELECT id,en_name,kh_name FROM category WHERE id <= 6 ORDER BY id ASC";
                            $rs=$cn->query($sql);
                            while($row=$rs->fetch_array()){
                                $active="";
                                if($row[0] == $cate_id){
                                    $active="active";
                                }
                            ?>
                                <li>
                                    <a class="<?php echo $active; ?>" href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo $menu_name ?>/<?php echo$row[0]; ?>"> 
                                        <?php echo $row[$lang] ?> 
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php
                            }
                        ?>
                    </ul>
                </div>
                <div class="filter-box" id="using">
                    <?php
                        if($pheasa=="en"){
                            $title="USING";
                        }else{
                            $title="ប្រើប្រាស់";
                        }
                    ?>
                    <h1><?php echo $title; ?></h1>
                    <ul>
                        <?php
                            $sql="SELECT id,en_name,kh_name FROM product_using WHERE id < 4 ORDER BY id DESC";
                            $rs=$cn->query($sql);
                            while($row=$rs->fetch_array()){
                                ?>
                                    <li>
                                        <a><i class="fa-regular check fa-square"></i><?php echo $row[$lang]  ?></a>
                                    </li>
                                <?php
                                // $using=$row[0];
                            }
                        ?>
                    </ul>
                </div>
                <div class="filter-box" id="type">
                    <?php
                        if($pheasa=="en"){
                            $title="PRODUCT TYPE";
                        }else{
                            $title="ប្រភេទ";
                        }
                    ?>
                    <h1><?php echo $title; ?></h1>
                    <ul>
                        <?php
                            $sql="SELECT id,en_name,kh_name FROM product_type WHERE id < 4 ORDER BY id DESC";
                            $rs=$cn->query($sql);
                            while($row=$rs->fetch_array()){
                                ?>
                                    <li>
                                        <a><i class="fa-regular check fa-square"></i><?php echo $row[$lang]  ?></a>
                                    </li>
                                <?php
                                // $type=$row[0];
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="phone-popUp"></div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 product">
                <div class="product-box">
                    <div class="img-box">
                        <img src="<?php echo $base_url; ?>home/img/product-img.jpg" alt="">
                    </div>
                    <div class="title-box">
                        <?php
                            if(isset($_GET['cate-id'])){
                                $sql="SELECT CATE.id,CATE.en_name,CATE.kh_name FROM product AS PD INNER JOIN category AS CATE ON PD.cate_id = CATE.id WHERE CATE.id = $cate_id";
                                $rs=$cn->query($sql);
                                $row=$rs->fetch_array();
                                    ?>
                                        <h1><?php echo $row[$lang]; ?></h1>
                                    <?php
                            }else if(!isset($_GET['cate-id'])){
                                    if($pheasa=="en"){
                                        $title="OUR PRODUCT";
                                    }else{
                                        $title="ផលិតផល";
                                    }
                                ?>
                                    <h1><?php echo $title; ?></h1>
                                <?php
                            }
                        ?>
                        <div class="btn-filter">
                            <i class="fa-solid fa-filter"></i> Fillter
                        </div>
                    </div>
                    <div class="container pro-container">
                        <div class="row" id="product">
                        <?php
                            if(!isset($_GET['cate-id'])){
                                $sql="SELECT PD.name,PU.en_name,PU.kh_name,PD.img,PD.cate_id,PD.id,PD.name_link FROM product AS PD 
                                    INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
                                    ORDER BY PD.od ASC LIMIT $s,$e";
                            }else if(isset($_GET['cate-id'])){
                                $sql="SELECT PD.name,PU.en_name,PU.kh_name,PD.img,PD.cate_id,PD.id,PD.name_link FROM product AS PD 
                                    INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
                                    WHERE cate_id = $cate_id ORDER BY PD.od ASC LIMIT $s,$e";
                            }
                            $rs=$cn->query($sql);
                            while($row=$rs->fetch_array()){
                                ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 box">
                                        <div class="pro-box" data-id="<?php echo $row[5]; ?>" data-name="<?php echo $row[0]; ?>" data-img="<?php echo $row[3]; ?>">
                                            <a href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo $menu_name ?>/<?php echo $row[4];?>/<?php echo $row[5]; ?>/<?php echo $row[6]; ?>">
                                                <div class="box-img">
                                                    <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[3]; ?>" alt="">
                                                    <span class="pcode"> Code: </span>
                                                </div>
                                                <div class="box-txt">
                                                    <h2><?php echo $row[$lang]; ?></h2>
                                                    <h1><?php echo $row[0]; ?></h1>
                                                </div>
                                            </a>
                                            <div class="shop" style="z-index:168"><i class="fa-solid fa-cart-plus"></i></div>
                                            <div class="fb" style="z-index:168"><i class="fa-brands fa-square-facebook"></i></div>
                                            <div class="link-cp" style="z-index:168"><i class="fa-solid fa-link"></i></div>
                                        </div>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php  
                    if( $total_item > 0){
                        ?>
                        <div class="view-more">
                            <div class="box">
                                <p>View-more <br> <i class="fa-solid fa-angle-down"></i></p>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
