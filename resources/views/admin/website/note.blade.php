@extends('layouts.admin')
@section('title','Thông Báo')
@section('script')
<script type="text/javascript">
	$(function(){
        $("#nav-accordion>li:eq(4)>a").addClass("active").parent().find("ul>li:eq(4)").addClass("active");
    	 $("#valiapp").show().find("input[type='submit']").removeAttr("disabled");
    });
</script>
@endsection
@section('content')

	
    <form method="post" action="">
		<div class="row">
			<div class="col-md-2">
				Nội Dung:
			</div>
			<div class="col-md-10">
				<textarea name="note" rows="5" class="form-control">{{$data}}</textarea>
				<span class="desc">
					Mỗi thông báo cách nhau 1 hàng.<br />
					VD:<br /> Nghỉ tết từ ngày 03/02/2016 đến 12/02/2016<br />
					 10/2/2016 - Họp phòng nhân sự<br />...
					 <br />
					 Hoặc dấu '|'
					 VD: Nghỉ tết từ ngày 03/02/2016 đến 12/02/2016 | 10/2/2016 - Họp phòng nhân sự | ...
				</span>
			</div>
		</div>    	
		<div class="row">
			<div class="col-md-12 text-right" id="valiapp">
				<input type="submit" class="btn btn-success"  disabled="disabled" value="Lưu Lại" />
    			<input type="reset" class="btn btn-default" value="Nhập Lại" />
			</div>
		</div><br />
		<input type="hidden" name="_token" value="{{csrf_token()}}"/>
    </form>

@endsection