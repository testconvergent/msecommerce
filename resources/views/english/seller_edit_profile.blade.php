@extends('english.layout.app')
@section('title',__('messages.edit_profile'))
@section('body')
<div class="wrapper">
@include('english.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2 ccgn55">
						<?php 
							$get_user = company_name(session()->get('user_id'));
						?>
						<h2>Welcome, {{@$get_user->company_name}}</h2>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
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
												<label class="name_label">@lang('messages.first_name')<sup class="required_field">*</sup></label>
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
												<label class="name_label">@lang('messages.last_name')<sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="Last Name" type="text" name="last_name" value="{{@$get->last_name}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.type_of_industry')<sup class="required_field">*</sup></label>
												<select class="form_select required" name="industry_type">
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
												<label class="name_label">@lang('messages.type_of_company')<sup class="required_field">*</sup></label>
												<select class="form_select required" name="type_of_company">
													<option value="">Type of Company</option>
													<option value="1" @if($get->type_of_company == 1){{'selected'}}@endif>Private Company Limeted</option>
													<option value="2" @if($get->type_of_company == 2){{'selected'}}@endif>Ready Made Pvt Ltd</option>
													<option value="3" @if($get->type_of_company == 3){{'selected'}}@endif>Public Ltd</option>
													<option value="4" @if($get->type_of_company == 4){{'selected'}}@endif>Limited Libality Pertnership</option>
												</select>
											</div>
										</div>
									</div>
									<!-- <div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.email_address')</label>
											<input class="from_type required" placeholder="abc@example.com" type="email" name="email_address" value="{{@$get->email}}">
											</div>
										</div>
									</div> -->
									<div class="row">
										<!--<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.company_name')</label>
												<input class="from_type required" placeholder="First Name" type="text" name="company_name" value="{{@$get->company_name}}">
											</div>
										</div>-->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label" style="margin-top: 36px;">Email Address : {{@$get->email}} </label>
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
												<label class="name_label">@lang('messages.phone')<sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="Phone" type="text" name="phone" value="{{@$get->phone}}" onkeypress="validate(event)">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.website')<sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="Website" type="text" name="website" value="{{@$get->website}}">
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.location')<sup class="required_field">*</sup></label>
												<!--<input class="from_type" placeholder="West Bengal" type="text">-->
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
												<label class="name_label">@lang('messages.area') <sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="Area" type="text" name="area" value="{{@$get->area}}">
											</div>
										</div>
										
									</div>
									<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.address') <sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="Address" type="text" name="address" value="{{@$get->address}}">
											</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Company E-mail</label>
												<input class="from_type" placeholder="Company E-mail" type="text" name="company_email" value="{{@$get->company_email}}">
										</div>
									</div>
									</div>
									<div class="row">									
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Block<sup class="required_field">*</sup></label>
											<input class="from_type required" placeholder="Block" type="text" name="block" value="{{@$get->block}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Street<sup class="required_field">*</sup></label>
											<input class="from_type required" placeholder="Street" type="text" name="street" value="{{@$get->street}}">
											</div>
										</div>
									</div>
									<div class="row">									
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Avenue</label>
												<input class="from_type" placeholder="Avenue" type="text" name="avenue" value="{{@$get->avenue}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">House/Building <sup class="required_field">*</sup></label>
												<input class="from_type required" placeholder="House/Building" type="text" name="house_building" value="{{@$get->house_building}}">
											</div>
										</div>
									</div>
									<div class="row">									
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Floor</label>
												<input class="from_type" placeholder="Floor" type="text" name="building_floor" value="{{@$get->floor}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Apartment</label>
											<input class="from_type" placeholder="Apartment" type="text" name="apartment" value="{{@$get->apartment}}">
											</div>
										</div>
									</div>
									<div class="row">									
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Pasi Number<span class="llgth556">(12 digits)</span></label>
												<input class="from_type" placeholder="Pasi Number"  type="text" name="pasi_number" value="{{@$get->pasi_number}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Post Code</label>
											<input class="from_type" placeholder="Post Code" type="text" name="zipcode" value="{{@$get->zipcode}}">
											</div>
										</div>
									</div>
								</div>
								<div class="details_box details_box_2">
                                		<h3>Contact Person</h3>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                          <label class="name_label">Name</label>
                                                    <input class="from_type" placeholder="Contact Name" type="text" name="contact_name" value="{{@$get->contact_name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="name_label">Email</label>
                                                   <input class="from_type" placeholder="Contact Email" type="text" name="contact_email" value="{{@$get->contact_email}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                            <label class="name_label">Mobile Number</label>
                                                   <input class="from_type" placeholder="Contact Mobile Number" type="text" name="contact_mobile_number" value="{{@$get->contact_mobile_number}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="name_label">Office Number</label>
                                                   <input class="from_type" placeholder=" Contact Office Number" type="text" name="contact_office_number" value="{{@$get->contact_office_number}}">
                                                </div>
                                            </div>
                                        </div>
                                	</div>
									<div class="details_box details_box_2">
                                		<h3>Bank Account</h3>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="name_label">Name of Bank</label>
                                                    <input class="from_type" placeholder="Name of Bank" type="text" name="bank_name" value="{{@$get->bank_name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="name_label">Account Number</label>
                                                   <input class="from_type" placeholder="Account Number" type="text" name="bank_account_number" value="{{@$get->bank_account_number}}">
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
@include('english.layout.footer')
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