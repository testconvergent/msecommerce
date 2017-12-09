@if(!$cart_item->IsEmpty())
<div class="trip_table history_table">
<div class="">
	<div class="table">
		<div class="one_row1 hidden-sm hidden-xs">
			<!--<div class="cell1 tab_head_sheet cc_lolorr">Seller</div>-->
			<div class="cell1 tab_head_sheet cc_lolorr">Order Items ajax</div>
			<div class="cell1 tab_head_sheet cc_lolorr">&nbsp;</div>
			<div class="cell1 tab_head_sheet cc_lolorr">Qty</div>
			<div class="cell1 tab_head_sheet cc_lolorr">Unit Price</div>
			<div class="cell1 tab_head_sheet cc_lolorr">Total Price</div>
			<div class="cell1 tab_head_sheet cc_lolorr">&nbsp;</div>
		</div>
			@foreach($cart_item as $cart)
			<div class="one_row1 small_screen31 qp_colorr5">
				
				<div class="cell1 tab_head_sheet_1">
					<span class="W55_1">Order Items</span>
					<div class="tbl_sl_logo noo_mm"><img src="images/seler.jpg" alt=""></div>
				</div>
				
				<div class="cell1 tab_head_sheet_1">
					<p class="nn_clorr7"> {{@$cart->product_title}}</p>
					<p class="nn_clorr7">Sold by : <a href="#" class="adi">{{$cart->first_name}} {{$cart->last_name}}</a></p>
				</div>
				
				<div class="cell1 tab_head_sheet_1">
					<span class="W55_1">Qty</span>
					<span class="qutt44">
					<select name="qty" class="cart_qty" data-id="{{$cart->product_id}}">
						<?php for($i=1;$i<=$cart->product_quentity;$i++){?>
							<option value="{{$i}}" @if($i == $cart->qty){{'selected'}}@endif>{{$i}}</option>
						<?php } ?>
					</select>
					</span>
				</div>
				
				<div class="cell1 tab_head_sheet_1">
					<span class="W55_1">Unit Price</span>
					<p class="add_ttrr nn_clorr7">${{$cart->unit_price}}</p>
				</div>
				
				<div class="cell1 tab_head_sheet_1">
					<span class="W55_1">Total Price</span>
					<p class="add_ttrr nn_clorr7">${{$cart->total_price}}</p>
				</div>
			   
				<div class="cell1 tab_head_sheet_1">
					<span class="W55_1">&nbsp;</span>
					<a href="#"><img src="images/cross.png" alt=""></a>
				</div>
				
			</div>
			@endforeach
	</div>
                                            
                                            
	<div class="sp_tptall_area">
	  <!--<p>Sub Total : <span>$6000</span></p>
	   <p>Shipping : <span>$60</span></p>
	   <p>Total : <span>$6060</span></p>-->
	   
	   
	   
	   <div class="sp_tptall_area thss_ff fd_ddaaaa">
		 <p><span class="hh_wdww">Sub Total : </span> <span class="hh_wdww22">${{$cart_item{0}->cart_sub_total}}</span></p>
		 <p><span class="hh_wdww">Shipping :  </span> <span class="hh_wdww22">$0.00</span></p>
		 <p><span class="hh_wdww">Total :     </span> <span class="hh_wdww22">${{$cart_item{0}->cart_total}}</span></p>
	   </div>
	   
	   <div class="clearfix"></div>
	   
	   <form>
		<div class="cuponne_area">
			<input type="text" placeholder="Enter Promotional Code">
			<input type="submit" value="Apply">
		</div>
	   </form>
	   <div class="rightt_btn_twoo">
		 <input type="button" class="bb_c" value="Continue Shopping">
		 <input type="button" class="yy_c" value="Place Order">
	   </div>
	</div>
</div>
</div>
@endif