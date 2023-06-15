<div class="container-fluid" style="margin-top:<?php echo $top ?>;padding:<?php echo $padding; ?>">
    <div class="container title">
        <div class="row">
            <div class="col-xl-12 video-title">
                <?php
                    if($pheasa=="en"){
                        $title="Video";
                    }else{
                        $title="វីដេអូ";
                    }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
    </div>
    <div class="container video-container">
        <div class="row">
            <?php
                $sql="SELECT * FROM ads WHERE od=2 ORDER BY id ASC";
                $rs=$cn->query($sql);
                while($row=$rs->fetch_array()){
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 video-box">
                        <div class="video" data-id="<?php echo $row[0]; ?>">
                            <div class="img-box">
                                <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[4]; ?>" alt="">
                            </div>
                            <div class="txt-box">
                                <h2>Interior</h2>
                                <h1><?php echo $row[3]; ?></h1>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<!-- ==========================popUP-Video===================== -->
<div class="video-popup">
    <div class="container frm-item-detail frm-video" style="background-color: rgb(0, 0, 0);width:76%;">
        <div class="close">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
</div>