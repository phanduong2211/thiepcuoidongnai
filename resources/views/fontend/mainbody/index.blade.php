@extends('fontend.index')
@section('main')
<div class="mainBody">
                
    
<div class="Product">
    <div class="tabbed_area">
        <div class="Title">
            <ul class="tabs">
                <li class="tabs-li"><a title="" class="tab active">Nhóm Sản Phẩm</a></li>
                <!-- <li class="tabs-li"><a title="content_2" class="tab">THIỆP CƯỚI KHUYẾN MẠI</a>
                    <img class="img-menubody" src="{{Asset('')}}public/fontend/images/icon-khuyenmai.png" alt="thiệp cưới khuyến mại" />
                </li>
                <li class="tabs-li"><a title="content_3" class="tab">THIỆP CƯỚI BÁN CHẠY </a>
                    <img class="img-menubody" src="{{Asset('')}}public/fontend/images/icon-banchay.png" alt="thiệp cưới bán chạy" /></li> -->
            </ul>
        </div>
        <div id="content_1" class="content">
            <div class="contentProduct">
                @foreach($product as $values)
                <div class="g-box">
                    <div class="g-image">
                    <!-------------------------------icon giảm giá------>
                        <!-- <div class="img-position-sale"><span>-50%</span></div> -->
                        <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                            
                            <img class="img-news" src="{{$convert->showImage($values->image)}}" alt="{{$values->name}}" />
                            </a>
                    </div>
                    <div class="g-price">
                        <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                            <span class="name-pro">{{$values->name}}</span></a>
                        
                        <span class="price-goc">{{number_format($values->promotion_price)}} đ</span>
                        <span class="price-km">{{number_format($values->price)}} đ</span>
                        
                    </div>
                    <!-------------------------------------đặt hàng----------------------------------->
                   <!--  <div class="g-order">
                        <a href="/thiep-cuoi-an-tuong/thiep-cuoi-h42-104" title="Thiệp cưới H42">
                            <img src="{{Asset('')}}public/fontend/images/btndathang.jpg" /></a>
                    </div> -->
                </div>
            @endforeach
            </div>
            <div class="linkxemthem"><a href="{{Asset('')}}/tat-ca-san-pham.html" class="xemthem">Xem thêm ...</a></div>
        </div>
    </div>
</div>

    
<div class="MenuRight">
    <!-- <div class="movable">
        <div class="video-block">
            <iframe width="268" height="250" src="https://www.youtube.com/embed/jo6MpYN_rWc" frameborder="0" allowfullscreen></iframe>
        </div>
    </div> -->
    <!-- <div class="movable1">
        <ul>
            
            <li id="various46" class="variousx" href="#title46" title="Click để xem bản đồ">295 Kim Mã - Giảng Võ - Ba Đình - Hà Nội<strong>(04).22 690 666</strong></li>
            
            <li id="various47" class="variousx" href="#title47" title="Click để xem bản đồ">89 Ô Chợ Dừa - Đống Đa - Hà Nội<strong>(04) 22 690 888</strong></li>
            
            <li id="various48" class="variousx" href="#title48" title="Click để xem bản đồ">469 Nguyễn Trãi - Thanh Xuân - Hà Nội<strong>(04) 22 650 999</strong></li>
            
            <li id="various49" class="variousx" href="#title49" title="Click để xem bản đồ">273 Hồ Tùng Mậu - Từ Liêm - Hà Nội<strong>(04).3797 0167</strong></li>
            
            <li id="various50" class="variousx" href="#title50" title="Click để xem bản đồ">193 Hồ Tùng Mậu - Từ Liêm - Hà Nội<strong>(04).3837 3284</strong></li>
            
            <li id="various51" class="variousx" href="#title51" title="Click để xem bản đồ">36 Phú Diễn - Cầu Diễn - Từ Liêm - Hà Nội<strong>(04).3797 0167</strong></li>
            
        </ul>
    </div> -->
    
    @foreach($ads as $values)
    
    <div class="movable">
        <a href="{{$values->url}}">
                <img src="{{$convert->showImage($values->image)}}" alt="{{$values->name}}" />
        </a>
    </div>
    @endforeach
    
</div>


            </div>
@stop