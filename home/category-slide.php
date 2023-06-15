<div class="container-fluid cate-menu-container">
    <div class="container menu-container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 cate-menu">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php
                            $sql="SELECT id,en_name,kh_name,color_code FROM category WHERE id  < 7 ORDER BY id DESC";
                            $rs=$cn->query($sql);
                            while($row=$rs->fetch_array()){
                                ?>
                                    <div class="swiper-slide" style="background-color:<?php echo $row[3]; ?>">
                                        <a href="<?php echo $base_url; ?><?php echo $pheasa ?>/<?php echo "Product"; ?>/<?php echo$row[0]; ?>">
                                            <span><?php echo $row[$lang] ?></span>
                                        </a> 
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="next-cate"><i class="fa-solid fa-angle-right"></i></div>
                    <div class="back-cate"><i class="fa-solid fa-angle-left"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>