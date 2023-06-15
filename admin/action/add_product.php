<?php
    date_default_timezone_set("Asia/Phnom_Penh");
    $cn=new mysqli("localhost","root","","toa");
    $cn->set_charset("utf8");
    include('active.php');
    $db=new Action;

    $edit_id=$_POST['edit-id'];

    $category=$_POST['category'];

    $poster=$_POST['poster'];

    $name=$_POST['name'];

    $type=$_POST['type'];

    $using=$_POST['using'];

    $location=$_POST['location'];

    $od=$_POST['od'];

    $status=$_POST['status'];

    $image=$_POST['txt-img-name'];

    $des=$_POST['des'];

    $view='1';

    $name_link= $db->slugStr($name);

    $date_post=date("Y-m-d h:i:sa");

    $res['dpl']=false;
    $res['edit']=false;
    $tbl="product";
    $fld="*";
    $con="name = '$name' && id != '$edit_id'";
    $dpl=$db->duplicate($fld,$tbl,$con);
    if($dpl==false){
        if($edit_id==0){
            $sql="INSERT INTO product VALUES(NULL,'$date_post','$category','$name','$des','$image','$type','$using','$od','$view','$poster','$location','$name_link','$status')";
            $cn->query($sql);
            $res['id']=$db->last_id;
        }else{
            $edit="UPDATE product SET 
                                cate_id = '$category' , 
                                name = '$name' ,
                                description = '$des' ,
                                img = '$image' ,
                                pro_type_id = '$type' ,
                                pro_using_id = '$using' ,
                                od = '$od' ,
                                uid = '$poster' ,
                                location = '$location' ,
                                status = '$status'
                    WHERE id = $edit_id ";
            $cn->query($edit);
            $res['edit']=true;
        }
    }else{
        $res['dpl']=true;
    }
    $res['date-post']= $date_post;
    echo json_encode($res);
?>