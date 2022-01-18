<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="TheTestingLounge | The number one place to get all your test done in the UK">
     <meta name="keywords" content="laboratory, TheTestingLounge laboratory, TheTestingLounge website">
    <title>TheTestingLounge | Testing Made Easy</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style css -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- Owl carousel style Css -->
    <link href="/css/owl.carousel.min.css" rel="stylesheet">
    <link href="/css/owl.theme.default.css" rel="stylesheet">
    <!-- Google Font css -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900" rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    @yield('style')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <!-- Coountry code -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
    @php
     $products = App\Models\Product::all()

    @endphp
    <div class="header">
        <!--header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="/images/logo.png" style="height: 50px;" alt="" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="navigation">
                        <!--navigation-->
                        <ul>
                            <li><a href="/" title="Home page">Home</a></li>
                            <li><a title="Covid Test">Covid-19 Testing</a>
                                <ul>
                                    @foreach($products as $product)
                                        @php
                                            $word_count = strlen($product->name);
                                        @endphp
                                    <li
                                    @if($word_count > 30)
                                        style="margin-bottom: 10px;"
                                        @endif
                                    ><a href="/view/product/{{$product->slug}}" title="{{$product->name}}">{{$product->name}}</a></li>
                                   @endforeach
                                </ul>


                            </li>

                            <li><a href="/about">ABOUT US</a>

                            <li><a href="/faq">FAQ</a>

                            </li>

                            <li><a href="/contact" title="">Contact us</a></li>
                            <a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary text-white" style="color: #fff">Register your Test</a>
                        </ul>
                    </div>
                    <!--/.navigation-->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">
                        Kindly Select the Test for registration</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px dotted #C2C2C2;">

                            <!-- Nav tabs -->
                            <div class="jumbotron jumbotron-fluid" style="padding: 20px">
                                <div class="row text-center sign-with">

                                    <div class="col-md-12">
                                        <img src="{{ url('/img/pcr.jpg') }}" height="50px" class="mb20"/>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-group btn-group-justified">
                                            <a href="{{ url('/register/test?type=pcr') }}" class="btn btn-primary">PCR Test</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <p style="font-size: 15px">Register your PCR test as guided by the Government</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="jumbotron jumbotron-fluid" style="padding: 20px">
                                <div class="row text-center sign-with">
                                    <div class="col-md-12">
                                        <img src="{{ url('/img/lateral_flow.jpeg') }}" height="50px" class="mb20"/>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-group btn-group-justified">
                                            <a href="#" disabled class="btn btn-primary">Literal Flow <br/> (coming soon)</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <p style="font-size: 15px">Register your Literal Flow test as guided by the Government</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @yield('content')
    <!--/.footer-->
    <div class="tiny-footer">
        <!--tiny-footer-->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>TheTestingLounge. All Rights Reserved. {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    <!--/.tiny-footer-->
    <!-- back to top icon -->
    <a href="#0" class="cd-top" title="Go to top">Top</a>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/menumaker.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/slider.js"></script>
    <!-- sticky header -->
    <script type="text/javascript" src="/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="/js/sticky-header.js"></script>

    <!-- Back to top script -->
    <script src="/js/back-to-top.js" type="text/javascript"></script>
    @yield('script')
</body>

</html>
