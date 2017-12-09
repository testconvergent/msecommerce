@if(session()->get('user_type') == 2)
	@if(App::getLocale()=='en')
		<div class="left_dash">
			<ul>
				<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard"><img src="images/dash_1.png" alt=""> Dashboard</a></li>
				<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile"><img src="images/dash_2.png" alt=""> Edit Profile</a></li>
				<li><a href="#"><img src="images/dash_3.png" alt=""> Add Products</a></li>
				<li><a href="#"><img src="images/dash_6.png" alt=""> My Products</a></li>
				<li><a href="#"><img src="images/dash_7.png" alt=""> My Sales</a></li>
				<li><a href="#"><img src="images/dash_8.png" alt=""> Finance</a></li>
			</ul>
		</div>
		@elseif(App::getLocale()=='ar')
		<div class="left_dash rtl_menu">
			<ul>
				<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard">@lang('messages.dashoboard')<img src="images/dash_1.png" alt=""> </a></li>
				<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile">@lang('messages.edit_profile')<img src="images/dash_2.png" alt=""></a></li>
				<li><a href="#">@lang('messages.add_product')<img src="images/dash_3.png" alt=""></a></li>
				<li><a href="#">@lang('messages.my_product')<img src="images/dash_6.png" alt=""></a></li>
				<li><a href="#">@lang('messages.my_sale')<img src="images/dash_7.png" alt=""></a></li>
				<li><a href="#">@lang('messages.finance')<img src="images/dash_8.png" alt=""></a></li>
			</ul>
		</div>
	@endif
@endif
@if(session()->get('user_type') == 3)
	<div class="left_dash">
		<ul>
			<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard"><img src="images/dash_1.png" alt=""> Dashboard</a></li>
			<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile"><img src="images/dash_2.png" alt=""> Edit Profile</a></li>
			<li><a href="#"><img src="images/dash_3.png" alt=""> Order History</a></li>
			<li><a href="#"><img src="images/dash_4.png" alt=""> My Wish list</a></li>
			<li><a href="#"><img src="images/dash_5.png" alt=""> Address Book</a></li>
		</ul>
	</div>
@endif