@extends('english.layout.app')
@section('title','Search Product')
@section('body')
<div class="shadow_outer" style="display:none;"></div>
<div class="wrapper for_this_bg">	
	@include('english.layout.header')	
	<div class="container">
		<div class="bread_cc">
			<p><a href="{{$base_url}}">Home</a> <img src="images/arrow1.png" alt="img01"></p>
			<p>@if(Request::segment(1) == 'search' && Request::segment(2) != '')
					<a href="{{$cat_url}}">{{$cat_bread_cum}}</a>
					<img src="images/arrow1.png" alt="img01">
				@endif
			</p>
			<p>@if(Request::segment(1) == 'search' && Request::segment(2) != '' && Request::segment(3) != '')
				{{@$sub_cat_bread_cum}}<img src="images/arrow1.png" alt="img01">
			@endif
			</p>	
		</div>
		<style>
		.less{
			height: 130px;
			overflow: hidden;
			text-decoration: underline;
		}
		.more{
			height: 100%;
		}
		</style>
		<!--left area start-->
		<div class="left_refine small_clopus_style">                                
			<nav class="navbar1 navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle ns ncomm" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Filter Option</span>
					<!--<img src="images/search_icon.png" alt=""/>-->Narrow results by <i class="fa fa-caret-down" aria-hidden="true"></i></button>
				</div>
				<div class="collapse navbar-collapse no_pad_both" id="bs-example-navbar-collapse-2">  
					<!--inner containt-->
					<h2>Filters</h2>
					<div class="rs_area">
						<form name="search_frm" id="search_frm" method="post" action="search">
						{{csrf_field()}}
						<input type="hidden" name="max_price" id="max_price">
						<input type="hidden" name="min_price" id="min_price">
							<h3>Category</h3>
							@if(@$total_category)
								<select class="sameclass form-control" name="category">
								@foreach($total_category as $cat)
									<option	data-category_slug="{{$cat->category_slug}}"
									@if($cat->category_id==$selected_category_id)
										{{'selected'}}
									     @endif
									value="{{$cat->category_id}}"  >{{$cat->cat_name}}</option>
								@endforeach
								</select>		
							@endif
							<h3>Sub Category</h3>
									<div class="ss_cbox">				
										@if(@total_subcategory)
										<select class="sameclass form-control" name="sub_category">
									<option  value="all" selected>All</option>	
										@foreach($total_subcategory as $sub)											
											<option data-sub-category_slug="{{$sub->sub_category_slug}}"	
										@if($sub->category_id==$selected_sub_category_id)
										{{'selected'}}
									     @endif
											value="{{$sub->category_id}}" >{{$sub->cat_name}}
											</option>
										@endforeach
										</select>	
										@endif
							
							
							@if(count($product_option_details))
								<?php $checkId=1; ?>								
								@foreach($product_option_details as  $option_key=>$option)
										@if(trim($option->option_type_search)=='single select' && count($option->optionTypeValue))
											<h3>{{$option->option_name}}</h3>	
											<select class="sameclass form-control" name="{{str_replace(' ','-',strtolower($option->option_name))}}">
											<option value="" selected>Select</option>	
											@foreach($option->optionTypeValue as $option_value)											
												<option	@if(in_array($option_value->option_detail_id,$request_option_value_array)) selected @endif										
												value="{{$option_value->option_detail_id}}" >{{$option_value->option_name}}
												</option>
											@endforeach
											</select>	
										@endif									
									@if(trim($option->option_type_search)=='multi select' && count($option->optionTypeValue))	
										<h3>{{$option->option_name}}</h3>
										@if(count($option->optionTypeValue)>4)
										<div class="less_more less">
										@else
										<div class="less_more">				
										@endif
										@foreach($option->optionTypeValue as $key=>$option_value)
										<div class="ss_cbox">
										 <div class="checkbox-group"> 
			 <input id="checkiz{{$checkId}}" @if(in_array($option_value->option_detail_id,$request_option_value_array)) checked @endif type="checkbox" name="{{str_replace(' ','-',strtolower($option->option_name))}}[]" value="{{$option_value->option_detail_id}}"> 
										   <label for="checkiz{{$checkId}}">
										   <span class="check"></span>
										   <span class="box"></span>
										   <p class="ft_text">{{$option_value->option_name}}</p>
										   </label>
										 </div>
										   </div>
										 <?php $checkId++; ?>
											@endforeach
											</div>	
											@if(count($option->optionTypeValue)>4)
											<div style="cursor: pointer;color: #337ab7;"class="more">More</div>
											@endif
										
									@endif
								@endforeach
							@endif
							
							<h3>Price</h3>
							<div class="slider_rnge">
								<div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
									<div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
									<span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span>
									<span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>
								</div>
								<p>
									<!--<label for="amount">Price range:</label>-->
									<input type="text" class="price_numb" id="amount" name="price">
								</p>
							</div>
							
						</form>
					</div>
					<!--inner containt-->
				</div>  
				 
			</nav>
		</div>
		<!--left area end-->   
		<!--right product area start-->
		<div class="search_productt">
			<!--searxh result page top banner area
			
			-->
			<div class="search_bner">
			  <img src="images/search_banner.jpg" alt="">  
			</div>
			<!--searxh result page top banner area-->
			<!--Sort By area-->
			<div class="top_lls99" style="margin:-11px 0 0 0;">
				<p>Womens Dresses <span>({{count($count)}} products found)</span></p>
				
				{{csrf_field()}}
				<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
					<div class="sorrt_ssc">
						<label>Sort by</label>
						<select  class="form-control" name="short" form="search_frm" id="sort_form">
							<option value="">Select</option>
							<option value="low" @if(@$post_data['short'] == "low"){{'selected'}}@endif>High to low price</option>
							<option value="high" @if(@$post_data['short'] == "high"){{'selected'}}@endif>low to high price</option>
						</select>
					</div>  
				
		   </div>
			<!--Sort By area end-->
			<!--Item adrea start--> 
			@if(!$product->isEmpty())
				@foreach($product as $row)
					<div class="searchh_itemm">
						<div class="searchh_ppc1">
							<img src="{{url('storage/app/public/product_image/thumb/'.$row->product_image)}}" alt="">
							<div class="sp_on_over">
								@if(session()->get('user_id') == "" && session()->get('user_type') == "")
									<a href="login" class="ic_fev"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
								@elseif(session()->get('user_id') != "" && session()->get('user_type') == 3)
									<?php $favorite = favorite($row->product_id);?>
									<a href="javascript:void(0);" class="ic_fev starr" data-id="{{$row->product_id}}">
									@if(count($favorite)>0)
										<i style="color: #fcb027;" id ="pro_{{$row->product_id}}" class="fa fa-heart" aria-hidden="true"></i>
									@else
										<i id ="pro_{{$row->product_id}}" class="fa fa-heart-o" aria-hidden="true"></i>
									@endif
									</a>
								@endif
								
								@if(session()->get('user_id') != "" && session()->get('user_type') == 3)
									<a href="javascript:void(0);" class="add_too cart" data-id="{{@$row->product_id}}">Add to Cart</a>
								@elseif(session()->get('user_id') != "" && session()->get('user_type') == "")
									<a href="login" class="add_too">Add to Cart</a>
								@endif
							</div>
						</div>
						<div class="searchh_dessc">
						   <h4><a href="{{url('/')}}/product/{{@$row->product_slug}}">{{@$row->product_title}}</a></h4>
							@if(@$row->offer_price)
								<p>${{@$row->offer_price}} <span>${{@$row->product_price}}</span></p>
							@else
								<p>${{@$row->product_price}}</p>
							@endif
							<ul>
								<?php 
								$product_rev = floor(@$row->ave_review);
								for($i=1;$i<=5;$i++){
									if($i <= $product_rev){
								?>
									<li><img src="images/rate_star.png" alt=""></li>
								<?php
									}
									else
									{
									?>
										<li><img src="images/rate_star_1.png" alt=""></li>
									<?php
									}
								} 
								?>
							</ul>
						</div>
					</div>
				@endforeach
				@else
					<div class="no_result">
						<img src="images/error-no-search-results.png" />
						<h1>Sorry, no results found!</h1>
						<p>Please check the spelling or try searching for something else</p>
					</div>
			@endif
			<!--Item adrea end-->
			<!--pagination-->
			<div class="pagination_area">
				{{$product->links()}}
		   </div>
        <!--pagination end-->
		</div>
		<!--right product area end--> 
	</div>
