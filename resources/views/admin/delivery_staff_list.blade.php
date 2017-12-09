@extends('admin.layout.app')
@section('title','Delivery Staff')
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
							<h4 class="pull-left page-title">Delivery Staff List</h4>
							<div class="submit-login pull-right">
								<a href="admin-add-delivery-staff"><button type="submit" class="btn btn-default tpp">Add Delivery Staff</button></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								@if(@session()->get('success'))<div class="alert alert-success ">{{session()->get('success')}}</div>@endif
								<div class="panel-body table-rep-plugin">
									<div class="row">
										<form method="post" action="admin-delivery-staff-list">
											{{csrf_field()}}
											<div class="admin_search_area">
											<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Status</label>
													<select class="form-control newdrop" name="status">
														<option value="">All</option>
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
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="add_btnm">
													<input value="Search" type="submit">
												</div>
											</div>
											</div>
											</div>
										</form>
										<div class="clearfix"></div>
								<form method="post" id="admin-multi-delivery-staff-change-status" action="admin-multi-delivery-staff-change-status">
											{{csrf_field()}}
											<div class="col-md-5 col-lg-5">
												<div class="add_btnm1">
													<button class="btn btn-primary btn-md" type="submit" name="action" value="Active">Active</button>
													<button  class="btn btn-primary btn-md" type="submit" name="action" value="Inactive">Inactive</button>
													<span class="multi_status_change_admin">Please check any record to submit.</span>
												</div>
											</div>
											<div class="col-md-7 col-lg-7 allnk">
												<span class="legrn">Legend : </span>
												<i class="fa fa-pencil-square-o cncl" aria-hidden="true"> <span class="cncl_oopo">= Edit</span></i>
												<i class="fa fa-check cncl" aria-hidden="true"> <span class="cncl_oopo">= Active</span></i>
												<i class="fa fa-times cncl" aria-hidden="true"> <span class="cncl_oopo">= Inactive</span></i>
												<i class="fa fa-trash cncl" aria-hidden="true"> <span class="cncl_oopo">= Delete</span></i>
											</div> 
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="table-responsive" data-pattern="priority-columns">
													<table id="datatable" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th><input type="checkbox" id="myCheckbox"/></th>
																<th>Name</th>
																<th>Email</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
														@if(!$delivery->isEmpty())
															@foreach($delivery as $row)
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
																	<td>@if($row->user_status == 1)Active
																	@elseif($row->user_status == 2)Inactive
																	@endif</td>
																	<td>
																		<a href="admin-edit-delivery-staff/{{$row->user_id}}" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
																		@if($row->user_status == 1)
																		<a href="admin-staff-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times cncl1" aria-hidden="true"></i></a>
																		@elseif($row->user_status == 2)
																		<a href="admin-staff-status/{{$row->user_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check delet" aria-hidden="true"></i></a>
																		@endif
																		<a href="admin-staff-delete/{{$row->user_id}}" onclick="return confirm('Are you want to delete this delivery staff ?')" title="Delete"><i class="fa fa-trash delet	" aria-hidden="true"></i></a>
																	</td>
																</tr>
																@endforeach
																</form>
																@else
																	<tr><td colspan="5">Nothng found.</td></tr>
															@endif
														</tbody>
													</table>
												</div>
												{{$delivery->links()}}
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
		$("#admin-multi-delivery-staff-change-status").submit(function(){
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
<style>
	.multi_status_change_admin{
		font-size: 12px;
		color: #e02222;
		font-weight: 700;
		padding-left: 7px;
		font-family: serif;
		display:none;
	}
</style> 
@endsection
  