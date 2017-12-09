@extends('admin.layout.app')
@section('title','Product Details')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Product Details</h4>
								<div class="submit-login pull-right">
									@if($product->product_status == 1)
										<a href="admin-product-status/{{$product->product_id}}"><button type="submit" class="btn btn-default tpp">Inactive</button></a>
									@elseif($product->product_status == 0)
										<a href="admin-product-approve/{{$product->product_id}}"><button type="submit" class="btn btn-default tpp">Approve</button></a>
									@elseif($product->product_status == 2)
										<a href="admin-product-status/{{$product->product_id}}"><button type="submit" class="btn btn-default tpp">Active</button></a>
									@endif
									<a href="admin-product-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Product Information</p>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Product Name</strong>: {{@$product->product_title}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Category</strong>: {{@$product->parent_cat_name}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Sub Category</strong>: {{@$product->sub_cat_name}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Quantity</strong>: {{@$product->product_quentity}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Price</strong>: {{@$product->product_price}}</label>
												</div>
											</div>
											<?php
											$optionrray = array();
											foreach($select_value as $key=>$marray_val){
												$optionrray[$key] = $marray_val->option_detail_id;
											}
											?>
											@foreach($fetch_value as $key=>$val)
												<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
													<div class="your-mail">
													<label for="exampleInputEmail1"><strong>{{@$val->option_name}}</strong>: 
													@foreach($val->option_value as $op_val)
													@if(in_array($op_val->option_detail_id ,@$optionrray)){{@$op_val->option_name}}
													@endif
													@endforeach
													</label>
													</div>
												</div>
											@endforeach
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Store</strong>: @if($product->product_in_stock == 1){{'In Stock'}}@else{{'Out Of Stock'}}@endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Status</strong>: @if($product->product_status == 0){{'Awating Approval'}}@elseif($product->product_status == 1){{'Active'}}@elseif($product->product_status == 2){{'Inactive'}}@endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Youtube</strong>: {{@$product->product_youtube}}</label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Product Description</p>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Product Description</strong>: {{@$product->product_description}}</label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Product Offer Details</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Start Date</strong>: {{@$product->offer_start_date}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>End Date</strong>: {{@$product->offer_end_date}}</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>End Date</strong>: {{@$product->offer_price}}</label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Product Image</p>
												</div>
											</div>
											@if(@$product_image)
												@foreach($product_image as $image)
													<div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
														<div class="pro_img">
															<img src="{{url('storage/app/public/product_image/thumb/'.$image->product_image)}}"/>
														</div>
													</div>
												@endforeach
											@endif
										</div>
									</div>
								</div>
                            </div>
                        </div><!-- End Row -->
                    </div> <!-- container -->       
                </div> <!-- content -->
            </div>
        </div>
		<style>
		.pro_img {
			width: 150px;
			float: left;
			margin: 5px 5px;
			height: 190px;
			position: relative;
			-webkit-box-shadow: 2px 2px 3px 2px #E3E3E3;
			box-shadow: 2px 2px 3px 2px #E3E3E3;
			padding: 10px;
		}
		.pro_img img {
			max-width: 100%;
		}
		</style>
@endsection   