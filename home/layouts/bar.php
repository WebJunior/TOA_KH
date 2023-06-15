<div class="container-fluid bar1">
    <div class="container bar">
        <div class="row">
            <div class="col-xl-12 col-lg-12 menu-bar">
                <div class="menu">
                    <div class="logo-box">
                        <a href="<?php echo $base_url; ?>en">
                            <img src="<?php echo $base_url; ?>home/css/toa.jpg" alt="">
                        </a>
                    </div>
                    <div class="menu-box">
                        <div class="box1">
                            <div class="box1-1">
                                <ul>
                                    <li class="search-box">
                                        <input type="text" name="" id="txt-search-text" placeholder="What are you looking for..">
                                        <a class="btnSearch">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a class="btnClose">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul> 
                                    <li class="btnMenu">
                                        <a>
                                            <i class="fas fa-bars"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li class="btn-search-box">
                                        <a>
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            <span>Search</span>
                                        </a>
                                    </li>    
                                    <li class="btn-card">
                                        <a href="<?php echo $base_url; ?>en&option=order">
                                            <i class="fa-solid fa-cart-arrow-down"></i>
                                            <span>Cart</span>
                                        </a>
                                    </li>                                   
                                    <li id="btn-my-toa-login">
                                        <a href="<?php echo $base_url; ?>en&option=mytoa">
                                            <i class="fa-brands fa-square-facebook"></i>
                                            <span>Login</span>
                                        </a>
                                    </li>
                                    <li>
                                        <?php
                                            if($pheasa=="en"){
                                                $language="kh";
                                                $cap="Khmer";
                                            }else{
                                                $language="en";
                                                $cap="ភាសាអង់គ្លេស";  
                                            }
                                            if(isset($_GET['lang'])){
                                                $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                                if($_GET['lang']=="en"){
                                                    $current_url=str_replace('en','kh',$url);
                                                }else if($_GET['lang']=="kh"){
                                                    $current_url=str_replace('kh','en',$url);
                                                }else{
                                                    $current_url=$url;
                                                }
                                            }else{
                                                $current_url=$base_url."kh";
                                            }
                                        ?>
                                        <a href="<?php echo $current_url; ?>">
                                            <i class="fa-solid fa-flag"></i>
                                            <span><?php echo $cap; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box2">
                            <ul>  
                                <?php
                                    $sql="SELECT * FROM menu WHERE status=1 ORDER BY id ASC";
                                    $rs=$cn->query($sql);
                                    while($row=$rs->fetch_array()){
                                        ?>
                                        <li class="show">
                                            <a href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo $row[3]; ?>">
                                                <?php echo $row[$lang+2];?>                                                
                                            </a>
                                        </li>
                                    <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="phone-popUp"></div>
<div class="phone-menu">
    <ul>  
        <li class="logo-box">
            <a href="<?php echo $base_url; ?>">
                <img src="<?php echo $base_url; ?>home/css/toa.jpg" alt="">
            </a>
        </li>
        <?php
            $sql="SELECT * FROM menu WHERE status=1 ORDER BY id ASC";
            $rs=$cn->query($sql);
            while($row=$rs->fetch_array()){
                ?>
                <li class="show">
                    <a href="<?php echo $base_url; ?><?php echo $pheasa; ?>/<?php echo $row[3]; ?>">
                        <?php echo $row[3];?>                                                
                    </a>
                </li>
            <?php
            }
        ?>
    </ul>
</div>