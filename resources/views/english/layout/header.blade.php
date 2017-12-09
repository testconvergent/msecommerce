<header>
	<div class="top_header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12 logo">
					<a href="{{url('/')}}">
						<img src="images/logo.png" alt="">
					</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-8 make_search">
					<div class="search_head">
						<form name="search" action="search" method="post">
							{{csrf_field()}}
							<div class="ui-widget">
							<input autocomplete="off" value="@if(@$searching_string){{$searching_string}} @endif" class="type_search" type="text" placeholder="Search for Products, Brands and More"   name="keyword">
							</div>
							<button class="submit_search" type="submit"><img src="images/search_icon.png" alt=""></button>
						</form>
						<div class="autocomplete_search">
						
						</div>
					</div>
				</div>
				@if(session()->get('user_id') == "")
				<div class="col-md-3 col-sm-3 col-xs-4 make_log no_pad_l">
					<div class="log_cart only_reletf">
						<ul>
							<li>
								<a href="javascript:void(0);" class="sign_ffrr">
								<!--<i class="fa fa-lock" aria-hidden="true"></i>-->
									<img src="images/sign.png" alt="">
								</a>
								<div class="drop_for_signup2">
									<a href="login"><i class="fa fa-sign-in" aria-hidden="true"></i> @lang('messages.login')</a>
									<a href="seller-signup"><i class="fa fa-user-o" aria-hidden="true"></i> @lang('messages.seller_signup')</a>
									<a href="customer-signup"><i class="fa fa-user-o" aria-hidden="true"></i> @lang('messages.customer_signup')</a>
								</div>
							</li>
							<li><span class="cart_item">0</span><a href="#">
							<!--<i class="fa fa-shopping-cart" aria-hidden="true"></i>-->
							<img src="images/cart.png" alt="">
							</a></li>
						</ul>
					</div>
					<div class="language">
						<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> 
							@if(App::getLocale()=='en')
							  <img src="images/flag_1.png" alt="">
							@elseif(App::getLocale()=='ar')
							  <img src="images/flag_2.png" alt="">
							@endif
							<span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
							<ul class="dropdown-menu">
								@foreach(Config::get('languages') as $lang => $language)
									@if ($lang != App::getLocale())
										<li>
											<a href="{{ route('lang.switch', $lang) }}">
												@if(App::getLocale()=='en')
													<img src="images/flag_2.png" alt="">
												@elseif(App::getLocale()=='ar')
													<img src="images/flag_1.png" alt="">
												@endif
											</a>
										</li>
									@endif
								@endforeach
							</ul>
						</div> 
					</div>
				</div>
				@endif
				@if(session()->get('user_id') != "")
					<div class="col-md-3 col-sm-3 col-xs-4 make_log no_pad_l after_login">
						<div class="log_cart">
							<ul>
								<?php $cart = cart();?>
								<li><span class="cart_item">
								<?php if(count($cart)>0)
								{
									echo $cart->cart_item_no;
								}
								else
								{
									echo 0;
								}
								?>
								</span><a href="shopping-cart">
								<img src="images/cart.png" alt="">
								</a></li>
							</ul>
						</div>
						<div class="language">
							<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> 
								@if(App::getLocale()=='en')
								<img src="images/flag_1.png" alt="">
								@elseif(App::getLocale()=='ar')
								<img src="images/flag_2.png" alt="">
								@endif
								<span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
								<ul class="dropdown-menu">
									@foreach(Config::get('languages') as $lang => $language)
										@if ($lang != App::getLocale())
											<li>
												<a href="{{ route('lang.switch', $lang) }}">
												@if(App::getLocale()=='en')
													<img src="images/flag_2.png" alt="">
												@elseif(App::getLocale()=='ar')
													<img src="images/flag_1.png" alt="">
												@endif
												</a>
											</li>
										@endif
									@endforeach
								</ul>
							</div> 
						</div>
						<div class="dashboard_header">
							<div class="menu_dash">
								<span class="uu_roundd"><img alt="" src="images/hi_image.png"></span>
								<?php 
								$get_user = fetch_user(session()->get('user_id'));
								$name = $get_user->first_name;
								//echo "<pre>";print_r($get_user);die;
								?>
								<p> Hi, {{@$name}}</p>
								<i class="fa fa-angle-down" aria-hidden="true"></i>
								<div class="clearfix"></div>
							</div>
							<div class="dropdown_dash" style="display:none;">
								<ul>
									<li><a href="dashboard"><i class="fa fa-user ad_tt" aria-hidden="true"></i> @lang('messages.my_profile')</a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-cog ad_tt" aria-hidden="true"></i> @lang('messages.setting')</a></li>
									<li><a href="logout"><i class="fa fa-sign-out ad_tt" aria-hidden="true"></i> @lang('messages.logout')</a></li>
								</ul>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="menu_area">
		<div class="container">
			<div class="row">
				
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li><a id="m1" class="#" href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> @lang('messages.category') <i class="fa fa-caret-down make_arrow" aria-hidden="true"></i> </a></li>
							<?php if(Request::segment(1) == 'search')
							{
								$category = category();
								//echo "<pre>";print_r($category);die;
							?>
							@if(!$category->isEmpty())
								@foreach($category as $cat)
									<li class="dropdown">
										<a href="search/{{$cat->category_slug}}" class="dropdown-toggle" data-toggle="dropdown">{{@$cat->cat_name}} <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
										<?php $subcat = sub_cat($cat->category_id);
										?>
										@if(!$subcat->isEmpty())
											<ul class="dropdown-menu open_mmnu">
												@foreach($subcat as $s_cat)
													<li><a href="search/{{$cat->category_slug}}/{{$s_cat->category_slug}}">{{@$s_cat->cat_name}}</a></li>
												@endforeach
											</ul>
										@endif
									</li>
								@endforeach
							@endif
							<?php 
							}
							else
							{
								$category = category();
							?>
								<li><a href="#">@lang('messages.all_offer')</a> </li>
								@if(!$category->isEmpty())
									@foreach($category as $cat)
										<li><a href="search/{{$cat->category_slug}}">{{@$cat->cat_name}}</a> </li>
									@endforeach
								@endif
							<?php
							}
							?>
						</ul>
					</div>
				</nav>
				<div class="menu-expend">
					<div class="container">
						<div class="cnt">
							<div id="sm" class="nwsubmnu" style="display:none;">
								<?php 
									$category = category(); 
								?>
								<!-- Product Section -->
								<ul class="blog-landin">
									@if(!$category->isEmpty())
										@foreach($category as $cat)
											<li class="white-panel">
												<a class="title" href="search/{{$cat->category_slug}}"><img src="@if(@$cat->category_icon){{url('storage/app/public/category_image/'.$cat->category_icon)}}@else{{'images/electronis.png'}}@endif" alt=""> {{@$cat->cat_name}}</a>
												<ul>
													<?php $subcat = sub_cat($cat->category_id);
													?>
													@if(!$subcat->isEmpty())
														@foreach($subcat as $s_cat)
															<li><a href="search/{{$cat->category_slug}}/{{$s_cat->category_slug}}">{{@$s_cat->cat_name}}</a></li>
														@endforeach
													@endif
												</ul>
											</li>
										@endforeach
									@endif
								</ul>
								<!-- Product Section -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<script>
