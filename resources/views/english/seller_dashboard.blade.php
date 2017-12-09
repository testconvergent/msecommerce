@extends('english.layout.app')
@section('title','Dashboard')
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
						?>
						<h2>Welcome, {{@$get_user->company_name}}</h2>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details">
							<!--<h2 class="dash_head">Dashboard</h2>-->
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s01.png" alt=""></span>
								<h3>Products In Stock</h3>
								<h4>23</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s02.png" alt=""></span>
								<h3>Product Sold</h3>
								<h4>123</h4>
							</div>
							
							<div class="in_boxx1 da_forr5 no_mrg_rr">
								<span><img src="images/s005.png" alt=""></span>
								<h3>Total Orders</h3>
								<h4>1455</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s006.png" alt=""></span>
								<h3>Gross Earning</h3>
								<h4>$2344567</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s007.png" alt=""></span>
								<h3>Net Earning</h3>
								<h4>$123450</h4>
							</div>
							
							<div class="in_boxx1 da_forr5 no_mrg_rr">
								<span><img src="images/s008.png" alt=""></span>
								<h3>Charges Paid</h3>
								<h4>$21000</h4>
							</div>
							 <span class="second blue_color selpa"><a href="change-password">Change Password</a></span>
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
@include('english.layout.footer')
@endsection