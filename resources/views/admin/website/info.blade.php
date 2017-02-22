@extends('layouts.admin')
@section('title','Thông tin website')
@section('content')

<?php 
    function showImage($path){
        if(strpos($path, "http")===0)
            return $path;
        return Asset('public/image/').'/'.$path;
    }
    ?>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
<style type="text/css">
hr{
	border-top:1px solid #ddd !important;
	margin-top: 0 !important;
}
</style>
<div>
	<h4>Thông Tin Chung</h4>
	<hr />
<form method="post" id="frm-all" action="{{Asset('admin/info/postinfoall')}}">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Tiêu đề:
				</div>
				<div class="col-md-8 require">
					<div class="red">*</div>
					<textarea rows="4" class="form-control" name="title">{{$data['title']}}</textarea>
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Mô Tả:
				</div>
				<div class="col-md-8">
					<textarea rows="4" class="form-control" name="description">{{$data['description']}}</textarea>
				</div>
			</div><br />
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Từ Khóa:
				</div>
				<div class="col-md-8">
					<textarea rows="3" class="form-control" name="keyword">{{$data['keyword']}}</textarea>
					<span class="desc">Mỗi từ khóa cách nhau 1 dấu ','</span>
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Bản Đồ:
				</div>
				<div class="col-md-8">
					<textarea rows="3" class="form-control" name="maps">{{$data['maps']}}</textarea>
					<span class="desc"><a target="_black" href='https://www.google.com/maps/@19.0084795,118.3805517,5z'>Vào đây</a> để lấy bản đồ</span>
				</div>
			</div><br />
		</div>
	</div>
	<div class="row">
    		<div class="col-md-12 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
</form>
</div><!--//Thông Tin Chung-->

<div>
	<h4>Thông Tin Liên Hệ</h4>
	<hr />
<form method="post" id="frm-contact" action="{{Asset('admin/info/postinfcontact')}}">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Địa Chỉ:
				</div>
				<div class="col-md-8 require">
					<div class="red">*</div>
					<textarea class="form-control" name="address">{{$data['address']}}</textarea>
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Số Điện Thoại:
				</div>
				<div class="col-md-8 require">
					<div class="red">*</div>
					<input type="text" class="form-control" name="phone" value="{{$data['phone']}}" />
				</div>
			</div><br />
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Email:
				</div>
				<div class="col-md-8 require">
					<div class="red">*</div>
					<input type="email" class="form-control" name="email" value="{{$data['email']}}" />
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Link Skype:
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="skype" value="{{$data['skype']}}" />
				</div>
			</div><br />
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Link Facebook:
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="facebook" value="{{$data['facebook']}}" />
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Link Google:
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="google" value="{{$data['google']}}" />
				</div>
			</div><br />
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					Link Twitter:
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="twitter" value="{{$data['twitter']}}" />
				</div>
			</div><br />
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
	<div class="row">
    		<div class="col-md-12 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
</form>

</div><!--//Thông Tin Liên Hệ-->
<br />
<div>
<h4>
	Logo & Favicon
	 
</h4>
	<hr />
	
	<div class="row">
			<div class="col-md-6">
				<b>Logo</b><br /><br />
				<form method="post" action="<?php echo Asset('admin/info/changelogo') ?>" id="frmchangelogo" enctype="multipart/form-data">
				<label for="logo" class="uploadimg">
					<div>
						<img class="img-thumbnail" src="{{Asset('public/img/logo.png')}}" data-old="logo.png" />
					</div>
					<br />
					<input type="file" name="logo" class="hide" id="logo" />
					</label>
					<span class="desc">Kích thước chuẩn: 200x90</span>
					<input type="submit" class="btn btn-success btn-xs disabled" disabled="disabled" value="Lưu Lại" />
					<input type="reset"  disabled="disabled" class="btn btn-primary btn-xs disabled" value="Hủy Bỏ" />
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form>
			</div>
			<div class="col-md-6">
				<b>Favicon</b><br /><br />
				<form method="post" action="<?php echo Asset('admin/info/changefavicon') ?>"  enctype="multipart/form-data">
				<label for="favicon" class="uploadimg">
					<div>
						<img class="img-thumbnail" src="{{Asset('public/img/favicon.png')}}" data-old="favicon.png" />
					</div>
					<br />
					<input type="file" name="favicon" class="hide" id="favicon" />
					</label>
					<br /><br />
					<br /><br />
					<br />
					<span class="desc">Kích thước chuẩn: 16x16.</span>

					<input type="submit" class="btn btn-success btn-xs disabled" disabled="disabled" value="Lưu Lại" />
					<input type="reset"  disabled="disabled" class="btn btn-primary btn-xs disabled" value="Hủy Bỏ" />
					<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				</form>
			</div>
		</div>