$('[name="search"]').submit(function(){
if($('[class="type_search"]').val()) return true;
return false;
});
var countUpDownArrow=0;
var totalListLength='';
$('[class="type_search"]').keyup(function(e){
	switch(e.which) { 
        case 38: // up
		console.log(countUpDownArrow);
		if(totalListLength>0){
		$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','');	
		countUpDownArrow--;
		$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','#ccc');
		}else{
			countUpDownArrow=totalListLength;
			$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','#ccc');
		}
        break;
		case 13: // enter
		console.log('sffff',countUpDownArrow);
		var redirectUrl=$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').attr('data-link');
		console.log(redirectUrl);
        break;
        case 40: // down
		console.log(countUpDownArrow);
		if(countUpDownArrow<=totalListLength){
		$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','');
		countUpDownArrow++;
		$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','#ccc');
		}else{
			countUpDownArrow=1;
			$('.autocomplete_search ul li:nth-child('+countUpDownArrow+')').css('background','#ccc');
		}
        break;
        default: 
		var value = $(this).val();
		$('.autocomplete_search').hide();
		if (!value) {
			$('.autocomplete_search').hide();

		}
		var token = " {{ csrf_token() }}";
		$.ajax({
			type: 'get',
			url: "{{ url('autocomplete-search')}}",
			data: {
				'_token': token,
				'value': value
			},
			success: function(data) {

				// $( "#autocomplete" ).autocomplete({
				// source: data.masterData
				// });
				if (data.status = 'success') {$('.autocomplete_search').show().html(data.data);
				totalListLength=$('.autocomplete_search ul li').length;
				}
				else $('.autocomplete_search').hide()

			}
		});
		return; // exit this handler for other keys
    }	
	

}).blur(function(){
$(document).on('click','[data-link]',function(){
	var redirectUrl=$(this).attr('data-link');
	location.href=redirectUrl;
	$('.autocomplete_search').hide()
	})
});
</script>