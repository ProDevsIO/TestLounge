
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>UKTravel Tests | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="/css/flexslider.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/line-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/theme-blues.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/custom.css" rel="stylesheet" type="text/css" media="all"/>
    <!--[if gte IE 9]>
    <link rel="stylesheet" type="text/css" href="/css/ie9.css" />
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>
    <script src="/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <link rel="stylesheet" href="/js/phone_lib/css/intlTelInput.css">
    <link rel="icon" type="image/png" href="/img/favicon.png">

    @yield('style')
    <style>
        .lnk:hover{
            text-decoration: none;
        }
    </style>
</head>
<body>
{{--<div class="loader">--}}
    {{--<div class="spinner">--}}
        {{--<div class="double-bounce1"></div>--}}
        {{--<div class="double-bounce2"></div>--}}
    {{--</div>--}}
{{--</div>--}}
<?php
    $ignore = ["booking","booking_success","booking_failed",'about','products_covid'];
?>
<div class="nav-container">
    <nav class="top-bar
       @if(!in_array(\Illuminate\Support\Facades\Route::current()->getName(),$ignore))
            overlay-bar

@endif
">


        <div class="container">

            <div class="row utility-menu">
                <div class="col-sm-12">
                    <div class="utility-inner clearfix">
                        <span class="alt-font"><i class="icon icon_mail"></i>info@uktraveltest.co.uk</span>

                        <div class="pull-right">
                            @if(!in_array(\Illuminate\Support\Facades\Route::current()->getName(),$ignore))
                                <a href="/login" class="btn btn-primary btn-white btn-xs">Login</a>
                                <a href="/register/agent" class="btn btn-primary btn-white btn-xs">Register as an Agent</a>
                            @else
                                <a href="/login" class="btn btn-primary btn-xs">Login</a>
                                <a href="/register/agent" class="btn btn-primary btn-xs">Register as an Agent</a>
                                @endif
                            <a href="#" class="language"><img alt="English" src="/img/english.png"></a>
                        </div>
                    </div>
                </div>
            </div><!--end of row-->


            <div class="row nav-menu">
                <div class="col-sm-3 col-md-2 columns">
                    <a href="{{ url('/') }}">
                        <img class="logo logo-light" alt="Logo" src="/img/logo-light.png">
                        <img class="logo logo-dark" alt="Logo" src="/img/logo-dark.png">
                    </a>
                </div>

                <div class="col-sm-9 col-md-10 columns">
                    <ul class="menu">
                        <li ><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li class="has-dropdown"><a  href="#">COVID TESTING</a>
                            <div class="subnav subnav-halfwidth">
                                <div class="col-sm-12">
                                    <ul class="subnav">
                                        @php
                                        $products = \App\Models\Product::orderby('name','asc')->get();
                                        @endphp
                                        @foreach($products as $product)
                                        <li><a href="/covid/testing">{{ $product->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </li>
                        <li><a href="/#faq">FAQ</a>
                        </li>
                        <li><a href="mailto:info@uktraveltests.com">Contact</a>
                        </li>
                        <li id="hide"><a href="/login">login</a></li>
                        <li id="hide"><a href="/register/agent">Register as an agent</a></li>
                    </ul>

                    <ul class="social-icons text-right">
                        <li>
                            <a href="#">
                                <i class="icon social_twitter"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon social_facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon social_instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!--end of row-->

            <div class="mobile-toggle">
                <i class="icon icon_menu"></i>
            </div>

        </div><!--end of container-->
    </nav>







</div>
		@yield('content')


<div class="footer-container">

    <footer class="bg-primary short-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <span class="text-white">© {{ date('Y') }} UKTravelTests.<br/> Built with ❤ by <a href="https://prodevs.io" target="_blank">ProDevs</a></span>
                    <span class="text-white"><a href="#">info@uktraveltests.com</a></span>
                    <span class="text-white">London, UK</span>
                </div>
            </div><!--end for row-->
        </div><!--end of container-->

        <div class="contact-action">
            <div class="align-vertical">
                <i class="icon text-white icon_mail"></i>
                <a href="mailto:info@uktraveltests.com" class="text-white"><span class="text-white">Get in touch with us <i class="icon arrow_right"></i></span></a>
            </div>
        </div>
    </footer>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.plugin.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.flexslider-min.js"></script>
<script src="/js/smooth-scroll.min.js"></script>
<script src="/js/skrollr.min.js"></script>
<script src="/js/spectragram.min.js"></script>
<script src="/js/scrollReveal.min.js"></script>
<script src="/js/isotope.min.js"></script>
<script src="/js/phone_lib/js/intlTelInput.js"></script>
<script src="/js/lightbox.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<script src="/js/scripts.js"></script>
@yield('script')
</body>
</html>
