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
                        <li><a href="index.html">Home</a></li>
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
                        Please fill out the form below and a member of our team will be in touch shortly.
                    </p>
                    <form class="form-horizontal " method="post" action="">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="sr-only" for="Name"><span class="required">*</span> </label>
                            <div class="col-md-6">
                                <input id="Name" name="Name" type="text" placeholder="Your Name" class="form-control input-md" required>
                            </div>
                            <label class="sr-only" for="Email"><span class="required">*</span> </label>
                            <div class="col-md-6">
                                <input id="Email" name="Email" type="email" placeholder="Email Address" class="form-control input-md" required>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="sr-only" for="Phone"> </label>
                            <div class="col-md-6">
                                <input id="Phone" name="Phone" type="text" placeholder="Phone No" class="form-control input-md" required>
                            </div>
                            <label class="sr-only" for="subject"> </label>
                            <div class="col-md-6">
                                <input id="subject" name="subject" type="text" placeholder="subject" class="form-control input-md" required>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="sr-only" for="address">Message</label>
                            <div class="col-md-12">
                                <textarea class="form-control" id="address" name="message" rows="4" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <button id="singlebutton" name="singlebutton" class="btn btn-default ">Submit</button>
                                <small class="required pull-right">* Required Field</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="full-cta">
        <!--full-cta-->
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <h2 class="cta-title">Ask a Question?</h2>
                    <p class="text-white">Call us on  <strong>02036334452</strong> </p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <a href="/faq" class="btn btn-secondary pull-right">Frequently Asked Questions</a>
                </div>
            </div>
        </div>
    </div>
    <!--/.full-cta-->
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
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <div class="widget-footer">
                        <!--widget-footer-->
                        <h3 class="widget-title">Quick Links</h3>
                        <ul class="listnone circle-style">
                            <li><a href="index.html">Home </a> </li>
                            <li><a href="contact-us.html">About Us</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <!-- <li><a href="contact-us.html">Blog</a></li> -->
                            <li><a href="contact-us.html">Contact us</a></li>
                        </ul>
                    </div>
                    <!--/.widget-footer-->
                </div>
               
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="widget-footer footer-social">
                        <!--widget-footer-social-->
                        <h3 class="widget-title">Connect With Us</h3>
                        <ul class="contact listnone">
                            <li><i class="fa fa-phone"></i><strong> 02036334452</strong></li>
                            <li><i class="fa fa-envelope-open-o"></i> <strong>info@thetestinglounge.com</strong></li>
                        </ul>
                        <ul class="listnone">
                            <li><a href="https://www.instagram.com/thetestingloungeuk/" class="facebook-btn" target="_blank"><i class="fa fa-instagram"></i></a> <strong>Instagram</strong>  </li> 
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