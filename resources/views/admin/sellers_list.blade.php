@extends('admin.layout.app')
@section('title','Sellers')
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
                                <h4 class="pull-left page-title">Sellers List</h4>
								<!--<div class="submit-login pull-right">
									<a href="admin-add-delivery-staff"><button type="submit" class="btn btn-default tpp">Add Delivery User</button></a>
								</div>-->
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))
										<div class="alert alert-success ">
										{{session()->get('success')}}
										</div>
									@endif
									@if(@session()->get('info'))
										<div class="alert alert-info ">
										{{session()->get('info')}}
										</div>
									@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<form method="post" action="admin-sellers-list">
												{{csrf_field()}}
												<div class="admin_search_area">
												<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Status</label>
														<select class="form-control newdrop" name="status">
															<option value="">All</option>
															<option value="5" @if(@$post_data['status'] == 5){{'selected'}}@endif>Awating Approval</option>
															<option value="1" @if(@$post_data['status'] == 1){{'selected'}}@endif>Active</option>
															<option value="2" @if(@$post_data['status'] == 2){{'selected'}}@endif>Inactive</option>
														</select>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
											<form method="post" id="admin-change-multi-seller-status" action="admin-change-multi-seller-status">
												{{csrf_field()}}
											<div class="col-md-3 col-lg-3">
												<div class="add_btnm1">
												<button class="btn btn-primary btn-md" value="Active" type="submit" name="action">Active</button>
												<button class="btn btn-primary btn-md" value="Inactive" type="submit" name="action">Inactive</button>
												<button class="btn btn-primary btn-md" value="Approve" type="submit" name="action">Approve</button>
												<span class="multi_status_change_admin">Please check any record to submit.</span>
												</div>
											</div>
											<div class="col-md-9 col-lg-9 allnk">
												<span class="legrn">Legend : </span>
												<i class="fa fa-eye cncl" aria-hidden="true"> <span class="cncl_oopo">= View</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true"> <span class="cncl_oopo">= Inactive</span></i>
												<i class="fa fa-trash cncl" aria-hidden="true"> <span class="cncl_oopo">= Delete</span></i>
												<i class="fa fa-shopping-bag cncl" aria-hidden="true"> <span class="cncl_oopo">= Product</span></i>
												<i class="fa fa-check-circle cncl" aria-hidden="true"> <span class="cncl_oopo">= Approve</span></i>
											</div> 
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>
																<input type="checkbox" id="myCheckbox"/> <!-- Checked -->
																</th>
																<th>Name</th>
																<th>Email</th>
																<!--<th>User Type</th>-->
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(!$user->isEmpty())
															@foreach($user as $row)
																<tr>
																	<td><input type="checkbox" name="user[]" value="{{@$row->user_id}}"/></td>
																	<td>
																	<?php 
																	$name = $row->first_name.' '.$row->last_name;
																	?>
																	{{@$name}}
																	</td>
																	<td>
																	{{@$row->email}}
																	</td>
																	<!--<td>@if($row->user_type == 2)Seller
																	@elseif($row->user_type == 3)Buyer
																	@endif</td>-->
																	<td>@if($row->user_status == 0 && $row->is_email_verified==1)Waiting for admin aproval
																	@elseif($row->is_email_verified==0)Email Not Verified
																	@elseif($row->user_status == 1)Active
																	@elseif($row->user_status == 2)Inactive
																	@endif</td>
																	<td>
																		<a href="admin-seller-details/{{$row->user_id}}" title="View"> <i class="fa fa-eye delet" aria-hidden="true"></i></a>
																		@if($row->user_status == 0 && $row->is_email_verified==1 )
																		<a href="admin-seller-approve/{{$row->user_id}}" title="Click to approve"> <i class="fa fa-check-circle cncl1" aria-hidden="true"></i></a>
																		@elseif($row->user_status == 1)
																		<a href="admin-seller-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times delet" aria-hidden="true"></i></a>
																		@elseif($row->user_status == 2)
																		<a href="admin-seller-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check delet" aria-hidden="true"></i></a>
																		@endif
																		@if($row->is_email_verified==0)
																		<a href="admin-seller-delete/{{$row->user_id}}" onclick="return confirm('Are you want to delete this user ?')" title="Delete"><i class="fa fa-trash delet	" aria-hidden="true"></i></a>
																		@elseif($row->is_email_verified==1 &&   $row->is_email_verified==1 )
																		
																		<a href="admin-seller-products/{{$row->user_id}}" title="Products"><i class="fa fa-shopping-bag delet	" aria-hidden="true"></i></a>
																		@endif
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="6">Nothing found. </td></tr>
															@endif
														</tbody>
													</table>
													</form>
												</div>
												{{$user->links()}}
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
			$('#myCheckbox').click(function() {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
			$('input:checkbox').click(function(){
				$('.multi_status_change_admin').hide();
			});
			$("#admin-change-multi-seller-status").submit(function(){
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