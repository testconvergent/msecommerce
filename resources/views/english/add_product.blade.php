@extends('english.layout.app')
@section('title','Add Product')
@section('body')
<div class="wrapper for_this_bg">
	@include('english.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2 ccgn55">
						<?php 
							$get_user = company_name(session()->get('user_id'));
							//echo "<pre>";print_r($get_user);die;
						?>
						<h2>Welcome, {{@$get_user->company_name}}</h2>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">Add Product</h2>
							@if(@$get_user->user_status != 0)
							<div class="clearfix"></div>
							<div class="allrt_edit">
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<form name="add_product" method="post" enctype="multipart/form-data" id="add_product">
								<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
								{{csrf_field()}}
								<div class="details_box">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Select Store</label>
												<div class="card1">
													<label class="radio cclk sto">
														<input id="radio2" checked type="radio" name="product_in_stock" value="1">
														<span class="outer"><span class="inner"></span></span>In Stock
													</label>
													<label class="radio cclk22 sto">
														<input id="radio1" type="radio" name="product_in_stock" value="2">
														<span class="outer"><span class="inner"></span></span>Out of Stock
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Category <span>*</span></label>
												<select class="form_select required" name="category" id="category">
													<option value="">Category</option>
													@if(@$category)
														@foreach($category as $cat)
															<option value="{{@$cat->category_id}}">{{@$cat->cat_name}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Sub Category <span>*</span></label>
												<select class="form_select required" name="sub_cat" id="sub_cat">
													<option value="">Sub Category</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row" id="option_value">
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Product Quantity <span>*</span> </label>
												<input class="from_type required" placeholder="Product Quantity" type="text" onkeypress="validate(event)" name="product_quentity">
											</div>
										</div>
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Product Price <span>*</span></label>
												<input class="from_type required" placeholder="Product Price" type="text" onkeypress="validate(event)" name="product_price">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Item name <span>*</span></label>
												<input class="from_type required" placeholder="Item name" type="text" name="product_title">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Item Description <span>*</span></label>
												<textarea class="from_msg required" placeholder="Item Description" name="product_description"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">YouTube Video</label>
												<input class="from_type" placeholder="https://www.youtube.com/watch?v=-6d9gM" type="text" name="product_youtube">
												<!--<span class="infooa_ttx">(https://www.youtube.com/watch?v=-6d9gM)</span>-->
											</div>
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">
											<!--<div class="form-group">
												<label class="name_label">Shipping Charges </label>
												<input class="from_type" placeholder="Shipping Charges" type="text" name="shipping_charge">
											</div>-->
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12" id="pro_image">
											<div class="form-group">
												<label class="name_label">Item Pictures <span>*</span> (You can upload up to 5 images. Recomended image size width 205px height 240px)</label>
												<div id="file-upload-cont">
													<input id="original" type="file" id="product_image" name="product_image[]" class="required upload" multiple>
													<div id="my-button">Upload</div>
													<input id="overlay"   placeholder="Upload Thumbnail"/>
												</div>
											</div>
											<span class="img_error"></span>
											<input type="hidden" name="count_image" id="count_image"/>
											<input type="hidden" name="change_image" id="hiddenPic" value=""/> 
										</div>
									</div>
									<div class="clearfix"></div>
									<h2 class="dash_head ofr">Offer Details</h2>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Offer Start Date </label>
												<input class="from_type" placeholder="Offer Start Date" type="text" id="from_date" name="offer_start_date" readonly>
											</div>
										</div>
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Offer End Date</label>
												<input class="from_type" placeholder="Offer End Date" type="text" name="offer_end_date" id="to_date" readonly>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="name_label">Offer Price </label>
												<input class="from_type" placeholder="Offer Price" type="text" onkeypress="validate(event)">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<input class="sub_btn" type="submit" value="Add Product">
											</div>
										</div>
									</div>
								</div>
							</form>
							@else
							<div class="clearfix" style="margin-top: 66px;"></div>
							<p class="not_approve">You are not a approve seller. When site admin approve your account then you get a notification shortly and get access everything.</p>
							@endif
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
<link rel="stylesheet" href="chosen/chosen.css">
<style>
#original .error{
	margin: 4px -12px !important;
}
</style>
<script>
$(document).ready(function(){
	//$.validator.setDefaults({ ignore: ":hidden:not(select)"});
	$('#add_product').validate();
	$('#add_product').submit(function(){
		var flag = 0;
		var flag1 = 0;
		$(".error_req").each(function(){
			var value = $(this).val();
			//alert(value);
			if($(this).val() == null){
				debugger;
				//alert('required');
				if(!$(this).nextAll('.error_msg').length){
					$(this).next().after('<span class="error_msg">This field is required.</span>');
				}
				flag = 1;
			}else{
				debugger;
				 $(this).nextAll('.error_msg').detach();
			}
        });
		if($(".error_req_chk").length){
		$(".error_req_chk").each(function(){
			if(!$(this).prop('checked')){
				//alert('required');
				if(!$(this).next('.error_msg2').length){
					$(this).next().after('<span class="error_msg2">This field is required.</span>');
				}						
				flag1 = 1;
			}else{
				$(this).next('.error_msg2').detach();
			}
		});	
		}
		debugger;

		if(flag == 0 && flag1 == 0){
			return true;
		}else{
			return false;
		}
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
	$('#sub_cat').change(function(){
		var sub_cat = $('#sub_cat').val();
		//alert(sub_cat);
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			method:"POST",
			url:"<?php echo url('fetch-option')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				category_id:sub_cat
			},
			success:function(result)
			{
				//alert(result.option_html);
				$('#option_value').html(result.option_html);
			}
			,
			error:function(error){
				console.log(error.responseText);
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
<script type="text/javascript">	
$(document).ready(function(){
	var uploadArray=[];
	if (window.File && window.FileList && window.FileReader) {
    $("#original").on("change", function(e) {//alert();
		//$('.imageThumb').attr('src','');
		$('.img_error').html("");
		var file_length=0;
		var files=0;
		var count_image=0;
		$('#count_image').val(0);
		var count = document.getElementById("count_image").value;
		var files = e.target.files;		
        filesLength = files.length;
		if(file_length!=''){
			var count_image = (parseInt(files.length)+parseInt(count))+parseInt(file_length);
			//alert('count : '+count_image);
		}else{
			var count_image = (parseInt(files.length)+parseInt(count));
		}
		file_length=parseInt(file_length)+parseInt(files.length);
		//alert(count_image);
		if(count_image<=5){
			$('#count_image').val(count_image);
			for (var i = 0; i < filesLength; i++) {
				var ix=0;
				var f = files[i];
				var fileExtn=f.name;
				var extn = fileExtn.substring(fileExtn.lastIndexOf('.') + 1).toLowerCase();
				if (extn == "png" || extn == "jpg" || extn == "jpeg"){
					var fileReader = new FileReader();
					fileReader.onload = (function(e){
						uploadArray[ix]="upload";
						var file = e.target;					
						$("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" />" +
						"<br/><span class=\"remove\" title='Close' style='cursor: pointer;' image-id=\""+(ix++)+"\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
						"</span>").insertAfter("#pro_image");
					});
					fileReader.readAsDataURL(f);
				}else{
					$('.img_error').html("You can not upload other than images.").css('color','red');
					$("#original").val('');
				}
			}
		}else{
			$('.img_error').html("You can not upload more than 5 images.");
			$("#original").val('');
			//$("#original").addClass('required');
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
	$('#add_product').submit(function(){
			$('#hiddenPic').val(uploadArray);
	});
});
</script>
@endsection