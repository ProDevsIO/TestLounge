<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ProDevs">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <title>UKTravel Tests | Admin</title>
    <link rel="icon" type="image/png" href="/img/favicon.png">

    <!--web fonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <!--bootstrap styles-->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--icon font-->
    <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/vendor/dashlab-icon/dashlab-icon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="/assets/vendor/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="/assets/vendor/weather-icons/css/weather-icons.min.css" rel="stylesheet">

    <!--jquery ui-->
    <link href="/assets/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!--iCheck-->
    <link href="/assets/vendor/icheck/skins/all.css" rel="stylesheet">

    <!--jqery steps-->
    <link href="/assets/vendor/jquery-steps/jquery.steps.css" rel="stylesheet">

    <!--custom styles-->
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/vendor/html5shiv.js"></script>
    <script src="/assets/vendor/respond.min.js"></script>
    <![endif]-->
    @yield('style')
</head>

<body class="left-sidebar-fixed">
<header class="app-header">
    <div class="branding-wrap">
        <!--left nav toggler start-->
        <a class="nav-link mt-2 float-left js_left-nav-toggler pos-fixed" href="javaScript:;">
            <i class=" ti-align-right"></i>
        </a>
        <!--left nav toggler end-->

        <!--brand start-->
        <div class="navbar-brand pos-fixed">
            <a class="" href="{{ url('/dashboard') }}">
                <img src="/img/logo-dark.png" style="height: 40px;" srcset="/img/logo-dark.png 2x" alt="UkTravelTest">
            </a>
        </div>
        <!--brand end-->
    </div>

    <!--header rightside links-->
    <ul class="header-links hide-arrow navbar">

       
        <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" id="userNav" href="#" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <div class="user-thumb">
                    <img class="rounded-circle" src="/assets/img/avatar/avatar2.jpeg" alt=""/>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userNav">
                <div class="dropdown-item- px-3 py-2">
                    <img class="rounded-circle mr-2" src="/assets/img/avatar/avatar2.jpeg" width="35" alt=""/>
                    <span class="text-muted">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                </div>
                <div class="dropdown-divider"></div>
                @if(auth()->user()->type == "2")
                      
                            <a class="dropdown-item" href="{{ url('/profile') }}" >
                                <span>Profile</span>
                            </a>
                       
                       
                      @endif
                <a class="dropdown-item" href="javascript:;"  onclick="signOut()">Sign Out</a>
            </div>
        </li>

    </ul>
    <!--/header rightside links-->
</header>

<div class="modal fade" id="referralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Referral</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-inline">
                <input type="text" class="form-control" value="{{ url('/booking?ref='.auth()->user()->referal_code) }}" id="myInput">
                <button onclick="copyText()" class="btn btn-primary">Copy Link</button></div>
                <p>Share on social media</p>
                <div id="share-buttons">

                    <!-- Email -->
                    <a href="mailto:?Subject=Uk Travel Test&amp;Body=Are%20you%20travelling%20to%20the%20UK,%20Book%20your%20travel%20test%20here,follow%20this%20link: {{ url('/booking?ref='.auth()->user()->referal_code) }}">
                        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email"/>
                    </a>

                    <!-- Facebook -->
                    <a href="http://www.facebook.com/sharer.php?u={{ url('/booking?ref='.auth()->user()->referal_code) }}" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook"/>
                    </a>

                    <!-- LinkedIn -->
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url('/booking?ref='.auth()->user()->referal_code) }}"
                       target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn"/>
                    </a>

                    <a style="background: #12d012;border-radius: 130px;padding: 20px 10px;" href="whatsapp://send?text=Are you travelling to the UK, Book your travel test here,follow this link: {{ url('/booking?ref='.auth()->user()->referal_code) }}"
                       target="_blank">
                        <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg" alt="Whatsapp" style="height: 35px;"/>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="app-body">
    <!--left sidebar start-->
    <div class="left-nav-wrap">
        <div class="left-sidebar">
            <nav class="sidebar-menu">
                <ul id="nav-accordion">
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <i class=" ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class=" icon-speech"></i>
                            <span>Bookings</span>
                        </a>
                        <ul class="sub">

                            <li><a href="{{ url('/pending/booking') }}">Unpaid Bookings</a></li>
                            <li><a href="{{ url('complete/booking') }}">Paid Bookings</a></li>
                            @if(auth()->user()->type == "1")
                            <li><a href="{{ url('/view/agent/booking') }}">Agent Bookings</a></li>
                            <li><a href="{{ url('/view/individual/booking') }}">Individual Bookings</a></li>
                            @endif
                        </ul>
                    </li>
                    <!-- <li>
                      <a href="{{ url('/view/subagent') }}">
                            <i class="icon-calculator"></i>
                            <span>Sub agents</span>
                        </a>
                    </li> -->
                    @if(auth()->user()->type == "2")
                   <li>
                      <a href="{{ url('/user/bank') }}">
                            <i class="icon-calculator"></i>
                            <span>Payment Settings</span>
                        </a>
                    </li>
                    
                    @endif
                    @if(auth()->user()->type == "1")
                    <li>
                      <a href="{{ url('/colors') }}">
                            <i class=" icon-grid"></i>
                            <span>Color zones</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/vendors') }}">
                            <i class=" icon-grid"></i>
                            <span>Vendors</span>
                        </a>
                    </li>

                        <li>
                            <a href="{{ url('/products') }}">
                                <i class="icon-basket-loaded"></i>
                                <span>Products</span>
                            </a>
                        </li>

                    <li>
                        <a href="{{ url('/users') }}">
                            <i class=" ti-pie-chart"></i>
                            <span>Users/Referrals</span>
                        </a>
                    </li>
                        <li>
                            <a href="{{ url('/finance/report') }}">
                                <i class="ti-receipt"></i>
                                <span>Financial Report</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/settings') }}">
                                <i class="icon-settings"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        @endif
                       
                        
                </ul>
            </nav>
        </div>
    </div>
    <!--left sidebar end-->
    <!--main content wrapper-->

    @yield('content')
</div>

<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/vendor/popper.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/vendor/jquery.dcjqaccordion.2.7.js"></script>
<script src="/assets/vendor/icheck/skins/icheck.min.js"></script>
<script src="/assets/vendor/jquery.nicescroll.min.js"></script>
<!--jquery validate-->
<script src="/assets/vendor/jquery-validation/jquery.validate.min.js"></script>

<!--jquery steps-->
<script src="/assets/vendor/jquery-steps/jquery.steps.min.js"></script>
<!--init steps-->
<script src="/assets/vendor/js-init/init-form-wizard.js"></script>

<!--jquery stepy-->
<script src="/assets/vendor/jquery-steps/jquery.stepy.js"></script>

<!--[if lt IE 9]>
<script src="/assets/vendor/modernizr.js"></script>
<![endif]-->

<!--basic scripts initialization-->
<script src="/assets/js/scripts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@yield('script')
<script>
    function copyText() {
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        toastr.success("Success", 'Link has been copied successfully')
    }
    function signOut() {
            
            var d = confirm("Are you sure, you want to sign out?");

            if (d) {
                
                window.location = "/logout";
            }
        }
</script>
</body>
</html>