</div>
@include('english.layout.footer')
<style>
.shadow_outer {
    width: 100%;
    height: 2790px;
    text-align: center;
    display: block;
    background: #FFF;
    position: fixed;
    z-index: 999999;
    top: 0;
	opacity:0.7;
}
</style>
<!--price range (Calender/date picker)-->
<link href="css/themes_smoothness_jquery-ui.css" rel="stylesheet" type="text/css">
<script src="js/jquery.com_ui_1.11.4_jquery-ui.js"></script>
<!--show more-->
<script>
	$(function() {
		<?php if(@$post_data['max_price']>0){?>
		var max_value = '<?php echo $post_data['max_price'];?>';
		<?php }else{?>
		var max_value = '<?php echo @$max_price->product_price;?>';
		<?php }?>
		<?php if(@$post_data['min_price']>0){?>
		var min_value = '<?php echo @$min_price->product_price;?>';
		<?php }else{?>
		var min_value = 0;
		<?php }?>
		$( "#slider-range" ).slider({
			range: true,
			min: min_value,
			max: max_value,
			values: [ min_value, max_value ],
			slide: function( event, ui ) {
				$( "#amount" ).val( "$." + ui.values[ 0 ] + " - $." + ui.values[ 1 ] );
				$( "#max_price" ).val(ui.values[ 1 ]);
				$( "#min_price" ).val(ui.values[ 0 ]);
				filter_search();
			}
		});
		$( "#amount" ).val( "$." + $( "#slider-range" ).slider( "values", 0 ) +
			" - $." + $( "#slider-range" ).slider( "values", 1 ) );
			$( "#max_price" ).val($( "#slider-range" ).slider( "values", 1 ));
			$( "#min_price" ).val($( "#slider-range" ).slider( "values", 0 ));
			
	});
