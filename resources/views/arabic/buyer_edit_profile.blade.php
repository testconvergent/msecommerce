@extends('arabic.layout.app')
@section('title',__('messages.edit_profile'))
@section('body')
<div class="wrapper">
@include('arabic.layout.header')
	<section class="body_section">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="inner_head inner_head_2 ccgn55">
						<?php 
							$get_user = fetch_user(session()->get('user_id'));
						?>
						<h2>Welcome, {{@$get_user->first_name}} {{@$get_user->last_name}}</h2>
						<!--<span class="line"></span>-->
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
								<form id="byuer_edit" method="post" action="buyer-edit" enctype="multipart/form-data">
								{{csrf_field()}}
                                	<div class="details_box">
                                	<h3>@lang('messages.personal_info')</h3>
                                    <div class="row">
                                    	<div class="col-md-6 col-sm-6 col-xs-12">
                                        	<div class="form-group">
                                            	<label class="name_label">@lang('messages.first_name') *</label>
                                                <input class="from_type required" placeholder="First Name" type="text" name="first_name" value="{{@$get->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        	<div class="form-group">
                                            	<label class="name_label">@lang('messages.last_name') *</label>
                                                <input class="from_type required" placeholder="Last Name" type="text" name="last_name" value="{{@$get->last_name}}">
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.gender') *</label>
												<select class="form_select required" name="gender" dir="rtl">
													<option value="">Select</option>
													<option value="1" @if($get->gender == 1){{'selected'}}@endif>@lang('messages.male')</option>
													<option value="2" @if($get->gender == 2){{'selected'}}@endif>@lang('messages.female')</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.dob') *</label>
												<input class="from_type form_cal required" id="dob2" type="text" placeholder="Date of Birth" name="dob" value="{{date('d-m-Y',strtotime(@$get->dob))}}" readonly>
											</div>
										</div>
									</div>
                                    <div class="row">
                                    	<div class="col-md-6 col-sm-6 col-xs-12">
                                        	<div class="form-group">
                                            	<label class="name_label">@lang('messages.email_address') *</label>
                                                <input class="from_type required" placeholder="Email Address" name "email" type="text" value="{{@$get->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        	<div class="form-group">
                                            	<label class="name_label">@lang('messages.mob') *</label>
                                                <input class="from_type required" placeholder="Phone" type="text" name="phone" value="{{@$get->phone}}" onkeypress="validate(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="details_box details_box_2">
                                        <h3>@lang('messages.address_info')</h3>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.area') *</label>
													<input class="from_type required" placeholder="@lang('messages.area')" type="text" name="area"  value="{{@$get->area}}">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.block') *</label>
													<input class="from_type required" placeholder="@lang('messages.block')" type="text" name="block" value="{{@$get->block}}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.street') *</label>
													<input class="from_type required" placeholder="@lang('messages.street')" type="text" name="street" value="{{@$get->street}}">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.avenue')</label>
													<input class="from_type" placeholder="@lang('messages.avenue')" type="text" name="avenue" value="{{@$get->avenue}}">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.house_building') *</label>
													<input class="from_type required" placeholder="@lang('messages.house_building')" type="text" name="house_building" value="{{@$get->house_building}}">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.floor')</label>
													<input class="from_type" placeholder="@lang('messages.floor')" type="text" name="floor_no" value="{{@$get->floor}}" onkeypress="validate(event)">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">@lang('messages.apartment')</label>
													<input class="from_type" placeholder="@lang('messages.apartment')" type="text" name="apartment" value="{{@$get->apartment}}">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Pasi Number <span class="llgth556">(12 digits)</span></label>
													<input class="from_type" placeholder="Pasi Number" type="text" name="pasi_number" value="{{@$get->pasi_number}}" onkeypress="validate(event)"  maxlength="12" minlength="12">
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<input class="sub_btn" type="submit" value="@lang('messages.save') @lang('messages.changes')">
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
	$('#byuer_edit').validate();
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