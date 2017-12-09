@extends('admin.layout.app')
@section('title','Edit Delivery Staff')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Edit Delivery Staff</h4>
								<div class="submit-login pull-right">
									<a href="admin-delivery-staff-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))<div class="alert alert-danger">{{session()->get('success')}}</div>@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nhp">
												<div class="table-responsive" data-pattern="priority-columns">
													<form id="add_staff" action="admin-edit-delivery-staff/{{@$user->user_id}}" enctype="multipart/form-data" method="post">
													<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
													{{csrf_field()}}
													<!--all_time_sho-->       
														<div class="all_time_sho">  
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">First Name</label>
																	<input type="text" class="form-control required" name ="first_name" value="{{@$user->first_name}}">
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Last Name</label>
																	<input type="text" class="form-control required" name ="last_name" value="{{@$user->last_name}}">
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Email</label>
																	<input type="email" class="form-control required" name ="email" value="{{@$user->email}}"id="email">
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Password</label>
																	<input type="password" class="form-control" name ="password">
																</div>
																<span>Enter password for change password of this delivery staff.</span>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
															<div class="form-group">
																<label for="name" class="upld_lbl">Upload Photo (Recommended icon size width 200 px height 100 px.)</label>
																<div class="fileUpload btn btn-primary cust_file clearfix">
																	<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i>Upload Photo</span>
																	<input type="file" class="upload" name="profile_logo" id="profile_image">
																</div> 
																@if(@$user->profile_logo)
																	<div class="uplpic2"><img id="up_img" src="{{url('storage/app/public/profile_image/thumb/'.@$user->profile_logo)}}" alt=""></div>
																@else
																	<div class="uplpic1"><img id="up_img" src="" alt=""></div>
																@endif
															</div>
														</div>
														<input type="hidden" class="form-control" name ="user_id" id="user_id" value="{{@$user->user_id}}">
														</div>
														<div class="clearfix"></div>
														<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
															<div class="add_btnm">
																<input value="Update" type="submit">
															</div>
														</div>
														<!--all_time_sho-->  
													</form>   
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div> <!-- End Row -->
                    </div> <!-- container -->
                </div> <!-- content -->
			</div>
        </div>
	<script>
			$(document).ready(function(){//alert();
				$('#add_staff').validate();
				$('#email').blur(function(){
					var email = $('#email').val();
					var user_id = $('#user_id').val();
					var token = $('meta[name="csrf-token"]').attr('content');
					if(email != "")
					{
						$.ajax({
							method:"POST",
							url:"<?php echo url('ajax-email1')?>",
							dataType: 'JSON',
							data:{
								_token:token,
								email:email,
								user_id:user_id
							},
							success:function(result)
							{
								if(result.msg == 2)
								{
									//$('#email').css('border','none');
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
							,
							error:function(error){
								console.log(error.responseText);
							} 
						});
					}
				});
				$('#profile_image').change(function(){
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
@endsection     