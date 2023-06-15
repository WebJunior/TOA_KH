<?php
    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $sql="SELECT id,kh_name FROM category ORDER BY id DESC";
    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data2=array();
        $sql2="SELECT id,name,cate_id FROM product WHERE cate_id = ".$row[0]."";
        $rs2=$cn->query($sql2);
        while($row2 = $rs2->fetch_array()){
            $data2[]=array(
                "id"=>$row2[0],
                "name"=>$row2[1],  
                "cate_id"=>$row2[2],
            );
        }
        $data[]=array(
            "id"=>$row[0],
            "name"=>$row[1],
            "cate"=>$data2
        );
    }

    echo json_encode($data);

?>