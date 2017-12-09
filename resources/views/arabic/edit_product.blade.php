@extends('arabic.layout.app')
@section('title',__('messages.edit_product'))
@section('body')
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2">
						<h2>Seller Dashboard</h2>
						<span class="line"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('arabic.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">@lang('messages.edit_product')</h2>
							<div class="clearfix"></div>
							<div class="allrt_edit">
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<form name="edit_product" method="post" enctype="multipart/form-data" id="edit_product">
								{{csrf_field()}}
								<div class="details_box">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.select_store')</label>
												<!--<select class="form_select">
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
												</select>-->
												<div class="card1 rtl_radio">
													<label class="radio cclk sto">
														<input id="radio2" name="radios" checked type="radio" name="product_in_stock" value="1" @if($product->product_in_stock == 1){{'checked'}}@endif>
														<span class="outer"><span class="inner"></span></span>@lang('messages.in_stock')
													</label>
													<label class="radio cclk22 sto">
														<input id="radio1" name="radios" type="radio" name="product_in_stock" value="2" @if($product->product_in_stock == 2){{'checked'}}@endif>
														<span class="outer"><span class="inner"></span></span>@lang('messages.out_of_stock')
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.category')</label>
												<select class="form_select required" name="category" id="category" dir="rtl">
													<option value="">@lang('messages.category')</option>
													@if(@$category)
														@foreach($category as $cat)
															<option value="{{@$cat->category_id}}" @if($cat->category_id ==  $product->parent_cat){{'selected'}}@endif>{{@$cat->cat_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.sub_cat')</label>
												<select class="form_select required" name="sub_cat" id="sub_cat" dir="rtl">
													<option value="">@lang('messages.sub_cat')</option>
													@if(@$sub_category)
														@foreach($sub_category as $sub_cat)
															<option value="{{@$sub_cat->category_id}}" @if($sub_cat->category_id == $product->sub_cat){{'selected'}}@endif>{{@$sub_cat->cat_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.product_quantity') </label>
												<input class="from_type required" placeholder="@lang('messages.product_quantity')" type="text" onkeypress="validate(event)" name="product_quentity" value="{{@$product->product_quentity}}">
											</div>
										</div>
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.product_price')</label>
												<input class="from_type required" placeholder="@lang('messages.product_price')" type="text" onkeypress="validate(event)" name="product_price" value="{{@$product->product_price}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.item_name')</label>
												<input class="from_type required" placeholder="@lang('messages.item_name')" type="text" name="product_title" value="{{@$product->product_title}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.item_desc')</label>
												<textarea class="from_msg required" placeholder="@lang('messages.item_desc')" name="product_description" dir="rtl">{{@$product->product_description}}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.shipping_charge') </label>
												<input class="from_type" placeholder="@lang('messages.shipping_charge')" type="text" name="shipping_charge" value="{{@$product->shipping_charge}}">
											</div>
										</div>
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">YouTube Video</label>
												<input class="from_type" placeholder="https://www.youtube.com/watch?v=-6d9gM" type="text" name="product_youtube" value="{{@$product->product_youtube}}">
												<!--<span class="infooa_ttx">(https://www.youtube.com/watch?v=-6d9gM)</span>-->
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12" id="pro_image">
											<div class="form-group">
												<label class="name_label">Item Pictures (You can upload up to 5 images. Recomended image size width 205px height 240px)</label>
												<div id="file-upload-cont">
													<input id="original" type="file" id="files" name="files[]" multiple/>
													<div id="my-button">@lang('messages.upload')</div>
													<input id="overlay"   placeholder="Upload Thumbnail"/>
												</div>
											</div>
											<span class="img_error"></span>
											<input type="hidden" name="count_image" id="count_image" value="{{count($image)}}">
											<input type="hidden" name="change_image" id="hiddenPic" value=""/>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											@if(@image)
												@foreach(@$image as $product_image)
													<div class="pro_img">
														<div class="cross">
															@if(count($image)>1)
																<a href="javascript:void(0);" onclick="delete_image(<?php echo $product_image->product_image_id;?>)"><img src="{{url('images/cross.png')}}"/></a>
															@endif
														</div>
														<img src="{{url('storage/app/public/product_image/thumb/'.$product_image->product_image)}}"/>
													</div>
												@endforeach
											@endif
										</div>
									</div>
									<div class="clearfix"></div>
									<h2 class="dash_head ofr">@lang('messages.offer_details')</h2>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.offer_start_date') </label>
												<input class="from_type" placeholder="@lang('messages.offer_start_date')" type="text" id="from_date" name="offer_start_date" value="{{@$product->offer_start_date}}" readonly>
											</div>
										</div>
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.offer_end_date')</label>
												<input class="from_type" placeholder="@lang('messages.offer_end_date')" type="text" name="offer_end_date" id="to_date" value="{{@$product->offer_end_date}}"  readonly>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">@lang('messages.offer_price') </label>
												<input class="from_type" placeholder="@lang('messages.offer_price')" type="text" onkeypress="validate(event)" value="{{@$product->product_offer_price}}">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<input class="sub_btn" type="submit" value="@lang('messages.edit_product')">
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
@include('arabic.layout.footer')
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script>
$(document).ready(function(){
	$('#edit_product').validate();
	$('#category').change(function(){
		var cat = $('#category').val();
		//alert(cat);
		$.ajax({
			type:'get',
			url:'<?php echo url('/get-subcat');?>',
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
<script type="text/javascript">	
$(document).ready(function(){
	var uploadArray=[];
	if (window.File && window.FileList && window.FileReader) {
    $("#original").on("change", function(e) {//alert();
		$('.img_error').html("");
		var file_length=0;
		var files=0;
		var count_image=$('#count_image').val();
		var count = document.getElementById("count_image").value;
		var files = e.target.files,
        filesLength = files.length;
		if(file_length!='')
		{
			var count_image = (parseInt(files.length)+parseInt(count))+parseInt(file_length);
			alert('count : '+count_image);
		}
		else
		{
			var count_image = (parseInt(files.length)+parseInt(count));
		}
		file_length=parseInt(file_length)+parseInt(files.length);
		alert(count_image);
		if(count_image<=5)
		{
			$('#count_image').val(count_image);
			for (var i = 0; i < filesLength; i++) {
				var ix=0;
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
					uploadArray[ix]="upload";
					var file = e.target;
					$("<span class=\"pip\">" +
					"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" />" +
					"<br/><span class=\"remove\" title='Close' style='cursor: pointer;' image-id=\""+(ix++)+"\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
					"</span>").insertAfter("#pro_image");
				});
				fileReader.readAsDataURL(f);
			}
		}
		else
		{
			$('.img_error').html("You can not upload more than 5 images.");
			$("#original").val('');
		}
    });
  } 
  else 
  {
    alert("Your browser doesn't support to File API")
  }
  $(".remove").click(function(){//alert();
		var count_image = $('#count_image').val();
		$('#count_image').val(count_image-1);
		$(this).prev().prev().fadeOut('slow');
		$(this).prev().fadeOut('slow');
		$(this).fadeOut('slow');
	});
	$('body').on('click','.remove',function(){
		var count_image = $('#count_image').val();
		$('#count_image').val(count_image-1);
		$(this).prev().prev().fadeOut('slow');
		$(this).prev().fadeOut('slow');
		$(this).fadeOut('slow');
		uploadArray[$(this).attr('image-id')]="cancel";
		console.log(uploadArray);
	});
	$('#edit_product').submit(function(){
			$('#hiddenPic').val(uploadArray);
	});
});
</script>
<script>
$(function() {	
		$("#from_date").datepicker({dateFormat: "yy-mm-dd",
		   changeMonth: true,
		   changeYear: true,
		   numberOfMonths: 1,		   
		   defaultDate: new Date(),
		   onClose: function( selectedDate ) {
		   $( "#to_date").datepicker( "option", "minDate", selectedDate );
		  }
		});	
		$("#to_date").datepicker({dateFormat: "yy-mm-dd",
		   changeMonth: true,
		   changeYear: true,
		   numberOfMonths: 1,		   
		   defaultDate: new Date(),
		   onClose: function( selectedDate ) {
		   $( "#to_date").datepicker( "option", "minDate", selectedDate );
		  }
		});	
	});
</script>
<script>  
	function delete_image(id)
	{
		//alert(id);
		swal({   title: "Are you sure?",   
		text: "You want to delete this product image!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, Delete it!",   
		cancelButtonText: "No, cancel!",   
		closeOnConfirm: false,   
		closeOnCancel: true 
		}, 
		function(isConfirm)
		{   
			if (isConfirm)
			{
				window.location.assign("<?php echo url('/');?>/delete-image/"+id);	
			} 
			
		});
	}
	</script>
@endsection