

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" itemscope itemtype="http://schema.org/LocalBusiness">
<head id="ctl00_Head1">
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="author" href="https://plus.google.com/u/0/116531394602490390562" />
<title>{{$header['title']}}</title>
<meta name="keywords" content="{{$header['keyword']}}">         
<meta name="description" content="{{$header['description']}}">          
<meta name="author" content="vitinhtienhung.com">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf_token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" type="image/x-icon" href="{{Asset('public/img/favicon.png')}}">
<link href="{{Asset('')}}public/fontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{Asset('')}}public/fontend/css/skitter.styles.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{Asset('')}}public/fontend/css/jquery.fancybox-1.3.4.css" media="screen" />
<link href="{{Asset('')}}public/fontend/css/contact.css" rel="stylesheet" type="text/css" />
<link href="{{Asset('')}}public/fontend/css/pagination.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="{{Asset('')}}public/fontend/js/jquery.js"></script>
    <script type="text/javascript" src="{{Asset('')}}public/fontend/sliderengine/amazingslider.js"></script>
    <script type="text/javascript" src="{{Asset('')}}public/fontend/sliderengine/initslider-1.js"></script>
    <script type="text/javascript" src="{{Asset('')}}public/fontend/js/jquery.fancybox-1.3.4.pack.js"></script>

    <script>
        $(document).ready(function () {
            $("a.tab").click(function () {
                $(".active").removeClass("active");
                $(this).addClass("active");
                $(".content").slideUp();
                var content_show = $(this).attr("title");
                $("#" + content_show).slideDown();
            });
        });
    </script>
    <script type="text/javascript">

        var timeload;

        function hideLive() {
            $('.collapse.expand').parent().stop().animate({ 'right': -230 }, 840, function () {
                $('.collapse.expand').removeClass('expand').parent().animate({ 'right': -230 }, 230);
            });
        }
        $(window).load(function () {
            $('.product-detail #big .item').hover(function () {
                $(this).dequeue().addClass('hover').delay(500).queue(function (next) {
                    $(this).removeClass("hover");
                    next();
                });
            });
            $('.product-detail .step .title.cart').hover(function () {
                $('.product-detail #big .item.cart').dequeue().addClass('hover').delay(500).queue(function (next) {
                    $('.product-detail #big .item.cart').removeClass("hover");
                    next();
                });
            });
            $('.product-detail .step .title.pen').hover(function () {
                $('.product-detail .item.pen').dequeue().addClass('hover').delay(500).queue(function (next) {
                    $('.product-detail #big .item.pen').removeClass("hover");
                    next();
                });
            });
            $('.product-detail .step .title.tools').hover(function () {
                $('.product-detail #big .item.tools').dequeue().addClass('hover').delay(500).queue(function (next) {
                    $('.product-detail #big .item.tools').removeClass("hover");
                    next();
                });
            });
            $('.product-detail .step .title.bag').hover(function () {
                $('.product-detail #big .item.bag').dequeue().addClass('hover').delay(500).queue(function (next) {
                    $('.product-detail #big .item.bag').removeClass("hover");
                    next();
                });
            });
            $('.product-detail .step .title.tag').hover(function () {
                $('.product-detail #big .item.tag').dequeue().addClass('hover').delay(500).queue(function (next) {
                    $('.product-detail #big .item.tag').removeClass("hover");
                    next();
                });
            });
        });
        $(document).ready(function () {
            var top = $('.livesupport').height() / 2;
            $('.livesupport').css('top', 5);
            if ($('.conten-support').length < 2 && top > 0) {
                $('.livesupport').animate({ 'opacity': 1 }, 400);
            }
            $(".collapse").live("click", function () {

                if ($(this).hasClass("expand")) {
                    hideLive();
                } else
                    $(this).addClass("expand").parent().stop().animate({ 'right': 0 });

            });
            $('.livesupport.popup').live("mouseover mouseout", function (event) {
                if (event.type == 'mouseover') {
                    clearTimeout(timeload);
                }
                if (event.type == 'mouseout') {
                    timeload = setTimeout("hideLive()", 8000);
                }
            });
            $(".toTop").live("click", function (event) {
                event.preventDefault();
                var t = $(window).scrollTop();
                $('html,body').stop().animate({ scrollTop: 0 }, t);
            });
            $(window).scroll(function () {
                var op = $(window).scrollTop() / $(window).height();
                op = op > 1 ? 1 : op;
                $(".toTop").stop().animate({ 'opacity': op }, 10);
            }).resize(function () {
                var top = ($(window).height() - $('.livesupport').height()) / 2;
                if ($('.conten-support').length < 2 && top > 0) {
                    $('.livesupport').css({ 'top': top }).show();
                } else {
                    $('.livesupport').css({ 'top': top }).hide();
                }
            });

        });
    </script>

    <script type="text/javascript">
        $(function () {
            if ($.browser.msie && $.browser.version.substr(0, 1) < 7) {
                $('li').has('ul').mouseover(function () {
                    $(this).children('ul').show();
                }).mouseout(function () {
                    $(this).children('ul').hide();
                })
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            $("#various46").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various47").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various48").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various49").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various50").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various51").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
              
            $("#various5").fancybox({
                'overlayShow': false,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic'
            });
        });
    </script>
    
