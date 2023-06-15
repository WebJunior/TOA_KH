$(document).ready(function(){
    $windowwidth=$(window).width();
    var popUP='<div class="popUP"></div>';
    var loading='<div class="popUP"><div class="loading-box"><div class="loading"></div></div></div>';
    let body=$("body");
    var eThis=$(this);
    //big slide
    get_big_slide();
    function get_big_slide(){
        const img=["img/slide1.jpg","img/slide2.jpg","img/slide3.jpg"];
        var txt="";
        var pagination='';
        img.forEach( (e) =>{
            txt += `
                <div class="slide-show" data-index="0">
                    <img src="home/${e}" alt="">
                </div>
            `;

            pagination += `
                <span></span>
            `;
        });
        $(".slide-container").find(".slide-box .slide").html(txt);
        $(".slide-container").find(".slide-box .pagination").html(pagination);

        // click show
        $(".slide-container").find(".slide-box .pagination span").eq(0).addClass("active");
        $(".slide-container").on('click','.slide-box .pagination span',function(){
            $(this).addClass("active").siblings().removeClass("active");
            slide.eq(indSlide).hide();
            indSlide=$(this).index();
            slide.eq(indSlide).show();
        });
        // slide
        let slide= $('.slide-show');
        let indSlide = 0;
        let numSlide = slide.length;
        slide.hide();
        slide.eq(indSlide).show();
        // next slide
        function nextslide(){
            $(".slide-container").find(".slide-box .pagination span").eq(indSlide).removeClass("active");
            slide.eq(indSlide).hide();
            indSlide ++;
            if( indSlide >= numSlide){
                indSlide = 0;
            }
            slide.eq(indSlide).show();
            $(".slide-container").find(".slide-box .pagination span").eq(indSlide).addClass("active");
        }
        var mynextslide = setInterval(
            nextslide,
            3000
        );
        // stop auto slide
        $('.slide').mouseover(function(){
            clearInterval(mynextslide);
        })
        $('.next').mouseover(function(){
            clearInterval(mynextslide);
        })
        $('.back').mouseover(function(){
            clearInterval(mynextslide);
        })
        $('.pagination').mouseover(function(){
            clearInterval(mynextslide);
        })
        // start auto slide
        $('.slide').mouseleave(function(){
            mynextslide = setInterval(
                nextslide,
                3000
            );
        })
        $('.next').click(function(){
            nextslide();
        });
        // back slide
        $('.back').click(function(){
            $(".slide-container").find(".slide-box .pagination span").eq(indSlide).removeClass("active");
            slide.eq(indSlide).hide();
            indSlide --;
            if( indSlide < 0 ){
                indSlide = numSlide-1 ;
            }
            slide.eq(indSlide).show();
            $(".slide-container").find(".slide-box .pagination span").eq(indSlide).addClass("active");
        });
    }
    //small device show search box
    body.on('click','.menu .menu-box .btn-search-box',function(){
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"left":"50%"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"top":"50%"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"transform":"translate(-50%,-50%)"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"transition":"0.5"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.btnMenu").css({"display":"none"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.btn-search-box").css({"display":"none"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li:not(.search-box)").css({"display":"none"});
    });
    body.on('click','.menu .menu-box .btnClose',function(){
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"left":"-100%"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.search-box").css({"transition":"0.5"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.btnMenu").css({"display":"block"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li.btn-search-box").css({"display":"block"});
        $(".menu-bar").find(".menu .menu-box .box1 .box1-1 ul li:not(.search-box)").css({"display":"block"});
    });
    //small device show menu
    body.on('click','.menu .menu-box .btnMenu',function(){
        $(".phone-popUp").css({"display":"block"});
        $(".phone-menu").css({"left":"0"});
    });    
    body.on('click','.phone-popUp',function(){
        $(".phone-popUp").css({"display":"none"});
        $(".phone-menu").css({"left":"-252px"});
        body.find(".product-con .filter").css({"left":"-252px"});
    });
    //get left menu
    body.find(".product-con .title-box .btn-filter").click(function(){
        $(".phone-popUp").css({"display":"block"});
        body.find(".product-con .filter").css({"left":"0"});
    });
    //filter category
    body.find(".filter .filter-box#cate ul li").click(function(){
        eThis.addClass("active").siblings().removeClass("active");
    });
    //filter using
    body.find(".filter .filter-box#using ul li").click(function(){
        var eThis=$(this);
        if(eThis.find(".fa-square-check").length>0){
            eThis.find("i").addClass("fa-square");
            eThis.find("i").removeClass("fa-square-check");
        }else if(eThis.find(".fa-square-check").length==0){
            eThis.find("i").addClass("fa-square-check");
            eThis.find("i").removeClass("fa-square");
        }
    });
    //filter type
    body.find(".filter .filter-box#type ul li").click(function(){
        var eThis=$(this);
        if(eThis.find(".fa-square-check").length>0){
            eThis.find("i").addClass("fa-square");
            eThis.find("i").removeClass("fa-square-check");
        }else if(eThis.find(".fa-square-check").length==0){
            eThis.find("i").addClass("fa-square-check");
            eThis.find("i").removeClass("fa-square");
        }
    });
    //popUp-video
    body.find(".video-container .video").click(function(){
        var video_id = $(this).data("id");
        var txt='';
        $.ajax({
            url:`${base_url}home/action/get-video.php`,
            type:'POST',
            data:{video_id:video_id},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success    
            },
            success:function(data){   
                data.forEach( (e) =>{
                    txt += `
                        <div class="row">           
                            <div class="col-xl-12 col-lg-12 img-box">
                                ${e.id_video}
                            </div>
                        </div>
                    `;
                });
                body.find(".frm-video").append(txt);
                body.find(".video-popup").show();
                    //work after success        
            }				
        }); 
    });
    //close video popUp
    body.find(".video-popup .close").click(function(){
        body.find(".video-popup").hide();
    });
    //more product
    var s=21;
    var e=21;
    $(".view-more").on('click','.box',function(){
        var body=$("body");
        var eThis =$(this);
        var more_product=body.find("#product");
        $.ajax({
            url:'home/action/get-more-product.php',
            type:'POST',
            data:{cate_id:cate_id,s:s,e:e},
            // contentType:false,
            cache:false,
            // processData:false,
            dataType:"json",
            beforeSend:function(){
                    //work before success  
                    body.append(loading);     
            },
            success:function(data){   
                    //work after success        
                var txt='';
                var using='';
                data.forEach( (e) =>{
                    if(pheasa=="en"){
                        using = `${e.en_using}`;
                    }else{
                        using = `${e.kh_using}`;
                    }
                    txt += `
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 box">
                            <div class="pro-box">
                                <a href="${base_url}?lang=${pheasa}&menu=Product&cate-id=${e.cate_id}&pro-id=${e.id}">
                                    <div class="box-img">
                                        <img src="admin/img/${e.img}" alt="">
                                        <span class="pcode"> Code: </span>
                                        <div class="shop"><i class="fa-solid fa-cart-plus"></i></div>
                                        <div class="fb"><i class="fa-brands fa-square-facebook"></i></div>
                                        <div class="link-cp"><i class="fa-solid fa-link"></i></div>
                                    </div>
                                    <div class="box-txt">
                                        <h2>${using}</h2>
                                        <h1>${e.pro_name}</h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `;
                });
                more_product.append(txt);
                s = s + e;
                body.find(".popUP").last().remove();
                total_data = total_data - e ;
                if( total_data <= 0 ){
                    eThis.hide();
                }
            }				
        }); 
    });
    //add order
    body.find(".shop").click(function(){
        var val=1;
        var eThis=$(this);
        var id_pro=eThis.parent().data("id");
        var name_pro=eThis.parent().data("name");
        var img_pro=eThis.parent().data("img");
        var txt='';
        txt += `
            <tr>
                <td width="50"><img src="admin/img/${img_pro}" alt=""></td>
                <td>${name_pro}</td>
                <td>$0.00</td>
                <td><input type="number" style="width:100%;" value="${val}"></td>
                <td>$0.00</td>
            </tr>
        `;
        console.log(txt);
        $(".order-box tr#first").after(txt);
        val=val+1;
    });
});