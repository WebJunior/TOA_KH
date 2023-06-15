<div class="container-fluid footer" style="float:left">
    <div class="container footer-box">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12 box1">
                <h3>LET'S COLOR YOUR LIFE </h3>
                <h1>TOA Coating (Cambodia) Co.,Ltd</h1>
                <h2>Address</h2>
                <p> 
                    TOA Coating (Cambodia) Co.,Ltd 
                    <br>Sales Office: The Point Community Mall
                    <br>No.#113C, Mao Tse Tung Blvd, Sangkat Toul Svay Prey,
                    <br>Khan Beong Keng Kong Phnom Penh, Cambodia.                
                </p>
                <?php
                    if($pheasa=="en"){
                        $phone="095999538";
                        $title="Business Center";
                    }else{
                        $phone="០៩៥ ៩៩៩ ៥៣៨";
                        $title="ទំនាក់ទំនង";
                    }
                ?>
                <h2>
                    Contact Us    
                </h2>
                <p>
                <?php echo $title; ?> : <?php echo $phone; ?>                
                </p>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-4 col-sm-4 col-12 box2">
                <h1>   
                    Quick Link 
                </h1>
                <ul>
                    <?php
                       $sql="SELECT id,en_name,kh_name FROM category WHERE id <= 6 ORDER BY id ASC";
                       $rs=$cn->query($sql);
                       while($row=$rs->fetch_array()){
                          ?>
                            <li>
                                <a href=""><?php echo $row[$lang] ?></a>
                            </li>
                          <?php
                       }
                    ?>
                </ul>
            </div>
            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-3 col-12 box3">
                <?php
                    if($pheasa=="en"){
                        $title="Follow us ";
                    }else{
                        $title="តាមពួកយើង";
                    }
                ?>
                <h1 style="font-style: italic;">
                    <?php echo $title; ?>
                </h1>
                <ul>
                    <li>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>
                                                    <li>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-square-youtube"></i>
                        </a>
                    </li>
                                                    <li>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-telegram"></i>
                        </a>
                    </li>
                                                    <li>
                        <a href="" target="_blank">
                            <i class="fa-brands fa-square-instagram"></i>
                        </a>
                    </li>
                                                    <li>
                        <a href="" target="_blank">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <p class="copyright">
                © 2022 All Rights Reserved Designed by TOA Coating (Cambodia) Co., Ltd. 
            </p>
        </div>
    </div>
</div>