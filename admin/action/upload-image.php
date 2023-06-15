<?php
    $file = $_FILES['txt-img'];

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $img_name = rand(100000, 999999).'-'.time().'.'.$ext;

    $txt_img_name = $_POST['txt-img-name'];

    $tmp_name = $file['tmp_name'];

    move_uploaded_file($tmp_name,'../img/'.$img_name);

    $msg['img-name']=$img_name;

    echo json_encode($msg);
?>