<div class="container-fluid video-container distributor-container" style="margin-top: 100px;margin-bottom:10px;padding:20px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 head-title">
                <h1>Distributor</h1>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 list-video list-distributor">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 video-box distributor-box">
                        <div class="box box-video2" data-url="ផ្លូវក្រវ៉ាត់ក្រុង រទេះភ្លើង ភូមិកំពងបាយខាងជើង ក្រុងកំពត ខេត្តកំពត">
                            <div class="img-box">
                                <?php
                                    $sql="SELECT id,img,name FROM ads WHERE od =11";
                                    $rs=$cn->query($sql);
                                    $row=$rs->fetch_array();
                                    ?>
                                        <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[1]; ?>" alt="">
                                    <?php
                                ?>
                            </div>
                            <div class="txt-box">
                                <h1>Kong Kea Shop, Kampot</h1>
                                <h2>
                                <span class="city">Kampot</span> / <span class="dist">Chhouk</span>
                                </h2>
                                <h3>
                                    ផ្លូវក្រវ៉ាត់ក្រុង រទេះភ្លើង ភូមិកំពងបាយខាងជើង ក្រុងកំពត ខេត្តកំពត                                                </h3>
                                <ul>
                                    <li>
                                        <a href="">
                                            010414120  <i class="fa-solid fa-phone"></i>
                                        </a>
                                    </li>
                                                                                                                                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fa-brands fa-facebook-messenger"></i>
                                        </a>
                                    </li>
                                                                                                                                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fa-brands fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
