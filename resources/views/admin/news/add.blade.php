@extends('layouts.admin')

@section('title', 'Thêm Tin Tức')
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
    var btnUpload=null;
     function callBackUpload(idobjclick,path){
            if(idobjclick=="#nicupload"){
                $("textarea"+btnUpload).parent().find(".nicEdit-main").append("<div class='postimg'><img src='"+asset_path+"image/"+path+"' /></div>");
                return false;
            }
            $(idobjclick).val(path);
            $(".boxupload img").attr("src",asset_path+"image/"+path);
    
            $("#frm input[name='image']").removeClass("error").next(".errortext").hide();
        }
    $(function(){
		$("#nav-accordion>li#menuitemtt>a").addClass("active").parent().find("ul>li:eq(1)").addClass("active");
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
                'name':'description',
                'trong':true
            },
            {
                'name':'categoryNewsId',
                'select':true
            }
    	]);

        $("#valiapp").show().find("input[type='submit']").removeAttr("disabled");
	});
</script>

<script type="text/javascript" src="{{Asset('')}}public/admin/js/jsupload.js"></script>
<script type="text/javascript" src="<?php echo Asset('public/admin/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        new nicEditor({ fullPanel: true }).panelInstance("content");
    });
</script>
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/news')}}'><i class="fa fa-chevron-circle-left"></i></a> Thêm Tin Tức</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
    <form method="post" action="" id="frm">
    	<div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        Tiêu Đề:
                    </div>
                    <div class="col-md-10 require">
                        <div class="red">*</div>
                        <textarea name="name" class="form-control">{{$_POST['name'] or ''}}</textarea>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        Loại:
                    </div>
                    <div class="col-md-10 require">
                        <div class="red">*</div>
                        <select name="categoryNewsId" class="form-control">
                            <option value="-1">-- Chọn Loại --</option>
                            @foreach($data as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        Hình Ảnh:
                    </div>
                    <div class="col-md-10 require boxupload">
                        <div class="red">*</div>
                        <img src="{{Asset('public/image/uploadimg.png')}}" class="img-thumbnail showupload uploadimg" href="#imagechooseval" id="imgchoose" width="100px">
                        <br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br>
                        <input type="text" class="form-control " name="image" id="imagechooseval" />Hoặc upload ảnh khác. Kích thước chuẩn 270x169</div>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        Mô Tả:
                    </div>
                    <div class="col-md-10 require">
                        <div class="red">*</div>
                       <textarea rows="7" name="description" class="form-control">{{$_POST['description'] or ''}}</textarea>
                        <span>Mổ tả ngắn gọn về tin tức. Khoảng 200 ký tự</span>
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        Nội Dung:
                    </div>
                    <div class="col-md-11">
                        <textarea style="width:100%;height:250px" name="content" id="content">{{$_POST['content'] or ''}}</textarea>
                    </div>
                </div><br />
            </div>
        </div><br />
    	<div class="row">
    		<div class="col-md-12 text-right" id="valiapp">
    			<input type="submit" class="btn btn-success" disabled="disabled" value="Lưu Lại" />
    			<input type="reset" class="btn btn-default" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
    </form>
@include('upload')
<a class="nicupload showupload" href="#nicupload">Upload</a>
@endsection