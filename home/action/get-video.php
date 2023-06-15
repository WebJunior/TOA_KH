<?php

    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $video_id=$_POST['video_id'];

    $sql="SELECT id,video FROM ads WHERE id = $video_id";
    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "id_video"=>$row[1],
        );
    };

    echo json_encode($data);
?>