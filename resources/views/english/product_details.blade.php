@extends('english.layout.app')
@section('title','Search Product')
@section('body')
<div class="shadow_outer" style="display:none;"></div>
<div class="wrapper for_this_bg">	
	@include('english.layout.header')
	<div class="container">
       
	<div class="bread_cc">
        <p>Home <img src="images/arrow1.png" alt="img01"></p>
        <p>{{@$product->parent_cat_name}} <img src="images/arrow1.png" alt="img01"></p>
        <p>{{@$product->sub_cat_name}} <img src="images/arrow1.png" alt="img01"></p>
        <p>{{@$product->product_title}}</p>
	</div>
       
       
	<!--slider top left-->
    <div class="left_slider_area"> 
            <div id="thumbnail-slider" style="float:left;">
            <div class="inner">
                <ul>
					@if(!$image->isEmpty())
						@foreach($image as $img)
							<li><a class="thumb" href="{{url('storage/app/public/product_image/thumb/'.$img->product_image)}}"></a></li>
						@endforeach
                    @endif
                </ul>
            </div>
            </div>
    
	        <div id="ninja-slider" style="float:left;">
            <div class="slider-inner">
                <ul>
					@if(!$image->isEmpty())
						@foreach($image as $img)
							<li><a class="ns-img" href="{{url('storage/app/public/product_image/'.$img->product_image)}}"></a></li>
						@endforeach
                    @endif
                </ul>
                
                <!--<div class="fs-icon" title="Expand/Close"></div>-->
                
                <!--<div class="wwishlistt"><a href="#" title="Add To Wishlist"></a></div>-->
                
            </div>
            </div>
    </div>   
    <!--slider top left end-->
     
      
    <!--desc right-->
    <div class="right_side_descc"> 
       <h2>{{@$product->product_title}}</h2>
       
       
       <div class="rev_rett">
         <ul>
		 <?php 
		$product_review = floor(@$product->ave_review);
		for($i=1;$i<=5;$i++){
			if($i <= $product_review){
		?>
			 <li><img src="images/star_big1.png" alt=""></li>
		<?php
			}
			else
			{
			?>
				<li><img src="images/star_big2.png" alt=""></li>
			<?php
			}
		} ?>
           
         </ul>
         
          <span>({{number_format(@$product->total_review)}} Ratings & 4,129 Reviews)</span>
       </div>
       
       <h3><span>Rs.28,900</span> Rs.21,624 </h3>
       
       <p><span>Availability :</span> @if($product->product_in_stock == 1){{'In Stock'}}@else {{'Out of Stock'}}@endif</p>
       <p><span>Product Type :</span> {{@$product->parent_cat_name}}</p>
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
<p>{{@$product->product_description}}</p>

<h2 class="heading_style">Specifications</h2>

<ul class="">
	<?php
	$optionrray = array();
	foreach($select_value as $key=>$marray_val){
		$optionrray[$key] = $marray_val->option_detail_id;
	}
	?>
	@if(!$fetch_value->isEmpty())
		@foreach($fetch_value as $key=>$val)
			<li class="spe_infoo5">{{@$val->option_name}}</li>
			@foreach($val->option_value as $op_val)
				<li class="spe_infoo6">@if(in_array($op_val->option_detail_id ,@$optionrray)){{@$op_val->option_name}}@endif</li>
			@endforeach
			<div class="clearfix"></div>
		@endforeach
	@endif
	
    
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
				@if(!$review->isEmpty())
					@foreach($review as $rev)
					  <div class="revv_boxx">
						<h2>{{@$rev->review_title}}</h2>
						<ul>
						<?php 
						$revi = floor(@$rev->review_point);
						for($i=1;$i<=5;$i++){
							if($i <= $revi){
						?>
							<li><img src="images/star_new1.png" alt=""></li>
						<?php
							}
							else
							{
							?>
								<li><img src="images/star_new2.png" alt=""></li>
							<?php
							}
						} ?>
						 <span>({{$revi}})</span>
						</ul>
						<h6><img src="images/calendar.png" alt=""> {{date('d-m-Y',strtotime($rev->review_date))}}</h6>
						<h6><img src="images/userr.png" alt=""> By {{$rev->first_name}} {{$rev->last_name}}</h6>
						<p class="show">{{@$rev->review_desc}}</p>
					  </div>
					  @endforeach
			@endif
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
.body{padding:0; margin:0;}
.main_ctnt {
    border: 1px solid #000000;
    margin: 100px;
    padding: 15px;
    width: 650px;
}
.show {
    font:normal 15px arial;
    text-align: justify;
	padding: 15px 0 0 0;
}
.morectnt span {
display: none;
}
.showmoretxt {
    font: bold 15px tahoma;
    text-decoration: none;
}
</style>
<script>
$(function() {
var showTotalChar = 200, showChar = "View More >>", hideChar = "<< View Less";
$('.show').each(function() {
var content = $(this).text();
if (content.length > showTotalChar) {
var con = content.substr(0, showTotalChar);
var hcon = content.substr(showTotalChar, content.length - showTotalChar);
var txt= con +  '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
$(this).html(txt);
}
});
$(".showmoretxt").click(function() {
if ($(this).hasClass("sample")) {
$(this).removeClass("sample");
$(this).text(showChar);
} else {
$(this).addClass("sample");
$(this).text(hideChar);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
</script>
@endsection