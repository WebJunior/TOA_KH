<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    include('active.php');
    $db=new Action;

    $edit_id=$_POST['edit-id'];

    $fn=$_POST['first-name'];
    $fn=$db->real_string($fn);

    $ln=$_POST['last-name'];
    $ln=$db->real_string($ln);

    $gen=$_POST['gender'];
    $gen=$db->real_string($gen);

    $date_j=$_POST['date-join'];

    $email=$_POST['email'];
    $email=$db->real_string($email);

    $pass=$_POST['pass'];
    $pass= md5($pass);
    $pass= password_hash( $pass , PASSWORD_DEFAULT );

    $type=$_POST['type'];
    $type=$db->real_string($type);

    $status=$_POST['status'];

    $ip="0000";

    $date_login=date("Y-m-d h:i:sa");

    $res['dpl']=false;
    $res['edit']=false;
    $dpl=$db->duplicate("*","users","first_name = '$fn' && id != $edit_id");
    if($dpl==false){
        if( $edit_id != 0 ){
            $res['edit']=true;
            $tbl="users";
            $con="id = $edit_id";
            $fld=" first_name='$fn',last_name='$ln',gender='$gen',date_join='$date_j',
                   email='$email',password='$pass',type='$type',status='$status' ";
            $db->update($tbl,$fld,$con);
        }else{
            $tbl="users";
            $val="NULL,'$fn','$ln','$gen','$date_j','$email','$pass','$type','$status','$ip','$date_login'";
            $db->insert_into($tbl,$val);
            $res['id']=$db->last_id;
        }
    }else{
        $res['dpl']=true;
    }

    echo json_encode($res);
?>