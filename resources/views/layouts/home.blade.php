
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>UkTravel Test | Home</title>
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
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <link rel="stylesheet" href="/js/phone_lib/css/intlTelInput.css">
</head>
<body>
{{--<div class="loader">--}}
    {{--<div class="spinner">--}}
        {{--<div class="double-bounce1"></div>--}}
        {{--<div class="double-bounce2"></div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="nav-container">
    <nav class="top-bar
       @if(\Illuminate\Support\Facades\Route::current()->getName() != "booking")
    overlay-bar
    @endif

">


        <div class="container">

            <div class="row utility-menu">
                <div class="col-sm-12">
                    <div class="utility-inner clearfix">
                        <span class="alt-font"><i class="icon icon_mail"></i> info@uktraveltest.co.uk</span>

                        <div class="pull-right">
                            <a href="login.html" class="btn btn-primary btn-white btn-xs">Login</a>
                            <a href="#" class="language"><img alt="English" src="img/english.png"></a>
                        </div>
                    </div>
                </div>
            </div><!--end of row-->


            <div class="row nav-menu">
                <div class="col-sm-3 col-md-2 columns">
                    <a href="{{ url('/') }}">
                        <img class="logo logo-light" alt="Logo" src="img/logo-light.png">
                        <img class="logo logo-dark" alt="Logo" src="img/logo-dark.png">
                    </a>
                </div>

                <div class="col-sm-9 col-md-10 columns">
                    <ul class="menu">
                        <li ><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="has-dropdown"><a href="#">About</a></li>
                        <li class="has-dropdown"><a  href="#">Covid19 Testing</a>
                            <div class="subnav subnav-halfwidth">
                                <div class="col-sm-6">
                                    <h6 class="alt-font">Article Lists</h6>
                                    <ul class="subnav">
                                        <li><a href="blog-masonry.html">Masonry</a></li>
                                        <li><a href="blog-masonry-sidebar.html">Masonry Sidebar</a></li>
                                        <li><a href="blog.html">Blog Large List</a></li>
                                        <li><a href="blog-large-image.html">Blog Image List</a></li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <h6 class="alt-font">Article Singles</h6>
                                    <ul class="subnav">
                                        <li><a href="blog-single.html">Article Basic</a></li>
                                        <li><a href="blog-single-2.html">Article Basic 2</a></li>
                                        <li><a href="blog-single-sidebar.html">Article Sidebar</a></li>
                                        <li><a href="blog-single-media.html">Article Media</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">FAQ</a>
                        </li>
                        <li><a href="#">Contact</a>
                        </li>
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
                    <span class="text-white">© 2014 Pivot Inc.</span>
                    <span class="text-white"><a href="#">hello@pivot.net</a></span>
                    <span class="text-white">+614 3827 492</span>
                    <span class="text-white">300 Collins St. Melbourne 3000</span>
                </div>
            </div><!--end for row-->
        </div><!--end of container-->

        <div class="contact-action">
            <div class="align-vertical">
                <i class="icon text-white icon_mail"></i>
                <a href="contact.html" class="text-white"><span class="text-white">Get in touch with us <i class="icon arrow_right"></i></span></a>
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
