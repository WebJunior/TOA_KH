<div class="container-fluid knowledge" style="margin-top:<?php echo $top ?>;padding:<?php echo $padding; ?>">
    <div class="container title">
        <div class="row">
            <div class="col-xl-12 video-title">
                <?php
                    if($pheasa=="en"){
                        $title="Knowledeg";
                    }else{
                        $title="ចំណេះដឹង";
                    }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
    </div>
    <div class="container video-container">
        <div class="row">
        <?php
                $sql="SELECT * FROM ads WHERE od=9 ORDER BY id ASC";
                $rs=$cn->query($sql);
                while($row=$rs->fetch_array()){
                    ?>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 video-box">
                            <a href="<?php echo $base_url; ?><?php echo $pheasa ?>/<?php echo $menu_name; ?>&item-id=<?php echo $row[0]; ?>">
                                <div class="video">
                                    <div class="img-box">
                                        <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[4]; ?>" alt="">
                                    </div>
                                    <div class="txt-box">
                                        <h2>Interior</h2>
                                        <h1><?php echo $row[3]; ?></h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>