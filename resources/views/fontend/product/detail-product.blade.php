@extends('fontend.index')
@section('main')
<div class="mainBody">
                
    <?php $images = explode(",",$detailproduct[0]->images); ?>
    <div class="product-detail">
        <div class="detail-titles">
            <div class="title-heads">
                <ul>
                    <li itemscope="" itemtype=""><a href="/" title="Trang chủ" itemprop="url">
                        <img src="{{Asset('')}}public/fontend/images/home-icon.png" itemprop="title"></a></li>
                    <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{Asset('')}}danh-muc/{{$convert->convertString($category['name'])}}" title="{{$category['name']}}" itemprop="url"><span itemprop="title">{{$category['name']}}</span></a></li>
                    <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="javascript:void(0);" title="" itemprop="url"><span itemprop="title">{{$product[0]->name}}</span></a></li>
                </ul>
            </div>
        </div>
        <div class="detail">
            <div class="detail-left">
                <div class="slide-detail">
                    <!-- Insert to your webpage where you want to display the slider -->
                    <div id="amazingslider-1" style="display: block; position: relative; width: 550px; height: 370px;">
                        <ul class="amazingslider-slides" style="display: none;">
                            
                            <li><a href="{{$convert->showImage($images[0])}}" class="html5lightbox" data-width="1000" data-height="680">
                                <img src="{{$convert->showImage($images[0])}}" alt="{{$product[0]->name}}" data-duration="5000"></a></li>
                            
                        </ul>
                        <ul class="amazingslider-thumbnails" style="display: none;">
                            
                            <li>
                                <img src="{{$convert->showImage($images[0])}}" alt="{{$product[0]->name}}"></li>
                            
                        </ul>
                    </div>
                    <!-- <div class="amazingslider-wrapper-0"><div class="amazingslider-background-image-0"></div>
                    <div class="amazingslider-slider-0"><div class="amazingslider-bottom-shadow-0"></div><div class="amazingslider-box-0"><div class="amazingslider-swipe-box-0"><div class="amazingslider-space-0" style="width: 550px; height: 370px;"></div><div class="amazingslider-img-box-0"></div><div class="amazingslider-lightbox-play-0"></div></div></div><div class="amazingslider-text-box-0" style="display: block;"><div class="amazingslider-text-wrapper-0" style="width: 100%; height: auto; position: absolute; left: 0px; bottom: 0px; margin-bottom: 0px;"><div class="amazingslider-text-0"><div class="amazingslider-text-bg-0" style="display: block;"></div><div class="amazingslider-title-0">Thiệp cưới H42</div><div class="amazingslider-description-0" style="display: none;"></div></div></div></div><div class="amazingslider-play-0"></div><div class="amazingslider-video-wrapper-0" style="display: none;"></div><div class="amazingslider-ribbon-0"></div><div class="amazingslider-arrow-left-0" style="overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; left: 8px; top: 50%; margin-top: -16px; display: none; background: url(&quot;{{Asset('')}}public/fontend/sliderengine/arrows-32-32-0.png&quot;) left top no-repeat;"></div><div class="amazingslider-arrow-right-0" style="overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; right: 8px; top: 50%; margin-top: -16px; display: none; background: url(&quot;{{Asset('')}}public/fontend/sliderengine/arrows-32-32-0.png&quot;) right top no-repeat;"></div><div class="amazingslider-timer-0"></div><div style="display:none;position:absolute;top:6px;left:6px;font:12px Arial,Tahoma,Helvetica,sans-serif;color:#666;padding:2px 4px;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;background-color:#fff;opacity:0.9;filter:alpha(opacity=90);cursor:pointer;"><a href="http://amazingslider.com?source=sliderwm" style="text-decoration:none;font:12px Arial,Tahoma,Helvetica,sans-serif;color:#333;" title="jQuery Slider" target="_blank">amazingslider.com</a></div></div><div class="amazingslider-nav-0" style="display: block; position: absolute; height: auto; overflow: hidden; width: 100%; top: 100%; left: 0px; margin-top: 16px;"><div class="amazingslider-nav-container-0" style="margin-left: 87px; margin-right: 87px; overflow: hidden;"><div class="amazingslider-bullet-wrapper-0" style="display: block; position: relative; width: 376px; height: auto; margin-left: auto; margin-right: auto; margin-top: 0px;"><div class="amazingslider-bullet-0-0" style="position: relative; float: left; margin-right: 0px; width: 116px; height: 90px; cursor: pointer; padding: 2px; opacity: 1; background-color: rgb(255, 255, 255);"></div>
                    <div class="amazingslider-nav-left-0" style="position:relative;float:left;margin-left:8px;width:120px;height:78px;cursor:pointer;"></div>
                    <div class="amazingslider-nav-right-0" style="position:relative;float:left;margin-left:8px;width:120px;height:78px;cursor:pointer;"></div> 
                    </div></div><div class="amazingslider-car-left-arrow-0" style="display: none; overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; left: 0px; top: 0px; margin-top: 23px; background: url(&quot;{{Asset('')}}public/fontend/sliderengine/carouselarrows-32-32-0.png&quot;) left top no-repeat;"></div><div class="amazingslider-car-right-arrow-0" style="display: none; overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; right: 0px; top: 0px; margin-top: 23px; background: url(&quot;{{Asset('')}}public/fontend/sliderengine/carouselarrows-32-32-0.png&quot;) right top no-repeat;"></div></div><div class="amazingslider-nav-play-0" style="position: absolute; width: 48px; height: 48px; bottom: 0px; right: 0px; margin-right: 8px; margin-bottom: 8px; display: none; background-image: url(&quot;{{Asset('')}}public/fontend/sliderengine/navplaypause-48-48-0.png&quot;); background-position: left top; background-repeat: no-repeat;"></div><div class="amazingslider-nav-pause-0" style="position: absolute; width: 48px; height: 48px; bottom: 0px; right: 0px; margin-right: 8px; margin-bottom: 8px; display: none; background-image: url(&quot;{{Asset('')}}public/fontend/sliderengine/navplaypause-48-48-0.png&quot;); background-position: right top; background-repeat: no-repeat;"></div></div></div> -->
                    <!-- End of body section HTML codes -->

                </div>
            </div>
            <div class="detail-right">
                <div class="description-pro">
                    <div class="name-pro">
                        <ul>
                            <li><span class="head-title">{{$product[0]->name}}</span></li>
                            
                        </ul>
                    </div>

                    <div class="des-tall">
                        
                        <strong>Giá: {{number_format($product[0]->price)}} đ </strong><span>Giá cũ: {{number_format($product[0]->promotion_price)}}</span>
                        
                        <ul>
                            
                            <!-- <li>Số lượng &gt; 300c: 2.800đ/thiệp (Giảm 30%)</li>
                            
                            <li>Số lượng &gt; 500c: 2.400đ/thiệp (Giảm 40%)</li>
                            
                            <li>Số lượng &gt; 1000c: 2.000đ/thiệp (Giảm 50%)</li> -->
                            
                        </ul>
                    </div>
                    
                    
                    <div class="khuyen-cao">
                        {!!$detailproduct[0]->infomation!!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="product-detail">
        <div class="Other-title">
            <span>Thiệp cưới cùng bộ sưu tập</span>
        </div>
        <div class="contentProduct">
            @foreach($relatedproducts as $values)
            <div class="g-box">
                <div class="g-image">
                   <!--  <div class="img-position-best"><span></span></div> -->
                    <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                        
                        <img class="img-news" src="{{$convert->showImage($values->image)}}" alt="{{$values->name}}">
                        </a>
                </div>
                <div class="g-price">
                    <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                        <span class="name-pro">{{$values->name}}</span></a>
                 
                        <span class="price-goc">{{number_format($values->promotion_price)}} đ</span>
                        <span class="price-km">{{number_format($values->price)}} đ</span>
                        
                </div>
                <!-- <div class="g-order">
                    <a href="/thiep-cuoi-an-tuong/thiep-cuoi-h52-114" title="Thiệp cưới H52">
                        <img src="{{Asset('')}}public/fontend/images/btndathang.jpg"></a>
                </div> -->
            </div>
            
            @endforeach
            
        </div>
    </div>

</div>
            @stop