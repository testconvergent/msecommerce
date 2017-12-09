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
						<div class="board_details">
							<h2 class="dash_head">Add New Address</h2>
							<div class="graw_address">
								<form id="add_address" method="post" action="add-address">
							        {{csrf_field()}}
									<div class="details_box">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">First Name <span>*</span></label>
													<input name="first_name" class="from_type required" placeholder="Type your first name" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group required">
													<label class="name_label">Last Name <span>*</span></label>
													<input name="last_name" class="from_type required" placeholder="Type your last name" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Email Address <span>*</span></label>
													<input name="email" class="from_type required" placeholder="Type your email address" type="email">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Mobile Number <span>*</span></label>
													<input name="mobile_number" class="from_type required" placeholder="Type your mobile number" type="text" onkeypress="validate(event)">
												</div>
											</div>
										</div>
									</div>
									<div class="details_box details_box_2">
										<div class="row">   
										   <div class="col-md-6 col-sm-6 col-xs-12">
											  <div class="form-group">
												 <label class="name_label">Area <span>*</span></label>
												 <input name="area" class="from_type required" placeholder="Type your area" type="text">
											  </div>
										   </div>
										</div> 
										<div  class="address_map_box">
										<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											  <div class="form-group">
												 <label class="name_label">Type your address and view it on the map <span>*</span></label>
												 <input id="latitude" name="latitude" type="hidden" size="50" value="">
												 <input id="longitude" name="longitude" type="hidden" size="50" value="">
												 <input value="Mubarak Al Kabeer St, Kuwait City, Kuwait" id="searchTextField" name="address" class="from_type required" placeholder="Type your address and view it on the map" type="text">
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
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Block <span>*</span></label>
													<input name="block" class="from_type required" placeholder="Type your block" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Street <span>*</span></label>
													<input name="street" class="from_type required" placeholder="Type your street" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Avenue</label>
													<input name="avenue" class="from_type" placeholder="Type your avenue" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">House/Building <span>*</span></label>
													<input name="house_building" class="from_type required" placeholder="Type your house/building" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Floor</label>
													<input name="building_floor" class="from_type" placeholder="Type your floor" type="text">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="name_label">Apartment</label>
													<input name="apartment" class="from_type" placeholder="Type your apartment" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="name_label">Pasi Number <span class="llgth556">(12 digits)</span></label>
												<input maxlength="12" minlength="12" name="pasi_number" class="from_type" placeholder="Type your pasi number" type="text">
												@if ($errors->has('pasi_number'))<p class="error">{{$errors->first('pasi_number')}}</p>@endif
											</div>
										</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<div class="checkbox-group forr1 make_check"> 
												   <input value="1" name="default_shipping_address" type="checkbox" id="checkiz1"> 
												   <label for="checkiz1">
												   <span class="check"></span>
												   <span class="box"></span>
												   <p class="ft_text">Use as my default shipping address</p>
												   </label>
												</div>
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
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>
@include('english.layout.footer')
<script>
$(document).ready(function(){
	$('#add_address').validate();
	$('#add_address').submit(function(){
		 var lng=document.getElementById('longitude').value;
         var lat=document.getElementById('latitude').value;
		 if(lng!='' && lat!='' )return true;
		$('.errorLatLng').css('color','red')
		$("html, body").animate({ scrollTop: $('.errorLatLng').height() }, "slow");
		return false;
	});
});
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
function initialize() {
    latLng = new google.maps.LatLng(29.375742933096898, 47.97745384275913);
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
        title: "Sie können mich per Drag & Drop auf das gewünschte Ziel setzen. Oder im Suche feld den Ort eingeben und auswählen."
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

    google.maps.event.addListener(marker, 'dragend', function() {		
        geocodePosition(marker.getPosition());
    });
	google.maps.event.addListener(map, 'click', function(event) {				   
		geocodePosition(event.latLng);	
		updateMarkerPosition(event.latLng);
		removePreviousMarker(null);
		latLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
		marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    draggable: true,
                    title:input.value
                });	
		$('.latitude').text(event.latLng.lat());
        $('.longitude').text(event.latLng.lng());
		 document.getElementById('longitude').value = latLng.lng();
         document.getElementById('latitude').value = latLng.lat(); 
         $('.errorLatLng').css('visibility','hidden')		 
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
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
$('.cancel_btn').click(function(){
location.href="address-book";
}); 
</script>  
@endsection