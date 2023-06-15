<?php

    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $s=$_POST['s'];
    $e=$_POST['e'];
    $search=$_POST['search'];
    $filter_field=explode(" ",$_POST['filter_field']);
    $search_val=$_POST['search_val'];
    $fld =array(
        "0"=>"id",
        "1"=>"en_name",
        "2"=>"kh_name",
        "3"=>"od",
        "4"=>"status",
    );

    if($search==0){
        $sql="SELECT *,user.first_name,user.last_name FROM category AS CATE INNER JOIN users AS user ON user.id = CATE.uid ORDER BY CATE.id DESC LIMIT $s,$e";
        $sql_count="SELECT COUNT(*) FROM category";
    }else{
        if($filter_field[0]==0){
            $sql="SELECT *,user.first_name,user.last_name FROM category AS CATE INNER JOIN users AS user ON user.id = CATE.uid 
                WHERE CATE.".$fld[$filter_field[0]]." = '$search_val' ORDER BY CATE.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM category WHERE ".$fld[$filter_field[0]]." = '$search_val'";
        }else{
            $sql="SELECT *,user.first_name,user.last_name FROM category AS CATE INNER JOIN users AS user ON user.id = CATE.uid 
            WHERE CATE.".$fld[$filter_field[0]]." LIKE '%$search_val%' ORDER BY CATE.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM category WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%'";
        }
    }
    
    $rs=$cn->query($sql);
    $rs_count=$cn->query($sql_count);
    $row_count=$rs_count->fetch_array();

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "id"=>$row[0],
            "date_post"=>$row[1],
            "en-name"=>$row[3],
            "kh-name"=>$row[4],
            "color-code"=>$row[5],
            "od"=>$row[6],
            "status"=>$row[7],
            "poster_f_name"=>$row[9],
            "poster_l_name"=>$row[10],
            "count"=>$row_count[0],
        );
    }

    echo json_encode($data);

?>