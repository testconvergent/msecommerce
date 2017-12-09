@extends('admin.layout.app')
@section('title','Seller Details')
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
							<h4 class="pull-left page-title">Seller Details</h4>
							<div class="submit-login pull-right">
								<a href="admin-sellers-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
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
												<p>Personal Information</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Name</strong>: {{@$user->first_name}} {{@$user->last_name}} </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Email</strong>: {{@$user->email}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Phone</strong>: {{@$user->phone}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Industry Type</strong>: @if($user->industry_type == 1)
												{{'Accommodations'}}
												@elseif($user->industry_type == 2)
												{{'Accounting'}}
												@elseif($user->industry_type == 3)
												{{'Advertising'}}
												@elseif($user->industry_type == 4)
												{{'Agriculture & Agribusiness'}}
												@endif </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Company Name</strong>: {{@$user->company_name}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Website</strong>: {{@$user->website}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Registration Date</strong>:
												@if(@$user->date_of_registration)
												{{date('d-m-Y'),strtotime(@$user->date_of_registration)}} @endif</label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Status</strong>: 
												@if($user->is_email_verified == 0 && $user->user_status == 0){{'Email Not Verified'}}
												
												@elseif($user->is_email_verified == 1 && $user->user_status == 0){{'Awating for admin approval'}}
												
												@elseif($user->is_email_verified == 1 && $user->user_status == 1){{'Active'}}
												
												@elseif($user->is_email_verified == 1 && $user->user_status == 2){{'Inactive'}}
												@endif
												</label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Type of Company</strong>: @if($user->type_of_company == 1)
												{{'Private Company Limeted'}}
												@elseif($user->type_of_company == 2)
												{{'Ready Made Pvt Ltd'}}
												@elseif($user->type_of_company == 3)
												{{'Public Ltd'}}
												@elseif($user->type_of_company == 4)
												{{'Limited Libality Pertnership'}}
												@endif </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Logo</strong>:
												@if(@$user->profile_logo)
												<img id="up_img" class="img-responsive" src="{{url('storage/app/public/profile_image/thumb/'.@$user->profile_logo)}}" alt="" />
												@endif
												</label>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="info_ii">
												<p>Address Information</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Location</strong>: {{@$user->country_name}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Area </strong>: {{@$user->area}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Address </strong>: {{@$user->address}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Company E-mail </strong>: {{@$user->company_email}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Block </strong>: {{@$user->block}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Street </strong>: {{@$user->street}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Avenue </strong>: {{@$user->avenue}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>House/Building </strong>: {{@$user->houser_building}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Floor </strong>: {{@$user->floor}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Apartment </strong>: {{@$user->apartment}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Pasi Number </strong>: {{@$user->pasi_number}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Post Code </strong>: {{@$user->post_code}}  </label>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="info_ii">
												<p>Contact Person Information</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong> Name</strong>: {{@$user->contact_name}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong> Email</strong>: {{@$user->contact_email}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong> Mobile Number</strong>: {{@$user->contact_mobile_number}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong> Office Number</strong>: {{@$user->contact_office_number}}  </label>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="info_ii">
												<p>Bank Account Information</p>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Bank Name</strong>: {{@$user->bank_name}}  </label>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Bank Account Number</strong>: {{@$user->bank_account_number}}  </label>
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
@endsection   