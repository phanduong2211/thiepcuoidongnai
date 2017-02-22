@extends('layouts.admin')

@section('title', 'Thêm Quản Trị Viên')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
	$(function(){
		$("#nav-accordion>li:eq(5)>a").addClass("active");
		$("#frm").kiemtra([
    		{
    			'name':'name',
    			'trong':true
    		},
            {
                'name':'username',
                'trong':true
            },
            {
                'name':'email',
                'email':true,
                'isnull':true
            },
            {
                'name':'phone',
                'sodt':true,
                'isnull':true
            },
            {
                'name':'level',
                'select':true
            },
            {
                'name':'password',
                'trong':true
            }
    	]);
	});
</script>
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/ad')}}'><i class="fa fa-chevron-circle-left"></i></a> Thêm Quản Trị Viên</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
    <form method="post" action="" id="frm">
    	<div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Họ Tên:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" class="form-control " name="name" value="{{$_POST['name'] or ''}}" />
                        <span class="desc">Hiển thị khi đăng nhập</span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Tài Khoản:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" class="form-control " name="username" value="{{$_POST['username'] or ''}}"  />
                        <span class="desc">Dùng để đăng nhập vào website</span>
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Email:
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control " name="email" value="{{$_POST['email'] or ''}}" />
                        <span class="desc">Dùng để đăng nhập vào website</span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Số Điện Thoại:
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="phone" value="{{$_POST['phone'] or ''}}"  />
                       
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Cấp Độ:
                    </div>
                    <div class="col-md-8 require">
                        <span class="red">*</span>
                       <select name="level" class="form-control">
                           <option value="-1">-- Lựa Chọn --</option>
                           <option value="1">Administrator</option>
                           <option value="2">Moderator</option>
                           <option value="3">Nhân Viên</option>
                       </select>
                        <span class="desc">
                            Administrator: Có mọi quyền.
                        </span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Mật Khẩu:
                    </div>
                    <div class="col-md-8 require">
                        <span class="red">*</span>
                        <input type="password" class="form-control" value="{{$_POST['password'] or '123456'}}" name="password"  />
                        <span class="desc">
                            Mật khẩu mặc định là 123456
                        </span>
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
        <input type="hidden" name="active" value="1"/>
        
    </form>

@endsection