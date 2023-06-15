<?php
    include('../_config_inc.php');
    $base_url=BASE_URL;
    $base_path=BASE_PATH;
    session_start();
    include('action/active.php');
    $db = new Action;
    $uid=0;
    $first_name=$_SESSION['first_name'];
    $last_name=$_SESSION['last_name'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $utype = $_SESSION['u_type'];
    if( !isset($_SESSION['login']) || $_SESSION['login']==false ){
        header("Location: https://www.youtube.com/");
    }else{
        $umail =  $_SESSION['uemail'];
        $post_data = $db->select_cur_data("*","users","email='$umail'");

        // $ip_login = $post_data[9];
        $uid = $post_data[0];
        $utype= $post_data[7];
    }

    $data2=array();
    $con = " uid = $uid ";
    $postData = $db->select("*","permission",$con,"id DESC",0,10,0,1,2,0);
    if($postData != '0'){
        foreach($postData as $val){
            $data2[]=array(
                "mid" => $val[2],
                "aid" => $val[3],
            );
        }
    }
    $list_opt=array(
        array("fa-solid fa-users","Users","1","#00BFFF"),
        array("fa-solid fa-bars","Menu","2","#8A2BE2"),
        array("fa-solid fa-table-list","Product","3","#088F8F"),
        array("fa-solid fa-cart-arrow-down","Order","4","#F1948A"),
    );
    $product_opt=array(
        array("fa-solid fa-table-list","Product","5"),
        array("fa-solid fa-list-check","Product Type","6"),
        array("fa-solid fa-table-cells","Category","7"),
        array("fa-solid fa-list-ul","Using","8"),
        array("fa-solid fa-list-ol","Ads","9"),
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOA-Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
    <link rel="icon" href="<?php echo $base_url ?>admin/css/file.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url ?>admin/css/admin.css">
</head>
<body>
    <div class="main">
        <div class="user-login">
            <p> <?php echo $utype; ?>  :  <?php echo $first_name; echo $last_name; ?> </p>
        </div>
        <div class="log-out">
            <i class="fa-regular fa-circle-left"></i>
        </div>
       <div class="bar1">
            <img src="css/toa.jpg" alt="">
       </div> 
       <div class="bar2">
            <div class="box">
                <?php
                    foreach( $list_opt AS $val ){
                        if( $utype=='Admin' ){
                            $role=1;
                                ?>
                                    <div class="box1" style="background-color:<?php echo $val[3] ?>" data-opt="<?php echo $val[2] ?>" data-role="<?php echo $role ?>" id='click'>
                                        <i class="<?php echo $val[0] ?>"></i>
                                        <p><?php echo $val[1] ?></p>
                                    </div>
                                <?php
                        }else{
                            foreach( $data2 AS $val2){
                                $role=0;
                                if( $val2['mid'] == $val[2] && $val2['aid'] != 0 ){
                                    $role = $val2['aid'];
                                    ?>
                                        <div class="box1" style="background-color:<?php echo $val[3] ?>" data-opt="<?php echo $val[2] ?>" data-role="<?php echo $role ?>" id='click'>
                                            <i class="<?php echo $val[0] ?>"></i>
                                            <p><?php echo $val[1] ?></p>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    }
                ?>
            </div>
       </div>
    </div>
    <div class="tab">
        <div class="bar">
            <div class="box1">
                <div class="box" id='main-page'>
                    <i class="fa-solid fa-angles-left"></i>
                </div>
            </div>
            <div class="box3">
                <div class="box" id="btn">
                    <i class="fa-solid fa-square-plus"></i>
                </div>
                <div class="show">
                    <p>Show</p> 
                    <select name="" id="limit-data">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="box2">
                <div class="box" style="border-bottom-left-radius: 20px; border-top-left-radius: 20px; border-right: 0;">
                    <input type="text" id='txt-search-val' name='txt-search-val' style="text-align:right; padding-right:10px">
                </div>
                <div class="box" style="border-bottom-right-radius: 20px; border-top-right-radius: 20px">
                    <div class="select">
                        <select id="txt-filter-field" name="txt-filter-field" style="padding:10px">
                            <!-- <option value=""></option>
                            <option value="Name">Name</option>
                            <option value="gender">Gender</option>
                            <option value="type">Type</option>
                            <option value="date-birth">Date-birth</option>
                            <option value="date-join">Date-join</option> -->
                        </select>
                    </div>
                    <div class="btn">
                        <i class="fa-regular fa-magnifying-glass" id='btn-search'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="ctr-tbl">
            <table>
                <!-- <tr id='first'>
                    <th align="left">First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of birth</th>
                    <th>Date join</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Active</th>
                </tr> -->
                <!-- <tr>
                    <td>Lihour</td>
                    <td>Ny</td>
                    <td>M</td>
                    <td>15/09/2003</td>
                    <td>23/2/2023</td>
                    <td>icetea010001@gmail.com</td>
                    <td>admin</td>
                    <td>status</td>
                    <td><button type="button" id='edit'>1</button><button type="button" id='del'>2</button></td>
                </tr> -->
            </table>
        </div>
        <div class="pigination">
            <div class="left">
                <p> Showing <span id='page-current'> 0 </span> to <span id='page-total'> 0 </span> of <span id='data-total'> 0 </span> </p>
            </div>
            <div class="right">
                <div class="next" id='next'>
                    <p>NEXT</p>
                </div>
                <div class="page">
                    <span id='current-page'> 0 </span>
                </div>
                <div class="back" id='back'>
                    <p>BACK</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Developed by <a style="color:navy;text-decoration:none" href="https://web.facebook.com/profile.php?id=100077355072497" target="_blank"> IceTeaJunior </a></p> 
        </div>
    </div>
    <div class="product-list">
        <div class="left-box">
            <ul>
                <li data-option="10" id="back">
                    <a><i class="fa-solid fa-arrow-left"></i></a>
                </li>
                <?php
                    foreach( $product_opt AS $val ){
                        if( $utype=='Admin' ){
                            $role=1;
                                ?>
                                    <li data-option="<?php echo $val[2] ?>" data-role="<?php echo $role ?>">
                                        <a><i class="<?php echo $val[0] ?>"></i> <?php echo $val[1] ?></a>
                                    </li>
                                <?php
                        }else{
                            foreach( $data2 AS $val2){
                                $role=0;
                                if( $val2['mid'] == $val[2] && $val2['aid'] != 0 ){
                                    $role = $val2['aid'];
                                    ?>
                                        <li data-option="<?php echo $val[2] ?>" data-role="<?php echo $role ?>">
                                            <a><i class="<?php echo $val[0] ?>"></i> <?php echo $val[1] ?></a>
                                        </li>
                                    <?php
                                }
                            }
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="right-box">
            <div class="bar">
                <div class="box3">
                    <div class="box" id="btn">
                        <i class="fa-solid fa-square-plus"></i>
                    </div>
                    <div class="show">
                        <p>Show</p> 
                        <select name="" id="limit-data">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="box2">
                    <div class="box" style="border-bottom-left-radius: 20px; border-top-left-radius: 20px; border-right: 0;">
                        <input type="text" id='txt-search-val' name='txt-search-val' style="text-align:right; padding-right:10px">
                    </div>
                    <div class="box" style="border-bottom-right-radius: 20px; border-top-right-radius: 20px">
                        <div class="select">
                            <select id="txt-filter-field" name="txt-filter-field" style="padding:10px">
                            </select>
                        </div>
                        <div class="btn">
                            <i class="fa-regular fa-magnifying-glass" id='btn-search'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ctr-tbl">
                <table>
                </table>
            </div>
            <div class="pigination">
                <div class="left">
                    <p> Showing <span id='page-current'> 0 </span> to <span id='page-total'> 0 </span> of <span id='data-total'> 0 </span> </p>
                </div>
                <div class="right">
                    <div class="next" id='next'>
                        <p>NEXT</p>
                    </div>
                    <div class="page">
                        <span id='current-page'> 0 </span>
                    </div>
                    <div class="back" id='back'>
                        <p>BACK</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Developed by <a style="color:navy;text-decoration:none" href="https://web.facebook.com/profile.php?id=100077355072497" target="_blank"> IceTeaJunior </a></p> 
        </div>
    </div>
</body>
<script> 
    var uid = <?php echo $uid; ?>;
    var first_name = "<?php echo $first_name; ?>";
    var last_name = "<?php echo $last_name; ?>";
</script>
<script src="js/admin.js"></script>
</html>