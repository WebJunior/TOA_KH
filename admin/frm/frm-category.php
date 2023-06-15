<form method="POST" class="upl">
    <div class="frm">
        <div class="header">
            <p><i class="fa-solid fa-user-plus"></i> Add Category</p>
        </div>
        <div class="body">
            <div class="box">
                <div class="left">
                    <h6>ID :</h6>
                </div>
                <div class="right">
                    <input type="text" class="form-control" id="id" name="id" readonly>
                    <input type="hidden" class="form-control" id="edit-id" name="edit-id" value="0">
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
                    <h6>En-Name :</h6>
                </div>
                <div class="right">
                    <input type="text" class="form-control" id="en-name" name="en-name">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Kh-Name :</h6>
                </div>
                <div class="right">
                    <input type="text" class="form-control" id="kh-name" name="kh-name">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Color-Code :</h6>
                </div>
                <div class="right">
                    <input type="text" class="form-control" id="color-code" name="color-code">
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
                    <h6>Status :</h6>
                </div>
                <div class="right">
                    <select class="form-select" id="status" name="status">
                        <option value="1">1</option>
                        <option value="0">0</option>
                    </select>
                </div>
            </div>
            <div class="box">
                <div class="left"></div>
                <div class="right">
                    <button type="button" class="btn btn-outline-primary" id="add">Add</button>
                    <button type="button" class="btn btn-outline-danger" id="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>