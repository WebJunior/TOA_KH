<?php
    session_start();
    date_default_timezone_set("Asia/Phnom_Penh");
    $_SESSION['login']=false;

    include("active.php");
    $db=new Action;

    $uemail=$_POST['uemail'];
    $uemail=$db->real_string($uemail);

    $upass=$_POST['upass'];
    $upass=$db->real_string($upass);
    $upass=md5($upass);

    $ip=$_SERVER['REMOTE_ADDR'];

    $res['dpl']=false;
    $timelogin=date("d-M-y h:i:sa");

    $dpl=$db->duplicate("*","users"," email='$uemail' ");
    if($dpl==true){
        $post_data=$db->select_cur_data("*","users"," email='$uemail' ");
        if( password_verify( $upass , $post_data[6] ) ){
            $db->update("users","ip='$ip',time_login='$timelogin'","email='$uemail'");
            $res['dpl']=true;
            $_SESSION['login']=true;
            $_SESSION['uemail']=$uemail;
            $_SESSION['first_name']=$post_data[1];
            $_SESSION['last_name']=$post_data[2];
            $_SESSION['u_type']=$post_data[7]; 
        }
    }
    echo json_encode($res);
?>