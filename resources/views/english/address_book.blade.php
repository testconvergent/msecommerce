@extends('english.layout.app')
@section('title','Address Book')
@section('body')
<div class="wrapper">
@include('english.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2 ccgn55">
						<?php 
							$get_user = fetch_user(session()->get('user_id'));
						?>
						<h2>Welcome, {{@$get_user->first_name}} {{@$get_user->last_name}}</h2>
						<!--<span class="line"></span>-->
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details address_book">
							<div class="allrt_edit">
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<h2 class="dash_head">Address Book</h2>
							<a class="add_addres" href="add-address"><i class="fa fa-plus" aria-hidden="true"></i> Add a New Address</a>
							<div class="below_dash">
								@if(count($bookedAddtitionalAddress))
									@foreach($bookedAddtitionalAddress as $val)
										<div class="{{$val['alterDesignClass']}}">
											<h4>{{$val['header']}}</h4>
											<span>
												<a href="javascript:void(0);"
												onclick="delete_address(<?php echo $val['uniqueTblId'];?>)">
												<img src="images/cross.png" onmouseover="this.src='images/cross_h.png'" onmouseout="this.src='images/cross.png'" alt="">
												</a>
											<a href="edit-address/{{$val['uniqueTblId']}}"><img src="images/edit.png" onmouseover="this.src='images/edit_h.png'" onmouseout="this.src='images/edit.png'" alt=""></a>
											</span>
											<div class="info_chart">
												<ul>
													<li>
														<span class="third">{{$val['name']}}</span>
													</li>
													<li>
														<span class="third">Address : {{$val['addressDetails']}}</span>
													</li>
													<li>
														<span class="third">Phone : {{$val['phone']}}</span>
													</li>
													<li>
													<span class="third">Email : {{$val['email']}}</span>
													</li>
												</ul>
											</div>
										</div>
									@endforeach
									@else
										<div class="no_rec">
										<p class="not_record">No address found.</p>
										</div>
								@endif
								</div>
							</div>
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
function delete_address(id)
{
	//alert(id);
	swal({   title: "Are you sure?",   
	text: "You want to delete this address!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Yes, Delete it!",   
	cancelButtonText: "No, cancel!",   
	closeOnConfirm: false,   
	closeOnCancel: true 
	}, 
	function(isConfirm)
	{   
		if (isConfirm)
		{
			window.location.assign("<?php echo url('/');?>/delete-address/"+id);	
		} 
		
	});
}
</script>
<script>
function validate(evt){
	var theEvent=evt || window.event;
	var key=theEvent.keyCode || theEvent.which;
	key=String.fromCharCode(key);
	var regex = /[0-9]||\./;
	if(!regex.test(key)){
		theEvent.returnValue=false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
</script>
@endsection