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
        $sql="SELECT *,user.first_name,user.last_name FROM menu AS menu INNER JOIN users AS user ON user.id = menu.uid ORDER BY menu.id DESC LIMIT $s,$e";
        $sql_count="SELECT COUNT(*) FROM menu";
    }else{
        if($filter_field[0]==0){
            $sql="SELECT *,user.first_name,user.last_name FROM menu AS menu INNER JOIN users AS user ON user.id = menu.uid 
                WHERE menu.".$fld[$filter_field[0]]." = '$search_val' ORDER BY menu.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM menu WHERE ".$fld[$filter_field[0]]." = '$search_val'";
        }else{
            $sql="SELECT *,user.first_name,user.last_name FROM menu AS menu INNER JOIN users AS user ON user.id = menu.uid 
            WHERE menu.".$fld[$filter_field[0]]." LIKE '%$search_val%' ORDER BY menu.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM menu WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%'";
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
            "od"=>$row[5],
            "status"=>$row[6],
            "poster_f_name"=>$row[8],
            "poster_l_name"=>$row[9],
            "count"=>$row_count[0],
        );
    }

    echo json_encode($data);

?>