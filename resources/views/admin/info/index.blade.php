@extends('layouts.admin')

@section('title', 'Thông Tin Cá Nhân')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
	$(function(){
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
            }
    	]);
	});
</script>
@endsection
@section('content')
<h1 class="titlepage">Thông Tin Cá Nhân</h1>
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
                        <input type="text" class="form-control " name="name" value="{{$data->name}}" />
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
                        <input type="text" class="form-control " name="username" value="{{$data->username}}"  />
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
                        <input type="email" class="form-control " name="email" value="{{$data->email}}" />
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
                        <input type="text" class="form-control " name="phone" value="{{$data->phone}}"  />
                       
                    </div>
                </div><br />
            </div>
        </div><br />
    	<div class="row">
    		<div class="col-md-12 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
    </form>

@endsection