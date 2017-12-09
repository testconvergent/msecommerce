@extends('english.layout.app')
@section('title','Seller Store')
@section('body')
<div class="wrapper">
@include('english.layout.header')
	<section class="body_section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner_head inner_head_2 ccgn55">
						<?php 
							$get_user = company_name(session()->get('user_id'));
							//echo "<pre>";print_r($get_user);die;
						?>
						<h2>Welcome, {{@$get_user->company_name}}</h2>
						<!--<span class="line"></span>-->
					</div>
				</div>
				<div class="col-md-12">
					<div class="dash_board">
						@include('english.layout.menu')
						<div class="board_details">
							@if(Request::segment(1) == 'seller-store-edit' && Request::segment(2) != '')
								<h2 class="dash_head">Edit branch location</h2>
							@else
								<h2 class="dash_head">Branch locations</h2>		
								<a class="add_addres" href="add-address"><i class="fa fa-plus" aria-hidden="true"></i> Add a new branch location</a>
							@endif			
							<div class="clearfix"></div>
							<div class="allrt_edit">
								@if(@session()->get('success'))
								<div class=" alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<i class="fa fa-check" aria-hidden="true"></i>{{session()->get('success')}}</div>@endif
							</div>
							<div class="add_edit_options">
								<div class="graw_address">
									<?php if(Request::segment(1) == 'seller-store-edit' && Request::segment(1) != ''){?>
									<form id="seller_store" action="seller-store-edit/{{$fetch_store->store_id}}" method="post">
									<?php 
									} 
									else
									{
									?>
									<form id="seller_store" action="seller-store" method="post">
									<?php
									}
									?>
										{{csrf_field()}}
										<div class="details_box">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="name_label">Branch Location</label>
														<input class="from_type" placeholder="Type your branch location" type="text" name="branch_location" value="{{@$fetch_store->branch_location}}">
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="name_label">Store Phone</label>
														<input class="from_type" placeholder="Type your Store Phone" type="text" name="store_phone" value="{{@$fetch_store->store_phone}}">
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label class="name_label">Store Mail</label>
														<input class="from_type" placeholder="Type your Store Mail" type="email" name="store_mail" value="{{@$fetch_store->store_mail}}">
													</div>
												</div>
											</div>
											<div class="address_map_box">
												<div class="row">
													<div class="col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label class="name_label">Type your address and view it on the map<span>*</span></label>
															<input id="latitude" name="latitude" type="hidden" size="50" value="{{@$fetch_store->latitude}}">
															<input id="longitude" name="longitude" type="hidden" size="50" value="{{@$fetch_store->longitude}}">
															<input id="searchTextField" class="from_type required" placeholder="Type your address" type="text" name="store_address" value="@if(@$fetch_store->store_address){{@$fetch_store->store_address}}@else{{'Mubarak Al Kabeer St, Kuwait City, Kuwait'}}@endif">
														</div>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-12">
													<label class="errorLatLng" >Click on map to get the coordinates.
													   </label>
													   <label class="name_label">
													   <b>Latitude : </b><span class="latitude"></span></label>
													   <label class="name_label">
													   <b> Longitude : </b><span class="longitude"></span>
													   </label>
													</div>
												</div>
												<div class="row">						
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div id="mapCanvas"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Area <span>*</span></label>
												<input class="from_type required" placeholder="Type your area" type="text" name="area" value="{{@$fetch_store->area}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Block <span>*</span></label>
												<input class="from_type required" placeholder="Type your block" type="text" name="block" value="{{@$fetch_store->block}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Street <span>*</span></label>
												<input class="from_type required" placeholder="Type your street" type="text" name="street" value="{{@$fetch_store->street}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Avenue</label>
												<input class="from_type" placeholder="Type your avenue" type="text" name="avenue" value="{{@$fetch_store->avenue}}">
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">House/Building <span>*</span></label>
												<input class="from_type required" placeholder="Type your house/building" type="text" name="house_building" value="{{@$fetch_store->house_building}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Floor</label>
												<input class="from_type" placeholder="Type your floor" type="text" name="floor_no" value="{{@$fetch_store->floor_no}}">
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Apartment</label>
												<input class="from_type" placeholder="Type your apartment" type="text" name="apperment" value="{{@$fetch_store->apperment}}">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Pasi Number <span class="llgth556">(12 digits)</span></label>
												<input class="from_type" placeholder="Type your pasi number" type="text" name="pasi_no" value="{{@$fetch_store->pasi_no}}">
											</div>
										</div> 
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Post Code</label>
												<input class="from_type" placeholder="Type your Post code" type="text" name="post_code" value="{{@$fetch_store->post_code}}">
											</div>
										</div>   
								</div>
								<div class="details_box details_box_2">
									<div class="row">
										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<input class="sub_btn" type="submit" value="Save">
												<input class="sub_btn cancel_btn" type="reset" value="Cancel">
											</div>
										</div>
									</div>
								</div>
								</form>
							</div>
                            <!--address_book-->
                            <div class="address_book">
                                <div class="below_dash">
									@if(!$store->isEmpty())
										@foreach($store as $row)
											<div class="info_box">
												<h4>Location 1</h4>
												<span>
												<a href="javascript:void(0);" onclick="delete_store(<?php echo $row->store_id;?>)">
												<img src="images/cross.png" onmouseover="this.src='images/cross_h.png'" onmouseout="this.src='images/cross.png'" alt="">
												</a>
												<a href="seller-store-edit/{{$row->store_id}}">
												<img src="images/edit.png" onmouseover="this.src='images/edit_h.png'" onmouseout="this.src='images/edit.png'" alt="">
												</a>
												</span>
												<div class="info_chart">
													<ul>
														<li>
															<span class="third">John Heard</span>
														</li>
														<li>
															<span class="third">Address : {{@$row->store_address}}</span>
														</li>
														<li>
															<span class="third">Phone :  {{@$row->store_phone}}</span>
														</li>
														<li>
															<span class="third">Email : {{@$row->store_mail}}</span>
														</li>
													</ul>
												</div>
											</div>
										@endforeach
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
$(document).ready(function(){
	$('#seller_store').validate();
	$('#seller_store').submit(function(){
		 var lng=document.getElementById('longitude').value;
         var lat=document.getElementById('latitude').value;
		 if(lng!='' && lat!='' )return true;
		$('.errorLatLng').css('color','red')
		$("html, body").animate({ scrollTop: $('.errorLatLng').height() }, "slow");
		return false;
	});
});
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
<script>  
function delete_store(id)
{
	//alert(id);
	swal({   title: "Are you sure?",   
	text: "You want to delete this store address!",   
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
			window.location.assign("<?php echo url('/');?>/delete-store/"+id);	
		} 
		
	});
}
	</script>
