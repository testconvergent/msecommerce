@extends('admin.layout.app')
@section('title','Dashboard')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Dashboard</h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-white">
                                    <span class="mini-stat-icon bg-warning"><i class="fa fa-user"></i></span>
                                    <div class="mini-stat-info text-right text-dark">
                                        <span class="counter text-dark">20</span>
                                       All Seller
                                    </div>
                                </div>
                            </div>
							<div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-white">
                                    <span class="mini-stat-icon bg-info"><i class="md-play-install"></i></span>
                                    <div class="mini-stat-info text-right text-dark">
                                        <span class="counter text-dark">20</span>
                                        All Buyer
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-white">
                                    <span class="mini-stat-icon bg-pink"><i class="fa fa-book" aria-hidden="true"></i></span>
                                    <div class="mini-stat-info text-right text-dark">
                                        <span class="counter text-dark">10</span>
                                       All Category
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-white">
                                    <span class="mini-stat-icon bg-success"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                    <div class="mini-stat-info text-right text-dark">
                                        <span class="counter text-dark">11</span>
                                        All Product
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
@endsection     