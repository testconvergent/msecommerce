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
							$get_user = fetch_user(session()->get('user_id'));
						?>
						<h2>Welcome, {{@$get_user->first_name}} {{@$get_user->last_name}}</h2>
						<!--<span class="line"></span>-->
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">Edit Profile</h2>
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
								<h3>Personal Information</h3>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label">First Name <span>*</span></label>
											<input class="from_type required" placeholder="First Name" type="text" name="first_name" value="{{@$get->first_name}}">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label">Last Name <span>*</span></label>
											<input class="from_type required" placeholder="Last Name" type="text" name="last_name" value="{{@$get->last_name}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label">Gender <span>*</span></label>
											<select class="form_select required" name="gender">
												<option value="">Select</option>
												<option value="1" @if($get->gender == 1){{'selected'}}@endif>Male</option>
												<option value="2" @if($get->gender == 2){{'selected'}}@endif>Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label">Date of Birth <span>*</span></label>
											<input class="from_type form_cal required" id="dob2" type="text" placeholder="Date of Birth" name="dob" value="@if(@$get->dob ){{date('d-m-Y',strtotime(@$get->dob))}}@endif" readonly>
										</div>
									</div>
                                </div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label">Mobile Number <span>*</span></label>
											<input class="from_type required" placeholder="Mobile Number" type="text" name="phone" value="{{@$get->phone}}" onkeypress="validate(event)">
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label class="name_label" style="margin-top: 36px;">Email Address : {{@$get->email}} </label>
										</div>
									</div>
								</div>
							</div>
								<div class="details_box details_box_2">
									<h3>Address Information</h3>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Area <span>*</span></label>
												<input class="from_type required" placeholder="Area" type="text" name="area"  value="{{@$get->area}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Block <span>*</span></label>
												<input class="from_type required" placeholder="Block" type="text" name="block" value="{{@$get->block}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Street <span>*</span></label>
												<input class="from_type required" placeholder="Street" type="text" name="street" value="{{@$get->street}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Avenue</label>
												<input class="from_type" placeholder="Avenue" type="text" name="avenue" value="{{@$get->avenue}}">
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">House/Building <span>*</span></label>
												<input class="from_type required" placeholder="House/Building" type="text" name="house_building" value="{{@$get->house_building}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Floor</label>
												<input class="from_type" placeholder="Floor" type="text" name="floor_no" value="{{@$get->floor}}" onkeypress="validate(event)">
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Apartment</label>
												<input class="from_type" placeholder="Apartment" type="text" name="apartment" value="{{@$get->apartment}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Pasi Number <span class="llgth556">(12 digits)</span></label>
												<input class="from_type" placeholder="Pasi Number" type="text" name="pasi_number" value="{{@$get->pasi_number}}"  maxlength="12" minlength="12">
												
											</div>
										</div>
                                    </div>
									 <div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<input class="sub_btn" type="submit" value="Save Changes">
											</div>
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
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
	$('#country').change(function(){
		var country = $('#country').val();
		//alert(cat);
		$.ajax({
			type:'get',
			url:'<?php echo url('/get-state');?>',
			data:'_token = <?php echo csrf_token() ?>&country='+country,
			success:function(data)
			{
				//alert(data);
				$('#state').html(data);
			}
		});
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
$(function() {
	$( "#dob2" ).datepicker({
		yearRange: "-100:+0",
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		numberOfMonths: 1,		   
		defaultDate: new Date(),
		//yearRange: start.getFullYear() + ':' + end.getFullYear(),
		onClose: function( selectedDate ) {
		//$( "#to_date").datepicker( "option", "minDate", selectedDate );
		}
	});
});
</script>
@endsection