<title>

</title></head>
<body>
   <!--                                               Hỗ trợ trực tuyến                                           -->
    
<!-- <div class="livesupport popup">
    <div class="collapse"></div>
    <div class="contentheader">
        <span class="title">Hỗ trợ trực tuyến</span>
    </div>
    <div class="conten-support">
        
        <div class="contents">
            <p class="chuc-vu">Showroom 1 - 295 Kim Mã</p>
            <p class="fullname">Ms. Lan Anh</p>
            <p class="phone">(04) 22 690 666</p>
            <div class="skype">
                <a title="" href="Skype:thiephong.hanoi?chat">
                    <img alt="" title="" src="{{Asset('')}}public/fontend/images/skype.png">
                </a>
            </div>
            <p class="email">inthiepcuoi.vn@gmail.com</p>
        </div>
        
        <div class="contents">
            <p class="chuc-vu">Showroom 2 - 89 Ô Chợ Dừa</p>
            <p class="fullname">Ms. Hường</p>
            <p class="phone">(04).22 690 888</p>
            <div class="skype">
                <a title="" href="Skype:thiephong.hanoi?chat">
                    <img alt="" title="" src="{{Asset('')}}public/fontend/images/skype.png">
                </a>
            </div>
            <p class="email">inthiepcuoi.vn@gmail.com</p>
        </div>
        
        <div class="contents">
            <p class="chuc-vu">Showroom 3 - 469 Nguyễn Trãi</p>
            <p class="fullname">Ms. Thu</p>
            <p class="phone">(04).22 650 999</p>
            <div class="skype">
                <a title="" href="Skype:thiephong.hanoi?chat">
                    <img alt="" title="" src="{{Asset('')}}public/fontend/images/skype.png">
                </a>
            </div>
            <p class="email">inthiepcuoi.vn@gmail.com</p>
        </div>
        
        <div class="contents">
            <p class="chuc-vu">Showroom 4 - 273 Hồ Tùng Mậu</p>
            <p class="fullname">Ms. Tâm</p>
            <p class="phone">(04).3797 0167</p>
            <div class="skype">
                <a title="" href="Skype:thiephong.hanoi?chat">
                    <img alt="" title="" src="{{Asset('')}}public/fontend/images/skype.png">
                </a>
            </div>
            <p class="email">inthiepcuoi.vn@gmail.com</p>
        </div>
        
        <div class="contents">
            <p class="chuc-vu">Hỗ trợ - CSKH</p>
            <p class="fullname">Ms. Tâm</p>
            <p class="phone">0971 315 688</p>
            <div class="skype">
                <a title="" href="Skype:thiephong.hanoi?chat">
                    <img alt="" title="" src="{{Asset('')}}public/fontend/images/skype.png">
                </a>
            </div>
            <p class="email">inthiepcuoi.vn@gmail.com</p>
        </div>
        
    </div>
</div> -->

    <div id="main">
        <div class="header">
            @include("fontend.header.index")
        </div>
        <div class="MainLab">
           @include("fontend.topbody.index")

        @yield("main")
     <!-----------------------------ads and video, news ------------------------------>       
    
<!-- <div class="adsFooter">
    
    <a href="" title="">
        <img src="{{Asset('')}}public/fontend/{{Asset('')}}upload/adslocal3/2015-09-24-09-04-0502.jpg" alt="" />
    </a>
    
