<?php
    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");

    $cate_id=$_POST['cate_id'];
    $s=$_POST['s'];
    $e=$_POST['e'];

    if($cate_id==0){
      $sql="SELECT PD.name,PU.en_name,PU.kh_name,PD.img,PD.cate_id,PD.id FROM product AS PD 
        INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
        ORDER BY PD.od DESC LIMIT $s,$e";
    }else{
      $sql="SELECT PD.name,PU.en_name,PU.kh_name,PD.img,PD.cate_id,PD.id FROM product AS PD 
            INNER JOIN product_using AS PU ON PD.pro_using_id =PU.id 
            WHERE PD.cate_id=$cate_id ORDER BY PD.od DESC LIMIT $s,$e";
    }
    $rs=$cn->query($sql);

    $data=array();
    while($row=$rs->fetch_array()){
        $data[]=array(
          "pro_name"=>$row[0],
          "en_using"=>$row[1],
          "kh_using"=>$row[2],
          "img"=>$row[3],  
          "cate_id"=>$row[4],  
          "id"=>$row[5],  
        );
    }

    echo json_encode($data);
?>