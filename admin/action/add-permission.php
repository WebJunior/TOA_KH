<?php

    include('active.php');
    $db=new Action;

    $mid= $_POST['mid'];
    $uid= $_POST['uid'];
    $aid= $_POST['aid'];

    $res['edit']=false;

    $dpl=$db->duplicate("*","permission"," uid=$uid && mid=$mid ");

    if($dpl==false){
        $db->insert_into("permission","null,$uid,$mid,$aid");
    }else{
        $fld="aid=$aid";
        $con="uid=$uid && mid=$mid";
        $db->update("permission",$fld,$con);
        $res['edit']=true;
    }

    echo json_encode($res);

?>