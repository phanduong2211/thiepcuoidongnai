@extends('layouts.admin')

@section('title', 'Sửa SlideShow')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/dialog.js"></script>
<script type="text/javascript">
    var base_url_admin="{{Asset('admin')}}/";
    var asset_path="{{Asset('public')}}/";
    var __token="{{csrf_token()}}";
     function callBackUpload(idobjclick,path){
            $(idobjclick).val(path);
            $(".boxupload img").attr("src",asset_path+"image/"+path);
    
            $("#frm input[name='image']").removeClass("error").next(".errortext").hide();
        }
    $(function(){
        $("#nav-accordion>li:eq(2)>a").addClass("active");
        $("#frm").kiemtra([
            {
                'name':'name',
                'trong':true
            },
            {
                'name':'image',
                'trong':true
            },
            {
                'name':'url',
                'url':true,
                'isnull':true
            },
            {
                'name':'page',
                'select':true
            }
        ]);
    });
</script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/jsupload.js"></script>
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/slide')}}'><i class="fa fa-chevron-circle-left"></i></a> Sửa SlideShow</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
<?php 
    function showImage($path){
        if(strpos($path, "http")===0)
            return $path;
        return Asset('public/image/').'/'.$path;
    }
    ?>
    <form method="post" action="" id="frm" name="frmedit">
        <div class="row">
            <div class="col-md-2">
                Tiêu Đề:
            </div>
            <div class="col-md-10 require">
                <div class="red">*</div>
                <textarea name="name" class="form-control">{{$data->name}}</textarea>
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Hình Ảnh:
                    </div>
                    <div class="col-md-8 require boxupload">
                        <div class="red">*</div>
                        <img src="{{showImage($data->image)}}" class="img-thumbnail showupload uploadimg" href="#imagechooseval" id="imgchoose" width="100px">
                        <br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br>
                        <input type="text" class="form-control " name="image" id="imagechooseval" value="{{$data->image}}" />Hoặc upload ảnh khác.</div>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Nội Dung:
                    </div>
                    <div class="col-md-8 ">
                       <textarea name="content" rows="7" class="form-control">{{$data->content}}</textarea>
                    </div>
                </div><br />
            </div>
          
        </div><br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Hiển Thị Trong Trang:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <select name="page" class="form-control">
                            <option value="-1">-- Lựa Chọn --</option>
                            <option value="0">Trang Chủ</option>
                            @foreach($datac as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        <span class="desc">Slide này sẽ hiện thị trong trang nào?</span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Url:
                    </div>
                    <div class="col-md-8">
                        <textarea name="url" rows="1" class="form-control">{{$data->url}}</textarea>
                        <span class="desc">Copy url trên trình duyệt vào dán vào.</span>
                    </div>
                </div><br />
            </div>
          
        </div><br />
          
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="submit" class="btn btn-success" value="Lưu Lại" />
                <input type="reset" class="btn btn-default" value="Nhập Lại" />
            </div>
        </div><br />
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="idedit" value="{{$data->id}}"/>
    </form>

    <script type="text/javascript">
    document.frmedit.page.value="{{$data->page}}";
    </script>

@include('upload')
@endsection

 