@extends('english.layout.app')
@section('title','Change Password')
@section('body')
<div class="wrapper for_this_bg">
	@include('english.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2">
						<h2>Change Password</h2>
						<span class="line"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details">
							<div class="clearfix"></div>
							<div class="allrt">
								@if(@session()->get('error'))
								<div class=" alert alert-error fade in ">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{session()->get('error')}}</div>@endif
								
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<div class="details_box forr_c_pass qxaa">
								<form id="change_password" method="post" action="change-password">
								{{csrf_field()}}
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Current Password</label>
												<input class="from_type required" placeholder="Current Password" type="password" id="curr_password" name="curr_password">
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">New Password</label>
												<input class="from_type required" placeholder="New Password" type="password" name="new_password" id="new_password">
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Confirm Password</label>
												<input class="from_type required" placeholder="Confirm Password" type="password" name="conf_password" id="conf_password">
											</div>
										</div>
									</div>
									<div class="details_box details_box_2">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<input class="sub_btn qqawee" value="Change Password" type="submit">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>
@include('english.layout.footer')
<script>
$(document).ready(function(){
	$("#change_password").validate({
		rules: {
			conf_password: {
				equalTo: "#new_password"
			}
		}
	});
});
</script>
@endsection