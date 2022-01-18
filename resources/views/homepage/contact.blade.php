@extends('layouts.home')

@section('style')

@endsection
@section('content')
<!--/.header-->
<div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="page-title">Contact Us</h3>
                    <h1 class="page-description">Have A Question? Drop Us A Line.</h1>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-header-->
    <div class="page-breadcrumb">
        <!--page-breadcrumb-->
        <!-- page-breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-breadcrumb-->
    <div class="space-medium bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h1>Get In Touch</h1>
                    <p class="lead mb40">
                        To easily reachout to us, Kindly send us an email here info@thetestinglounge.com or call us +44 2036 334452
                    </p>

                </div>
            </div>
        </div>
    </div>


    <!--/.full-cta-->
   @include('includes.home_footer')
 @endsection
@section('script')

@endsection