<script>
var geocoder = new google.maps.Geocoder();
function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {		
        if (responses && responses.length > 0) {
            updateMarkerAddress(responses[0].formatted_address);
        } else {
            updateMarkerAddress('Keine Koordinaten gefunden!');
        }
    });
}
function updateMarkerPosition(latLng) {   
}
function removePreviousMarker(map){
				 marker.setMap(map);
				}
function updateMarkerAddress(str) {
    document.getElementById('searchTextField').value = str;
}
var marker;
var input;
var latLng;
function initialize(lat,lng,markerTitle){
    latLng = new google.maps.LatLng(lat,lng);
    var map = new google.maps.Map(document.getElementById('mapCanvas'), {
        zoom: 10,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: false,
        mapTypeControl: false

    });
     marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: true,
        title: markerTitle
    });
     input = document.getElementById('searchTextField');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    // Update current position info.
    updateMarkerPosition(latLng);
    //geocodePosition(latLng);

    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragstart', function() {
        updateMarkerAddress('Dragging...');
    });

    google.maps.event.addListener(marker, 'drag', function() {
        updateMarkerPosition(marker.getPosition());
    });
	google.maps.event.addListener(map, 'click', function(event) {				   
		geocodePosition(event.latLng);	
		updateMarkerPosition(event.latLng);
		$('.latitude').text(event.latLng.lat());
        $('.longitude').text(event.latLng.lng());
		removePreviousMarker(null);
		latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
		marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    draggable: true,
                    title:input.value
                });	
		document.getElementById('longitude').value = event.latLng.lng();
        document.getElementById('latitude').value = event.latLng.lat(); 
        $('.errorLatLng').css('visibility','hidden');		 
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        //input.className = '';
		document.getElementById('longitude').value = '';
        document.getElementById('latitude').value = '';      
		$('.latitude').text('');
		$('.longitude').text('');
		$('.errorLatLng').css('visibility','visible').css('color','black');
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // Inform the user that the place was not found and return.
            input.className = 'notfound';
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        updateMarkerPosition(marker.getPosition());
        //geocodePosition(marker.getPosition());

    });
}

// Onload handler to fire off the app.

</script>
@if(Request::segment(1) == 'seller-store' && Request::segment(1) != '')
<script>
$('.add_edit_options').hide();
$('.add_addres').click(function(event) {
    event.preventDefault();
	$('.dash_head').text('Add new branch location');
	if($('.allrt_edit').length)$('.allrt_edit').hide();
    $('.add_edit_options').show();
    $(this).hide();   
    google.maps.event.addDomListener(window, 'load', initialize(29.375742933096898, 47.97745384275913));
});
</script>
@endif
@if(Request::segment(1) == 'seller-store-edit' && Request::segment(2) != '')
<script>
var lat=document.getElementById('latitude').value;
var lng=document.getElementById('longitude').value;
var markerTitle=document.getElementById('searchTextField').value;
$('.latitude').text(lat);
$('.longitude').text(lng);
google.maps.event.addDomListener(window, 'load', initialize(lat,lng,markerTitle));
$('.address_book').hide();
</script>
@endif	
<script>
$('.cancel_btn').click(function(){
location.href="seller-store";
});
</script>
@endsection