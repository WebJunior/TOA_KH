<?php
    $file = $_FILES['txt-video'];

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $video_name = rand(100000, 999999).'-'.time().'.'.$ext;

    $txt_video_name = $_POST['txt-video-name'];

    $tmp_name = $file['tmp_name'];

    move_uploaded_file($tmp_name,'../video/'.$video_name);

    $msg['video-name']=$video_name;

    echo json_encode($msg);
?>