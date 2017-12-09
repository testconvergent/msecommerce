@extends('admin.layout.app')
@section('title','Add Category')
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
                                <h4 class="pull-left page-title">Add Category</h4>
								<div class="submit-login pull-right">
									<a href="admin-category-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
								@if($errors->has('category_icon'))<div class="alert alert-danger">{{$errors->first('category_icon')}}</div>@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nhp">
												<div class="table-responsive" data-pattern="priority-columns">
													<form id="add_category" action="admin-add-category" enctype="multipart/form-data" method="post">
													{{csrf_field()}}
													<!--all_time_sho-->       
													<div class="all_time_sho">   
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<div class="your-mail">
															 <label for="exampleInputEmail1">Category</label>
																   <select class="form-control newdrop" name="category" id="category">
																		<option value="">Select Category</option>
																		@foreach($category as $cat)
																		<option value="{{$cat->category_id}}">{{$cat->cat_name}}</option>
																		@endforeach
																	</select>
																</div>
                                                                <p class="hht_ht55">Leave this field for make parent category.</p>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="your-mail" style="position:absolute">
																	<label for="exampleInputEmail1">Display Order</label>
																	<input placeholder="Type to check the previous order" autocomplete="off" type="text" class="form-control required" name ="display_order" placeholder="">
																	<div class="display_order">Display Order 12</div>
																</div>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
																<div class="form-group">
																	<label style="margin-top:3px;"for="name" class="upld_lbl">Upload Icon</label>
																	<div class="fileUpload btn btn-primary cust_file clearfix">
																		<span class="upld_txt"><i class="fa fa-upload upld-icon" aria-hidden="true"></i>Upload icon</span>
																		<input type="file" class="upload" name="category_icon" id="category_icon">
																	</div> 
																	 <div class="uplpic"><img id="up_img" src="" alt="" /></div>
																</div>
                                                                <p class="hht_ht56">Recommended icon size width 18px and height 18px.</p>
															</div>
                                                            
															<div class="clearfix"></div>
															<div class="col-md-12">
																<div class="engl">
																	<img src="{{url('storage/app/public/language_image/'.@$language[0]->language_flag)}}"/>
																	{{@$language[0]->language_name}}
																</div>
                                                            </div>
                                                            <div class="clearfix"></div>
															<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Category Name</label>
																	<input type="text" class="form-control required" name ="category_name_e" placeholder="">
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Meta Title</label>
																	<input type="text" class="form-control required" name ="category_meta_title_e" placeholder="">
																</div>
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Meta Description</label>
																	<textarea placeholder="" rows="3" class="form-control message required" name="category_meta_description_e"></textarea>
																</div>
															</div>
															<div class="clearfix"></div>
                                                            <div class="col-md-12">
																<div class="engl">
																	<img src="{{url('storage/app/public/language_image/'.@$language[1]->language_flag)}}"/>
																	{{@$language[1]->language_name}}
																</div>
                                                            </div>
															<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Category Name</label>
																	<input type="text" class="form-control required" name ="category_name_a" placeholder="">
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Meta Title</label>
																	<input type="text" class="form-control required" name ="category_meta_title_a" placeholder="">
																</div>
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
																<div class="your-mail">
																	<label for="exampleInputEmail1">Meta Description</label>
																	<textarea placeholder="" rows="3" class="form-control message required" name="category_meta_description_a"></textarea>
																</div>
															</div>
														</div>
														<div class="clearfix"></div>
														<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
															<div class="add_btnm">
																<input value="Save" type="submit">
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
				$('#add_category').validate();
				$('#category_icon').change(function(){
				$('.display_order').hide();
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
		$('body').on('keyup','[name="display_order"]',function(){//alert();		
		var categoryId = $('#category').val();
		var token = "{{csrf_token()}}";
		var displayOrder = $(this).val().trim();
		$('.display_order').hide();
		if(displayOrder!=''){
			$.ajax({
			method:"POST",
			url:"<?php echo url('admin-previous-category-display-order')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				categoryId:categoryId,
				displayOrder:displayOrder,
			},
			success:function(result)
			{
				if(result.message)$('.display_order').show().text(result.message);
				else $('.display_order').hide();
				
			}
			,
			error:function(error){
				console.log(error.responseText);
			} 
		});
		}
		
	});
			});
	</script>
@endsection     