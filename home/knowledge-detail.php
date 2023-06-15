<div class="container knowledge-detail-container" style="margin-top:100px;padding-top:20px">
    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 box1">
            <?php
                $sql="SELECT id,name,img,video,od FROM ads WHERE od = 9 AND id = $item_id";
                $rs=$cn->query($sql);
                $row=$rs->fetch_array();
                ?>
                    <h1><?php echo $row[1]; ?></h1>
                    <p>
                        <img class="img-fluid" src="<?php echo $base_url; ?>admin/video/<?php echo $row[3]; ?>">
                    </p>
                    <p>&nbsp;</p>
                    <p><strong>Content Updating...</strong></p>
                    <p>&nbsp;</p>
                <?php
            ?>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 box2">
            <ul>
                <?php
                $sql="SELECT id,name,img,video,od FROM ads WHERE od = 9";
                $rs=$cn->query($sql);
                while($row=$rs->fetch_array()){
                    ?>
                        <li>
                            <a href="<?php echo $base_url; ?><?php echo $pheasa ?>/Knowledge&item-id=<?php echo $row[0]; ?>">
                                <img src="<?php echo $base_url; ?>admin/img/<?php echo $row[2]; ?>" alt="">
                                <span><?php echo $row[1]; ?></span>
                            </a>
                        </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>