<?php

    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $edit_id=$_POST['id'];

    $sql=" SELECT password,status FROM users WHERE id='$edit_id' ";
    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "pass"=>$row[0],
            "status"=>$row[1],
        );
    }

    echo json_encode($data);
?>