</div>

    
<div class="newsFoot">
    <div class="experience">
        <div class="TitleEx">Kinh Nghiệm Cưới</div>
        <div class="contentExperience">
            
            <div class="contentEx">
                <a href="/bai-viet/cach-viet-noi-dung-thiep-cuoi-7-43" title="Cách viết nội dung thiệp cưới">

                    
                    <img class="img-news" src="{{Asset('')}}public/fontend/{{Asset('')}}upload/2014-08-29-12-11-32cach-viet-noi-dung-thiep-cuoi.jpg" alt="Cách viết nội dung thiệp cưới" />
                    
                </a>
                <div class="DescriptionEx">
                    <span><a href="/bai-viet/cach-viet-noi-dung-thiep-cuoi-7-43" title="Cách viết nội dung thiệp cưới">Cách viết nội dung thiệp cưới</a></span>
                    <p>Hướng dẫn cách viết nội dung thiệp cưới chi tiết, đầy đủ, để bộ thiệp cưới của bạn trở nên hoàn hảo nhất.</p>
                </div>
            </div>
            
            <div class="contentEx">
                <a href="/bai-viet/3-cach-hieu-qua-giup-giam-chi-phi-thiep-cuoi-7-143" title="3 cách hiệu quả giúp giảm chi phí thiệp cưới">

                    
                    <img class="img-news" src="{{Asset('')}}public/fontend/{{Asset('')}}upload/2014-09-09-09-13-54giam-chi-phi-thiep-cuoi.jpg" alt="3 cách hiệu quả giúp giảm chi phí thiệp cưới" />
                    
                </a>
                <div class="DescriptionEx">
                    <span><a href="/bai-viet/3-cach-hieu-qua-giup-giam-chi-phi-thiep-cuoi-7-143" title="3 cách hiệu quả giúp giảm chi phí thiệp cưới">3 cách hiệu quả giúp giảm chi phí thiệp cưới</a></span>
                    <p>Trong thời buổi kinh tế khó khăn như hiện nay thì việc lựa chọn thiệp cưới thông minh sẽ giúp các đôi uyên ương tiết kiệm một khoản chi phí tương đối cho đám cưới.</p>
                </div>
            </div>
            
            <div class="contentEx">
                <a href="/bai-viet/11-dia-diem-chup-anh-cuoi-dep-o-ha-noi-7-145" title="11 địa điểm chụp ảnh cưới đẹp ở Hà Nội">

                    
                    <img class="img-news" src="{{Asset('')}}public/fontend/{{Asset('')}}upload/2014-09-26-02-31-44chup-anh-cuoi-o-ha-noi.jpg" alt="11 địa điểm chụp ảnh cưới đẹp ở Hà Nội" />
                    
                </a>
                <div class="DescriptionEx">
                    <span><a href="/bai-viet/11-dia-diem-chup-anh-cuoi-dep-o-ha-noi-7-145" title="11 địa điểm chụp ảnh cưới đẹp ở Hà Nội">11 địa điểm chụp ảnh cưới đẹp ở Hà Nội</a></span>
                    <p>Hà Nội vốn đẹp, nhưng không vì thế mà việc chọn địa điểm chụp ảnh cưới trở nên dễ dàng.</p>
                </div>
            </div>
            
        </div>
        <br />
        <div class="linkxemthem"><a href="/chuyen-muc/kinh-nghiem-cuoi" class="xemthem">Xem thêm ...</a></div>
    </div>
    <div class="news">
        <div class="TitleEx">Tin Tức</div>
        
        <a href="/bai-viet/nhung-mau-thiep-cuoi-dep-2015-5-146" title="Những mẫu thiệp cưới đẹp 2015">
            
            <img class="img-footerNews" src="{{Asset('')}}public/fontend/{{Asset('')}}upload/2014-09-26-03-18-58nhung-mau-thiep-cuoi-dep.jpg" alt="Những mẫu thiệp cưới đẹp 2015" />
            
        </a>
        
        <a href="/bai-viet/nhung-mau-thiep-cuoi-sang-trong-2014-5-149" title="Những mẫu thiệp cưới sang trọng 2014">
            
            <img class="img-footerNews" src="{{Asset('')}}public/fontend/{{Asset('')}}upload/2014-10-15-04-28-22thiep-cuoi-sang-trong-h44.jpg" alt="Những mẫu thiệp cưới sang trọng 2014" />
            
        </a>
        
        <div class="linkxemthem" style="padding-top: 30px;"><a href="/chuyen-muc/tu-van-mua-cuoi" class="xemthem">Xem thêm ...</a></div>
    </div>
</div> -->


        </div>
        
@include("fontend.footer.index")

</script>

</body>
</html>


