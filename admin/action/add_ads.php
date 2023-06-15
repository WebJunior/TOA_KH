<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    include('active.php');
    $db=new Action;

    $edit_id=$_POST['edit-id'];

    $poster=$_POST['poster'];

    $name=$_POST['name'];
    $name=$db->real_string($name);

    $img=$_POST['txt-img-name'];

    $video=$_POST['txt-video'];

    $od=$_POST['od'];

    $status=$_POST['status'];

    $date_post=date("Y-m-d h:i:sa");

    $res['dpl']=false;
    $res['edit']=false;
    $dpl=$db->duplicate("*","ads","name = '$name' && id != '$edit_id'");
    if($dpl==false){
        if($edit_id==0){
            $tbl="ads";
            $val=" NULL,'$date_post','$poster','$name','$img','$video','$od','$status' ";
            $db->insert_into($tbl,$val);
            $res['id']=$db->last_id;
        }else{
            $res['edit']=true;
            $tbl="ads";
            $con="id = $edit_id";
            $fld="uid = '$poster',name = '$name', img = '$img', video = '$video', od='$od' , status='$status' ";
            $db->update($tbl,$fld,$con);
        }
    }else{
        $res['dpl']=true;
    }
    $res['date-post']= $date_post;
    echo json_encode($res);
?>