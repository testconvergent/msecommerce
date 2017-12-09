@extends('admin.layout.app')
@section('title','Admin')
@section('body')
	<div class="wrapper-page">
		<div class="panel panel-color panel-primary panel-pages">
			<div class="panel-heading bg-img"> 
				<div class="bg-overlay"></div>
				<h3 class="text-center m-t-10 text-white"><img src="assets/images/llogo.png"></h3>
			</div> 
			<div class="panel-body">
				<span class="err_msg text-center">
                  @if(@session()->get('success'))<div class="alert alert-danger ">{{session()->get('success')}}</div>@endif
               </span>
			<form class="form-horizontal m-t-20" method="post" name="login_frm" action="{{url('/admin-login')}}" id="login_frm">
			 {{csrf_field()}}
				<div class="form-group">
					<div class="col-xs-12">
						<input class="form-control input-lg required" type="text" placeholder="Email" name="email"> 
					</div>
					@if ($errors->has('email'))<p class="error">{{$errors->first('email')}}</p>@endif
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<input class="form-control input-lg required" type="password" placeholder="Password" name="password">
					</div>
					@if ($errors->has('password'))<p class="error">{{$errors->first('password')}}</p>@endif
				</div>
				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
					</div>
				</div>
				
			</form> 
			</div>   
		</div>
	</div>
	 <script>
	  $(document).ready(function(){
		  $("#login_frm").validate();
		   $(".fg_form").validate();
		   $(".fg").click(function(){
			   $(".fg_form").show();
			   $(".lg_form").hide();
		   });
		   $(".lg").click(function(){
			   $(".lg_form").show();
			   $(".fg_form").hide();
		   });
	  });
	  </script>
@endsection