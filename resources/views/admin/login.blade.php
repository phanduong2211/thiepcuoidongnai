<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Đăng Nhập ACP</title>
	<link href="{{Asset('')}}public/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		#box{
			width:350px;
			margin: 5% auto;
			
		}
		#box #ctbox{
			background-color: white;
			padding: 20px;
			box-shadow: 0px 0px 3px #ccc;
			-webkit-box-shadow: 0px 0px 3px #ccc;
			-moz-box-shadow: 0px 0px 3px #ccc;
		}
		body{
			padding:0;
			background-color: #eee;
		}
		label{
			font-weight: normal;
			font-size: 13px;
		}
		a{
			color:#999;
		}
		.message {
			margin-left: 0;
			padding: 12px;
		}
		.message {
			border-left: 4px solid #00a0d2;
			background-color: #fff;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		span{
			color:#999;
		}
	</style>
</head>
<body>

	<div id="box">
		<div class="text-center">
			<img src="{{Asset('public/img/logo.png')}}" />
		</div><br />
		@if(Session::has('message'))
		<p class="message"> {{ Session::get('message') }}<br>
		</p>
		@endif
		<div id="ctbox">
			<form method="post" action="" name="frm">
				Tài khoản hoặc email
				<div style="height:3px"></div>
				<input class="form-control" type="text" name="username" value="<?php echo (Session::has('username'))?Session::get('username'):'' ?>" /><br />
				Mật khẩu
				<div style="height:3px"></div>
				<input class="form-control" type="password" name="password" />
				<br />
				<label>
					<input type="checkbox" name="rememberme" /> Tự động đăng nhập lần sau
				</label> 
				<input type="submit" class="btn btn-primary pull-right" value="Đăng nhập" />
				<input type="hidden" name="_token" value="{{csrf_token()}}"/>
			</form>
		</div>
		<br /><span>Nếu quyên mật khẩu, vui lòng liên hệ admin để reset lại.</span>
		<br /><br />
		<a href='{{Asset('')}}'><< Trở về trang chủ</a>
	</div>
	<script type="text/javascript">
	document.frm.username.focus();
	</script>
</body>
</html>