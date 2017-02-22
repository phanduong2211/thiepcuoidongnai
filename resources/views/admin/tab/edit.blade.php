@extends('layouts.admin')

@section('title', 'Sửa Tab')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
	$(function(){
		$("#nav-accordion>li:eq(1)>a").addClass("active").parent().find("ul>li:eq(3)").addClass("active");
		$("#frm").kiemtra([
    		{
    			'name':'name',
    			'trong':true
    		}
    	]);
	});
</script>
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/tab')}}'><i class="fa fa-chevron-circle-left"></i></a> Sửa Tab</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
    <form method="post" action="" id="frm">
    	<div class="row">
    		<div class="col-md-2">
    			Tên Tab:
    		</div>
    		<div class="col-md-10 require">
    			<div class="red">*</div>
    			<textarea class="form-control" name="name">{{$data->name}}</textarea>
    			
    		</div>
    	</div><br />
    	<div class="row">
    		<div class="col-md-12 text-right">
    			<input type="submit" class="btn btn-success" value="Lưu Lại" />
    			<input type="button" class="btn btn-default btn-reset" value="Hủy Bỏ" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="idedit" value="{{$data->id}}"/>
    </form>

@endsection