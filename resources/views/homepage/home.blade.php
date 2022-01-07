@extends('layouts.home')

@section('style')

@endsection
@section('content')

<!--/.header-->
<div class="slider">
    <!--slider-->
    <div class="owl-carousel owl-theme">
        <div class="item"> <img src="images/slider-3.jpg" alt="" class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="slider-captions">

                            <h2 class="slider-title text-white">We provide fast Covid-19 testing for international
                                travel.</h2>
                            <p class="slider-text hidden-xs text-white">At The Testing Lounge, our goal is to provide
                                fast and efficient test services by collaborating with UKAS-accredited labs approved for
                                testing by the Government.</p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="item"><img src="images/slider-1.jpg" alt="" class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="slider-captions">
                            <!--slider-captions-->
                            <h2 class="slider-title text-white">Fast and Reliable Testing Services</h2>
                            <p class="slider-text hidden-xs text-white">We make the testing process easy, fast and reliable with our seamless booking process. We aim to put your mind at ease as you navigate on our platform.</p>

                        </div>
                        <!--/.slider-captions-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.slider-->


<!--/.space-medium-->
<div class="bg-white space-medium">
    <!--space-medium-->
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                <div class="section-title mb60 text-center">
                    <!-- section title start-->
                    <h1>How it works</h1>
                </div>
                <!-- /.section title start-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="how-it-block text-center">
                    <!--how-it-block-->
                    <div class="circle-icon doted-line">
                        <i class="fa fa-wpforms"></i>
                    </div>
                    <h3>Fill The Form</h3>
                    <p>Submit your details in a simple form.</p>
                </div>
                <!--how-it-block-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="how-it-block text-center">
                    <!--how-it-block-->
                    <div class="circle-icon doted-line">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h3>Get Your Kit</h3>
                    <p>Receive your test kit and follow the instructions.</p>
                </div>
                <!--/.how-it-block-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="how-it-block text-center">
                    <!--how-it-block-->
                    <div class="circle-icon doted-line">
                        <i class="fa fa-flask"></i>
                    </div>
                    <h3>Post it back</h3>
                    <p>Send your swab specimen (as instructed) to us </p>
                </div>
                <!--/.how-it-block-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="how-it-block text-center">
                    <!--how-it-block-->
                    <div class="circle-icon">
                        <i class="fa fa-download"></i>
                    </div>
                    <h3>Get Result</h3>
                    <p>Receive your test result(s) from us by email</p>
                </div>
                <!--/.how-it-block-->
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
                <div class="section-title mb60 text-center">
                    <!-- section title start-->
                    
                    <h1>Single Tests</h1>
                    @php
                    $vproducts = App\Models\VendorProduct::all()
                    @endphp
                </div>
                <!-- /.section title start-->
            </div>
        </div>
        <div class="row">
            @foreach($vproducts as $vproduct)
                @if($vproduct->product->classify == 0)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top:10px;">
                        <div class="service-block" style="min-height:300px;max-height:300px;">
                            <!-- service block -->
                            <div class="service-content">
                                <!-- service content -->
                                <h2><a href="#" class="title">{{$vproduct->product->name}}</a></h2>

                                <span class="price"
                                    style="background-color: rgb(235, 235, 235); padding: 10px 25px; border-radius: 50px;">
                                    £{{$vproduct->price_pounds}}
                                </span> <br>
                                <!-- /view/product/{{$vproduct->product->slug}} -->
                                <a href="/view/product/{{$vproduct->product->slug}}" class="btn btn-default"
                                    style="margin-top: 50px;">Book Test</a>

                            </div>
                            <!-- service content -->
                        </div>
                        <!-- /.service block -->
                    </div>
                @endif
            @endforeach
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                <div class="section-title mb60 text-center">
                    <!-- section title start-->
                    
                    <h1>Bundle Tests</h1>
                   
                </div>
                <!-- /.section title start-->
            </div>
        </div>
        <div class="row">
            @foreach($vproducts as $vproduct)
                @if($vproduct->product->classify == 1)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top:10px;">
                        <div class="service-block" style="min-height:300px;max-height:300px;">
                            <!-- service block -->
                            <div class="service-content">
                                <!-- service content -->
                                <h2><a href="#" class="title">{{$vproduct->product->name}}</a></h2>

                                <span class="price"
                                    style="background-color: rgb(235, 235, 235); padding: 10px 25px; border-radius: 50px;">
                                    £{{$vproduct->price_pounds}}
                                </span> <br>

                                <a href="/view/product/{{$vproduct->product->slug}}" class="btn btn-default"
                                    style="margin-top: 50px;">Book Test</a>

                            </div>
                            <!-- service content -->
                        </div>
                        <!-- /.service block -->
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!--/.space-medium-->
<div class="client-logo-section">
    <!--client-logo-section-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div class="client-logo">
                    <!--client-logo-->
                    <!-- <img src="images/client-logo-1.png" alt="" class="img-responsive"> -->
                </div>
                <!--/.client-logo-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div class="client-logo">
                    <!--client-logo-->
                    <!-- <img src="images/client-logo-2.png" alt="" class="img-responsive"> -->
                </div>
                <!--/.client-logo-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-7">
                <div class="client-logo">
                    <!--client-logo-->
                    <!-- <img src="images/client-logo-3.png" alt="" class="img-responsive"> -->
                </div>
                <!--/.client-logo-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                <div class="client-logo">
                    <!--client-logo-->
                    <!-- <img src="images/client-logo-4.png" alt="" class="img-responsive"> -->
                </div>
                <!--/.client-logo-->
            </div>
        </div>
    </div>
