@extends('layouts.home')

@section('style')

@endsection
@section('content')
<div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="page-title">FAQ</h3>
                    <h1 class="page-description">Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-header-->
    <div class="page-breadcrumb">
        <!-- page-breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-breadcrumb-->

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="st-accordion">
                        <!--st-accordion-->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title"> <a role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">How long does it take to get my result(s)?</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="panel-body">Within 24 to 48hours from arrival of the sample at the
                                        laboratory. <br>
                                        <strong> Please note that when you send your sample via post, you will need to
                                            give the postal service time to deliver the sample to the
                                            laboratory.</strong>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title"> <a class="collapsed" role="button"
                                                data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">When will I receive my
                                                home test kit?</a></h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingTwo">
                                        <div class="panel-body">If you order your home test kit before 1pm on a weekday,
                                            you will get it the next business day. If you order after 1pm on a weekday,
                                            you will get it 2 business days later. <br>
                                            If you order after 1pm on a Friday, you will get it the following Tuesday as
                                            no posts are sent out on weekends. <br>
                                            Home test kits are not delivered on Sundays and Bank Holidays

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title"> <a class="collapsed" role="button"
                                                data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">I did not get an
                                                email. What should I do?</a></h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingThree">
                                        <div class="panel-body">Please check your junk mail and if it is not there, call
                                            us on 02036334452 or email us at <a
                                                href="mailto:info@thetestinglounge.com">info@thetestinglounge.com</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title"> <a class="collapsed" role="button"
                                                data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">How will I receive my
                                                results?</a></h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingFour">
                                        <div class="panel-body">Results are sent by email.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFive">
                                        <h4 class="panel-title"> <a class="collapsed" role="button"
                                                data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">Where can I find my reference number for my Passenger Locator Form?</a> </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingFive">
                                        <div class="panel-body"> Your reference number  will be located in your confirmation email and it starts with <strong>TTLUK</strong> followed by some numbers. </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSix">
                                        <h4 class="panel-title"> <a class="collapsed" role="button"
                                                data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">My home test hasn’t arrived yet. What should I do?</a> </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingSix">
                                        <div class="panel-body"> If your home test hasn’t arrived and it has been a few days, you should check the dispatch email with the tracking link we sent to you. <br>If the address is incorrect, you can contact the courier to rearrange a delivery. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.st-accordion-->
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
                        <p class="text-white">Call us on <strong>02036334452</strong> </p>
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
                                <li><i class="fa fa-envelope-open-o"></i> <strong>info@thetestinglounge.com</strong>
                                </li>
                            </ul>
                            <ul class="listnone">
                                <li><a href="https://www.instagram.com/thetestingloungeuk/" class="facebook-btn"
                                        target="_blank"><i class="fa fa-instagram"></i></a> <strong>Instagram</strong>
                                </li>
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