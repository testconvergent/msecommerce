@extends('admin.layout.app')
@section('title','Add Product Option')
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
                                <h4 class="pull-left page-title">Edit Product Option</h4>
								<div class="submit-login pull-right">
								<form id="back_form" action="admin-product-option-list" method="post">
								{{csrf_field()}}
								<input type="hidden" name="category" value="{{session()->get('category_id')}}">
								<input type="hidden" name="sub_cat" value="{{session()->get('sub_cat')}}">
									<a href="admin-product-option-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
									</form>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
								@if(@session()->get('success'))<div class="alert alert-success ">{{session()->get('success')}}</div>@endif
								@if($errors->has('category_icon'))<div class="alert alert-danger">{{$errors->first('category_icon')}}</div>@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nhp">
												<div class="table-responsive" data-pattern="priority-columns">
													<form id="add_category" action="admin-edit-product-option/{{$product_option_id}}" enctype="multipart/form-data" method="post">
													{{csrf_field()}}
													<!--all_time_sho-->       
													<div class="all_time_sho"> 
													<div class="row">
														<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<div class="your-mail">
															 <label for="exampleInputEmail1">Category</label>
																   <select class="form-control newdrop required" name="category" id="category">
																		<option value="">Select Category</option>
																		@foreach($category as $cat)
																		<option value="{{$cat->category_id}}" @if($category_id==$cat->category_id) selected @endif >{{$cat->cat_name}}</option>
																		@endforeach
																	</select>
																</div>
															</div>
													</div>
													<div class="row">
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<div class="your-mail">
															 <label for="exampleInputEmail1">Sub Category</label>
																  <select class="form-control newdrop required" name="sub_cat" id="sub_cat">
														<option value="">Sub Category</option>	
																	</select>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<div class="your-mail">
															 <label for="exampleInputEmail1">Type in product form</label>
																   <select class="form-control newdrop required" name="option_type_product_form" id="category">
																		<option value="">Select Type</option>
																		<option @if($product_option_data->option_type_product_form==1) selected @endif value="1">Single Select</option>
																		<option @if($product_option_data->option_type_product_form==2) selected @endif  value="2">Multi Select</option>
																		<option @if($product_option_data->option_type_product_form==3) selected @endif  value="3">Single Checkbox</option>
																		
																	</select>
																</div>
															</div>
															</div>
															<div class="row">
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
															<div class="your-mail">
															 <label for="exampleInputEmail1">Show in search
															<input  value="1" name="show_in_search"type="radio" 
															@if($product_option_data->show_in_search==1) checked @endif>Yes
															<input value="0" name="show_in_search" type="radio" @if($product_option_data->show_in_search==0) checked @endif>No
															</label>	 
																</div>
															</div>
                                                          </div>
														  <div class="row">		
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
															<div class="your-mail showInSearch" style="display:none;">
															 <label for="exampleInputEmail1">Type In Search</label>
																   <select class="form-control newdrop required" name="option_type_search_form" id="option_type_search_form">
																		<option value="">Select Type</option>
																		<option @if($product_option_data->option_type_search_form==1) selected @endif value="1">Single Select</option>
																		<option @if($product_option_data->option_type_search_form==2) selected @endif value="2">Multi Select</option>
																	</select>
																</div>
															</div>
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
																<label for="exampleInputEmail1">Option Name</label>
																	<input type="text" class="form-control required" name ="product_option_name_e" placeholder="" value="{{$product_option_details['english']}}">
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
																	<label for="exampleInputEmail1">Option Name</label>
																	<input type="text" class="form-control required" name ="product_option_name_a" value="{{$product_option_details['arabic']}}" placeholder="">
																</div>
															</div>
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
@if($product_option_data->show_in_search==1) 
	<script>$('.showInSearch').show();</script> 
@endif
@if($category_id!='') 
	<script>
var sub_category_id={{$sub_category_id}};
$(document).ready(function(){
		var cat = $('#category').val();
			//alert(cat);
			$.ajax({
				type:'get',
				url:'<?php echo url('/admin-get-subcat');?>',
				data:'_token = <?php echo csrf_token() ?>&category='+cat,
				success:function(data)
				{
					//alert(data);
					$('#sub_cat').html(data);
				}
			}).then(function(){
				$.each($('[id="sub_cat"] option'), function( index, value ) {
                      if($(this).val()==sub_category_id)$(this).attr('selected',true)
                           });				
			});
	});</script> 
@endif
<script>
$(document).ready(function(){
	//showInSearch radio button
	$('[name="show_in_search"]').click(function(){
		if($(this).val()==1)$('.showInSearch').show();
		if($(this).val()==0){
			$('.showInSearch').hide();
			$('#option_type_search_form').val('');
		};
	});

	$('#category').change(function(){
			var cat = $('#category').val();
			//alert(cat);
			$.ajax({
				type:'get',
				url:'<?php echo url('/admin-get-subcat');?>',
				data:'_token = <?php echo csrf_token() ?>&category='+cat,
				success:function(data)
				{
					//alert(data);
					$('#sub_cat').html(data);
				}
			});
		});
});
</script>
	<script>
			$(document).ready(function(){//alert();
				$('#add_category').validate();
				$('#category_icon').change(function(){
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