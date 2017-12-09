@extends('arabic.layout.app')
@section('title',__('messages.login'))
@section('body')
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<div class="container">
	   <div class="row">
		   <div class="signup_cont">
				<div class="signup_area xxmgb">
				   <h1>@lang('messages.welcome') @lang('messages.back')!</h1>
				   <!--<h2>Please provide your details to signup on MsEcommerce</h2>-->
					@if(@session()->get('msg'))<div class="alert alert-danger ">{{session()->get('msg')}}</div>@endif
					<form id="login" method="post" action="login">
						{{csrf_field()}}
						<input class="log_img required" type="text" placeholder="@lang('messages.email_address')" name="email">
						<input class="pass_img required" type="password" placeholder="@lang('messages.password')" name="password">
						<div class="clearfix"></div>
						<a href="#">@lang('messages.forget_pass')</a>
						<div class="checkbox-group forr1 forr2"> 
							<input id="checkiz1" type="checkbox"> 
							<label for="checkiz1">
							<p class="ft_text">@lang('messages.remember') @lang('messages.me')</p>
								<span class="check"></span>
								<span class="box"></span>
							</label>
						</div>
						<div class="clearfix"></div>
						<input type="submit" value="@lang('messages.login')">  
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
	$('#login').validate();
});
</script>
@endsection