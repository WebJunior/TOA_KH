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
        "1"=>"name",
        "2"=>"cate_id",
        "3"=>"pro_type_id",
        "4"=>"pro_using_id",
        "5"=>"uid",
        "6"=>"od",
        "7"=>"status",
    );

    if($search==0){
        $sql = "SELECT 
                    PRO.id,
                    PRO.date_post,
                    PRO.name,
                    PRO.img,
                    CATE.en_name,
                    CATE.kh_name,
                    PT.en_name,
                    PT.kh_name,
                    PU.en_name,
                    PU.kh_name,
                    users.first_name,
                    users.last_name,
                    PRO.location,
                    PRO.od,
                    PRO.status
                FROM ((((product AS PRO INNER JOIN category AS CATE ON PRO.cate_id = CATE.id)
                INNER JOIN product_type AS PT ON PRO.pro_type_id = PT.id)
                INNER JOIN product_using AS PU ON PRO.pro_using_id = PU.id)
                INNER JOIN users ON PRO.uid = users.id)
                ORDER BY PRO.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM product";
    }else{
        if($filter_field[0]==0){
            $sql = "SELECT 
                    PRO.id,
                    PRO.date_post,
                    PRO.name,
                    PRO.img,
                    CATE.en_name,
                    CATE.kh_name,
                    PT.en_name,
                    PT.kh_name,
                    PU.en_name,
                    PU.kh_name,
                    users.first_name,
                    users.last_name,
                    PRO.location,
                    PRO.od,
                    PRO.status
                FROM ((((product AS PRO INNER JOIN category AS CATE ON PRO.cate_id = CATE.id)
                INNER JOIN product_type AS PT ON PRO.pro_type_id = PT.id)
                INNER JOIN product_using AS PU ON PRO.pro_using_id = PU.id)
                INNER JOIN users ON PRO.uid = users.id)
                WHERE PRO.".$fld[$filter_field[0]]." = '$search_val'
                ORDER BY PRO.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM product AS PRO WHERE PRO.".$fld[$filter_field[0]]." = '$search_val'";
        }else{
            $sql = "SELECT 
                    PRO.id,
                    PRO.date_post,
                    PRO.name,
                    PRO.img,
                    CATE.en_name,
                    CATE.kh_name,
                    PT.en_name,
                    PT.kh_name,
                    PU.en_name,
                    PU.kh_name,
                    users.first_name,
                    users.last_name,
                    PRO.location,
                    PRO.od,
                    PRO.status
                FROM ((((product AS PRO INNER JOIN category AS CATE ON PRO.cate_id = CATE.id)
                INNER JOIN product_type AS PT ON PRO.pro_type_id = PT.id)
                INNER JOIN product_using AS PU ON PRO.pro_using_id = PU.id)
                INNER JOIN users ON PRO.uid = users.id)
                WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%'
                ORDER BY PRO.id DESC LIMIT $s,$e";
            $sql_count="SELECT COUNT(*) FROM product WHERE ".$fld[$filter_field[0]]." LIKE '%$search_val%'";
        }
    }

    $rs=$cn->query($sql);
    $rs_count=$cn->query($sql_count);
    $row_count=$rs_count->fetch_array();

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
            "id"=>$row[0],
            "date-post"=>$row[1],
            "name"=>$row[2],
            "img"=>$row[3],
            "category"=>$row[4],
            "pro-type"=>$row[6],
            "using"=>$row[8],
            "poster_f_name"=>$row[10],
            "poster_l_name"=>$row[11],
            "location"=>$row[12],
            "od"=>$row[13],
            "status"=>$row[14],
            "count"=>$row_count[0],
        );
    }

    echo json_encode($data);
?>