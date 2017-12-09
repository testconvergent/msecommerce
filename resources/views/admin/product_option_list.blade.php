@extends('admin.layout.app')
@section('title','Product Option List')
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
							<h4 class="pull-left page-title">Product Option List</h4>
							<div class="submit-login pull-right">
								<a href="admin-add-product-option"><button type="submit" class="btn btn-default tpp">Add Product Option</button></a>
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
										<form method="post" action="admin-product-option-list" id="search_frm">
											{{csrf_field()}}
											<div class="admin_search_area">
											<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Category</label>
													<select class="form-control newdrop required" name="category" id="category">
														<option value="">Select Category</option>
														@if(@$category)
															@foreach($category as $cat)
																<option value="{{$cat->category_id}}"@if($cat->category_id == @$post['category']){{'selected'}}@endif>{{$cat->cat_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="your-mail">
													<label for="exampleInputEmail1">Sub category</label>
													<select class="form-control newdrop required" name="sub_cat" id="sub_cat">
														<option value="">Sub Category</option>
														@if(@$sub_cat)
															@foreach($sub_cat as $cat)
																<option value="{{@$cat->category_id}}" @if($cat->category_id == @$post['sub_cat']){{'selected'}}@endif>{{@$cat->cat_name}}</option>
															@endforeach
														@endif	
													</select>
												</div>
											</div>
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<div class="add_btnm">
													<input value="Go" type="submit">
												</div>
											</div>
											</div>
											</div>
										</form>
										<div class="clearfix"></div>
										<div class="col-md-7 col-lg-7 allnk">
											<span class="legrn">Legend: </span>
											<i class="fa fa-pencil-square-o cncl" aria-hidden="true"> <span class="cncl_oopo">Edit</span></i>
											<i class="fa fa-plus cncl" aria-hidden="true"> <span class="cncl_oopo">Add Option Value</span></i>
											<i class="fa fa-trash cncl" aria-hidden="true"> <span class="cncl_oopo">Delete</span></i>
										</div> 
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="table-responsive" data-pattern="priority-columns">
												<table id="datatable" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>Category</th>
															<th>Sub Category</th>
															<th>Option Name</th>
															<th>Form Type</th>
															<th>Search</th>
															<th>Search Type</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														@if(@$option_list)
															@foreach($option_list as $row)
																<tr>
																	<td>		{{@$row->cat_name}}</td>
																	<td>		{{@$row->sub_cat_name}}</td>
																	<td>		{{@$row->option_name}}</td>
																	<td>
																	@if($row->option_type_product_form == 1)
																	{{'Single Select'}}
																	@elseif($row->option_type_product_form == 2)
																	{{'Multi Select'}}
																	@elseif($row->option_type_product_form == 3)
																	{{'Single check Box'}}
																	@endif
																	</td>
																	<td>
																	@if($row->show_in_search == 0)
																	{{'No'}}
																	@elseif($row->show_in_search == 1)
																	{{'Yes'}}
																	@endif
																	</td>
																	<td>
																	@if($row->option_type_search_form == 1)
																	{{'Single Select'}}
																	@elseif($row->option_type_search_form == 2)
																	{{'Multi Select'}}
																	@else
																	{{'No'}}
																	@endif
																	</td>
																	<td>
																		<a href="admin-edit-product-option/{{$row->option_master_id}}" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
																		<a href="admin-product-option-delete/{{$row->option_master_id}}" onclick="return confirm('Are you want to delete this product option ?')" title="Delete"><i class="fa fa-trash delet" aria-hidden="true"></i></a>
																		<a href="javascript:void(0);" title="Add Option Value" data-toggle="modal" data-target="#myModal" class="add_value" data-id="{{@$row->option_master_id}}"><i class="fa fa-plus delet" aria-hidden="true"></i></a>
																	</td>
																</tr>
															@endforeach
															@else
																<tr><td colspan="7">Nothing found.</td></tr>
														@endif
													</tbody>
												</table>
											</div>
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
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Product Option Name</h4>
                    <span class="modal-title modal-title_2 option_title"></span>
				</div>
				<form class="add_otp_form">
				{{csrf_field()}}
					<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
					<input type="hidden" name="option_id" value="" class="opt">
					<div class="modal-body">
						<div class="clearfix"></div>
						<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
							<div class="engl">
								<img src="{{url('storage/app/public/language_image/'.@$language[0]->language_flag)}}"/>
								{{@$language[0]->language_name}} <span>(Option Value)</span>
                                
							</div>
							<div class="clearfix"></div>
							<div class="your-mail">
								<input type="text" class="form-control required option_value_e" name ="option_value_e" placeholder="">
								<label id="option_value1" class="error"></label>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
							<div class="engl">
								<img src="{{url('storage/app/public/language_image/'.@$language[1]->language_flag)}}"/>
								{{@$language[1]->language_name}} <span>(Option Value)</span>
							</div>
							<div class="clearfix"></div>
							<div class="your-mail">
								<input type="text" class="form-control required option_value_a" name ="option_value_a" placeholder="">
								<label id="option_value2" class="error"></label>
							</div>
						</div>
					</div>
                    <div class="col-md-12">
						<div class="alert alert-success message1" style="display:none;"></div>
                    </div>
					<div class="clearfix"></div>
					<div class="modal-footer">
						<div class="add_btnm">
							<input value="Add" type="button" class="add_option_value"/>
						</div>
					</div>
				</form>
				<form class="edit_otp_form" style="display:none;">
				{{csrf_field()}}
					<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
					<input type="hidden" name="option_id" value="" class="opt">
					<div class="modal-body">
						<div class="clearfix"></div>
						<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
							<div class="engl">
								<img src="{{url('storage/app/public/language_image/'.@$language[0]->language_flag)}}"/>
								{{@$language[0]->language_name}} <span>(Option Value)</span>
							</div>
							<div class="clearfix"></div>
							<div class="your-mail">
								<input type="text" class="form-control required valuea option_value_e1" name ="option_value_e" placeholder="" value="">
								<label id="option_value1" class="error"></label>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
							<div class="engl">
								<img src="{{url('storage/app/public/language_image/'.@$language[1]->language_flag)}}"/>
								{{@$language[1]->language_name}} <span>(Option Value)</span>
							</div>
							<div class="clearfix"></div>
							<div class="your-mail">
								<input type="text" class="form-control required valuee option_value_a1" name ="option_value_a" placeholder="" value="">
								<label id="option_value2" class="error"></label>
							</div>
						</div>
					</div>
                    <div class="col-md-12">
						<div class="alert alert-success message1" style="display:none;"></div>
                    </div>
					<div class="clearfix"></div>
					<div class="modal-footer">
						<div class="add_btnm">
							<input value="Update" type="button" class="edit_option_value"/>
						</div>
					</div>
				</form>
				<p>
					<!--<tt id="results"></tt>-->
                	<a class="ad0_value add_value" href="javascript:void(0);">Add Option Value +</a>
                </p>
				<div class="table_op"></div>
			</div>
		</div>
	</div>
	<style>
	.modal-content {
	top: 150px;
	}
	.fileht{
	height:auto !important;
	}
	.modal-footer {
	border:none !important;
	}
	button.close {
	top: -2px !important;
	right: -5px !important;
	}
	.upldpic{
	width:120px;
	height:60px;
	}
	.upldpic img{
	max-width:100%;
	}
	.modal .modal-dialog .modal-content{
		padding:15px !important;
		}
	.modal-dialog{
		margin: 0px auto;
		}
	.modal-title {
	margin: 0;
	line-height: 1.42857143;
	width: auto;
	float: left;
}		
.modal-title_2{
	width: auto;
	float:right;
	color: #505458;
	font-family: 'Roboto', sans-serif;
	font-size:18px;
	}
	.modal-header{
		padding-bottom:5px !important;
		}
	.engl span{
		font-size:13px;
		color:#656363;
		font-weight:400;
		}	
	.add_btnm input[type="button"]{
		margin-top:0px;
		margin-bottom:0px !important;
		padding:5px 10px !important;
		}
	.message1{
		padding:5px !important;
		margin-bottom:0px !important;
		}	
	.modal-footer{
		padding:0px !important;
		}	
	.ad0_value{ margin:15px 0 0 0;}	
	.your-mail input[type="text"]{margin-bottom:0px !important;}		
	</style> 
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
		
	$('.add_otp_form').validate();
	$('.edit_otp_form').validate();
	$(".pagination a").click(function(){
		var url=$(this).attr('href');
		$("#search_frm").attr('action',url);
		$("#search_frm").submit();
		return false;
	});
	$('.add_value').click(function(){
		$('.message1').hide();
		var id = $(this).data('id');
		//alert(id);
		$('.opt').val(id);
		$('.ad0_value').attr('data-id',id);
		$('.add_otp_form').show();
		$('.edit_otp_form').hide();
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			method:"POST",
			url:"<?php echo url('fetch-option-value')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				option_id:id
			},
			success:function(result)
			{
				//alert(result.opt_name);
				$('.table_op').html(result.table);
				$('.option_title').html(result.opt_name);
			}
			,
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
	$('.add_option_value').click(function(){
		$('.message1').hide();
		if($('.option_value_e').val() == "")
		{
			$('#option_value1').html('This field is required');
			return false;
		}
		else if($('.option_value_a').val() == "")
		{
			$('#option_value2').html('This field is required');
			return false;
		}
		else
		{
			//return true;
			var str = $(".add_otp_form").serialize();
			//$( "#results" ).text( str );
			$.ajax({
				method:"POST",
				url:"<?php echo url('admin-product-option-value')?>",
				dataType: 'JSON',
				data:str
				,
				success:function(result)
				{
					//alert(result.table);
					//alert(result.success);
					$('.option_value_e').val('');
					$('.option_value_a').val('');
					$('.message1').show();
					$('.table_op').html(result.table);
					$('.message1').html(result.success);
				}
				,
				error:function(error){
					console.log(error.responseText);
				} 
			});
		}
	});
	$('.edit_option_value').click(function(){//alert();
		$('.message1').html('');
		if($('.option_value_e1').val() == "")
		{
			$('#option_value1').html('This field is required');
			return false;
		}
		else if($('.option_value_a1').val() == "")
		{
			$('#option_value2').html('This field is required');
			return false;
		}
		else
		{
			//return true;
			var str = $(".edit_otp_form").serialize();
			$( "#results" ).text( str );
			$.ajax({
				method:"POST",
				url:"<?php echo url('admin-product-option-value-update')?>",
				dataType: 'JSON',
				data:str
				,
				success:function(result)
				{
					//alert(result.table);
					//alert(result.success);
					$('.message1').show();
					$('.table_op').html(result.table);
					$('.message1').html(result.success);
				}
				,
				error:function(error){
					console.log(error.responseText);
				} 
			});
		}
	});
	$('body').on('click','.edit_val',function(){//alert();
	$('.message1').hide();
		var id = $(this).data('id');
		//alert(id);
		$('.add_otp_form').hide();
		$('.edit_otp_form').show();
		$('.opt').val(id);
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			method:"POST",
			url:"<?php echo url('admin-product-option-edit')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				option_id:id
			},
			success:function(result)
			{
				//alert(result.value_en);
				//alert(result.value_ar);
				$('.valuea').val(result.value_en);
				$('.valuee').val(result.value_ar);
			}
			,
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
	$('body').on('click','.delete_val',function(){//alert();
		$('.message1').html('');
		var id = $(this).data('id');
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			method:"POST",
			url:"<?php echo url('admin-product-option-delete')?>",
			dataType: 'JSON',
			data:{
				_token:token,
				option_id:id
			},
			success:function(result)
			{
				//alert(result.value_en);
				alert(result.option_val_id);
				$('.add_otp_form').show();
				$('.edit_otp_form').hide();
				$('.opt').val(result.option_val_id);
				$('.message1').show();
				$('.table_op').html(result.table);
				$('.message1').html(result.success);
			}
			,
			error:function(error){
				console.log(error.responseText);
			} 
		});
	});
});
</script>
@endsection   