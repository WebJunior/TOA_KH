<form method="POST" class="upl">
    <div class="frm" style="width:1400px;top:2%;">
        <div class="header">
            <p><i class="fa-solid fa-user-plus"></i> Add Product</p>
        </div>
        <div class="body">
            <div class="box1">
                <div class="box" style="margin-top: 10px">
                    <div class="left">
                        <h6>ID :</h6>
                    </div>
                    <div class="right">
                        <input type="text" class="form-control" id="id" name="id" readonly style="cursor:pointer;">
                        <input type="hidden" class="form-control" id="edit-id" name="edit-id" value="0">
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>CATEGORY :</h6>
                    </div>
                    <div class="right">
                        <?php
                            $cn=new mysqli("localhost","root","","toa");
                            $cn->set_charset("utf8");

                            $sql="SELECT * FROM category WHERE id < 7 ";
                            $rs=$cn->query($sql);

                            ?>
                            <select class="form-select" id="category" name="category">
                                <option value="0"></option>
                                <?php
                                    while($row=$rs->fetch_array()){
                                    ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <?php
                        ?>
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>Poster :</h6>
                    </div>
                    <div class="right">
                        <?php
                            $cn=new mysqli("localhost","root","","toa");
                            $cn->set_charset("utf8");

                            $sql="SELECT * FROM users ORDER BY id DESC";
                            $rs=$cn->query($sql);

                            ?>
                            <select class="form-select" id="poster" name="poster">
                                <option value="0"></option>
                                <?php
                                    while($row=$rs->fetch_array()){
                                    ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?>_<?php echo $row[2] ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <?php
                        ?>
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>Name :</h6>
                    </div>
                    <div class="right">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>Type :</h6>
                    </div>
                    <div class="right">
                    <?php
                            $cn=new mysqli("localhost","root","","toa");
                            $cn->set_charset("utf8");

                            $sql="SELECT * FROM product_type WHERE id < 4 ORDER BY id DESC";
                            $rs=$cn->query($sql);

                            ?>
                            <select class="form-select" id="type" name="type">
                                <option value="0"></option>
                                <?php
                                    while($row=$rs->fetch_array()){
                                    ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <?php
                        ?>
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>Using :</h6>
                    </div>
                    <div class="right">
                        <?php
                            $cn=new mysqli("localhost","root","","toa");
                            $cn->set_charset("utf8");

                            $sql="SELECT * FROM product_using WHERE id < 4 ";
                            $rs=$cn->query($sql);

                            ?>
                            <select class="form-select" id="using" name="using">
                                <option value="0"></option>
                                <?php
                                    while($row=$rs->fetch_array()){
                                    ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <?php
                        ?>
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>Location :</h6>
                    </div>
                    <div class="right">
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>OD :</h6>
                    </div>
                    <div class="right">
                        <input type="text" class="form-control" id="od" name="od">
                    </div>
                </div>
                <div class="box">
                    <div class="left">
                        <h6>STATUS :</h6>
                    </div>
                    <div class="right">
                        <select class="form-select" id="status" name="status">
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                    </div>
                </div>
                <div class="box" style="margin-bottom:20px; ">
                    <div class="left">
                        <h6>PHOTO :</h6>
                    </div>
                    <div class="photo">
                        <input type="file" name="txt-img" id="txt-img" class="txt-img">
                        <input type="hidden" name="txt-img-name" id="txt-img-name">    
                    </div>
                </div>
            </div>
            <div class="box2">
                <div class="box">
                    <div class="left" style="width:100%">
                        <h6>Description :</h6>
                    </div>
                    <div class="right" style="width:100%">
                        <textarea name="des" id="des"></textarea>
                    </div>
                </div>
                <div class="box" style="margin-bottom:10px;margin-top:10px">
                    <div class="left"></div>
                    <div class="right" style="float: right;">
                        <button type="button" class="btn btn-outline-danger" id="cancel">Cancel</button>
                        <button type="button" class="btn btn-outline-primary" id="add">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>