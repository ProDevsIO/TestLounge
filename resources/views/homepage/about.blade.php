@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="main-container">

        <header class="title" style="max-height: 200px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-white">About</h1>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="feature-selector">
            <div class="container">

            </div>

            <div class="container">
                <ul class="selector-content">
                    <li class="clearfix active">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1>A bit about us</h1>
                            </div>
                        </div><!--end of row-->

                        <div class="row">
                            <div class="col-sm-12">
                                <p class="lead">
                                    <p  style = "font-weight:900;">We are a platform that helps aggregate UK Labs and test providers vetted and seen to provide seamless and good customer service to travelers.</p>
                                    <p  style = "font-weight:900;">  This platform gives you the information you need to confidently book the appropriate test(s) for your travel.Our mission is to provide clarity on the information needed for travel tests.We currently provide a list of COVID-19 testing providers who help to make the testing process as seamless as possible.</p>
                                    <p  style = "font-weight:900;"> Through our partnerships with accredited self-test service providers, we provide access to cutting-edge, accredited self-test services providers.</p>
                                 </p>
                            </div>


                        </div><!--end of row-->
                    </li><!--end of individual feature content-->


                </ul>
            </div>
        </section>



    </div>

@endsection

