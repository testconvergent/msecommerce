@extends('english.layout.app')
@section('title','My Products')
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
                            	<h2 class="dash_head">My Products</h2>
								@if(@$get_user->user_status != 0)
								<div class="clearfix"></div>
								<div class="allrt_edit">
									@if(@session()->get('success'))
									<div class=" alert alert-success fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
									<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
								</div>
                                <div class="wish_listt pro_my">
                                    <div class="trip_table pro_table">
                                    	<div class="">
                                        	<div class="table">
                                            	<div class="one_row1 hidden-xs hidden-sm">
                                                    <div class="cell1 tab_head_sheet">Item Name</div>
                                                    <div class="cell1 tab_head_sheet" style="padding-left:9px;">Qty</div>
                                                    <div class="cell1 tab_head_sheet">Category</div>
                                                    <div class="cell1 tab_head_sheet" style="padding-left:9px;">Status</div>
                                                    <div class="cell1 tab_head_sheet">&nbsp; &nbsp; &nbsp;</div>
                                                </div>
												@if(@$product)
													@foreach($product as $my_product)
														<div class="one_row1 small_screen31 small_1">
															<div class="cell1 tab_head_sheet_1">
																<span class="W55_1">Item Name</span>
																<div class="item_img">
																@if(@$my_product->product_image)
																<img style="width: 55px;height:55px;" src="{{url('storage/app/public/product_image/thumb/'.$my_product->product_image)}}" alt="">
																@else
																	
																@endif
																</div>
																<p class="add_ttrr">{{@$my_product->product_title}}</p>
															</div>
															<div class="cell1 tab_head_sheet_1">
																<span class="W55_1">Qty</span>
																<p class="add_ttrr">{{@$my_product->product_quentity}}</p>
															</div>
															<div class="cell1 tab_head_sheet_1">
																<span class="W55_1">Category</span>
																<p class="add_ttrr">{{@$my_product->parent_cat_name}} > {{@$my_product->sub_cat_name}}</p>
															</div>
															<div class="cell1 tab_head_sheet_1">
																<span class="W55_1">Status</span>
																<p class="add_ttrr">
																	@if($my_product->product_status == 0)
																		{{'Awating Approval'}}@endif
																	@if($my_product->product_status == 1)
																		{{'Active'}}@endif
																	@if($my_product->product_status == 2)
																		{{'Inactive'}}@endif
																</p>
															</div>
															<div class="cell1 tab_head_sheet_1">
																<span class="W55_1">&nbsp;</span>
																<a href="edit-product/{{$my_product->product_slug}}"><img src="images/edit_icon.png" alt=""></a>
																@if($my_product->product_status == 1)
																<a href="javascript:void(0);" onclick="product_status(<?php echo $my_product->product_id;?>)"><img src="images/none_icon.png" alt="" title="Click to Inactive"></a>
																@elseif($my_product->product_status == 2)
																<a href="javascript:void(0);" onclick="product_status(<?php echo $my_product->product_id;?>)"><img src="images/tick.png" alt=""title="Click to active"></a>
																@endif
															</div>
														</div>
													@endforeach
													<div class="pagination_area">
													{{$product->links()}}
													</div>
												@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
								@else
								<div class="clearfix" style="margin-top: 66px;"></div>
								<p class="not_approve">You are not a approve seller. When site admin approve your account then you get a notification shortly and get access everything.</p>
								@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
@include('english.layout.footer')
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script>  
	function product_status(id)
	{
		//alert(id);
		swal({   title: "Are you sure?",   
		text: "You want to status for this product?",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, Change it!",   
		cancelButtonText: "No, cancel!",   
		closeOnConfirm: false,   
		closeOnCancel: true 
		}, 
		function(isConfirm)
		{   
			if (isConfirm)
			{
				window.location.assign("<?php echo url('/');?>/product-status/"+id);	
			} 
			
		});
	}
</script>
@endsection