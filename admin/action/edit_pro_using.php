<?php

    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $edit_id=$_POST['id'];

    $sql=" SELECT status,uid FROM product_using WHERE id='$edit_id' ";
    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "status"=>$row[0],
            "uid"=>$row[1]
        );
    }

    echo json_encode($data);
?>