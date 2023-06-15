<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    include('active.php');
    $db=new Action;

    $edit_id=$_POST['edit-id'];

    $poster=$_POST['poster'];

    $en_name=$_POST['en-name'];
    $en_name=$db->real_string($en_name);

    $kh_name=$_POST['kh-name'];
    $kh_name=$db->real_string($kh_name);

    $od=$_POST['od'];

    $status=$_POST['status'];

    $date_post=date("Y-m-d h:i:sa");

    $res['dpl']=false;
    $res['edit']=false;
    $dpl=$db->duplicate("*","menu","en_name = '$en_name' && id != '$edit_id'");
    if($dpl==false){
        if($edit_id==0){
            $tbl="menu";
            $val=" NULL,'$date_post','$poster','$en_name','$kh_name','$od','$status' ";
            $db->insert_into($tbl,$val);
            $res['id']=$db->last_id;
        }else{
            $res['edit']=true;
            $tbl="menu";
            $con="id = $edit_id";
            $fld="date_post ='$date_post' , uid = '$poster' ,en_name = '$en_name',kh_name='$kh_name', od='$od' , status='$status' ";
            $db->update($tbl,$fld,$con);
        }
    }else{
        $res['dpl']=true;
    }
    $res['date-post']= $date_post;
    echo json_encode($res);
?>