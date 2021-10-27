<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>Traveltestsltd | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="/css/flexslider.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/line-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/theme-blues.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/custom.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <!--[if gte IE 9]>
    <link rel="stylesheet" type="text/css" href="/css/ie9.css"/>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700'
          rel='stylesheet' type='text/css'>
    <script src="/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <link rel="stylesheet" href="/js/phone_lib/css/intlTelInput.css">
    <link rel="icon" type="image/png" href="/img/fav.PNG">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    @yield('style')
    <link href="/css/index.css" rel="stylesheet"/>
</head>
<body>
<?php
$ignore = ["booking", "booking_success", "booking_failed", 'about', 'products_covid', "next_steps", "make_payment", "code_failed", "voucher_booking"];
?>
<div class="nav-container">
    <nav class="top-bar
       @if(!in_array(\Illuminate\Support\Facades\Route::current()->getName(),$ignore))
            overlay-bar

@endif
            ">


        <div class="container">

            <div class="row utility-menu">
                <div class="col-sm-12 ">
                    <div class="utility-inner clearfix">
                        <span class=""><i class="icon-envelope"></i> INFO@TRAVELTESTSLTD.COM</span>

                        <div class="pull-right">
                            @if(!in_array(\Illuminate\Support\Facades\Route::current()->getName(),$ignore))
                                <a id="nav-btn" href="/login" class="btn btn-primary btn-white btn-xs">Login</a>
                                <a id="nav-btn" href="/register/agent" class="btn btn-primary btn-white btn-xs">Register
                                    as an Agent</a>
                            @else
                                <a id="nav-btn" href="/login" class="btn btn-primary btn-xs">Login</a>
                                <a id="nav-btn" href="/register/agent" class="btn btn-primary btn-xs">Register as an
                                    Agent</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end of row-->


            <div class="row nav-menu">
                <div class="col-sm-3 col-md-2 columns">
                    <a href="{{ url('/') }}" >
                        <img class="logo logo-light" alt="Logo" style=" max-width: 150px;max-height:100px;top:-50px;" src="/img/logo-white.png">
                        <img class="logo logo-dark" alt="Logo" style=" max-width: 150px;max-height:100px;top:-37px;left: -20px;" src="/img/logo-dark.png">
                        
                    </a>
                </div>

                <div class="col-sm-9 col-md-10 columns">
                    <ul class="menu">
                        <li><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="/#contact">Contact</a>
                        </li>
                        <?php
                        $cartcount = App\Models\Cart::where('ip', session()->get('ip'))->count();

                        ?>
                        <li id="hide2"><a href="{{url('/view/cart')}}"><i class="icon icon_cart"></i><span
                                        class="badge badge-cart cart_count_item">{{$cartcount}}</span></a></li>
                        <li id="hide"><a href="/login">login</a></li>
                        <li id="hide"><a href="/register/agent">Register as an agent</a></li>
                    </ul>

                    <ul class="social-icons text-right">

                        <li>
                            <a target="_blank" href="https://twitter.com/tests_uk">
                                <i class="icon social_twitter"></i>
                            </a>
                        </li>

                        <li>
                            <a target="_blank" href="https://www.facebook.com/UK-Travel-Tests-105975218439195">
                                <i class="icon social_facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a target="_blank" href="https://www.instagram.com/uktraveltests1/?hl=en">
                                <i class="icon social_instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!--end of row-->
            <div id="hide" style="
                    position: absolute;
                    top: 33px;
                    right: 50px;">
                <a href="{{url('/view/cart')}}" style="color:#777777;font-size:14px;"><i
                            class="icon icon_cart"></i><span
                            class="badge badge-cart cart_count_item">{{$cartcount}}</span></a></li>

            </div>
            <div class="mobile-toggle">

                <i class="icon icon_menu"></i>
            </div>

        </div><!--end of container-->
    </nav>


</div>
@yield('content')


<div class="footer-container">

    <footer class="bg-1 short-2" id="contact">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h5 class="text-white">Contact us</h5>
                    <span class="text-white" style="font-size: 16px !important;line-height: 33px;">If you have further questions call us on<br>
                    Phone number: +44 20 8087 2262<br>
                    WhatsApp: +44 74 3687 5938<br>
                    Email us at: info@traveltestsltd.com
                    <br>
                  {{--Powered by <a href="https://www.medburymedicals.com/" target="_blank">MMS</a>--}}
                </span>

                </div>
            </div><!--end for row-->
        </div><!--end of container-->

        <div class="footer2">
            <div class="align-vertical">
                <span class="text-white" style="font-size: 16px;">© {{ date('Y') }} Traveltestsltd.
                </span>
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
<script>
    @if(isset($_GET['ref']) && $_GET['ref'])
      localStorage.setItem('ref', '{{ $_GET['ref'] }}');
    @endif
    console.log('Built with ❤ by ProDevs(https://prodevs.io)');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@yield('script')
</body>
</html>
