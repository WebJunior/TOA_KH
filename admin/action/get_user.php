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
        "1"=>"first_name",
        "2"=>"last_name	",
        "3"=>"gender",
        "4"=>"type",
        "7"=>"status",
    );

    if($search==0){
        $sql="SELECT * FROM users ORDER BY id DESC LIMIT $s,$e";
        $sql_count="SELECT COUNT(*) AS total_count FROM users ";
    }else{
        if($filter_field[0] == '0'){
            $sql="SELECT * FROM users WHERE ".$fld[$filter_field[0]]." = '$search_val' ORDER BY id DESC LIMIT $s,$e ";
            $sql_count="SELECT COUNT(*) AS total_count FROM users WHERE ".$fld[$filter_field[0]]." = '$search_val'";
        }else{
            $sql="SELECT * FROM users WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%' ORDER BY id DESC LIMIT $s,$e ";
            $sql_count="SELECT COUNT(*) AS total_count FROM users WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%'";
        }
    }

    $rs=$cn->query($sql);

    $rs_count=$cn->query($sql_count);
    $row_count=$rs_count->fetch_array();

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "id"=>$row[0], 
            "first-name"=>$row[1],  
            "last-name"=>$row[2], 
            "gender"=>$row[3], 
            "date-join"=>$row[4], 
            "email"=>$row[5], 
            "type"=>$row[7], 
            "status"=>$row[8], 
            "count"=>$row_count[0],
        );
    }

    echo json_encode($data);
?>