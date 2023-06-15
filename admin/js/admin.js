$(document).ready(function(){
    let body = $("body");
    var popUP='<div class="popUP"></div>';
    var loading='<div class="popUP"><div class="loading"></div></div>';
    var permission='<i class="fa-solid fa-gear" id="permission" style="margin-left:10px"></i>';
    var frm={
        "1":"frm-user.php",
        "2":"frm-menu.php",
        "5":"frm-product.php",
        "6":"frm-pro-type.php",
        "7":"frm-category.php",
        "8":"frm-pro-using.php",
        "9":"frm-ads.php",
    };
    var filter=[
        // 0 is = , 1 is LIKE
        //1=id ; 2=name ; 3=status
        {}, // opt=0
        {"0 0":"ID","1 1":"FIRST-NAME","2 1":"LAST-NAME","3 1":"GENDER","4 1":"TYPE","7 0":"STATUS"}, // opt=1 check
        {"0 0":"ID","1 1":"EN-NAME","2 1":"KH-NAME","3 0":"OD","4 0":"STATUS"}, // opt=2 check
        {}, // opt=3
        {}, // opt=4
        {"0 0":"ID","1 1":"NAME","2 1":"CATEGORY-ID","3 1":"PRODUCT-TYPE-ID","4 1":"USING-ID","5 1":"POSTER-ID","6 0":"OD","7 0":"STATUS"}, // option=5
        {"0 0":"ID","1 1":"EN-NAME","2 1":"KH-NAME","3 0":"OD","4 0":"STATUS"}, // option=6 
        {"0 0":"ID","1 1":"EN-NAME","2 1":"KH-NAME","3 0":"OD","4 0":"STATUS"}, // option=7 
        {"0 0":"ID","1 1":"EN-NAME","2 1":"KH-NAME","3 0":"OD","4 0":"STATUS"}, // option=8
        {"0 0":"ID","1 1":"NAME","3 0":"OD","4 0":"STATUS"}, // option=9
        {"0 0":"ID","1 1":"NAME","3 0":"OD","4 0":"STATUS"}, // option=10
    ];
    var hide='hide';
    var opt=0;
    var option=0;
    var search=0;
    var search_val=$("#txt-search-val");
    var filter_field= $("#txt-filter-field");
    var current_page=$("#page-current");
    var page_total=$("#page-total");
    var data_total=$("#data-total");
    var limit_data=$("#limit-data");
    var p_current=$("#current-page");
    // product
    var search_pro=0;
    var search_val_pro=$(".product-list").find("#txt-search-val");
    var filter_field_pro=$(".product-list").find("#txt-filter-field");
    var current_page_pro=$(".product-list").find("#page-current");
    var page_total_pro=$(".product-list").find("#page-total");
    var data_total_pro=$(".product-list").find("#data-total");
    var limit_data_pro=$(".product-list").find("#limit-data");
    var p_current_pro=$(".product-list").find("#current-page");
    s=0;
    s_pro=0;
    e=limit_data.val();
    e_pro=limit_data_pro.val();
    //back login
    $(".main").on('click','.log-out',function(){
        window.location.href="http://localhost/php/TOA/admin/";
    });
    //back
    $(".tab").on('click','.box1 #main-page',function(){
        $(".main").show();
        $(".tab").hide();
        search_val.val("");
    });
    $(".product-list").on('click','.left-box ul li#back',function(){
        $(".product-list").hide();
        $(".main").show();
        $(".product-list").find(".right-box").hide();
        body.find(".product-list .left-box ul li").removeClass("active");
    });
    //add data
    body.on('click','.frm #add',function(){
        var eThis=$(this);
        if(opt==1){
            $(".tab").show();
            add_user(eThis);
        }else if(opt==2){
            $(".tab").show();
            add_menu(eThis);
        }else if(opt==3){
            if(option==5){
                add_product(eThis);
            }else if(option==6){
                add_pro_type(eThis);
            }else if(option==7){
                add_category(eThis);
            }else if(option==8){
                add_pro_using(eThis);
            }else if(option==9){
                add_ads(eThis);
            }
        }else if(opt==4){
            $(".tab").show();
        }
    });
    //get data
    $(".main").on('click','.bar2 #click',function(){
        hide='';
        s=0;
        var eThis=$(this);
        var role=eThis.data("role");
        if(role==2){
            body.find(".tab .bar #btn").css({"pointer-events":"none"});
            body.find(".tab .bar #btn").css({"opacity":"0.3"});
            hide='hide';
        }else{
            body.find(".tab .bar #btn").css({"pointer-events":"auto"});
            body.find(".tab .bar #btn").css({"opacity":"1"});
        }
        opt = eThis.data("opt");
        search=0;

        //set filter field
        var obj1=filter[opt];
        var txt='<option value="0 0">---Select Option---</option>';
        for (const key of Object.keys(obj1)) {
            txt+=`<option value="${key}">${obj1[key]}</option>`;
        }
        filter_field.html(txt);

        current_page.text(1);
        p_current.text(current_page.text());
        if(opt==1){
            $(".tab").show();
            get_user();
        }else if(opt==2){
            $(".tab").show();
            get_menu();
        }else if(opt==3){
            $(".product-list").show();
        }else if(opt==4){
            $(".tab").show();
            product_orders();
        }
        body.find(".product-list .left-box ul li").click(function(){
            hide='';
            var role=$(this).data("role");
            if(role==2){
                body.find(".product-list .bar #btn").css({"pointer-events":"none"});
                body.find(".product-list .bar #btn").css({"opacity":"0.3"});
                hide='hide';
            }else{
                body.find(".product-list .bar #btn").css({"pointer-events":"auto"});
                body.find(".product-list .bar #btn").css({"opacity":"1"});
            }
            s_pro=0;
            var eThis=$(this);
            search_pro=0;
            search_val_pro.val("");
            current_page_pro.text(1);
            p_current_pro.text(current_page_pro.text());
            eThis.addClass("active").siblings().removeClass("active");
            option = $(this).data("option");
            var obj1_pro=filter[option];
            var txt='<option value="0 0">---Select Option---</option>';
            for (const key of Object.keys(obj1_pro)) {
                txt+=`<option value="${key}">${obj1_pro[key]}</option>`;
            }
            filter_field_pro.html(txt);

            if(option==5){
                $(".product-list .right-box").show();
                get_product();
            }else if(option==6){
                $(".product-list .right-box").show();
                get_pro_type();
            }else if(option==7){
                $(".product-list .right-box").show();
                get_category();
            }else if(option==8){
                $(".product-list .right-box").show();
                get_pro_using();
            }else if(option==9){
                $(".product-list .right-box").show();
                get_ads();
            }
        });
    });
    //edit data
    $(".ctr-tbl").on('click','#edit',function(){
        var eThis=$(this);
        if(opt==1){
            $(".tab").show();
            edit_user(eThis);
        }else if(opt==2){
            $(".tab").show();
            edit_menu(eThis);
        }else if(opt==3){
            if(option==5){
                edit_product(eThis);
            }else if(option==6){
                edit_pro_type(eThis);
            }else if(option==7){
                edit_category(eThis);
            }else if(option==8){
                edit_pro_using(eThis);
            }else if(option==9){
                edit_ads(eThis);
            }
        }else if(opt==4){
            $(".tab").show();
        }
    });
    //limit data
    limit_data.change(function(){
        s=0;
        e=$(this).val();
        current_page.text(1);
        p_current.text(current_page.text());
        if(opt==1){
            $(".tab").show();
            get_user();
        }else if(opt==2){
            $(".tab").show();
            get_menu();
        }else if(opt==4){
            $(".tab").show();
            product_orders();
        }
    });
    //limit data pro
    limit_data_pro.change(function(){
        s_pro=0;
        e_pro=$(this).val();
        current_page_pro.text(1);
        p_current_pro.text(current_page_pro.text());
        if(option==5){
            get_product();
        }else if(option==6){
            get_pro_type();
        }else if(option==7){
            get_category();
        }else if(option==8){
            get_pro_using();
        }else if(option==9){
            get_ads();
        }
    });
    //next page
    $(".tab").on('click','#next',function(){
        if( current_page.text() != page_total.text() && page_total.text()!=0){
            s =parseInt(s) + parseInt(e);
            current_page.text( parseInt(current_page.text())+1 );
            p_current.text(current_page.text());
        }
        if(opt==1){
            $(".tab").show();
            get_user();
        }else if(opt==2){
            $(".tab").show();
            get_menu();
        }else if(opt==4){
            $(".tab").show();
            product_orders();
        }
    });
    //next page product
    $(".product-list").on('click','#next',function(){
        if( current_page_pro.text() != page_total_pro.text() && page_total_pro.text() != 0){
            s_pro =parseInt(s_pro) + parseInt(e_pro);
            current_page_pro.text( parseInt(current_page_pro.text())+1 );
            p_current_pro.text(current_page_pro.text());
        }
        if(option==5){
            get_product();
        }else if(option==6){
            get_pro_type();
        }else if(option==7){
            get_category();
        }else if(option==8){
            get_pro_using();
        }else if(option==9){
            get_ads();
        }
    });
    //back page
    $(".tab").on('click','#back',function(){
        if( current_page.text() <= 1 ){
            return;
        }else{
            s =parseInt(s) - parseInt(e);
            current_page.text( parseInt(current_page.text())-1 );
            p_current.text(current_page.text());
        }
        if(opt==1){
            $(".tab").show();
            get_user();
        }else if(opt==2){
            $(".tab").show();
            get_menu();
        }else if(opt==4){
            $(".tab").show();
            product_orders();
        }
    });
    //back page product
    $(".product-list").on('click','#back',function(){
        if( current_page_pro.text() <= 1 ){
            return;
        }else{
            s_pro =parseInt(s_pro) - parseInt(e_pro);
            current_page_pro.text( parseInt(current_page_pro.text())-1 );
            p_current_pro.text(current_page_pro.text());
        }
        if(option==5){
            get_product();
        }else if(option==6){
            get_pro_type();
        }else if(option==7){
            get_category();
        }else if(option==8){
            get_pro_using();
        }else if(option==9){
            get_ads();
        }
    });
    //search
    $("#btn-search").click(function(){
        search=1;
        if(opt==1){
            $(".tab").show();
            get_user();
        }else if(opt==2){
            $(".tab").show();
            get_menu();
        }else if(opt==4){
            $(".tab").show();
            product_orders();
        }
    });
    //search product
    $(".product-list").find("#btn-search").click(function(){
        search_pro=1;
        if(option==5){
            get_product();
        }else if(option==6){
            get_pro_type();
        }else if(option==7){
            get_category();
        }else if(option==8){
            get_pro_using();
        }else if(option==9){
            get_ads();
        }
    });
    //keyup search
    body.on('keyup',".tab .box2 #txt-search-val",function(){
        var emp=body.find(".tab .box2 #txt-filter-field");
        if( emp.val() != "0 0" ){
            search=1;
            if(opt==1){
                $(".tab").show();
                get_user();
            }else if(opt==2){
                $(".tab").show();
                get_menu();
            }else if(opt==4){
                $(".tab").show();
                product_orders();
            }
        }
    });
    //keyup search product
    body.on('keyup',".product-list .right-box .box2 #txt-search-val",function(){
        var emp_pro=body.find(".product-list .right-box .box2 #txt-filter-field");
        if( emp_pro.val() != "0 0" ){
            search_pro=1;
            if(option==5){
                get_product();
            }else if(option==6){
                get_pro_type();
            }else if(option==7){
                get_category();
            }else if(option==8){
                get_pro_using();
            }else if(option==9){
                get_ads();
            }
        }
    });
    // get auto id
    function getAutoID(){
        $.ajax({
            url:'action/auto-id.php',
            type:'POST',
            data:{ ind:opt },
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                body.find(".frm #id").val( parseInt(data['id']) +1 ); 
                body.find(".frm #od").val( parseInt(data['id']) +1 );  
            }				
        }); 
    }
    // get auto id product list
    function getAutoID_Pro_list(){
        $.ajax({
            url:'action/auto-id.php',
            type:'POST',
            data:{ ind:option },
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                body.find(".frm #id").val( parseInt(data['id']) +1 ); 
                body.find(".frm #od").val( parseInt(data['id']) +1 );  
            }				
        }); 
    }
    //close form
    body.on('click','.frm #cancel',function(){
        body.find(".popUP").remove();
    });
    //load form
    $(".tab").on('click','.box3 #btn',function(){
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[opt], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                calleditor();
                getAutoID();
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
    //load form product
    $(".product-list").on('click','.right-box .box3 #btn',function(){
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                calleditor();
                getAutoID_Pro_list()
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
    //get image
    body.on('change','.frm .txt-img',function(){
        var eThis=$(this);
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        var parent=eThis.parents('.frm');
        var photo=parent.find(".photo");
        var img_name=parent.find("#txt-img-name");
        $.ajax({
            url:'action/upload-image.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success
                    body.append(loading);       
            },
            success:function(data){  
                    photo.css({"background-image":`url(img/${data['img-name']})`});
                    photo.css({"background-size":"cover"});
                    img_name.val(data['img-name']);
                    body.find(".popUP").last().remove();
            }				
        }); 
    });
    //upload video
    body.on('change','.frm .txt-video',function(){
        var eThis=$(this);
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        var parent=eThis.parents('.frm');
        var video=parent.find(".video");
        var video_name=parent.find("#txt-video-name");
        $.ajax({
            url:'action/upload-video.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success
                    body.append(loading);       
            },
            success:function(data){  
                    video.css({"background-image":`url(video/${data['video-name']})`});
                    video.css({"background-size":"cover"});
                    video_name.val(data['video-name']);
                    body.find(".popUP").last().remove();
            }				
        }); 
    });
    //=========================================================ORDERS======================================================
    function product_orders(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th width="50">ID</th>
                <th width="200">Name</th>
                <th width="200">Address</th>
                <th width="200">Phone-Number</th>
                <th width="350">Description</th>
                <th width="50">Image</th>
                <th width="50">Qty</th>
                <th style="text-align:center" width="50">Status</th>
                <th style="text-align:center" width="50">Active</th>
            </tr>
        `;
        tbl.html(tr);
    }
    //=========================================================MENU======================================================
    //add
    function add_menu(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var poster=parent.find("#poster");
        var en_name=parent.find("#en-name");
        var kh_name=parent.find("#kh-name");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(poster.val()==0){
            alert("Plase chooes poster !!!");
            poster.focus();
            return;
        }else if(en_name.val()==0){
            alert("Plase chooes poster !!!");
            en_name.focus();
            return;
        }else if(kh_name.val()==0){
            alert("Plase chooes poster !!!");
            kh_name.focus();
            return;
        }
        $.ajax({
            url:'action/add_menu.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(en_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(kh_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center" style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        en_name.val("");
                        kh_name.val("");
                    } 
                    // body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_menu(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th width="50">ID</th>
                <th width="200">Date-Post</th>
                <th>Poster</th>
                <th>En-Name</th>
                <th>Kh-Name</th>
                <th width="50">OD</th>
                <th style="text-align:center" width="50">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_menu.php',
            type:'POST',
            data:{s:s ,e:e ,search:search ,filter_field:filter_field.val(),search_val:search_val.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);    
            },
            success:function(data){ 
                var td='';
                if(data.length==0){
                    data_total.text(0);
                    page_total.text(0);
                    tbl.html(tr);
                }else{  
                    data_total.text(data[0]['count']);
                    page_total.text( Math.ceil(data[0]['count'] / e) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else if(e.status==0){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_menu(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var en_name=tr.find("td:eq(3)").text();
        var kh_name=tr.find("td:eq(4)").text();
        var od=tr.find("td:eq(5)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[opt], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #en-name").val(en_name);
                body.find(".frm #kh-name").val(kh_name);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_menu.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //=========================================================product======================================================
    //add
    function add_product(eThis){
        tinymce.triggerSave();
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var category=parent.find("#category");
        var using=parent.find("#using");
        var poster=parent.find("#poster");
        var name=parent.find("#name");
        var type=parent.find("#type");
        var location=parent.find("#location");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var img=parent.find("#txt-img-name");
        var des=parent.find("#des");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(name.val()==""){
            alert("Plase Input Name !!!");
            name.focus();
            return;
        }else if(poster.val()==0){
            alert("Plase Select poster !!!");
            poster.focus();
            return;
        }else if(category.val()==0){
            alert("Plase Select category !!!");
            category.focus();
            return;
        }else if(type.val()==0){
            alert("Plase Select type !!!");
            type.focus();
            return;
        }else if(using.val()==0){
            alert("Plase Select using !!!");
            using.focus();
            return;
        }
        $.ajax({
            url:'action/add_product.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if(data['edit']==true){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3) img").attr("src",`img/${img.val()}`);
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3) img").attr("alt",`${img.val()}`);
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(category.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(type.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(using.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(7)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(8)").text(location.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(9)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(10)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td += `
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${name.val()}</td>
                                    <td align="center">
                                        <img src="img/${img.val()}" alt="${img.val()}">
                                    </td>
                                    <td align="center">${category.find('option:selected').text()}</td>
                                    <td align="center">${type.find('option:selected').text()}</td>
                                    <td align="center">${using.find('option:selected').text()}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${location.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td += `
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">date-post.val()</td>
                                    <td align="center">${name.val()}</td>
                                    <td align="center">
                                        <img src="img/${img.val()}" alt="${img.val()}">
                                    </td>
                                    <td align="center">${category.find('option:selected').text()}</td>
                                    <td align="center">${type.find('option:selected').text()}</td>
                                    <td align="center">${using.find('option:selected').text()}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${location.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        name.val("");
                        name.focus();
                        category.val(0);
                        poster.val(0);
                        using.val(0);
                        type.val(0);
                        location.val("");
                        img.css({"backgorund-image":"url(css/img-icon.png)"});
                        img.css({"background-size": "50px"});
                        tinyMCE.activeEditor.setContent('');
                    }
                }
                    //work after success        
            }				
        }); 
    }
    // get
    function get_product(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th width="50">ID</th>
                <th width="100">Date-post</th>
                <th width="350">Name</th>
                <th width="60">Image</th>
                <th width="150">Category</th>
                <th width="150">Pro Type</th>
                <th width="300">Using</th>
                th>Product Type</th>
                <th width="100">Poster</th>
                <th width="50">Loc</th>
                <th width="50">OD</th>
                <th style="text-align:center" width="50">Status</th>
                <th style="text-align:center" >Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_product.php',
            type:'POST',
            data:{s:s_pro ,e:e_pro ,search:search_pro ,filter_field:filter_field_pro.val(),search_val:search_val_pro.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success  
                    body.append(loading);      
            },
            success:function(data){   
                if(data.length==0){
                    data_total_pro.text(0);
                    page_total_pro.text(0);
                    tbl.html(tr);
                }else{
                    var td='';
                    data_total_pro.text(data[0]['count']);
                    page_total_pro.text( Math.ceil(data[0]['count'] / e_pro) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date-post']}</td>
                                    <td align="center">${e['name']}</td>
                                    <td align="center">
                                        <img src="img/${e['img']}" alt="${e['img']}">
                                    </td>
                                    <td align="center">${e['category']}</td>
                                    <td align="center">${e['pro-type']}</td>
                                    <td align="center">${e['using']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['location']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date-post']}</td>
                                    <td align="center">${e['name']}</td>
                                    <td align="center">
                                        <img src="img/${e['img']}" alt="${e['img']}">
                                    </td>
                                    <td align="center">${e['category']}</td>
                                    <td align="center">${e['pro-type']}</td>
                                    <td align="center">${e['using']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['location']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td);
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_product(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var name=tr.find("td:eq(2)").text();
        var img=tr.find("td:eq(3) img").attr("alt");
        var location=tr.find("td:eq(8)").text();
        var od=tr.find("td:eq(9)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #name").val(name);
                body.find(".frm .photo").css({"background-image":`url(img/${img})`});
                body.find(".frm .photo").css({"background-size":"cover"});
                body.find(".frm .photo #txt-img-name").val(img);
                body.find(".frm #location").val(location);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_product.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #category").val(e.cate_id);
                            body.find(".frm #type").val(e.type);
                            body.find(".frm #using").val(e.using_id);
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #des").val(e.des);
                            body.find(".frm #status").val(e.status);
                        });
                        calleditor();
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //=========================================================ADS======================================================
    //add
    function add_ads(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var poster=parent.find("#poster");
        var name=parent.find("#name");
        var img=parent.find("#txt-img-name");
        var video=parent.find("#txt-video");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(poster.val()==0){
            alert("Plase chooes poster !!!");
            poster.focus();
            return;
        }else if(name.val()==0){
            alert("Plase chooes poster !!!");
            name.focus();
            return;
        }
        $.ajax({
            url:'action/add_ads.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4) img").attr("src",`img/${img.val()}`);
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4) img").attr("alt",`${img.val()}`);
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5) ").text(video.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(7)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${name.val()}</td>
                                    <td align="center">
                                        <img src="img/${img.val()}" alt="${img.val()}">
                                    </td>
                                    <td align="center">${video.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${name.val()}</td>
                                    <td align="center">
                                        <img src="img/${img.val()}" alt="${img.val()}">
                                    </td>
                                    <td align="center">${video.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        name.val("");
                        img.css({"backgorund-image":"url(css/img-icon.png)"});
                        img.css({"background-size": "50px"});
                        video.css({"backgorund-image":"url(css/img-icon.png)"});
                        video.css({"background-size": "50px"});
                    } 
                    // body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_ads(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th width="50">ID</th>
                <th width="100">Date-Post</th>
                <th>Poster</th>
                <th width="400">Name</th>
                <th>IMAGE</th>
                <th width="400">VIDEO</th>
                <th width="50">OD</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_ads.php',
            type:'POST',
            data:{s:s_pro ,e:e_pro ,search:search_pro ,filter_field:filter_field_pro.val(),search_val:search_val_pro.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);    
            },
            success:function(data){ 
                var td='';
                if(data.length==0){
                    data_total_pro.text(0);
                    page_total_pro.text(0);
                    tbl.html(tr);
                }else{  
                    data_total_pro.text(data[0]['count']);
                    page_total_pro.text( Math.ceil(data[0]['count'] / e_pro) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['name']}</td>
                                    <td align="center">
                                        <img src="img/${e['img']}" alt="${e['img']}">
                                    </td>
                                    <td align="center">${e['video']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else if(e.status==0){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['name']}</td>
                                    <td align="center">
                                        <img src="img/${e['img']}" alt="${e['img']}">
                                    </td>
                                    <td align="center">${e['video']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td align="center">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_ads(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var name=tr.find("td:eq(3)").text();
        var img=tr.find("td:eq(4) img").attr("alt");
        var video=tr.find("td:eq(5)").text();
        var od=tr.find("td:eq(6)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #name").val(name);
                body.find(".frm .photo").css({"background-image":`url(img/${img})`});
                body.find(".frm .photo").css({"background-size":"cover"});
                body.find(".frm .photo #txt-img-name").val(img);
                body.find(".frm #txt-video").val(video);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_ads.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //=========================================================product-using======================================================
    //add
    function add_pro_using(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var poster=parent.find("#poster");
        var en_name=parent.find("#en-name");
        var kh_name=parent.find("#kh-name");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(poster.val()==0){
            alert("Plase chooes poster !!!");
            poster.focus();
            return;
        }else if(en_name.val()==0){
            alert("Plase chooes poster !!!");
            en_name.focus();
            return;
        }else if(kh_name.val()==0){
            alert("Plase chooes poster !!!");
            kh_name.focus();
            return;
        }
        $.ajax({
            url:'action/add_pro_using.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(en_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(kh_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center" style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        en_name.val("");
                        kh_name.val("");
                    } 
                    // body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_pro_using(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th>ID</th>
                <th>Date-Post</th>
                <th>Poster</th>
                <th>En-Name</th>
                <th>Kh-Name</th>
                <th>OD</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_pro_using.php',
            type:'POST',
            data:{s:s_pro ,e:e_pro ,search:search_pro ,filter_field:filter_field_pro.val(),search_val:search_val_pro.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);    
            },
            success:function(data){ 
                var td='';
                if(data.length==0){
                    data_total_pro.text(0);
                    page_total_pro.text(0);
                    tbl.html(tr);
                }else{  
                    data_total_pro.text(data[0]['count']);
                    page_total_pro.text( Math.ceil(data[0]['count'] / e_pro) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' >
                                            <i class="fa-solid fa-xmark" class='${hide}'></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else if(e.status==0){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_pro_using(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var en_name=tr.find("td:eq(3)").text();
        var kh_name=tr.find("td:eq(4)").text();
        var od=tr.find("td:eq(5)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #en-name").val(en_name);
                body.find(".frm #kh-name").val(kh_name);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_pro_using.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //=========================================================product-type======================================================
    //add
    function add_pro_type(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var poster=parent.find("#poster");
        var en_name=parent.find("#en-name");
        var kh_name=parent.find("#kh-name");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(poster.val()==0){
            alert("Plase chooes poster !!!");
            poster.focus();
            return;
        }else if(en_name.val()==0){
            alert("Plase chooes poster !!!");
            en_name.focus();
            return;
        }else if(kh_name.val()==0){
            alert("Plase chooes poster !!!");
            kh_name.focus();
            return;
        }
        $.ajax({
            url:'action/add_pro_type.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(en_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(kh_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center" style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        en_name.val("");
                        kh_name.val("");
                    } 
                    // body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_pro_type(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th>ID</th>
                <th>Date-Post</th>
                <th>Poster</th>
                <th>En-Name</th>
                <th>Kh-Name</th>
                <th>OD</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_pro_type.php',
            type:'POST',
            data:{s:s_pro ,e:e_pro ,search:search_pro ,filter_field:filter_field_pro.val(),search_val:search_val_pro.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);    
            },
            success:function(data){ 
                var td='';
                if(data.length==0){
                    data_total_pro.text(0);
                    page_total_pro.text(0);
                    tbl.html(tr);
                }else{  
                    data_total_pro.text(data[0]['count']);
                    page_total_pro.text( Math.ceil(data[0]['count'] / e_pro) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else if(e.status==0){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_pro_type(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var en_name=tr.find("td:eq(3)").text();
        var kh_name=tr.find("td:eq(4)").text();
        var od=tr.find("td:eq(5)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #en-name").val(en_name);
                body.find(".frm #kh-name").val(kh_name);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_pro_type.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //=========================================================category======================================================
    //add
    function add_category(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var poster=parent.find("#poster");
        var en_name=parent.find("#en-name");
        var kh_name=parent.find("#kh-name");
        var color_code=parent.find("#color-code");
        var od=parent.find("#od");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        if(poster.val()==0){
            alert("Plase chooes poster !!!");
            poster.focus();
            return;
        }else if(en_name.val()==0){
            alert("Plase chooes poster !!!");
            en_name.focus();
            return;
        }else if(kh_name.val()==0){
            alert("Plase chooes poster !!!");
            kh_name.focus();
            return;
        }
        $.ajax({
            url:'action/add_category.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){  
                var td='';
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    en_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(poster.find('option:selected').text());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(en_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(kh_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(color_code.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(od.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(7)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if(status.val()==1){
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${color_code.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td align="center" style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else{
                            td+=`
                                <tr>
                                    <td align="center">${id.val()}</td>
                                    <td align="center">${data['date-post']}</td>
                                    <td align="center">${poster.find('option:selected').text()}</td>
                                    <td align="center">${en_name.val()}</td>
                                    <td align="center">${kh_name.val()}</td>
                                    <td align="center">${color_code.val()}</td>
                                    <td align="center">${od.val()}</td>
                                    <td style="display:flex;
                                            justify-content: center;
                                            align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td align="center" width="100">
                                        <button type="button" id='edit' >
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        od.val(data['id']+1);
                        color_code.val("");
                        en_name.val("");
                        kh_name.val("");
                    } 
                    // body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_category(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th>ID</th>
                <th>Date-Post</th>
                <th>Poster</th>
                <th>En-Name</th>
                <th>Kh-Name</th>
                <th>COLOR-CODE</th>
                <th>OD</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_category.php',
            type:'POST',
            data:{s:s_pro ,e:e_pro ,search:search_pro ,filter_field:filter_field_pro.val(),search_val:search_val_pro.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);    
            },
            success:function(data){ 
                var td='';
                if(data.length==0){
                    data_total_pro.text(0);
                    page_total_pro.text(0);
                    tbl.html(tr);
                }else{  
                    data_total_pro.text(data[0]['count']);
                    page_total_pro.text( Math.ceil(data[0]['count'] / e_pro) );
                    data.forEach( (e) =>{
                        if(e.status==1){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['color-code']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-check" id='tick'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }else if(e.status==0){
                            td += `
                                <tr>
                                    <td align="center">${e['id']}</td>
                                    <td align="center">${e['date_post']}</td>
                                    <td align="center">${e['poster_f_name']+"_"+e['poster_l_name']}</td>
                                    <td align="center">${e['en-name']}</td>
                                    <td align="center">${e['kh-name']}</td>
                                    <td align="center">${e['color-code']}</td>
                                    <td align="center">${e['od']}</td>
                                    <td style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                        <i class="fa-solid fa-square-xmark" id='x'></i>
                                    </td>
                                    <td width="100">
                                        <button type="button" id='edit' class='${hide}'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" id='del' class='${hide}'>
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_category(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var en_name=tr.find("td:eq(3)").text();
        var kh_name=tr.find("td:eq(4)").text();
        var color_code=tr.find("td:eq(5)").text();
        var od=tr.find("td:eq(6)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[option], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #en-name").val(en_name);
                body.find(".frm #kh-name").val(kh_name);
                body.find(".frm #color-code").val(color_code);
                body.find(".frm #od").val(od);
                $.ajax({
                    url:'action/edit_category.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #poster").val(e.uid);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //===========================================================user========================================================
    //add
    function add_user(eThis){
        var parent=eThis.parents(".frm");
        var id=parent.find("#id");
        var first_name=parent.find("#first-name");
        var last_name=parent.find("#last-name");
        var gender=parent.find("#gender");
        var date_join=parent.find("#date-join");
        var email=parent.find("#email");
        var pass=parent.find("#pass");
        var type=parent.find("#type");
        var status=parent.find("#status");
        var tbl=$(".ctr-tbl").find("table tr#first");
        if( first_name.val()==""){
            alert("Plase Input First-Name!");
            first_name.focus();
            return;
        }else if( last_name.val()=="" ){
            alert("Plase Input Last-Name!");
            last_name.focus();
            return;
        }else if( gender.val()=="" ){
            alert("Plase input Gender !");
            gender.focus();
            return;
        }else if( date_join.val()== ''){
            alert("plase input date_join!");
            date_join.focus();
            return;
        }else if(email.val()==""){
            alert("Plase Input Email!!");
            email.focus();
            return;
        }else if(pass.val()==""){
            alert("Plase Input Password!");
            pass.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url:'action/add_user.php',
            type:'POST',
            data:frm_data,
            contentType:false,
            cache:false,
            processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success  
                    body.append(loading);    
            },
            success:function(data){   
                var td="";
                if( data['dpl'] == true ){
                    alert("Duplicate Name");
                    first_name.focus();
                }else{
                    if( data['edit']==true ){
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(1)").text(first_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(2)").text(last_name.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(3)").text(gender.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(4)").text(date_join.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(5)").text(email.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(6)").text(type.val());
                        $(".ctr-tbl").find("tr:eq("+ind+") td:eq(7)").text(status.val());
                        body.find(".popUP").remove();
                    }else{
                        if( status.val()==1 ){
                            if(type.val()!="Admin"){
                                td+=`
                                    <tr>
                                        <td align="center">${id.val()}</td>
                                        <td align="center">${first_name.val()}</td>
                                        <td align="center">${last_name.val()}</td>
                                        <td align="center">${gender.val()}</td>
                                        <td align="center">${date_join.val()}</td>
                                        <td align="center">${email.val()}</td>
                                        <td align="center">${type.val()+permission}</td>
                                        <td align="center" style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                            <i class="fa-solid fa-square-check" id='tick'></i>
                                        </td>
                                        <td align="center" width="100">
                                            <button type="button" id='edit' >
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }else{
                                td+=`
                                    <tr>
                                        <td align="center">${id.val()}</td>
                                        <td align="center">${first_name.val()}</td>
                                        <td align="center">${last_name.val()}</td>
                                        <td align="center">${gender.val()}</td>
                                        <td align="center">${date_join.val()}</td>
                                        <td align="center">${email.val()}</td>
                                        <td align="center">${type.val()}</td>
                                        <td align="center" style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                            <i class="fa-solid fa-square-check" id='tick'></i>
                                        </td>
                                        <td align="center" width="100">
                                            <button type="button" id='edit' >
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }
                        }else if( status.val()==0 ){
                            if(type.val()!="Admin"){
                                td+=`
                                    <tr>
                                        <td align="center">${id.val()}</td>
                                        <td align="center">${first_name.val()}</td>
                                        <td align="center">${last_name.val()}</td>
                                        <td align="center">${gender.val()}</td>
                                        <td align="center">${date_join.val()}</td>
                                        <td align="center">${email.val()}</td>
                                        <td align="center">${type.val()+permission}</td>
                                        <td align="center" style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                            <i class="fa-solid fa-square-xmark" id='x'></i>
                                        </td>
                                        <td align="center" width="100">
                                            <button type="button" id='edit' >
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }else{
                                td+=`
                                    <tr>
                                        <td align="center">${id.val()}</td>
                                        <td align="center">${first_name.val()}</td>
                                        <td align="center">${last_name.val()}</td>
                                        <td align="center">${gender.val()}</td>
                                        <td align="center">${date_join.val()}</td>
                                        <td align="center">${email.val()}</td>
                                        <td align="center">${type.val()}</td>
                                        <td align="center" style="display:flex;
                                                justify-content: center;
                                                align-items: center; ">
                                            <i class="fa-solid fa-square-xmark" id='x'></i>
                                        </td>
                                        <td align="center" width="100">
                                            <button type="button" id='edit' >
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }
                        }
                        tbl.after(td);
                        id.val(data['id']+1);
                        first_name.val("");
                        last_name.val("");
                        gender.val("");
                        date_join.val("");
                        email.val("");
                        pass.val("");
                        type.val("");
                        status.val("0");
                    }
                    body.find(".popUP").last().remove();
                }
                    //work after success        
            }				
        }); 
    }
    //get
    function get_user(){
        var tbl=$(".ctr-tbl").find("table");
        var tr=`
            <tr id='first'>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Date join</th>
                <th>Email</th>
                <th>Type</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Active</th>
            </tr>
        `;
        $.ajax({
            url:'action/get_user.php',
            type:'POST',
            data:{s:s ,e:e ,search:search ,filter_field:filter_field.val(),search_val:search_val.val()},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
                    body.append(loading);  
            },
            success:function(data){ 
                if(data.length==0){
                    data_total.text(0);
                    page_total.text(0);
                    tbl.html(tr);
                }else{
                    var td='';
                    data_total.text(data[0]['count']);
                    page_total.text( Math.ceil(data[0]['count'] / e) );
                    data.forEach( (e) =>{
                        if( e.status==1 ){
                            if(e.type!="Admin"){
                                td += `
                                    <tr>
                                        <td align="center">${e['id']}</td>
                                        <td align="center">${e['first-name']}</td>
                                        <td align="center">${e['last-name']}</td>
                                        <td align="center">${e['gender']}</td>
                                        <td align="center">${e['date-join']}</td>
                                        <td align="center">${e['email']}</td>
                                        <td align="center">${e['type']+permission}</td>
                                        <td style="display:flex;
                                                    justify-content: center;
                                                    align-items: center; ">
                                            <i class="fa-solid fa-square-check" id='tick'></i>
                                        </td>
                                        <td width="100">
                                            <button type="button" id='edit' class='${hide}'>
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del' class='${hide}'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }else{
                                td += `
                                    <tr>
                                        <td align="center">${e['id']}</td>
                                        <td align="center">${e['first-name']}</td>
                                        <td align="center">${e['last-name']}</td>
                                        <td align="center">${e['gender']}</td>
                                        <td align="center">${e['date-join']}</td>
                                        <td align="center">${e['email']}</td>
                                        <td align="center">${e['type']}</td>
                                        <td style="display:flex;
                                                    justify-content: center;
                                                    align-items: center; ">
                                            <i class="fa-solid fa-square-check" id='tick'></i>
                                        </td>
                                        <td width="100">
                                            <button type="button" id='edit' class='${hide}'>
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del' class='${hide}'>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }
                        }else{
                            if(e.type!="Admin"){
                                td += `
                                    <tr>
                                        <td align="center">${e['id']}</td>
                                        <td align="center">${e['first-name']}</td>
                                        <td align="center">${e['last-name']}</td>
                                        <td align="center">${e['gender']}</td>
                                        <td align="center">${e['date-join']}</td>
                                        <td align="center">${e['email']}</td>
                                        <td align="center">${e['type']+permission}</td>
                                        <td style="display:flex;
                                                    justify-content: center;
                                                    align-items: center; ">
                                            <i class="fa-solid fa-square-xmark" id='x'></i>
                                        </td>
                                        <td width="100">
                                            <button type="button" id='edit'>
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del' >
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }else{
                                td += `
                                    <tr>
                                        <td align="center">${e['id']}</td>
                                        <td align="center">${e['first-name']}</td>
                                        <td align="center">${e['last-name']}</td>
                                        <td align="center">${e['gender']}</td>
                                        <td align="center">${e['date-join']}</td>
                                        <td align="center">${e['email']}</td>
                                        <td align="center">${e['type']}</td>
                                        <td style="display:flex;
                                                    justify-content: center;
                                                    align-items: center; ">
                                            <i class="fa-solid fa-square-xmark" id='x'></i>
                                        </td>
                                        <td width="100">
                                            <button type="button" id='edit'>
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" id='del' >
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            }
                        }
                    } );
                    tbl.html(tr+td); 
                }
                body.find(".popUP").last().remove();
                    //work after success        
            }				
        }); 
    }
    //edit
    function edit_user(eThis){
        var tr=eThis.parents("tr");
        ind=tr.index();
        var id=tr.find("td:eq(0)").text();
        var first_name=tr.find("td:eq(1)").text();
        var last_name=tr.find("td:eq(2)").text();
        var gender=tr.find("td:eq(3)").text();
        var date_join=tr.find("td:eq(4)").text();
        var email=tr.find("td:eq(5)").text();
        var type=tr.find("td:eq(6)").text();
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/"+frm[opt], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find(".frm #id").val(id);
                body.find(".frm #edit-id").val(id);
                body.find(".frm #first-name").val(first_name);
                body.find(".frm #last-name").val(last_name);
                body.find(".frm #gender").val(gender);
                body.find(".frm #date-join").val(date_join);
                body.find(".frm #email").val(email);
                body.find(".frm #type").val(type);
                $.ajax({
                    url:'action/edit_user.php',
                    type:'POST',
                    data:{id:id},
                    // contentType:false,
                    cache:false,
                    // processData:false,
                    dataType:"json",
                    beforeSend:function(){
                            //work before success   
                            body.append(loading);  
                    },
                    success:function(data){ 
                        body.find(".popUP").last().remove();
                        data.forEach( (e) =>{
                            body.find(".frm #pass").val(e.pass);
                            body.find(".frm #status").val(e.status);
                        });
                            //work after success        
                    }				
                }); 
                body.find(".popUP").last().remove();
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>permission<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    //get permission
    body.on('click','#permission',function(){  
        var eThis=$(this);
        uid=eThis.parents("tr").find("td:eq(0)").text();     
        body.append(popUP);
        body.append(loading);
        body.find('.popUP').first().load("frm/frm-permission.php", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
            $.ajax({
                url:'action/get-permission.php',
                type:'POST',
                data:{uid:uid},
                // contentType:false,
                cache:false,
                // processData:false,
                dataType:"json",
                beforeSend:function(){
                        //work before success    
                },
                success:function(data){  
                    var tr=body.find("table#tblPermission tr");
                    data.forEach( (e) =>{
                        for(x=0; x<tr.length; x++){
                            var code = tr.eq(x).find("td:eq(0) span").text();
                            if( uid==e.uid ){
                                if(code==e.mid){
                                    body.find("table#tblPermission tr:eq("+x+") td:eq(1) select").val(e.aid);
                                }
                            }
                        }
                    });
                    body.find(".popUP").last().remove();       
                        //work after success        
                }				
            }); 
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
    //set permission 
    body.on('change','table#tblPermission tr td select',function(){
        var eThis=$(this);
        var parent=eThis.parents("tr");
        var mid=parent.find("td:eq(0) span").text();
        var actionID=eThis.val();
        $.ajax({
            url:'action/add-permission.php',
            type:'POST',
            data:{ uid:uid , mid:mid , aid:actionID },
            cache:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success   
            },
            success:function(data){   
                    //work after success     
            }				
        }); 
    });
    //close permission
    body.on('click','.frm .close',function(){
        body.find(".popUP").remove();
    });
    function calleditor(){
        tinymce.remove();
        tinymce.init({selector:"textarea",theme: "modern",width: "760",height:"300",relative_urls: false, remove_script_host: false,
        file_browser_callback:function(field_name, url, type, win){
        var filebrowser = "js/filebrowser.php";
        filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
        tinymce.activeEditor.windowManager.open({
        title : "Insert Photo",
        width : 660,
        height : 500,
        url : filebrowser
        }, {
        window : win,
        input : field_name
        });
        return false;
        },
        plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools media code",	
        ],
        menubar:true,toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
        toolbar2:"fontselect | fontsizeselect | forecolor media code",
        });
    }
});