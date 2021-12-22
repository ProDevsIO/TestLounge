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
    <link rel="icon" type="image/png" href="/images/logo1.png">
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
                        <a href="index.html"><img src="/images/logo.png" alt="" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="navigation">
                        <!--navigation-->
                        <ul>
                            <li><a href="/" title="Home page">Home</a></li>
                            <li><a href="https://testlounge.prodevs.io/RBS" title="Test">Covid-19 Testing</a>
                                <!-- <ul>
                                    @foreach($products as $product)
                                    <li><a href="/view/product/{{$product->slug}}" title="{{$product->name}}">{{$product->name}}</a></li>  
                                   @endforeach
                                </ul> -->
                            
                                
                            
                            </li>

                            <li><a href="/about">ABOUT US</a>
                            
                            <li><a href="/faq">FAQ</a>
                        
                            </li>
                            
                            <li><a href="/contact" title="">Contact us</a></li>
                            <li><a href="/login" title="">Login</a></li>
                             <!-- <li><a href="/register/agent" title="">Register</a></li> -->
                        </ul>
                    </div>
                    <!--/.navigation-->
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
                    <p>TheTestingLounge. All Rights Reserved. 2021</p>
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
    <!-- location -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="/js/location.js"></script>
    <!-- Back to top script -->
    <script src="/js/back-to-top.js" type="text/javascript"></script>
    @yield('script')
</body>

</html>
