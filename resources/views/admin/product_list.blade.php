@extends('admin.layout.app')
@section('title','Product List')
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
							<h4 class="pull-left page-title">Product List</h4>
							<!--<div class="submit-login pull-right">
								<a href="admin-add-delivery-staff"><button type="submit" class="btn btn-default tpp">Add Delivery User</button></a>
							</div>-->
							
						</div>
					</div>
					<div class="row">					
						<div class="col-md-12">
							@if(@session()->get('success'))
							<div class="alert alert-success ">
								{{session()->get('success')}}
							</div>
							@endif
							<div class="panel panel-default">
								<div class="panel-body table-rep-plugin">
									<div class="row">
										<form method="post" action="admin-product-list" id="search_frm">
											{{csrf_field()}}
											<div class="admin_search_area">
											<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Category</label>
													<select class="form-control newdrop" name="category" id="category">
														<option value="">All</option>
														@if($get_parent)
															@foreach($get_parent as $cat)
																<option value="{{@$cat->category_id}}" @if($cat->category_id == @$post_data['category']){{'selected'}}@endif>{{@$cat->cat_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Sub Category</label>
													<select class="form-control newdrop" name="sub_cat" id="sub_cat">
														<option value="">Sub Category</option>
														@if(@$sub_cat)
															@foreach($sub_cat as $cat)
																<option value="{{@$cat->category_id}}" @if($cat->category_id == @$post_data['sub_cat']){{'selected'}}@endif>{{@$cat->cat_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Status</label>
													<select class="form-control newdrop" name="status">
														<option value="">All</option>
														<option value="3" @if(@$post_data['status'] == 3){{'selected'}}@endif>Awating Approval</option>
														<option value="1" @if(@$post_data['status'] == 1){{'selected'}}@endif>Active</option>
														<option value="2" @if(@$post_data['status'] == 2){{'selected'}}@endif>Inactive</option>
													</select>
												</div>
											</div>
											</div>
											<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Keyword</label>
													<input class="form-control" id="exampleInputEmail1" type="text" name="keyword" value="{{@$post_data['keyword']}}">
												</div>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="add_btnm">
													<input value="Search" type="submit">
												</div>
											</div>
											</div>
											</div>
										</form>	
										 <div class="clearfix"></div>
										<form method="post" id="admin-multi-product-change-status" action="admin-multi-product-change-status">
												{{csrf_field()}}
											<div class="col-md-5 col-lg-5">
												<div class="add_btnm1">
													<button class="btn btn-primary btn-md" type="submit" name="action" value="Active">Active</button>
													<button  class="btn btn-primary btn-md" type="submit" name="action" value="Inactive">Inactive</button>
													<button  class="btn btn-primary btn-md" type="submit" name="action" value="Approve"> Approve</button>
													<span class="multi_status_change_admin">Please check any record to submit.</span>
												</div>
											</div>
											<div class="col-md-7 col-lg-7 allnk">
											<span class="legrn">Legend : </span>
											<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
											<i class="fa fa-times cncl" aria-hidden="true"> <span class="cncl_oopo">= Inactive</span></i>
											<i class="fa fa-eye cncl" aria-hidden="true"> <span class="cncl_oopo">= View</span></i>
											<i class="fa fa-check-circle cncl" aria-hidden="true" style="border-right: none;"> <span class="cncl_oopo">= Approve</span></i>
											</div> 
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive" data-pattern="priority-columns">
												<table id="datatable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th><input type="checkbox" id="myCheckbox"/></th>
															<th>Product Name</th>
															<th>Seller</th>
															<th>Category</th>
															<th>Sub Category</th>
															<th>Price</th>
															<th>Stock</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													@if(!$product->isEmpty())
														@foreach($product as $row)
															<tr>
															<td><input type="checkbox" name="product[]" value="{{@$row->product_id}}"/></td>
																<td>
																{{@$row->product_title}}
																</td>
																<td>
																<?php 
																$name = $row->fname.' '.$row->lname;
																?>
																{{@$name}}
																</td>
																<td>{{@$row->parent_cat_name}}
																</td>
																<td>
																{{@$row->sub_cat_name}}
																</td>
																<td>{{@$row->product_price}}</td>
																<td>
																@if(@$row->product_in_stock == 1)
																{{'In Stock'}}
																@else
																{{'Out of Stock'}}
																@endif
																</td>
																<td>@if($row->product_status == 0)Awating Approval
																@elseif($row->product_status == 1)Active
																@elseif($row->product_status == 2)Inactive
																@endif</td>
																<td>
																	@if($row->product_status == 1)
																	<a href="admin-product-status/{{$row->product_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times cncl1" aria-hidden="true"></i></a>
																	@elseif($row->product_status == 0)
																	<a href="admin-product-approve/{{$row->product_id}}" title="Click to approve"><i class="fa fa-check-circle delet" aria-hidden="true"></i></a>
																	@elseif($row->product_status == 2)
																	<a href="admin-product-status/{{$row->product_id}}" title="Click to active"><i class="fa fa-check delet" aria-hidden="true"></i></a>
																	@endif
																	<a href="admin-product-details/{{$row->product_id}}" title="View"><i class="fa fa-eye delet" aria-hidden="true"></i></a>
																</td>
															</tr>
															@endforeach
															</form>
															@else
																<tr><td colspan="8">Norhing found.</td></tr>
														@endif
													</tbody>
												</table>
											</div>
											{{$product->links()}}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End Row -->
				</div> <!-- container -->       
			</div> <!-- content -->
		</div>
	</div>
<script>
$(document).ready(function(){
	$('#category').change(function(){
			var cat = $('#category').val();
			//alert(cat);
			$.ajax({
				type:'get',
				url:'<?php echo url('/admin-get-subcat');?>',
				data:'_token = <?php echo csrf_token() ?>&category='+cat,
				success:function(data)
				{
					//alert(data);
					$('#sub_cat').html(data);
				}
			});
		});
});
</script>
<script>
$(document).ready(function(){
	$(".pagination a").click(function(){
			var url=$(this).attr('href');
			$("#search_frm").attr('action',url);
			$("#search_frm").submit();
			return false;
		});
});
</script>
<script>
		$(document).ready(function(){
			$('#myCheckbox').click(function() {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
			$('input:checkbox').click(function(){
				$('.multi_status_change_admin').hide();
			});
			$("#admin-multi-product-change-status").submit(function(){
				var status=false;;
				$.each($('input:checkbox'),function(event){
					if($(this).prop('checked')){
						status=$(this).prop('checked');
						return false;
					}
				});
				
				if(!status){$('.multi_status_change_admin').fadeIn('slow');return false;}
				else return true
			});
		});
		</script>
@endsection   