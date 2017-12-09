@extends('english.layout.app')
@section('title','Success')
@section('body')
<div class="wrapper">
	@include('english.layout.header')
	<div class="full_bg_area" >
		<div class="container">
			<div class="row">
			  <div class="meea">
				 <div class="artist_boxx" style="margin-top: 75px; width: 100%;">
					<img src="images/customer.png" alt="">
					@if($message == 'resistration-success')
					<h3>Registration Successfully</h3>
					<P>You have scuccessfully completed your registration. A verification link has been sent to your registered email address. Please verify your account and login with your registered email and password.</P>
					<a href="login" class="upload">log in now</a>
					@elseif($message == 'mail-verification')
					<h3>Email Verification</h3>
					<P>You have successfully verify your email. Now you can login your register email and password.</P>
					<a href="login" class="upload">log in now</a>
					@elseif($message == 'expired_link')
					<h3>Oppos Somthing Went Wrong</h3>
					<P>Your entire link has been expired.</P>
					<a href="login" class="upload">log in now</a>
					@elseif($message == 'forgetpassword')
					<h3>Reset Password</h3>
					<P>A password reset mail has been sent to your email please check your email and reset your password.</P>
					<a href="login" class="upload">log in now</a>
					@elseif($message == 'resetpassword')
					<h3>Reset Password</h3>
					<P>Your password reset has been successfully.</P>
					<a href="login" class="upload">log in now</a>
					@endif
				 </div>
			  </div>
			</div>
		</div>
	</div>
</div>
@include('english.layout.footer')
@endsection