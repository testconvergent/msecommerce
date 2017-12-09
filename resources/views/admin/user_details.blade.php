@extends('admin.layout.app')
@section('title','User Details')
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
                                <h4 class="pull-left page-title">User Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-user-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="order-detail">
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="order-id">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Name :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															<?php $name = @$user->first_name.' '.@$user->last_name;?>
															{{@$name}}</strong></div>
															
															<div class="clearfix"></div>
															
															@if($user->user_type == 2)
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Industry Type :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															@if($user->industry_type == 1)
															{{'Accommodations'}}
															@elseif($user->industry_type == 2)
															{{'Accounting'}}
															@elseif($user->industry_type == 3)
															{{'Advertising'}}
															@elseif($user->industry_type == 4)
															{{'Agriculture & Agribusiness'}}
															@endif
															</strong></div>
															@endif
															
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>gender :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>@if(@$user->gender == 1){{'Man'}}
															@elseif(@$user->gender == 2){{'Woman'}}
															@endif
															</strong></div>
															@endif
															<div class="clearfix"></div>
															@if($user->user_type == 3)
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Area :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->area}}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Block :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->block}}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>House/Building :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->house_building}}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Floor :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->floor}}
															</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Website :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->website}}</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Facebook :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->facebook_link}}</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Instagrame :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->instagram_link}}</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Company Name :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->company_name}}</strong></div>
															@endif
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>User Type :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>@if($user->user_type == 2){{'Seller'}}@elseif($user->user_type == 3){{'Buyer'}}@endif</strong></div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
														<div class="order-id">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Email :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->email}}</strong></div>
															<div class="clearfix"></div>
															@if($user->user_type == 2)
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Type of Company:</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															@if($user->type_of_company == 1)
															{{'Private Company Limeted'}}
															@elseif($user->type_of_company == 2)
															{{'Ready Made Pvt Ltd'}}
															@elseif($user->type_of_company == 3)
															{{'Public Ltd'}}
															@elseif($user->type_of_company == 4)
															{{'Limited Libality Pertnership'}}
															@endif
															</strong></div>
															@endif
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Phone :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->phone}}</strong></div>
															<div class="clearfix"></div>
															@if($user->user_type == 3)
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Street :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->street }}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Avenue :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->avenue}}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Apartment :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->apartment}}
															</strong></div>
															@endif
															@if($user->user_type == 3)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Pasi Number :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															{{@$user->pasi_number}}
															</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Location :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>
															
															</strong></div>
															@endif
															@if($user->user_type == 2)
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Twitter :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>{{@$user->twitter_link}}</strong></div>
															@endif
															<div class="clearfix"></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no_padd_lft"><p>Registration Date :</p></div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong><?php 
															$date = date('d-m-Y',strtotime(@$user->date_of_registration))
															?>
															{{@$date}}</strong></div>
														</div>
													</div>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="order-id">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padd_lft"><p>Address :</p>
															<strong>{{@$user->address}}</strong>
															</div>
														</div>
													</div>
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