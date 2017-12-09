@extends('arabic.layout.app')
@section('title',__('messages.search_product'))
@section('body')
<div class="shadow_outer" style="display:none;"></div>
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<div class="container">
		<div class="bread_cc">
			<p>Home <img src="images/arrow1.png" alt="img01"></p>
			<p>Clothing & Shoes <img src="images/arrow1.png" alt="img01"></p>
			<p>Women's Clothing <img src="images/arrow1.png" alt="img01"></p>
			<p>Dresses & Skirts</p>
		</div>
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
					<h2>@lang('messages.filters')</h2>
					<div class="rs_area">
						<form name="search_frm" id="search_frm" method="post" action="search">
							{{csrf_field()}}
							<input type="hidden" name="short" id="sort_by" value="{{@$post_data['short']}}">
							<h3>@lang('messages.category')</h3>
							@if(@category1)
								@foreach($category1 as $cat1)
									<div class="ss_cbox">
										<div class="checkbox-group"> 
											<input class="sameclass" id="checkiz_{{$cat1->category_id}}" type="checkbox" name="category[]" value="{{$cat1->category_id}}" @if(@$post_data['category'])
												@foreach($post_data['category'] as $val1)
													@if($val1 == $cat1->category_id)
														{{'checked'}}
													@endif
												@endforeach
											@endif> 
											<label for="checkiz_{{$cat1->category_id}}">
												<span class="check"></span>
												<span class="box"></span>
												<p class="ft_text">{{$cat1->cat_name}}</p>
											</label>
										</div>
									</div>
								@endforeach
							@endif
							<div class="clearfix"></div>
							<div class="show_click snd_div" style="display:none;">
								@if(@category2)
									@foreach($category2 as $cat2)
										<div class="ss_cbox">
											<div class="checkbox-group"> 
												<input class="sameclass" id="checkiz_{{$cat2->category_id}}" type="checkbox" name="category[]" value="{{$cat2->category_id}}"@if(@$post_data['category'])
												@foreach($post_data['category'] as $val2)
													@if($val2 == $cat2->category_id)
														{{'checked'}}
													@endif
												@endforeach
											@endif>  
												<label for="checkiz_{{$cat2->category_id}}">
													<span class="check"></span>
													<span class="box"></span>
													<p class="ft_text">{{$cat2->cat_name}}</p>
												</label>
											</div>
										</div>
									@endforeach
								@endif
							</div>
							<!--<h3>Price</h3>
							<input type="text" placeholder="Price">-->
							<!--sho_hide ben-->
							@if(count(@$category2)>0)
								<div class="show_moree see_more" >
									<a href="javascript:void(0);" id="sho" class="show_all">{{count(@$category2)}} @lang('messages.more') <i class="fa fa-caret-down" aria-hidden="true"></i></a>
									<input type="hidden" id="shoval" value="">
									<input class="appl" type="submit" value="@lang('messages.apply')">
								</div>
								<div class="show_moree see_less" style="display:none;">
									<a href="javascript:void(0);" class="show_llo">@lang('messages.less') <i class="fa fa-caret-up" aria-hidden="true"></i></a>
									<input class="appl" type="submit" value="@lang('messages.apply')">
								</div>
							@endif
							<input class="appl" type="submit" value="@lang('messages.apply')">
							<h3>@lang('messages.sub_cat')</h3>
							@if(@sub_category1)
								@foreach($sub_category1 as $subcat1)
									<div class="ss_cbox">
										<div class="checkbox-group"> 
											<input class="sameclass1" id="checkiz_{{$subcat1->category_id}}" type="checkbox" name="sub_category[]" value="{{$subcat1->category_id}}" @if(@$post_data['sub_category'])
												@foreach($post_data['sub_category'] as $sub_val1)
													@if($sub_val1 == $subcat1->category_id)
														{{'checked'}}
													@endif
												@endforeach
											@endif> 
											<label for="checkiz_{{$subcat1->category_id}}">
												<span class="check"></span>
												<span class="box"></span>
												<p class="ft_text">{{$subcat1->cat_name}}</p>
											</label>
										</div>
									</div>
								@endforeach
							@endif
							<div class="clearfix"></div>
							<div class="show_click snd_div" style="display:none;">
								@if(@sub_category2)
									@foreach($sub_category2 as $sub_cat2)
										<div class="ss_cbox">
											<div class="checkbox-group"> 
												<input class="sameclass1" id="checkiz_{{$sub_cat2->category_id}}" type="checkbox" name="sub_category[]" value="{{$sub_cat2->category_id}}"> 
												<label for="checkiz_{{$sub_cat2->category_id}}">
													<span class="check"></span>
													<span class="box"></span>
													<p class="ft_text">{{$sub_cat2->cat_name}}</p>
												</label>
											</div>
										</div>
									@endforeach
								@endif
							</div>
							@if(count(@$sub_category2)>0)
							<div class="show_moree see_more" >
								<a href="javascript:void(0);" id="sho" class="show_all">{{count(@$category2)}} @lang('messages.more') <i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<input type="hidden" id="shoval" value="">
								<input class="appl" type="submit" value="@lang('messages.apply')">
							</div>
							<div class="show_moree see_less" style="display:none;">
								<a href="javascript:void(0);" class="show_llo">@lang('messages.less') <i class="fa fa-caret-up" aria-hidden="true"></i></a>
								<input class="appl" type="submit" value="@lang('messages.apply')">
							</div>
							@endif
							<input class="appl" type="submit" value="@lang('messages.apply')">
							<!-- <h3>keyword</h3>
							<input type="text" placeholder="Type your category">
							<input class="appl" type="submit" value="Apply">-->
							<h3>@lang('messages.price')</h3>
							<input type="text" class="leftt_tt1" id="min_price" name="min_price"  placeholder="From" value="{{@$post_data['min_price']}}">
							<input type="text" class="leftt_tt2" id="max_price" name="max_price"  name="dsf" placeholder="To" value="{{@$post_data['max_price']}}">
							<input class="appl" type="submit" value="@lang('messages.apply')">
							<div class="clearfix"></div>
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
							<input class="appl" type="submit" value="@lang('messages.apply')">
						</form>
					</div>
					<!--inner containt-->
				</div>  
				 
			</nav>
		</div>
		<!--left area end-->   
		<!--right product area start-->
		<div class="search_productt">
			<!--searxh result page top banner area-->
			<div class="search_bner">
			  <img src="images/search_banner.jpg" alt="">  
			</div>
			<!--searxh result page top banner area-->
			<!--Sort By area-->
			<div class="top_lls99">
				<p>Womens Dresses <span>({{count($product)}} products found)</span></p>
				<form>
				{{csrf_field()}}
				<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
					<div class="sorrt_ssc">
						<label>@lang('messages.sort_by')</label>
						<select name="short" id="sort_form">
							<option value="">@lang('messages.popularity')</option>
							<option value="low" @if(@$post_data['short'] == "low"){{'selected'}}@endif>@lang('messages.p_h_to_l')</option>
							<option value="high" @if(@$post_data['short'] == "high"){{'selected'}}@endif>@lang('messages.p_l_to_h')</option>
						</select>
					</div>  
				</form>
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
								
								@if(session()->get('user_id') == "" && session()->get('user_type') == "")
									<a href="login" class="add_too">Add to Cart</a>
								@else
									
								@endif
							</div>
						</div>
						<div class="searchh_dessc">
						   <h4><a href="{{url('/')}}/product/{{@$row->product_slug}}">{{@$row->product_title}}</a></h4>
							@if(@$row->offer_price)
								<p>${{$row->offer_price}} <span>${{@$row->product_price}}</span></p>
							@else
								<p>${{@$row->product_price}}</p>
							@endif
						   <ul>
							 <li><img src="images/rate_star.png" alt=""></li>
							 <li><img src="images/rate_star.png" alt=""></li>
							 <li><img src="images/rate_star.png" alt=""></li>
							 <li><img src="images/rate_star.png" alt=""></li>
							 <li><img src="images/rate_star_1.png" alt=""></li>
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
@include('arabic.layout.footer')
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
				//filter_search();
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
	$('#sort_form').change(function(){alert();
		$('#sort_by').val($(this).val());
		filter_search();
	});
	$('.sameclass').click(function(){alert();
		filter_search();
	});
	$('.sameclass1').click(function(){alert();
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
	$('#search_frm').submit();
	}
</script>
@endsection