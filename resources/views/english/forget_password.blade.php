@extends('english.layout.app')
@section('title','Forget Password')
@section('body')
<div class="wrapper for_this_bg">
	@include('english.layout.header')
	<div class="container">
		   <div class="row">
			   <div class="signup_cont">
					<div class="signup_area xxmgb">
					   <h1>Forget Password</h1>
					   <!--<h2>Please provide your details to signup on MsEcommerce</h2>-->
					    @if(@session()->get('msg'))<div class="alert alert-danger ">{{session()->get('msg')}}</div>@endif
						<form id="forget_password" method="post">
							{{csrf_field()}}
							<input class="log_img required" type="text" placeholder="Email Address" name="email">
							<div class="clearfix"></div>
							<input type="submit" value="Submit">  
						</form>
						 <div class="login_bt_arera">
						   <h5>New To MsEcommerce? <span>Signup Now</span></h5>
						   <a href="seller-signup" class="borrdd">Signup As Seller</a>
						   <a href="customer-signup">Signup As Customer</a>
						 </div>
					</div>
			   </div>
		   </div>
       </div>
</div>
@include('english.layout.footer')
<script>
$(document).ready(function(){
	$('#forget_password').validate();
});
</script>
@endsection