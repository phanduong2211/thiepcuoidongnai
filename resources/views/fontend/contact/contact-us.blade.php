@extends('fontend.index')
@section('main')
<style type="text/css">
	h2.contant-page-title {
    margin-bottom: 17px;
}
h2.page-title {
    border-bottom: 1px solid #d6d4d4;
    color: #555454;
    font-size: 18px;
    line-height: 22px;
    font-weight: 600;
    margin-bottom: 30px;
    margin-top: 0px;
    overflow: hidden;
    padding: 0 0 17px;
    text-transform: uppercase;
}

form.contact-form button.send-message {
    margin: 0;
    padding: 10px 10px 10px 14px;
}
.main-btn:hover, .main-btn:focus, .main-btn:active {
    background: #3A3D42;
    color: #fff;
    border: 1px solid #3A3D42;
}
.main-btn {
    background: #ff4f4f none repeat scroll 0 0;
    border: 1px solid #ff4f4f;
    border-radius: 0;
    color: #fff;
    font-size: 17px;
    line-height: 21px;
    padding: 0;
    transition: all 500ms ease 0s;
    margin-bottom: 7px;
}
.input-feild
{
	height: 26px;
    width: 326px;
    margin-top:5px;
}
.form-group label
{
	padding-left:5px;
	margin-right:5px;
}
.contact-text
{
	    margin: 0px;
    width: 657px;
    height: 101px;
}
.alert-info {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
</style>
		<section style="clear: both" class="main-content-section">
			<div style="margin-left:10px" class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
					</div>
				</div>
				<div class="row">
					<div style="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h2 style="margin-top:106px" class="page-title contant-page-title">Nhập vào thông tin liên hệ</h2>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!-- CONTACT-US-FORM START -->
						<div class="contact-us-form">
							<div class="contact-form-center">
								<h3 class="contact-subheading"></h3>
								<!-- CONTACT-FORM START -->
								<form class="contact-form" id="contactForm" method="post" action="insertcontact">
									<?php if(Session::has("contactSend")) { echo '<div class="alert alert-info">
										  <strong>Thành công!</strong> Cám ơn bạn đã gửi thông tin phản hồi cho chúng tôi, chúng tôi sẽ liên hệ với bạn sớm nhất có thể.
										</div>'; Session::forget("contactSend");}?>
									<div class="row">
										<div style="float: left" class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
											<div class="form-group primary-form-group">
												<label>Chủ đề</label>
												<input type="text" class="form-control input-feild" id="subject" name="subject" value="" required>
											</div>	
											<div class="form-group primary-form-group">
												<label style="margin-right:17px">Email</label>
												<input type="email" class="form-control input-feild" id="email" name="email" value="" required>
											</div>	
											
											<br>
											
										</div>
										<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
											<div class="type-of-text">
												<div class="form-group primary-form-group">
													<label style="float:left">Nội dung</label>
													<textarea class="contact-text" required name="content"></textarea>
												</div>													
											</div>
										</div>
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button style="float:right;margin: 20px" type="submit" name="submit" id="sendMessage" class="send-message main-btn">Gửi <i class="fa fa-chevron-right"></i></button>
										<div class="" style="clear: both;"> </div>
									</div>
								</form>
								<!-- CONTACT-FORM END -->
							</div>
						</div>
						<!-- CONTACT-US-FORM END -->
					</div>
				</div>
			</div>
		</section>
		<!-- MAIN-CONTENT-SECTION END -->
		<!-- BRAND-CLIENT-AREA START -->
		@stop