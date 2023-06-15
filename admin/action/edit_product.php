<?php

    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $edit_id=$_POST['id'];

    $sql = "SELECT 
                PRO.description,
                CATE.id,
                PU.id,
                users.id,
                PRO.status,
                PT.id
            FROM ((((product AS PRO INNER JOIN category AS CATE ON PRO.cate_id = CATE.id)
            INNER JOIN product_type AS PT ON PRO.pro_type_id = PT.id)
            INNER JOIN product_using AS PU ON PRO.pro_using_id = PU.id)
            INNER JOIN users ON PRO.uid = users.id)
            WHERE PRO.id = '$edit_id' ";

    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "des"=>$row[0],
            "cate_id"=>$row[1],
            "using_id"=>$row[2],
            "uid"=>$row[3],
            "status"=>$row[4],
            "type"=>$row[5],
        );
    }

    echo json_encode($data);

?>