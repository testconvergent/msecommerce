@extends('arabic.layout.app')
@section('title',__('messages.dashbaord'))
@section('body')
<div class="wrapper for_this_bg">
	@include('arabic.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2">
						<h2>@lang('messages.buyer') @lang('messages.dashbaord')</h2>
						<!--<span class="line"></span>-->
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('arabic.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">@lang('messages.dashbaord')</h2>
							<div class="below_dash">
								<div class="info_box">
									<h4>@lang('messages.personal_info')</h4>
									<span class="ltlf"><a href="edit-profile">
										<img src="images/edit.png" onmouseover="this.src='images/edit_h.png'" onmouseout="this.src='images/edit.png'" alt="">
										</a>
									</span>
									<div class="info_chart">
										<ul>
											<li>
												<span class="first">@lang('messages.first_name') </span>
												<span class="second">{{@$get->first_name}} </span>
											</li>
											<li>
												<span class="first">@lang('messages.last_name') </span>
												<span class="second">{{@$get->last_name}} </span>
											</li>
											<li>
												<span class="first">@lang('messages.email') </span>
												<span class="second">{{@$get->email}} </span>
											</li>
											<li>
												<span class="first">@lang('messages.phone').</span>
												<span class="second">{{@$get->phone}} </span>
											</li>
											<li>
												<span class="first">@lang('messages.password')</span>
												<span class="second blue_color"><a href="change-password">@lang('messages.change_password')</a></span>
											</li>
										</ul>
									</div>
								</div>
								<div class="info_box info_box_2">
									<h4>@lang('messages.default_shiping_address')</h4>
									<span class="ltlf"><a href="#">
										<img src="images/edit.png" onmouseover="this.src='images/edit_h.png'" onmouseout="this.src='images/edit.png'" alt="">
										</a>
									</span>
									<div class="info_chart">
										<ul>
											<li>
												<span class="third">John Heard</span>
											</li>
											<li>
												<span class="third">Kolkata, West Bengal, 785224, India : Address</span>
											</li>
											<li>
												<span class="third">+1 9856 552 523 : Phone</span>
											</li>
											<li>
												<span class="third">johnheard007@gmail.com : Email</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="top_dash">
								<div class="wish_listt">
									<div class="trip_table history_table">
										<div class="">
											<div class="table">
												<div class="one_row1 hidden-xs hidden-sm">
													<div class="cell1 tab_head_sheet">Order No</div>
													<div class="cell1 tab_head_sheet">Item </div>
													<div class="cell1 tab_head_sheet seller">Seller</div>
													<div class="cell1 tab_head_sheet">Qty</div>
													<div class="cell1 tab_head_sheet">Price</div>
													<div class="cell1 tab_head_sheet">Ordered On </div>
													<div class="cell1 tab_head_sheet">Status</div>
													<div class="cell1 tab_head_sheet">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
												</div>
												
												
												<div class="one_row1 small_screen31 small_1">
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Order No </span>
														<a href="#"><p class="add_ttrr">ORD000028</p></a>
													</div>
													<div class="cell1 tab_head_sheet_1 make1199">
														<span class="W55_1">Item</span>
														<div class="item_img"><img src="images/item_1.png" alt=""></div>
														<p class="add_ttrr">Anand Sarees Printed Fashion Saree</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Seller </span>
														<p class="add_ttrr seller"><strong><img src="images/seller_1.png" alt=""></strong> Saree House</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Qty</span>
														<p class="add_ttrr">1</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Price</span>
														<p class="add_ttrr">$15.00</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Ordered On</span>
														<p class="add_ttrr">Oct 15,2017</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">Status</span>
														<p class="add_ttrr">Delivered</p>
													</div>
													<div class="cell1 tab_head_sheet_1">
														<span class="W55_1">&nbsp;</span>
														<!--<a href="#"><img src="images/exit.png" alt=""></a>-->
														<a href="#"><img src="images/arrow-down.png" alt=""></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>
@include('arabic.layout.footer')
@endsection