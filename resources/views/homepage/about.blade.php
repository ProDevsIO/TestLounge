@extends('layouts.home')
@section('style')


@endsection
@section('content')

    <div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="page-title">About Us</h3>
                    <h1 class="page-description">About The Testing Lounge</h1>
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
                        <li class="active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-breadcrumb-->

    <div class="space-medium">
        <!--space-medium-->
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1>Who We Are?</h1>
                    <p>At The Testing Lounge, we believe you and your health should come first. We work hard to keep your mind at ease by providing <strong>clarity, a seamless booking &amp; an affordable service.</strong>
                    </p>
                    <p> The Testing Lounge is on the Government List of <a target="_blank" href="https://www.gov.uk/government/publications/list-of-private-providers-of-coronavirus-testing/list-of-private-providers-of-coronavirus-testing#general-testing" style="color: #cda768;">Private Providers</a>  for general COVID-19 testing, Day 2 &8 testing and Test to Release. We are part of The Scarlet Practice, a UK-based company. Our focus is helping people access affordable private healthcare.
                    </p>
                    <p> Private Provider on UK Government List <br/>
                        Partners with top UKAS- accredited laboratories to provide a fast and accurate service.</p>
                </div>
                <div class="col-lg-5">
                    <a href="#"><img src="/images/about-img.jpeg" alt="" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
    <!--/.space-medium-->

    <div class="space-medium">
        <!--space-medium-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                    <div class="section-title text-center">
                        <!-- section title start-->
                        <h1>Why Choose The Testing Lounge?</h1>
                    </div>
                    <!-- /.section title start-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-blurb text-center">
                        <!--feature-blurb-->
                        <h3>Clarity</h3>
                        <p>We create clarity around the testing process so it gets less overwhelming.</p>
                    </div>
                    <!--/.feature-blurb-->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-blurb text-center">
                        <!--feature-blurb-->
                        <h3>Seamless Booking Process</h3>
                        <p>We continuously update our booking process to make sure it is as easy and seamless as possible. </p>
                    </div>
                    <!--/.feature-blurb-->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="feature-blurb text-center">
                        <!--feature-blurb-->
                        <h3>Affordable Prices</h3>
                        <p>We aim to give you competitive prices and prioritise your customer experience with us.</p>
                    </div>
                    <!--/.feature-blurb-->
                </div>

            </div>
        </div>
    </div>

    @include('includes.home_footer')


@endsection

