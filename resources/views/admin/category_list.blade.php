@extends('admin.layout.app')
@section('title','Category')
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
							<h4 class="pull-left page-title">Category List</h4>
							<div class="submit-login pull-right">
								<a href="admin-add-category"><button type="submit" class="btn btn-default tpp">Add Category</button></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								@if(@session()->get('success'))<div class="alert alert-success">{{session()->get('success')}}</div>@endif
								@if(@session()->get('error'))<div class="alert alert-danger">{{session()->get('error')}}</div>@endif
								<div class="panel-body table-rep-plugin">
									<div class="row">
										<form method="post" action="admin-category-list" id="search_frm">
											{{csrf_field()}}
											<div class="admin_search_area">
											<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">category</label>
													<select class="form-control newdrop" name="category">
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
													<label for="exampleInputEmail1">Status</label>
													<select class="form-control newdrop" name="status">
														<option value="">All</option>
														<option value="1" @if(@$post_data['status'] == 1){{'selected'}}@endif>Active</option>
														<option value="4" @if(@$post_data['status'] == 4){{'selected'}}@endif>Inactive</option>
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
											</div>
											</div>
										</form>
										<div class="clearfix"></div>
										<div class="clearfix"></div>
										<form id="admin-multi-category-change-status" method="post" action="admin-multi-category-change-status">
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
														<tr><th>
																<input type="checkbox" id="myCheckbox"/> <!-- Checked -->
																</th>
															<th>Category</th>
															<th>Parent</th>
															<th>Parent Display Order</th>
															<th>Display Order</th>
															<th>Icon</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>										
													@if(!$category->isEmpty())
														@foreach($category as $row)
															<tr>
															 <td>
															 <input type="checkbox" name="category[]" value="{{@$row->category_master_id}}"/>
															 </td>				
																<td>
																{{@$row->category_name}}
																</td>
																<td>
																@if(@$row->parent_id == 0)
																{{'N|A'}}
																@else
																	@foreach($get_parent as $cat)
																		@if(@$cat->category_id == @$row->parent_id)
																		{{@$cat->cat_name}}
																		@endif
																	@endforeach
																@endif
																</td>
																<td>
																@if(@$row->parent_id == 0)
																	{{@$row->display_order}}
																@else
																{{'N|A'}}
																@endif
																</td>
																<td>
																@if(@$row->parent_id != 0)
																	{{@$row->display_order}}
																@else
																{{'N|A'}}
																@endif						
																</td>
																<td>
																@if(@$row->category_icon)
																<div class="">
																<img src="{{url('storage/app/public/category_image/'.@$row->category_icon)}}"/>
																</div>
																@endif
																</td>
																<td>@if($row->category_status == 1)Active
																@elseif($row->category_status == 0)Inactive
																@endif</td>
																<td>
																	<a href="admin-edit-category/{{$row->category_master_id}}" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
																	@if($row->category_status == 1)
																	<a href="admin-category-status/{{$row->category_master_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to inactive"> <i class="fa fa-times cncl1" aria-hidden="true"></i></a>
																	@elseif($row->category_status == 0)
																	<a href="admin-category-status/{{$row->category_master_id}}" onclick="return confirm('Are you sure to change status ?')" title="Click to active"> <i class="fa fa-check delet" aria-hidden="true"></i></a>
																	@endif
																	<a href="admin-category-delete/{{$row->category_master_id}}" onclick="return confirm('Are you want to delete this category ?')" title="Delete"><i class="fa fa-trash delet	" aria-hidden="true"></i></a>
																</td>
															</tr>
															@endforeach
															</form>
															@else
																<tr><td colspan="5">Nothing found.</td></tr>
														@endif
													</tbody>
												</table>
											</div>
											{{$category->links()}}
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
			$("#admin-multi-category-change-status").submit(function(){
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
