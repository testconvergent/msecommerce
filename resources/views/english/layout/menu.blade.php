@if(session()->get('user_type') == 2)
<div class="left_dash">
	<ul>
		<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard"><img src="images/dash_1.png" alt=""> Dashboard</a></li>
		<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile"><img src="images/dash_2.png" alt=""> Edit Profile</a></li>
		<li class="<?php if(Request::segment(1)=='add-product'){echo "active";}?>"><a href="add-product"><img src="images/dash_3.png" alt=""> Add Products</a></li>
		<li class="<?php if(Request::segment(1)=='my-product'){echo "active";}?>"><a href="my-product"><img src="images/dash_6.png" alt=""> My Products</a></li>
		<li><a href="javascript:void(0);"><img src="images/dash_7.png" alt="">My Orders</a></li>
		<li><a href="javascript:void(0);"><img src="images/dash_8.png" alt=""> Finance</a></li>
		<li class="<?php if(Request::segment(1)=='seller-store'){echo "active";}?>"><a href="seller-store"><img src="images/dash_5.png" alt="">Branch Location</a></li>
	</ul>
</div>
@endif
@if(session()->get('user_type') == 3)
<div class="left_dash">
	<ul>
		<li class="<?php if(Request::segment(1)=='dashboard'){echo "active";}?>"><a href="dashboard"><img src="images/dash_1.png" alt=""> Dashboard</a></li>
		<li class="<?php if(Request::segment(1)=='edit-profile'){echo "active";}?>"><a href="edit-profile"><img src="images/dash_2.png" alt=""> Edit Profile</a></li>
		<li><a href="javascript:void(0);"><img src="images/dash_3.png" alt=""> Order History</a></li>
		<li><a href="javascript:void(0);"><img src="images/dash_4.png" alt=""> My Wish list</a></li>
		<li class="<?php if(Request::segment(1)=='address-book'){echo "active";}?>"><a href="address-book"><img src="images/dash_5.png" alt=""> Address Book</a></li>
	</ul>
</div>
@endif