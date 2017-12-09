@extends('arabic.layout.app')
@section('title',__('messages.edit_profile'))
@section('body')
<div class="wrapper">
@include('arabic.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2">
						<h2>@lang('messages.seller_edit_profile')</h2>
						<span class="line"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('arabic.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">@lang('messages.edit_profile')</h2>
							<div class="clearfix"></div>
							<div class="allrt_edit">
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<form id="seller_edit" method="post" action="seller-edit" enctype="multipart/form-data">
							{{csrf_field()}}
								<div class="details_box">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.first_name')</label>
												<input class="from_type required" placeholder="First Name" type="text" name="first_name" value="{{@$get->first_name}}">
											</div>
										</div>
										<!--<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Email Address</label>
												<input class="from_type required" placeholder="johnmccain700@gmail.com" type="text" name="email" value="{{@$get->email}}">
											</div>
										</div>-->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.last_name')</label>
												<input class="from_type required" placeholder="Last Name" type="text" name="last_name" value="{{@$get->last_name}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.type_of_industry')</label>
												<select class="form_select required" name="industry_type" dir="rtl">
													<option value="">@lang('messages.type_of_industry')</option>
													<option value="1" @if($get->industry_type == 1){{'selected'}}@endif>Accommodations</option>
													<option value="2" @if($get->industry_type == 2){{'selected'}}@endif>Accounting</option>
													<option value="3" @if($get->industry_type == 3){{'selected'}}@endif>Advertising</option>
													<option value="4" @if($get->industry_type == 4){{'selected'}}@endif>Agriculture & Agribusiness</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.type_of_company')</label>
												<select class="form_select required" name="company_name" dir="rtl">
													<option value="">Type of Company</option>
													<option value="1" @if($get->company_name == 1){{'selected'}}@endif>Private Company Limeted</option>
													<option value="2" @if($get->company_name == 2){{'selected'}}@endif>Ready Made Pvt Ltd</option>
													<option value="3" @if($get->company_name == 3){{'selected'}}@endif>Public Ltd</option>
													<option value="4" @if($get->company_name == 4){{'selected'}}@endif>Limited Libality Pertnership</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.profile_logo') (@lang('messages.recomended')
												@lang('messages.size') @lang('messages.width') 200 @lang('messages.px') @lang('messages.height') 100 @lang('messages.px'))</label>
												<div id="file-upload-cont">
													<input id="original" type="file" name="profile_logo"/>
													<div id="my-button">@lang('messages.upload')</div>
													<input id="overlay" placeholder="@lang('messages.upload_profile_picture') "/>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">
										<div class="if_up_image">
											@if(@$get->profile_logo)
												<img id="up_img" src="{{url('storage/app/public/profile_image/thumb/'.@$get->profile_logo)}}" alt="" />
											@else
												<img id="up_img" src="" alt="" />
											@endif
										</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.phone')</label>
												<input class="from_type required" placeholder="Phone" type="text" name="phone" value="{{@$get->phone}}" onkeypress="validate(event)">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.website')</label>
												<input class="from_type required" placeholder="Website" type="text" name="website" value="{{@$get->website}}">
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.location')</label>
												<select class="form_select required" name="location">
													<option value="">Location</option>
													@if(@$country)
														@foreach($country as $country)
															<option value="{{@$country->country_id}}" @if($country->country_id == $get->location){{'selected'}}@endif>{{@$country->country_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.address')</label>
												<input class="from_type required" placeholder="Address" type="text" name="address" value="{{@$get->address}}">
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2 bor_tt">
									<h3>@lang('messages.social_link')</h3>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Facebook</label>
												<input class="from_type" placeholder="Facebook Link" type="text" name="facebook_link" value="{{@$get->facebook_link}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Twitter</label>
												<input class="from_type" placeholder="Twitter Link" type="text" name="twitter_link" value="{{@$get->twitter_link}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Instagram</label>
												<input class="from_type" placeholder="Instagram Link" type="text" name="instagram_link" value="{{@$get->instagram_link}}">
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input class="sub_btn qqawee" type="submit" value="@lang('messages.save')">
										</div>
									</div>
								</div>
							</form>
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
	$('#seller_edit').validate({
	rules: {
		website: {
				required: true,
				url: true
			},
			facebook_link: {
				//required: true,
				url: true
			},
			twitter_link: {
				//required: true,
				url: true
			},
			instagram_link: {
				//required: true,
				url: true
			}
		}
	});
	$('#original').change(function(){
		var imgPath = $(this)[0].value;
		var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		if (extn == "png" || extn == "jpg" || extn == "jpeg")
		{
			var reader = new FileReader();
			reader.onload = function(e) 
			{
				 $('#up_img').attr('src', e.target.result);
			}
			reader.readAsDataURL($(this)[0].files[0]);
		}
		else
		{
			alert('Please choose an image');
		}
	});
});
</script>
<script>
function validate(evt){
	var theEvent=evt || window.event;
	var key=theEvent.keyCode || theEvent.which;
	key=String.fromCharCode(key);
	var regex = /[0-9]||\./;
	if(!regex.test(key)){
		theEvent.returnValue=false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
</script>
@endsection