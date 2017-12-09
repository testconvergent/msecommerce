@extends('arabic.layout.app')
@section('title',__('messages.change_password'))
@section('body')
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2">
						<h2>@lang('messages.change_password')</h2>
						<span class="line"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('arabic.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">@lang('messages.change_password')</h2>
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
												<label class="name_label">@lang('messages.current_password')</label>
												<input class="from_type required" placeholder="@lang('messages.current_password')" type="password" id="curr_password" name="curr_password">
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.new_password')</label>
												<input class="from_type required" placeholder="@lang('messages.new_password')" type="password" name="new_password" id="new_password">
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.con_password')</label>
												<input class="from_type required" placeholder="@lang('messages.con_password')" type="password" name="conf_password" id="conf_password">
											</div>
										</div>
									</div>
									<div class="details_box details_box_2">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<input class="sub_btn qqawee" value="@lang('messages.change_password')" type="submit">
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
@include('arabic.layout.footer')
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