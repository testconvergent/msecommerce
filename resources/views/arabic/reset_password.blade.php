@extends('arabic.layout.app')
@section('title',__('messages.reset_password'))
@section('body')
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<div class="container">
	   <div class="row">
		   <div class="signup_cont">
				<div class="signup_area xxmgb">
				   <h1>@lang('messages.reset_password')</h1>
				   <!--<h2>Please provide your details to signup on MsEcommerce</h2>-->
					@if(@session()->get('msg'))<div class="alert alert-danger ">{{session()->get('msg')}}</div>@endif
					<form id="reset_password" method="post">
						{{csrf_field()}}
						<input class="pass_img required" type="password" placeholder="@lang('messages.password')" name="password" id="password">
						<input class="pass_img required" type="password" placeholder="@lang('messages.con_password')" name="cpassword" id="cpassword">
						<div class="clearfix"></div>
						<input type="submit" value="@lang('messages.save')">  
					</form>
					<div class="login_bt_arera">
					   <h5>@lang('messages.new') @lang('messages.to') MsEcommerce? <span>@lang('messages.signup') @lang('messages.now')</span></h5>
					   <a href="seller-signup" class="borrdd">@lang('messages.signup') @lang('messages.as') @lang('messages.seller')</a>
					   <a href="customer-signup">@lang('messages.signup') @lang('messages.as') @lang('messages.customer')</a>
					</div>
				</div>
		   </div>
	   </div>
    </div>
</div>
@include('arabic.layout.footer')
<script>
$(document).ready(function(){
	$('#reset_password').validate({
		rules: {
			cpassword: {
			  equalTo: "#password"
			}
		}
	});
});
</script>
@endsection