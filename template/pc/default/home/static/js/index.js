$(document).ready(function(){
  $(".style_roadmap-item__JBIDt").click(function(){
    //$("#tianwei1").fadeToggle();
    //$(".man-1").toggleClass("man-show");
     $(this).find(".tianwei").fadeToggle();
     $(this).find(".man-1").toggleClass("man-show");
     $(this).find(".style_roadmap-wow__rFv5y").toggleClass("title-show");
  });
  $(".menu").click(function(){
     $(".menu-list").toggleClass("menu-show");
  });
  
  /*
   $(window).scroll(function(){//开始监听滚动条$("div").css("color","yellow");background-color: rgba(0, 0, 0, 0.8);
        var topp = $(document).scrollTop();
        if(topp > -1){
        //alert("ok");  <img alt="" src="/icon/cheers-up-logo.png" style="width:210px;" class="logoimg">
         $(".nav").css("background-color","rgba(0, 0, 0, 0.8)");
         $(".language").css("color","#fff");
         $(".logoimg").attr('src',"/template/pc/default/home/icon/cheers-up-logo-w.png"); 
         
         $(".tuite").attr('src',"/template/pc/default/home/static/image/tuite-w.png"); 
         $(".discord").attr('src',"/template/pc/default/home/static/image/discord-w.png"); 
         $(".OpenSea").attr('src',"/template/pc/default/home/static/image/OpenSea-fill-w.png"); 
         
        }else
        {
            $(".language").css("color","#000")
            $(".nav").css("background-color","transparent");
            $(".logoimg").attr('src',"/template/pc/default/home/icon/cheers-up-logo.png");
           $(".tuite").attr('src',"/template/pc/default/home/static/image/tuite.png"); 
         $(".discord").attr('src',"/template/pc/default/home/static/image/discord.png"); 
         $(".OpenSea").attr('src',"/template/pc/default/home/static/image/OpenSea-fill.png"); 
        }

    })
    
    if(navigator.userAgent.match(/mobile/i)) {
           // alert('手机')
           $("body").css("width",1440);
        }else {
          // alert('pc')
        }
    //$("body").css("width",$(document).width());
    //alert();//浏览器当前窗口文档对象宽度 
    */
});