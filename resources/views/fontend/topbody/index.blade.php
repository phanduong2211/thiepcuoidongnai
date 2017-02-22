 <style type="text/css">
     .image_main
     {
        width: 100% !important;
     }
     .container_skitter,.box_skitter,.box_clone
     {
        width:100% !important;
     }
     .Slide
     {
        width:76% !important;
     }


 </style>
 <div class="Topbody">
                
<div class="MenuLeft">
    <div class="movableTop">
        <div class="contentheader">
            <span class="title">Bộ sưu tập</span>
        </div>
        <div class="Support_Block">
            <ul class="categories">
                @foreach($categorys as $values)
                    
                    <li>
                        <a href="{{Asset('')}}danh-muc/{{$convert->convertString($values->name)}}" title="{{$values->name}}">{!!$values->name!!}</a>
                    </li>
                @endforeach
                
                
            </ul>
        </div>
    </div>
</div>

                
<!-- Skitter Styles -->
<link href="{{Asset('')}}public/fontend/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />

<!-- Skitter JS -->

<script type="text/javascript" src="{{Asset('')}}public/fontend/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{{Asset('')}}public/fontend/js/jquery.skitter.min.js"></script>

<!-- Init Skitter -->
<script type="text/javascript" lang="javascript">
    $(document).ready(function () {
        $('.box_skitter_large').skitter({
            theme: 'clean',
            numbers_align: 'center',
            progressbar: false,
            dots: true,
            preview: false
        });
    });
</script>
<div class="Slide">
    <div class="box_skitter box_skitter_large">
        <ul>
            @foreach($slideshow as $values)
            <li><a href="#1">
                <img src="{{$convert->showImage($values->image)}}" class="circles" alt="Slide-01"/></a>
            </li>
            @endforeach
            
        </ul>
    </div>
</div>
<!-- <div class="rightSlide">
    <a href="/lien-he" title="Liên hệ">
        <img alt="slider" src="{{Asset('')}}public/fontend/images/5.jpg" /></a>
</div> -->

            </div>
    <!----------------------------------------------------view ads------------------------>        
<!-- <div class="viewAds">
    
    <div class="logoslider">
        <a href="/" title="Quảng cáo 1">
            <img src="{{Asset('')}}public/fontend/upload/adslocal1/2014-08-25-04-19-58logo1.jpg" alt="Quảng cáo 1" />
        </a>
    </div>
   
    <div class="logoslider">
        <a href="/" title="Quảng cáo 2">
            <img src="{{Asset('')}}public/fontend/upload/adslocal1/2014-08-25-04-20-40logo2.jpg" alt="Quảng cáo 2" />
        </a>
    </div>
   
    <div class="logoslider">
        <a href="/" title="Quảng cáo 3">
            <img src="{{Asset('')}}public/fontend/upload/adslocal1/2014-08-25-04-20-52logo3.jpg" alt="Quảng cáo 3" />
        </a>
    </div>
   
</div> -->