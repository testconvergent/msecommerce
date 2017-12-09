@extends('english.layout.app')
@section('title','Search Product')
@section('body')
<div class="shadow_outer" style="display:none;"></div>
<div class="wrapper for_this_bg">	
	@include('english.layout.header')
	<div class="container">
       
	<div class="bread_cc">
        <p>Home <img src="images/arrow1.png" alt="img01"></p>
        <p>Mobiles & Accessories <img src="images/arrow1.png" alt="img01"></p>
        <p>Mobiles <img src="images/arrow1.png" alt="img01"></p>
        <p>Samsung Mobiles</p>
	</div>
       
       
	<!--slider top left-->
    <div class="left_slider_area"> 
            <div id="thumbnail-slider" style="float:left;">
            <div class="inner">
                <ul>
                    <li><a class="thumb" href="images/s_mobile1.jpg"></a></li>
                    <li><a class="thumb" href="images/s_mobile2.jpg"></a></li>
                    <li><a class="thumb" href="images/s_mobile3.jpg"></a></li>
                    <li><a class="thumb" href="images/s_mobile2.jpg"></a></li>
                </ul>
            </div>
            </div>
    
	        <div id="ninja-slider" style="float:left;">
            <div class="slider-inner">
                <ul>
                    <li><a class="ns-img" href="images/b_bomile.png"></a></li>
                    <li><a class="ns-img" href="images/b_mobile1.jpg"></a></li>
                    <li><a class="ns-img" href="images/b_mobile2.jpg"></a></li>
                    <li><a class="ns-img" href="images/b_mobile1.jpg"></a></li>
                </ul>
                
                <!--<div class="fs-icon" title="Expand/Close"></div>-->
                
                <!--<div class="wwishlistt"><a href="#" title="Add To Wishlist"></a></div>-->
                
            </div>
            </div>
    </div>   
    <!--slider top left end-->
     
      
    <!--desc right-->
    <div class="right_side_descc"> 
       <h2>Samsung Galaxy On Max (Black, 32 GB) (4 GB RAM)</h2>
       
       
       <div class="rev_rett">
         <ul>
            <li><img src="images/star_big1.png" alt=""></li>
            <li><img src="images/star_big1.png" alt=""></li>
            <li><img src="images/star_big1.png" alt=""></li>
            <li><img src="images/star_big1.png" alt=""></li>
            <li><img src="images/star_big2.png" alt=""></li>
         </ul>
         
          <span>(16,831 Ratings & 4,129 Reviews)</span>
       </div>
       
       <h3><span>Rs.28,900</span> Rs.21,624 </h3>
       
       <p><span>Availability :</span> In Stock</p>
       <p><span>Product Type :</span> Electronics</p>
       <p><span>Warranty :</span> 1 Year Manufacturer Warranty</p>
       
       <div class="pd_color">
         <span>Color :</span>
         <ul>
            <li><a href="#"><img src="images/m_color3.png" alt=""></a></li>
            <li><a href="#"><img src="images/m_color2.png" alt=""></a></li>
            <li><a href="#"><img src="images/m_color1.png" alt=""></a></li>
         </ul>
       </div>
       
       <form>
         <!--<div class="secect_sizee">
            <label>Select Size</label>
            <select>
              <option>Select</option>
              <option>Free Size</option>
              <option>XS</option>
              <option>XL</option>
              <option>M</option>
              <option>XXL</option>
              <option>Custom Size</option>
            </select>
            <a href="#">What Size am I?</a>
         </div>
         
         <div class="quantity ">
            <label>Quantity</label>
            <div class="for_countt">
              <input type="text" placeholder="">
              <a href="#" class="lefts_22"><img src="images/plus.png" alt=""></a>
              <a href="#" class="lefts_25"><img src="images/minus.png" alt=""></a>
            </div>
         </div>-->
         
         
         <div class="productss_infoo2">
         <h5>Highlights :</h5>
         <ul>
           <li>4 GB RAM | 32 GB ROM | Expandable Upto 256 GB</li>
           <li>5.7 inch Full HD Display.</li>
           <li>23MP Rear Camera | 13MP Front Camera</li>
           <li>3300 mAh Battery</li>
           <li>MediaTek MTK6757V/WL 2.39GHz, 1.69GHz, Octa Core Processor</li>
         </ul>
		</div>
         
         <!--<div class="share_icon6">
            <h6>Share This Product With</h6>
            <ul>
              <li><a href="#"><img src="images/face.png" alt=""></a></li>
              <li><a href="#"><img src="images/twiter.png" alt=""></a></li>
              <li><a href="#"><img src="images/in.png" alt=""></a></li>
            </ul>
         </div>-->
         
		<a href="#" class="add_to">Add to Cart</a>
        <a href="#" class="buyy_noww">Buy Now</a>
		 <a href="#" class="buyy_noww">Add to Favorite</a>

       </form>
        
       
    </div>    
    <!--desc right-->

    </div>
	<div class="container">
