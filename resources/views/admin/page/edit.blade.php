@extends('layouts.admin')

@section('title', 'Sửa Trang')
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
        }
	$(function(){
		$("#nav-accordion>li:eq(4)>a").addClass("active");
		$("#frm").kiemtra([
    		{
    			'name':'name',
    			'trong':true
    		}
            // ,
            // {
            //     'name':'menuid',
            //     'select':true
            // }
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
<h1 class="titlepage"><a href='{{Asset('admin/page')}}'><i class="fa fa-chevron-circle-left"></i></a> Sửa Trang</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
    <form method="post" action="" id="frm" name="frmedit">
    	<div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Tiêu Đề Trang:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" name="name" class="form-control" value="{{$data->name}}" />
                        <span class="desc">Hiển thị trên trình duyệt.</span>
                    </div>
                </div><br />
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Url:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" name="url" class="form-control" value="{{$data->url}}" />
                        <span class="desc">Nếu bỏ trống thì sẽ lấy theo tiêu đề trang</span>
                    </div>
                </div><br />
            </div>
          
        </div><br />
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        Nội Dung:
                    </div>
                    <div class="col-md-10">
                        <textarea style="width:100%;height:250px" name="content" id="content">{{$data->content}}</textarea>
                    </div>
                </div><br />
            </div>
        </div><br />
    	<div class="row">
    		<div class="col-md-12 text-right" id="valiapp">
    			<input type="submit" class="btn btn-success" disabled="disabled" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Hủy Bỏ" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="idedit" value="{{$data->id}}"/>
    </form>

@include('upload')
<a class="nicupload showupload" href="#nicupload">Upload</a>
@endsection