<!-- ========== Left Sidebar Start ========== -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!--- Divider -->
		<div id="sidebar-menu">
			<ul>
				<li>
					<a href="admin-dashboard" class="<?php if(Request::segment(1)=='admin-dashboard'){echo "active";}?>">
					<i class="fa fa-tachometer" aria-hidden="true"></i><span> Dashboard </span></a>
				</li>
				<li>
					<a href="admin-delivery-staff-list" class="<?php if(Request::segment(1) == "admin-delivery-staff-list" || Request::segment(1) == "admin-add-delivery-staff" || Request::segment(1) == "admin-edit-delivery-staff"){echo "active";}?>">
					<i class="fa fa-users" aria-hidden="true"></i><span> Delivery Staff </span></a>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-category-list" || Request::segment(1) == "admin-add-category" || Request::segment(1) == "admin-edit-category"){?>subdrop active<?php } ?>"></i><i class="md ion-cube"></i>
					<span>Category</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
						<li><a href="admin-category-list" class="<?php if(Request::segment(1) == "admin-category-list" || Request::segment(1) == "admin-add-category" || Request::segment(1) == "admin-edit-category"){?>active1<?php } ?>">Category</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-product-list" || Request::segment(1) == "admin-product-details" || Request::segment(1) == "admin-product-option-list" || Request::segment(1) == "admin-add-product-option" || Request::segment(1) == "admin-edit-product-option"){?>subdrop active<?php } ?>"></i><i class="fa fa-product-hunt"></i>
					<span>Product</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
						<li><a href="admin-product-list" class="<?php 
						if(Request::segment(1) == "admin-product-list" || Request::segment(1) == "admin-product-details")						
						{?>active1<?php } ?>">Product</a></li>
						
						<li><a href="admin-product-option-list" class="<?php if(Request::segment(1) == "admin-product-option-list" || Request::segment(1) == "admin-add-product-option" || Request::segment(1) == "admin-edit-product-option"){?>active1<?php } ?>">Product Option</a></li>
					</ul>
				</li>				
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect<?php if(Request::segment(1) == "admin-customers-list" ||Request::segment(1) == "admin-sellers-list" || Request::segment(1) == "admin-customer-details" || Request::segment(1) == "admin-seller-details"){?>subdrop active<?php } ?>"></i><i class="md ion-person "></i>
					<span>User Management</span> <span class="pull-right"><i class="md md-add"></i></span></a>
					<ul class="list-unstyled">
	                 <li><a href="admin-customers-list" class="<?php if(Request::segment(1) == "admin-customers-list" || Request::segment(1) == "admin-customer-details"){?>active1<?php } ?>">Customers</a></li>
						<li><a href="admin-sellers-list" class="<?php if(Request::segment(1) == "admin-sellers-list" || Request::segment(1) == "admin-seller-details"){?>active1<?php } ?>">Sellers</a></li>
					</ul>
				</li>				
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Left Sidebar End -->