<div class="prodd_desc">

<h2 class="heading_style">product description</h2>
<p>{{@$s_product->product_title}}</p>

<h2 class="heading_style">Specifications</h2>

<ul class="spe_infoo5">
	<li>Brand</li>
    <li>In The Box</li>
    <li>Model Number</li>
    <li>Model Name</li>
    <li> Color</li>
    <li>Browse Type</li>
    <li>SIM Type</li>
    <li>SIM Size</li>
</ul>

<ul class="spe_infoo6">
	<li>Lenovo</li>
    <li>Handset, Adaptor, Earphone, User</li>
    <li>SM-G570FZKGINS</li>
    <li>Galaxy J5 Prime</li>
    <li>Black</li>
    <li>Smartphones</li>
    <li>Dual Sim</li>
    <li>Normal</li>
</ul>


</div>
</div>
 <section class="body_2">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12 product_head">
                    	<!--<h2>Products of this seller</h2>-->
                        <h2>Relative products</h2>
                        <span class="line"></span>
                        <p>View All</p>
                    </div>
                	<div class="col-md-12">
                    	<div class="slide_area xxmg_b">
                        
	<!--  Demos -->
    <section id="demos">
      <div class="row">
        <div class="large-12 columns">
          <div class="owl-carousel owl-theme">
            @if(!$similer_product->isEmpty())
				@foreach($similer_product as $s_product)
					<div class="item">
					  <a href="{{url('/')}}/product/{{@$s_product->product_slug}}">
						<div class="item_image">
						<img src="{{url('storage/app/public/product_image/thumb/'.$s_product->product_image)}}" alt="">
						<div class="item_hover"></div>
					  </div>
						<div class="item_details">
						<h4>{{@$s_product->product_title}}</h4>
						<div class="rate_area">
							<div class="rating">
							<?php 
								$product_rev = floor(@$s_product->ave_review);
								for($i=1;$i<=5;$i++){
									if($i <= $product_rev){
								?>
									<img src="images/rate_star.png" alt="">
								<?php
									}
									else
									{
									?>
										<img src="images/rate_star_1.png" alt="">
									<?php
									}
								} ?>
							</div>
							<span>{{@$s_product->product_price}} </span>
						</div>
						
					  </div>
					  </a>
					</div>
			@endforeach
            @endif
          </div>
        </div>
      </div>
    </section>
                        
                        
                    </div>
                    </div>
                    
                    
           
         <div class="container">   
            <div class="ttp_hhd2 carlamm66">
              <h2>Reviews</h2>
              <span></span>
              <a href="#" class="rght_rvw">Write a Review</a>
           </div>
                    
                    
            <div class="tab-content usemrgn xmbgg_btt">

            
            <div class="tab-pane fade for_revieww active in">
              <div class="revv_boxx">
                <h2>Excellent product...exactly the same as shown..quality of silk is very good...my mother loved it..</h2>
                <ul>
                 <li><img src="images/star_new1.png" alt=""></li>
          		 <li><img src="images/star_new1.png" alt=""></li>
          		 <li><img src="images/star_new1.png" alt=""></li>
				 <li><img src="images/star_new1.png" alt=""></li>
          		 <li><img src="images/star_new2.png" alt=""></li>
                 <span>(4)</span>
                </ul>
                <h6><img src="images/calendar.png" alt=""> 23-05-2015</h6>
                <h6><img src="images/userr.png" alt=""> By Rickii Jones</h6>
                <p>Most beautiful Saree. It z same as described. Actually looking better. Was a Gift for my Mother and she loved it. I just saw her glittering eyes. Thank you Smart Retail. Thank you Trendz.</p>
                <a href="#">View More &gt;&gt;</a>
              </div>
            </div>
           
          </div>
         </div>           
                    
                    
                    
                </div>
            </div>
        </section>
		@include('english.layout.footer')
</div>	
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
@endsection