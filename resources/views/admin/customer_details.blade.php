@extends('admin.layout.app')
@section('title','Customer Details')
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
                                <h4 class="pull-left page-title">Customer Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-customers-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
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
													<label for="exampleInputEmail1"><strong>Email</strong>: {{@$user->email}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Gender</strong>: 
													@if($user->gender == 1){{'Male'}}
													@elseif($user->gender == 1){{'Female'}}
													@endif
													</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Date of Birth</strong>: {{@$user->dob}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Mobile Number</strong>: {{@$user->phone}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Status</strong>: 
													@if($user->is_email_verified == 0 && $user->user_status == 0){{'Email Not Verified'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 1){{'Active'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 2){{'Inactive'}}
													@endif
													</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
											<div class="your-mail">
												<label for="exampleInputEmail1"><strong>Registration Date</strong>:
												@if(@$user->date_of_registration)
												{{date('d-m-Y'),strtotime(@$user->date_of_registration)}} @endif</label>
											</div>
										</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Address Information</p>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Area</strong>: {{@$user->area}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Block</strong>: {{@$user->block}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Street</strong>: {{@$user->street}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Avenue</strong>: {{@$user->avenue}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>House/Building</strong>: {{@$user->houser_building}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Floor</strong>: {{@$user->floor}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Apartment</strong>: {{@$user->apartment}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Pasi Number</strong>: {{@$user->pasi_number}} </label>
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