<?php
    include('../_config_inc.php');
    $base_url=BASE_URL;
    $base_path=BASE_PATH;
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <link rel="icon" href="<?php echo $base_url ?>admin/css/file.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>admin/css/login.css">
</head>
<body>
    <div class="login">
        <form class="upl">
            <div class="frm">
                <div class="top">
                    <span>
                        Login Form
                    </span>
                </div>
                <div class="mid">
                    <label for="">Email :</label>
                    <input type="email" class="form-control" id="txt-email" name="txt-email" placeholder="Email@gmail.com">
                    <label for="">Password :</label>
                    <input type="password" class="form-control" id="txt-pass" name="txt-pass" placeholder="Password">
                </div>
                <div class="bottom">
                    <button type="button" class="btn btn-info">LOGIN</button>
                    <span id="btnNewPass">
                        forget password ?
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    $(document).ready(function(){
        body=$("body");
            // $("#btnNewPass").click(function(){
            //     var email = $("#txt-email");
            //     if(email.val()==""){
            //         alert("plase input Email");
            //         email.focus;
            //         return;
            //     }
            //     $.ajax({
            //         url:'action/new-pass.php',
            //         type:'POST',
            //         data:{uemail:email.val()},
            //         cache:false,
            //         dataType:"json",
            //         beforeSend:function(){
            //                 //work before success    
            //         },
            //         success:function(data){   
            //                 //work after success 
                            
            //         }				
            //     }); 
            // });
        // body.find(".bottom button").keypress(function(event){
        //     if(event.key === "Enter"){
        //         var email = $("#txt-email");
        //         var pass = $("#txt-pass");
        //         if(email.val()==""){
        //             alert("Plase input email");
        //             email.focus();
        //             return;
        //         }else if(pass.val()==""){
        //             alert("Plase input Password");
        //             pass.focus;
        //             return;
        //         }
        //         $.ajax({
        //             url:'action/login.php',
        //             type:'POST',
        //             data:{uemail:email.val(),upass:pass.val()},
        //             cache:false,
        //             dataType:"json",
        //             beforeSend:function(){
        //                     //work before success    
        //             },
        //             success:function(data){   
        //                     //work after success 
        //                     if(data.dpl==true){
        //                         window.location.href="admin.php"
        //                     }else{
        //                         alert("Wrong Password! Plase Login Again");
        //                     }
        //             }				
        //         }); 
        //     }
        // });
        $(".bottom").find("button").click(function(){
            var email = $("#txt-email");
            var pass = $("#txt-pass");
            if(email.val()==""){
                alert("Plase input email");
                email.focus();
                return;
            }else if(pass.val()==""){
                alert("Plase input Password");
                pass.focus;
                return;
            }
            $.ajax({
                url:'action/login.php',
                type:'POST',
                data:{uemail:email.val(),upass:pass.val()},
                cache:false,
                dataType:"json",
                beforeSend:function(){
                        //work before success    
                },
                success:function(data){   
                        //work after success 
                        if(data.dpl==true){
                            window.location.href="admin.php"
                        }else{
                            alert("Wrong Password! Plase Login Again");
                        }
                }				
            }); 
        });
    });
</script>
</html>