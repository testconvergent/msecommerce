@if(session()->get('user_type') == 2)
	<div class="left_dash rtl_menu">
		<ul>
			<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard">@lang('messages.dashbaord')<img src="images/dash_1.png" alt=""> </a></li>
			<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile">@lang('messages.edit_profile')<img src="images/dash_2.png" alt=""></a></li>
			<li><a href="add-product">@lang('messages.add_product')<img src="images/dash_3.png" alt=""></a></li>
			<li><a href="my-product">@lang('messages.my_product')<img src="images/dash_6.png" alt=""></a></li>
			<li><a href="javascript:void(0);">@lang('messages.my_sale')<img src="images/dash_7.png" alt=""></a></li>
			<li><a href="javascript:void(0);">@lang('messages.finance')<img src="images/dash_8.png" alt=""></a></li>
		</ul>
	</div>
@endif
@if(session()->get('user_type') == 3)
	<div class="left_dash rtl_menu">
		<ul>
			<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard"> @lang('messages.dashbaord')<img src="images/dash_1.png" alt=""></a></li>
			<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile"> @lang('messages.edit_profile')<img src="images/dash_2.png" alt=""></a></li>
			<li><a href="javascript:void(0);"> @lang('messages.order_history')<img src="images/dash_3.png" alt=""></a></li>
			<li><a href="javascript:void(0);">@lang('messages.my_wish_list')<img src="images/dash_4.png" alt=""></a></li>
			<li><a href="javascript:void(0);">@lang('messages.address_book')<img src="images/dash_5.png" alt=""></a></li>
		</ul>
	</div>
@endif