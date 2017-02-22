<div class="Footer">
    <div class="content-footer">
        <div class="block-footer">
        
            <div class="block-1">
                <p>Địa chỉ:</p>
                <ul>
                @foreach($info as $values)
                    @if($values->contents!="")
                            @if($values->name == "address")
                                <li>{!!$values->contents!!}</li>
                            @endif
                        
                    
                   @endif
                 @endforeach 
                </ul>
            </div>
            <div class="block-2">
                <p>Giờ mở cửa</p>
                <ul>
                    <li>Các ngày trong tuần từ 08:00h - 22:00h</li>
                </ul>
                @foreach($info as $values)
                    @if($values->contents!="")
                        @if($values->name == "email")<br/>
                        <strong>Email: </strong><span>{!!$values->contents!!}</span><br />
                        @endif
                        @if($values->name == "phone")
                        <strong>Hỗ trợ và CSKH: </strong><span>{!!$values->contents!!}</span>
                        @endif
                    @endif
                 @endforeach
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="width: 42%;float: left;margin-top: 10px;">
                                        <!-- GOOGLE-MAP-AREA START -->

                                        <div class="google-map-area">
                                            <div class="google-map">
                                            @foreach($info as $values)
                                            @if($values->contents!="" && $values->name =="maps")
                                                <?php echo $values->contents; ?>
                                                <!-- <div id="googleMap" style="width:100%;height:150px;"></div> -->
                                            @endif
                                            @endforeach
                                            </div>
                                        </div>
                                        <!-- GOOGLE-MAP-AREA END -->
        </div>
        <div class="block-footer2">
            <div class="block-1">
                <img src="{{Asset('')}}public/fontend/images/banner-foot.jpg" />
            </div>
        </div>
    </div>
    <div class="content-footer2">
        <div class="genius">
            <a style="color: white;float: right;margin-top: 12px;" href="http://Lovadweb.com">Develop by Lovadweb.com</a>
        </div>
    </div>
</div>