</div>
<!--/.client-logo-section-->

<!--/.space-medium-->
<div class="bg-white space-medium">
    <!--space-medium-->
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                <div class="section-title mb60 text-center">
                    <!-- section title start-->
                    <h1>Which test(s) do I need to book?</h1>
                </div>
                <!-- /.section title start-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="service-block" style="box-shadow: -3px 10px 19px -5px rgba(0,0,0,0.64);height:400px">
                    <!-- service block -->
                    <div class="service-content">
                        <!-- service content -->
                        <h2 class="title" style="color: #cda768;">VACCINATED (over 18s)</h2>

                        <p style="font-weight: 700;">PRIOR TO YOUR TRIP</p>
                        <ul>
                            <li>Take a <a href="/view/product/test-to-travel-fit-to-fly-from-the-uk" style="color: #cda768;">PCR Fit to Fly</a></li>
                        </ul>

                        <p style="font-weight: 700;">BEFORE YOUR RETURN TO THE UK</p>
                        <ul>
                            <li>Book a <a href="/view/product/vaccinated-day-2-mandatory-test" style="color: #cda768;">PCR Day 2 Test</a> to be taken
                                on or before Day 2 of your arrival in the UK</li>
                            <li>Complete a Passenger Locator Form in the 48 hours before your trip.</li>

                            <li>Self - isolate until you receive a negative result from your Day 2 Test.</li>
                        </ul>

                        <!-- <a href="#" class="btn btn-default" style="margin-top: 50px;">Book Test</a> -->

                    </div>
                    <!-- service content -->
                </div>
                <!-- /.service block -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="service-block" style="box-shadow: -3px 10px 19px -5px rgba(0,0,0,0.64);height:400px">
                    <!-- service block -->
                    <div class="service-content">
                        <!-- service content -->
                        <h2 class="title" style="color: #cda768;">UNVACCINATED</h2>

                        <p style="font-weight: 700;">PRIOR TO YOUR TRIP</p>
                        <ul>
                            <li>Take a <a href="/view/product/test-to-travel-fit-to-fly-from-the-uk" style="color: #cda768;">PCR Fit to Fly</a> </li>
                        </ul>

                        <p style="font-weight: 700;">BEFORE YOUR RETURN TO THE UK</p>
                        <ul>
                            <li>Take a <a href="/view/product/test-to-travel-fit-to-fly-from-the-uk" style="color: #cda768;">PCR Fit to Fly test</a>
                                (72hrs before your trip).</li>
                            <li>Book a <a href="/view/product/unvaccinated-day-2-and-day-8-mandatory-test" style="color: #cda768;">PCR Day 2 and Day 8</a> Test
                                Package to be taken on Day 2 and Day 8 of your arrival.</li>
                            <li>Complete a Passenger Locator Form in the 48 hours before your trip.</li>
                        </ul>

                        <!-- <a href="#" class="btn btn-default" style="margin-top: 50px;">Book Test</a> -->

                    </div>
                    <!-- service content -->
                </div>
                <!-- /.service block -->
            </div>
        </div>
    </div>
</div>
<!--/.space-medium-->
<div class="footer">
    <!--footer-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <div class="widget-footer mb60">
                    <!--widget-footer-->
                    <a href="index.html"><img src="images/logo.png" alt="" class="img-responsive"></a>
                </div>
                <!--/.widget-footer-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="widget-footer">
                    <!--widget-footer-->

                </div>
                <!--/.widget-footer-->
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="widget-footer">
                    <!--widget-footer-->
                    <h3 class="widget-title">Quick Links</h3>
                    <ul class="listnone circle-style">
                        <li><a href="/">Home </a> </li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <!-- <li><a href="contact-us.html">Blog</a></li> -->
                        <li><a href="/contact">Contact us</a></li>
                    </ul>
                </div>
                <!--/.widget-footer-->
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="widget-footer footer-social">
                    <!--widget-footer-social-->
                    <h3 class="widget-title">Connect With Us</h3>
                    <ul class="contact listnone">
                        <li><i class="fa fa-phone"></i><strong> 02036334452</strong></li>
                        <li><i class="fa fa-envelope-open-o"></i> <strong>info@thetestinglounge.com</strong></li>
                    </ul>
                    <ul class="listnone">
                        <li><a href="https://www.instagram.com/thetestingloungeuk/" class="facebook-btn"
                                target="_blank"><i class="fa fa-instagram"></i></a> <strong>Instagram</strong> </li>
                    </ul>
                </div>
                <!--/.widget-footer-social-->
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection
