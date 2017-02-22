@extends('layouts.admin')

@section('title', 'Đổi Mật Khẩu')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
	$(function(){
		$("#frm").kiemtra([
    		{
    			'name':'password',
    			'trong':true
    		},
            {
                'name':'newpassword',
                'trong':true
            },
            {
                'name':'renewpassword',
                'sosanhdoituong':true,
                'name2':'newpassword',
                'message':'Nhập lại mật khẩu sai'
            }
    	]);
	});
</script>
@endsection
@section('content')
<h1 class="titlepage" style="text-align:center">Đổi Mật Khẩu</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
    <form method="post" action="" id="frm">
    	<div class="row">
    		<div class="col-md-2 col-md-offset-2">
    			Mật Khẩu Cũ:
    		</div>
    		<div class="col-md-4">
    			<input type="password" name="password" class="form-control" />
    		</div>
    	</div><br />
    	<div class="row">
    		<div class="col-md-2 col-md-offset-2">
    			Mật Khẩu Mới:
    		</div>
    		<div class="col-md-4">
    			<input type="password" name="newpassword" class="form-control" />
    		</div>
    	</div><br />
    	<div class="row">
    		<div class="col-md-2 col-md-offset-2">
    			Nhập Lại Mật Khẩu Mới:
    		</div>
    		<div class="col-md-4">
    			<input type="password" name="renewpassword" class="form-control" />
    		</div>
    	</div><br />
    	<div class="row">
    		<div class="col-md-8 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
    </form>

@endsection