</script>
<script type="text/javascript">
    $(document).ready(function(){
		$(".pagination a").click(function(){
			var url=$(this).attr('href');
			$("#search_frm").attr('action',url);
			$("#search_frm").submit();
			return false;
		});
		$('.checkbox-group').click(function(){
			filter_search();
		});
		$('.sameclass').change(function(){
			filter_search();
		});
		$('#sort_form').change(function(){
			$('#sort_by').val($(this).val());
			filter_search();
		});		
		$('[name="category"]').change(function(){
			$('[name="sub_category"]').val('');
			$('[name="max_price"]').val('');
			filter_search();
		});
		$('[name="sub_category"]').change(function(){
			$('[name="max_price"]').val('');
			filter_search();
		});
		$('.starr').click(function(){
			var product =$(this).data('id');
			var token = $('meta[name="csrf-token"]').attr('content');
			//alert(product);
			$.ajax({
				method:"POST",
				url:"<?php echo url('add-to-favorite')?>",
				dataType: 'JSON',
				data:{
					_token:token,
					product_id:product
				},
				//data:'product_id='+product+'&_token='+token,
				success:function(result)
				{
					//var obj = jQuery.parseJSON( result );
					//console.log(responseText);
					//alert(result.msg);
					//alert(result._token);
					if(result.msg == 1)
					{
						$('#pro_'+product).removeClass('fa fa-heart-o');
						$('#pro_'+product).addClass('fa fa-heart');
						$('#pro_'+product).css('color','#fcb027');
					}
					else
					{
						$('#pro_'+product).removeClass('fa fa-heart');
						$('#pro_'+product).addClass('fa fa-heart-o');
					}
				},
				error:function(error){
					console.log(error.responseText);
				} 
			});
		});
		$('.cart').click(function(){
			var product =$(this).data('id');
			var token = $('meta[name="csrf-token"]').attr('content');
			//alert(product);
			$.ajax({
				method:"POST",
				url:"<?php echo url('add-to-cart')?>",
				dataType: 'JSON',
				data:{
					_token:token,
					product_id:product
				},
				success:function(result)
				{
					alert(result.cart_item);
					$('.cart_item').html(result.cart_item);
					
				},
				error:function(error){
					console.log(error.responseText);
				} 
			});
		});
		$('.see_more').click(function(){
		$(this).prev().show();
		$(this).next().show();
		$(this).hide();
		
		});
		$('.see_less').click(function(){
		$(this).prev().prev().hide();
		$(this).hide();
		$('#fst_div').show();
		$(this).prev().show();
		});
			$('#tabs').tab();
		});
	
</script>   
<!--show more end-->   
<script>
function filter_search(){
	$('.shadow_outer').show();
			var sub_category_slug_string='';
			var sub_category_slug=$('[name="sub_category"] option:selected').attr('data-sub-category_slug');			
			var category_slug=$('[name="category"] option:selected').attr('data-category_slug');
			if(typeof(sub_category_slug)!='undefined') sub_category_slug_string='/'+sub_category_slug;
			$('#search_frm').attr('action','search/'+category_slug+sub_category_slug_string)
	        $('#search_frm').submit();
	//var sub_category_slug_strin='';
	
	}
$(".more").click(function(){
if($(this).text()=='More')$(this).html('Less');
else if($(this).text()=='Less')$(this).html('More');
$(this).prev().toggleClass('more');
})
</script>
@endsection