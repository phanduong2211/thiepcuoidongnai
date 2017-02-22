@extends('fontend.index')
@section('main')
<style type="text/css">
    .detail-titlex
    {
            border-bottom: 2px solid #e13a86;
            display: inline-block;
            height: 36px;
            margin: 20px 0 0;
            width: 100%;
    }
    .title-headx
    {
        height: 100%;
        width: 100%;
        background: url("{{Asset('')}}public/fontend/images/bg-title-other.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
        padding: 1px 0;
    }
     .product-detail .detail-titlex .title-headx ul {
    height: 100%;
    width: 100%;
    list-style: none;
    margin: 0;
    padding: 0;
    line-height: 36px;
    }
     .product-detail .detail-titlex .title-headx ul li {
    height: 100%;
    list-style: none;
    float: left;
    }
    .product-detail .detail-titlex .title-headx ul li a {
    text-decoration: none;
}
 .product-detail .detail-titlex .title-headx ul li a img {
    width: 20px;
    height: 20px;
    padding: 10px 0 0 20px;
}
.product-detail .detail-titlex .title-headx ul li a span {
    color: #fff;
    font-family: Arial;
    font-size: 14px;
    padding: 10px 5px 11px 50px;
    text-transform: uppercase;
    background: url("{{Asset('')}}public/fontend/images/arrow-dot.png") no-repeat scroll 10px center transparent;
}
.pagination
{
    margin-top: -10px;
    margin-left: 37%;
}
.pagination li
{
    list-style: none;
    float: left;

}
</style>
<div class="product-detail">
        <div class="detail-titlex">
            <div class="title-headx">
                <ul>
                    <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/" itemprop="url" title="Trang chủ">
                        <img src="{{Asset('')}}public/fontend/images/home-icon.png" itemprop="title"></a></li>
                    <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="javascript:void(0);" title="Thiệp cưới đẹp 2016"><span itemprop="title">{{$Name}}</span></a></li>
                </ul>
            </div>
        </div>
        <div class="contentProduct">
            @foreach($product as $values)
            <div class="g-box">
                <div class="g-image">
                    <!-- <div class="img-position-new"><span>25</span></div> -->
                    <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                        
                        <img class="img-news" src="{{$convert->showImage($values->image)}}" alt="{{$values->name}}" alt="{{$values->name}}">
                        </a>
                </div>
                <div class="g-price">
                    <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                        <span class="name-pro">{{$values->name}}</span></a>
                 
                        <span class="price-goc">{{number_format($values->promotion_price)}} đ</span>
                        <span class="price-km">{{number_format($values->price)}} đ</span>
                        
                </div>
                <!-- <div class="g-order">
                    <a href="{{Asset('products')}}/{{$values->id}}/{{$convert->convertString($values->name)}}.html" title="{{$values->name}}">
                        <img src="images/btndathang.jpg"></a>
                </div> -->
            </div>
            
            @endforeach
            
        </div>
        <div class="cate_pagination">
            <div id="ctl00_sanpham_pager" class="pagination" style="color: #000;"><?php echo $product->render(); ?></div>
        </div>
    </div>
    @stop