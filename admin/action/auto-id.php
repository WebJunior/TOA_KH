<?php
    include("active.php");
    $db = new Action;

    $ind = $_POST['ind'];

    $tbl = array(
        "1"=>"users",
        "2"=>"menu",
        "5"=>"product",
        "6"=>"product_type",
        "7"=>"category",
        "8"=>"product_using",
        "9"=>"ads",
    );

    $msg['id']= $db->auto_id("id",$tbl[$ind],"id DESC");

    echo json_encode($msg);
?>