</div><!--//Logo và favicon-->
<br />
<h4>Đối tác(Kích thước chuẩn 130x50)
<a href='' class="newimageslide btn btn-xs btn-primary pull-right">
                            <i class="fa fa-plus" ></i> Thêm Đối Tác

                        </a>
</h4>
	<hr />
	<form method="post" action="{{Asset('admin/info/changebrand')}}">
	<div id="imagesclss">
	<?php 
                 $brand=explode(",", $data['brand']);
                 foreach ($brand as $key => $value) {
                    if($value!=""){
                    ?>
                    <div class="col-md-3 text-center itemimages"><img src="{{showImage($value)}}" class="img-thumbnail showupload uploadimg" href="#imagesschooseval{{$key}}" id="imgchoose" width="50%"><br><b class="removeimgsss">Xóa</b><br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br><input type="text" value="{{$value}}" class="form-control " name="silebar_images[]" id="imagesschooseval{{$key}}" />Hoặc upload ảnh khác.</div></div>
                    <?php }} ?>

                   </div>
<div>
<div class="row">
    		<div class="col-md-12 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
</form>
	
</div><!--//Đối tác-->

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/dialog.css" />
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection

@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/dialog.js"></script>
<script type="text/javascript">
var asset_path1="{{Asset('public/img')}}/";
var base_url_admin="{{Asset('admin')}}/";
    var asset_path="{{Asset('public')}}/";
    var __token="{{csrf_token()}}";
    function callBackUpload(idobjclick,path){
    	$(idobjclick).val(path);
    	$(idobjclick).parent().parent().find(".uploadimg").attr("src",asset_path+"image/"+path);
    }
function isImage(file) {
    file = file.split(".").pop();
    switch (file) {
        case "jpg": case "png": case "gif": case "bimap": case "jpeg": case "ico":
            return true;
        default:
            return false;
    }
    return false;
}
	function readURL(input) {
		if (input.files && input.files[0]) {
			if(isImage(input.files[0].name)){
				var reader = new FileReader();
				reader.onload = function (e) {
					$(input).parent().find(".img-thumbnail").attr("src",e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}else{
				alert("vui lòng chọn 1 hình ảnh");
			}
		}
		else {
			$(input).parent().find(".img-thumbnail").attr("src",  $(input).val());
		}
	}
	$(document).ready(function(){
		$("#nav-accordion>li:eq(4)>a").addClass("active").parent().find("ul>li:eq(1)").addClass("active");
		$("label.uploadimg .hide").change(function(){
			if(this.files){
			readURL(this);
		}
			$(this).parent().parent().find(".disabled").removeClass("disabled").removeAttr("disabled");
		});
		$("form input[type=reset]").click(function(){
			var img=$(this).parent().find(".img-thumbnail");
			img.attr("src",asset_path1+img.attr("data-old"));
		});

		$("#imagesclss").on("click",".removeimgsss",function(){
		    if($(this).parent().find('input[type="text"]').val()!=""){
		        if(confirm("Bạn có chắc muốn xóa?")){
		            $(this).parent().remove();

		        }
		        return false;
		    }
		    $(this).parent().remove();
		    return false;
		});

		$(".newimageslide").click(function(){
		    var size=$("#imagesclss").find(".itemimages").size();
		   $("#imagesclss").append('<div class="col-md-3 text-center itemimages"><img src="'+(asset_path+"image/uploadimg.png")+'" class="img-thumbnail showupload uploadimg" href="#imagesschooseval'+size+'" id="imgchoose" width="50%" /><br /><b class="removeimgsss">Xóa</b><br /><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br /><input type="text" value="" class="form-control " name="silebar_images[]" id="imagesschooseval'+size+'" />Hoặc upload ảnh khác.</div></div>');
		    return false;
		});

		$("#frm-all").kiemtra([
			{
				'name':'title',
				'trong':true
			}
		]);

		$("#frm-contact").kiemtra([
			{
				'name':'address',
				'trong':true
			},
			{
				'name':'phone',
				'sodt':true
			}
			,
			{
				'name':'email',
				'email':true
			}
		]);
	});
</script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/jsupload.js"></script>
@endsection
<style type="text/css">
	.uploadimg:hover img{
		border:1px solid #ccc;
	}
	 .removeimgsss{
        font-weight: normal;
    }
    .removeimgsss:hover{
        text-decoration: underline;
        cursor: pointer;
    }
</style>
 @include('upload')