<?php
    include('active.php');
    $db=new Action;
    $uid=$_POST['uid'];
    $data=array();

    $get_data=$db->select( "*" , "permission" , "id > 0" , "uid = 13" , 0 , 100 , 0, 0 , 0 , 0 );
    if( $get_data != 0 ){
        foreach( $get_data as $row ){
            $data[]=array(
                "uid"=>$row[1],
                "mid"=>$row[2],
                "aid"=>$row[3], 
            );
        }
    }

    echo json_encode($data);
?>