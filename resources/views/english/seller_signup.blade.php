@extends('english.layout.app')
@section('title',__('messages.seller_signup'))
@section('body')
<div class="wrapper for_this_bg">
	@include('english.layout.header')
	<div class="container">
		<div class="row">
			<div class="signup_cont">
				<div class="signup_area">
				   <h1>@lang('messages.seller_signup')</h1>
				   <h2>@lang('messages.seller_sign_up_text') MsEcommerce</h2>
					<form id="seller" method="post" action="seller-signup">
						{{csrf_field()}}
						<div class="f_name">
							<input class="required" type="text" placeholder="@lang('messages.first_name')" name="fname">
						</div>
						<div class="l_name">
							<input class="required" type="text" placeholder="@lang('messages.last_name')" name="lname">
						</div>
						<input type="text" placeholder="@lang('messages.company_name')" class="required" name="company_name" id="company_name">
						<input type="email" placeholder="@lang('messages.email_address')" class="required" name="email" id="email">
						<input type="password" placeholder="@lang('messages.password')" class="required" name="password" id="new_password">
						<input type="password" placeholder="@lang('messages.con_password')" class="required" name="conf_password" id="conf_password">
						<div class="clearfix"></div>
						<div class="checkbox-group forr1"> 
							<input id="checkiz1" type="checkbox" name="term_condi" class="term_condi"> 
							<label for="checkiz1">
								<span class="check"></span>
								<span class="box"></span>
								<p class="ft_text">@lang('messages.trem_and_condi')</p>
							</label>
							<span id="tc"></span>
						</div>
						<input type="submit" value="@lang('messages.signup')" name="signup">     
						<h3>@lang('messages.existing_user') <a href="login">@lang('messages.login')</a></h3>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
@include('english.layout.footer')
<style>
#tc{
	width: 100%;
	float: left;
	text-align: left;
	color: red;
	display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
</style>
<script>
$(document).ready(function(){
	$('#seller').validate({
	rules: {
			conf_password: {
			  equalTo: "#new_password"
			}
		}
	});
	$('#seller').submit(function(){
		if(!$('.term_condi').is(':checked')) 
		{
			//alert('uncheck');
			$('#tc').html('This field is required');
			return false;
		}
		else
		{
			//alert('check');
			//$('#customer').submit();
			return true;
		}
	});
	$('.term_condi').click(function(){
		$('#tc').html('');
	});
	$('#email').blur(function(){
		var email = $('#email').val();
		if(email != "")
		{
			$.ajax({
				type:'get',
				url:'<?php echo url('ajax-email');?>',
				data:'_token = <?php echo csrf_token()?>&email='+email,
				dataType: 'json',
				success:function(data)
				{
					
					if(data == 2)
					{
						$('#email').css('border','');
						return true;
					}
					else
					{
						$('#email').val('');
						$('#email').attr('placeholder','Email already exist');
						$('#email').css('border','2px solid #FF0000');
						$('#email').focus();
						return false;
					}
				}
			});
		}
	});
});
</script>
@endsection