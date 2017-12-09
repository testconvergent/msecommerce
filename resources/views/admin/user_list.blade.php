@extends('admin.layout.app')
@section('title','User')
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
                                <h4 class="pull-left page-title">User List</h4>
								<!--<div class="submit-login pull-right">
									<a href="admin-add-delivery-staff"><button type="submit" class="btn btn-default tpp">Add Delivery User</button></a>
								</div>-->
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
									@if(@session()->get('success'))<div class="alert alert-success ">{{session()->get('success')}}</div>@endif
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<form method="post" action="admin-user-list">
												{{csrf_field()}}
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">User Type</label>
														<select class="form-control newdrop" name="user_type">
															<option value="">Choose</option>
															<option value="2" @if(@$post_data['user_type'] == 2){{'selected'}}@endif>Seller</option>
															<option value="3" @if(@$post_data['user_type'] == 3){{'selected'}}@endif>Buyer</option>
														</select>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="your-mail">
														<label for="exampleInputEmail1">Status</label>
														<select class="form-control newdrop" name="status">
															<option value="">Choose</option>
															<option value="1" @if(@$post_data['status'] == 1){{'selected'}}@endif>Active</option>
															<option value="2" @if(@$post_data['status'] == 2){{'selected'}}@endif>Inactive</option>
														</select>
													</div>
												</div>
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
											</form>
                                            <div class="clearfix"></div>
											<div class="col-md-12 dess5">
												<i class="fa fa-eye cncl" aria-hidden="true"> <span class="cncl_oopo">View</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true"> <span class="cncl_oopo">Inactive</span></i>
												<i class="fa fa-trash cncl" aria-hidden="true"> <span class="cncl_oopo">Delete</span></i>
											</div> 
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Name</th>
																<th>Email</th>
																<th>User Type</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(!$user->isEmpty())
															@foreach($user as $row)
																<tr>
																	<td>
																	<?php 
																	$name = $row->first_name.' '.$row->last_name;
																	?>
																	{{@$name}}
																	</td>
																	<td>
																	{{@$row->email}}
																	</td>
																	<td>@if($row->user_type == 2)Seller
																	@elseif($row->user_type == 3)Buyer
																	@endif</td>
																	<td>@if($row->user_status == 0)Email Not Verified
																	@elseif($row->user_status == 1)Active
																	@elseif($row->user_status == 2)Inactive
																	@endif</td>
																	<td>
																		<a href="admin-user-details/{{$row->user_id}}" title="View"> <i class="fa fa-eye delet" aria-hidden="true"></i></a>
																		@if($row->user_status == 0)
																		<a href="admin-user-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check cncl1" aria-hidden="true"></i></a>
																		@elseif($row->user_status == 1)
																		<a href="admin-user-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times delet" aria-hidden="true"></i></a>
																		@elseif($row->user_status == 2)
																		<a href="admin-user-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check delet" aria-hidden="true"></i></a>
																		@endif
																		<a href="admin-user-delete/{{$row->user_id}}" onclick="return confirm('Are you want to delete this user ?')" title="Delete"><i class="fa fa-trash delet	" aria-hidden="true"></i></a>
																	</td>
																</tr>
																@endforeach
																@else
																	<tr><td colspan="5">No Record Found</td></tr>
															@endif
														</tbody>
													</table>
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
@endsection   