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
						<h2>@lang('messages.seller') @lang('messages.dashbaord')</h2>
						<span class="line"></span>
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('arabic.layout.menu')
						<div class="board_details">
							<h2 class="dash_head">@lang('messages.dashbaord')</h2>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s01.png" alt=""></span>
								<h3>@lang('messages.product_in_stock')</h3>
								<h4>23</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s02.png" alt=""></span>
								<h3>@lang('messages.product_sold')</h3>
								<h4>123</h4>
							</div>
							
							<div class="in_boxx1 da_forr5 no_mrg_rr">
								<span><img src="images/s005.png" alt=""></span>
								<h3>@lang('messages.total_order')</h3>
								<h4>1455</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s006.png" alt=""></span>
								<h3>@lang('messages.gross_earning')</h3>
								<h4>$2344567</h4>
							</div>
							
							<div class="in_boxx1 da_forr5">
								<span><img src="images/s007.png" alt=""></span>
								<h3>@lang('messages.net_earning')</h3>
								<h4>$123450</h4>
							</div>
							
							<div class="in_boxx1 da_forr5 no_mrg_rr">
								<span><img src="images/s008.png" alt=""></span>
								<h3>@lang('messages.commision_paid')</h3>
								<h4>$21000</h4>
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