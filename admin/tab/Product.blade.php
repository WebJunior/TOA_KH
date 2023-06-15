<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product-Tab</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="{{asset('js\tinymce\js\tinymce\tinymce.min.js')}}"></script>
    <link rel="icon" href="{{URL('css/file.jpg')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>
    <div class="tab" data-opt="3">
        <div class="bar">
            <div class="box1">
                <div class="box" id='main-page'>
                    <a href="{{route('admin')}}"><i class="fa-solid fa-angles-left"></i></a>
                </div>
            </div>
            <div class="box3">
                <div class="box" id="btn">
                    <i class="fa-solid fa-square-plus"></i>
                </div>
                <div class="show">
                    <p>Show</p> 
                    <select name="" id="limit-data">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="box2">
                <div class="box" style="border-bottom-left-radius: 20px; border-top-left-radius: 20px; border-right: 0;">
                    <input type="text" id='txt-search-val' name='txt-search-val' style="text-align:right; padding-right:10px">
                </div>
                <div class="box" style="border-bottom-right-radius: 20px; border-top-right-radius: 20px">
                    <div class="select">
                        <select id="txt-filter-field" name="txt-filter-field" style="padding:10px">
                            <!-- <option value=""></option>
                            <option value="Name">Name</option>
                            <option value="gender">Gender</option>
                            <option value="type">Type</option>
                            <option value="date-birth">Date-birth</option>
                            <option value="date-join">Date-join</option> -->
                        </select>
                    </div>
                    <div class="btn">
                        <i class="fa-regular fa-magnifying-glass" id='btn-search'></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="pigination">
            <div class="left">
                <p> Showing <span id='page-current'> 0 </span> to <span id='page-total'> 0 </span> of <span id='data-total'> 0 </span> </p>
            </div>
            <div class="right">
                <div class="next" id='next'>
                    <p>NEXT</p>
                </div>
                <div class="page">
                    <span id='current-page'> 0 </span>
                </div>
                <div class="back" id='back'>
                    <p>BACK</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Developed by <a style="color:navy;text-decoration:none" href="https://web.facebook.com/profile.php?id=100077355072497" target="_blank"> IceTeaJunior </a></p> 
        </div>
    </div>
</body>
<script src="{{asset('js/admin/admin.js')}}"></script>
</html>