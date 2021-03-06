<header>
		<div class="top_header">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 logo">
						<a href="{{url('/')}}">
							<img src="images/logo.png" alt="">
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-9 make_search">
						<div class="search_head">
							<input class="type_search" type="text" placeholder="Search for Products, Brands and More">
							<button class="submit_search" type="submit"><img src="images/search_icon.png" alt=""></button>
						</div>
					</div>
					@if(session()->get('user_id') == "")
					<div class="col-md-2 col-sm-3 col-xs-3 make_log no_pad_l">
						<div class="log_cart only_reletf">
							<ul>
								<li>
								<a href="javascript:void(0);" class="sign_ffrr">
								<!--<i class="fa fa-lock" aria-hidden="true"></i>-->
								<img src="images/sign.png" alt="">
								</a>
								<div class="drop_for_signup2">
									<a href="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
									<a href="seller-signup"><i class="fa fa-user-o" aria-hidden="true"></i> Seller Signup</a>
									<a href="customer-signup"><i class="fa fa-user-o" aria-hidden="true"></i> Customer Signup</a>
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
								  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <img src="images/flag_1.png" alt="">
								  <span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
								  <ul class="dropdown-menu">
									<li><a href="#"><img src="images/flag_2.png" alt=""></a></li>
								  </ul>
							 </div> 
						</div>
					</div>
					@endif
					@if(session()->get('user_id') != "")
						<div class="col-md-3 col-sm-3 col-xs-3 make_log after_login no_pad_l">
                            <div class="log_cart">
                            	<ul>
                                	<!--<li><a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a></li>-->
                                    <li><span class="cart_item">0</span><a href="#">
                                    <!--<i class="fa fa-shopping-cart" aria-hidden="true"></i>-->
                                    <img src="images/cart.png" alt="">
                                    </a></li>
                                </ul>
                            </div>
                            
                            <div class="dashboard_header">
                              <div class="menu_dash">
                                 <span class="uu_roundd"><img alt="" src="images/hi_image.png"></span>
								 <?php 
									$get_user = fetch_user(session()->get('user_id'));
									$name = $get_user->first_name.' '.$get_user->last_name
									//echo "<pre>";print_r($get_user);die;
								 ?>
                                 <p> Hi, {{@$name}}</p>
                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="dropdown_dash" style="display:none;">
                                 <ul>
                                   <li><a href="dashboard"><i class="fa fa-user ad_tt" aria-hidden="true"></i> My profile</a></li>
                                   <li><a href="#"><i class="fa fa-cog ad_tt" aria-hidden="true"></i> Settings</a></li>
                                   <li><a href="logout"><i class="fa fa-sign-out ad_tt" aria-hidden="true"></i> Logout</a></li>
                                 </ul>
                              </div>
            		   	   </div>
                            
                            <!--<div class="language">
                            	 <div class="dropdown">
                                  	  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <img src="images/flag_1.png" alt="">
                                  	  <span class=""><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
                                      <ul class="dropdown-menu">
                                        <li><a href="#"><img src="images/flag_1.png" alt=""></a></li>
                                      </ul>
                                 </div> 
                            </div>-->
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
								<li><a id="m1" class="#" href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> Category <i class="fa fa-caret-down make_arrow" aria-hidden="true"></i> </a></li>
								<!--<li><a id="item_1" href="#">Electronics <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Electronics <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Mobiles</a></li>
									<li><a href="#">Mobile Accessories</a></li>
									<li><a href="#">Laptop</a></li>
									<li><a href="#">Smart Wearable Tech</a></li>
									<li><a href="#">Desktop PCs</a></li>
									<li><a href="#">Televisions</a></li>
									<li><a href="#">Camera</a></li>
									<li><a href="#">Camera Accessories</a></li>
									<li><a href="#">Tablets</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Appliances <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Appliances <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Washing Machine</a></li>
									<li><a href="#">Refrigerators</a></li>
									<li><a href="#">Air Conditioners</a></li>
									<li><a href="#">Geysers</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Men's Fashion <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Men's Fashion <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Footwear</a></li>
									<li><a href="#">Sports wear</a></li>
									<li><a href="#">Top wear</a></li>
									<li><a href="#">Innerwear & Sleepwear</a></li>
									<li><a href="#">Ties, Socks, Caps & more</a></li>
									<li><a href="#">Kurta, Pyjama & more</a></li>
									<li><a href="#">Winter wear</a></li>
									<li><a href="#">Sneakers</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Women's Fashion <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Women's Fashion <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Clothing</a></li>
									<li><a href="#">Western Wear</a></li>
									<li><a href="#">Lingerie & Sleepwear</a></li>
									<li><a href="#">Sandals</a></li>
									<li><a href="#">Ethnic Wear</a></li>
									<li><a href="#">Jewellery</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Baby & Kids <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Baby & Kids <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Kids Clothing</a></li>
									<li><a href="#">Boys' Clothing</a></li>
									<li><a href="#">Kids Footwear</a></li>
									<li><a href="#">Boys' Footwear</a></li>
									<li><a href="#">Toys</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Home & Furniture <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home & Furniture <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Kitchen & Dining</a></li>
									<li><a href="#">Furniture</a></li>
									<li><a href="#">Home Decor</a></li>
									<li><a href="#">Gas Stoves</a></li>
									<li><a href="#">Lighting</a></li>
									<li><a href="#">House Keeping & Laundry</a></li>
									<li><a href="#">Blankets, Quilts & Dohars</a></li>
									<li><a href="#">Towels</a></li>
								  </ul>
								</li>
								<!--<li><a href="#">Books & More <i class="fa fa-angle-down" aria-hidden="true"></i> </a></li>-->
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books & More <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
								  <ul class="dropdown-menu open_mmnu">
									<li><a href="#">Entrance Exams</a></li>
									<li><a href="#">Academic</a></li>
									<li><a href="#">Literature & Fiction</a></li>
									<li><a href="#">Indian Writing</a></li>
									<li><a href="#">Biographies</a></li>
									<li><a href="#">Children</a></li>
									<li><a href="#">Business</a></li>
									<li><a href="#">Self Help</a></li>
								  </ul>
								</li>
								
							</ul>
						</div>
					</nav>
					<div class="menu-expend">
						<div class="container">
						
							<div class="cnt all_menu">
								<div id="sm" class="nwsubmnu" style="display:none;">
									<!-- Product Section -->
									<ul class="blog-landin">
										<li class="white-panel">
											<a class="title" href="#"><img src="images/electronis.png" alt=""> Electronics</a>
											<ul>
												<li><a href="#">Mobiles</a></li>
												<li><a href="#">Mobile Accessories</a></li>
												<li><a href="#">Laptop</a></li>
												<li><a href="#">Smart Wearable Tech</a></li>
												<li><a href="#">Desktop PCs</a></li>
												<li><a href="#">Televisions</a></li>
												<li><a href="#">Camera</a></li>
												<li><a href="#">Camera Accessories</a></li>
												<li><a href="#">Tablets</a></li>
											</ul>
										</li>
										<li class="white-panel">
											<a class="title" href="#"><img src="images/afeliation.png" alt=""> Appliances</a>
											<ul>
												<li><a href="#">Washing Machine</a></li>
												<li><a href="#">Refrigerators</a></li>
												<li><a href="#">Air Conditioners</a></li>
												<li><a href="#">Geysers</a></li>
											</ul>
										</li>
									</ul>
									<ul class="blog-landin blog-landin_graw">
										<li class="white-panel">
											<a class="title" href="#"><img src="images/fashion.png" alt=""> Men's Fashion</a>
											<ul>
												<li><a href="#">Footwear</a></li>
												<li><a href="#">Sports wear</a></li>
												<li><a href="#">Top wear</a></li>
												<li><a href="#">Innerwear & Sleepwear</a></li>
												<li><a href="#">Ties, Socks, Caps & more</a></li>
												<li><a href="#">Kurta, Pyjama & more</a></li>
												<li><a href="#">Winter wear</a></li>
												<li><a href="#">Sneakers</a></li>
											</ul>
										</li>
										<li class="white-panel">
											<a class="title" href="#"><img src="images/shoes.png" alt=""> Women's Fashion</a>
											<ul>
												<li><a href="#">Clothing</a></li>
												<li><a href="#">Western Wear</a></li>
												<li><a href="#">Lingerie & Sleepwear</a></li>
												<li><a href="#">Sandals</a></li>
												<li><a href="#">Ethnic Wear</a></li>
												<li><a href="#">Jewellery</a></li>
											</ul>
										</li>
									</ul>
									<ul class="blog-landin">
										<li class="white-panel">
											<a class="title" href="#"><img src="images/kids.png" alt=""> Baby & Kids</a>
											<ul>
												<li><a href="#">Kids Clothing</a></li>
												<li><a href="#">Boys' Clothing</a></li>
												<li><a href="#">Kids Footwear</a></li>
												<li><a href="#">Boys' Footwear</a></li>
												<li><a href="#">Toys</a></li>
											</ul>
										</li>
										<li class="white-panel">
											<a class="title" href="#"><img src="images/home.png" alt=""> Home & Furniture</a>
											<ul>
												<li><a href="#">Kitchen & Dining</a></li>
												<li><a href="#">Furniture</a></li>
												<li><a href="#">Home Decor</a></li>
												<li><a href="#">Gas Stoves</a></li>
												<li><a href="#">Lighting</a></li>
												<li><a href="#">House Keeping & Laundry</a></li>
												<li><a href="#">Blankets, Quilts & Dohars</a></li>
												<li><a href="#">Towels</a></li>
											</ul>
										</li>
									</ul>
									<ul class="blog-landin blog-landin_graw">
										<li class="white-panel">
											<a class="title" href="#"><img src="images/bool.png" alt=""> Books & More</a>
											<ul>
												<li><a href="#">Entrance Exams</a></li>
												<li><a href="#">Academic</a></li>
												<li><a href="#">Literature & Fiction</a></li>
												<li><a href="#">Indian Writing</a></li>
												<li><a href="#">Biographies</a></li>
												<li><a href="#">Children</a></li>
												<li><a href="#">Business</a></li>
												<li><a href="#">Self Help</a></li>
											</ul>
										</li>
										<li class="white-panel">
											<a class="title" href="#"><img src="images/sports.png" alt=""> Gaming & Accessories</a>
											<ul>
												<li><a href="#">PS4</a></li>
												<li><a href="#">Xbox One</a></li>
												<li><a href="#">Xbox 360</a></li>
												<li><a href="#">Gaming Consoles</a></li>
												<li><a href="#">Smart Glasses(VR)</a></li>
												<li><a href="#">Comics</a></li>
											</ul>
										</li>
									</ul>
									<ul class="blog-landin">
										<li class="white-panel">
											<a class="title" href="#"><img src="images/ball.png" alt=""> Sports</a>
											<ul>
												<li><a href="#">Cricket</a></li>
												<li><a href="#">Badminton</a></li>
												<li><a href="#">Football</a></li>
												<li><a href="#">Camping & Hiking</a></li>
												<li><a href="#">Swimming</a></li>
												<li><a href="#">Table Tennis</a></li>
												<li><a href="#">Tennis</a></li>
											</ul>
										</li>
										<li class="white-panel">
											<a class="title" href="#"><img src="images/meter.png" alt=""> Car & Bike Accessories</a>
											<ul>
												<li><a href="#">Car Body Cover</a></li>
												<li><a href="#">Bike Body Cover</a></li>
												<li><a href="#">Car Air Freshener</a></li>
												<li><a href="#">Vehicle Washing & Cleaning</a></li>
												<li><a href="#">Car Sun Shade</a></li>
												<li><a href="#">Bike Body Cover</a></li>
												<li><a href="#">Car Air Freshener</a></li>
												<li><a href="#">Car Mat</a></li>
											</ul>
										</li>
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