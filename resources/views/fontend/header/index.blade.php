
<div class="content-head">
   <!--------------------------flash chạy chữ----------------------------------->             
<!-- <div class="headerTop">
    <embed src="{{Asset('')}}public/fontend/images/thiepcuoibanner.swf" quality="high" type="application/x-shockwave-flash" wmode="transparent" width="780" height="40" pluginspage="http://www.macromedia.com/go/getflashplayer" allowscriptaccess="always"></embed>
</div> -->
<div class="medium-head">
    <div class="Logo">
        <a href="{{Asset('')}}">
            <img src="{{Asset('public/img/logo.png')}}" alt="thiếp cưới đồng nai logo" />

    </div>
    <div class="Hotline">
        @foreach($info as $values)
        @if($values->name == "phone" && $values->contents!="")
            <p style="text-align:right;color:white;font-weight: bold;line-height: 3;width: 81%; background: url('{{Asset('')}}public/fontend/images/bg_call.png') no-repeat left">{{$values->contents}}</p>
        @endif
        @endforeach
        </div>
</div>

                
<div class="MainMenu">
        <ul id="menu">
            <li><a href="/" title="Trang chủ">
                <img src="{{Asset('')}}public/fontend/images/home-icon.png" alt="trang chủ" /></a></li>
            <li>
                <a href="{{Asset('')}}pages/gioi-thieu" title="Giới thiệu">Giới thiệu</a>
            </li>
            <li>
                <a href="javascript:void(0);" title="Bộ sưu tập">Bộ sưu tập</a>
                <ul>
                    @foreach($categorys as $values)
                    
                    <li>
                        <a href="{{Asset('')}}danh-muc/{{$convert->convertString($values->name)}}" title="{{$values->name}}">{!!$values->name!!}</a>
                    </li>
                    @endforeach
                    
                </ul>
            </li>
            @foreach($menu as $values)
             <li>
                <a href="{{Asset($values->url)}}" title="Đặt hàng">{!!$values->name!!}</a>
            </li>
            @endforeach
            
            <li>
                <a href="{{Asset('')}}Lien-he" title="Liên hệ">Liên hệ</a>
            </li>
        </ul>
</div>

            </div>