<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>TheTestingLounge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin for TheTestinglounge" name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css -->
    <link href="/assets/css/config/modern/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="/assets/css/config/modern/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet"/>

    <link href="/assets/css/config/modern/bootstrap-dark.min.css" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet"/>
    <link href="/assets/css/config/modern/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"/>

    <!-- icons -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    @yield('style')
</head>

<!-- body start -->
<body class="loading" data-layout-mode="detached"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

<div id="wrapper">
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-end mb-0">


                <li class="dropdown d-none d-lg-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                       href="#">
                        <i class="fe-maximize noti-icon"></i>
                    </a>
                </li>


                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="/assets/images/users/user-6.jpeg" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                        {{ auth()->user()->first_name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">
                                Welcome {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</h6>
                            @if(auth()->user()->type == 1)
                                <span class="text-muted" style="padding-left:50px">Role: Admin</span>
                            @elseif(auth()->user()->vendor_id != 0)
                                <span class="text-muted " style="padding-left:50px">Role: Vendor</span>

                            @elseif(auth()->user()->type == 2)
                                @if(auth()->user()->main_agent_id == null)
                                    <span class="text-muted " style="padding-left:50px">Role: Super Agent</span>
                                @else
                                    <span class="text-muted" style="padding-left:50px">Role: Sub Agent</span>
                                @endif
                            @endif
                        </div>
                        @if(auth()->user()->type == "2")

                            <a class="dropdown-item notify-item" href="{{ url('/profile') }}">
                                <span>Profile</span>
                            </a>


                        @endif
                        <a class="dropdown-item notify-item" href="javascript:;" onclick="signOut()">Sign Out</a>

                    </div>
                </li>


            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="/images/logo1.png" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                    <span class="logo-lg">
                    <img src="/images/logo.png" alt="" height="20">
                        <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="/images/logo1.png" alt="" height="22">
                </span>
                    <span class="logo-lg">
                    <img src="/images/logo.png" alt="" height="20">
                </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="dropdown d-none d-xl-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#"
                       role="button" aria-haspopup="false" aria-expanded="false">
                        Quick Links
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- item-->
                        <a href="/vendors" class="dropdown-item">
                            <i class="fe-briefcase me-1"></i>
                            <span>Vendors</span>
                        </a>

                        <!-- item-->
                        <a href="/finance/report" class="dropdown-item">
                            <i class="fe-user me-1"></i>
                            <span>Financial Report</span>
                        </a>

                        <a href="/validate/test" class="dropdown-item">
                            <i class="fe-radio me-1"></i>
                            <span>Validate Result</span>
                        </a>




                    </div>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="left-side-menu">

        <div class="h-100" data-simplebar>
            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <i class=" ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="#sidebarExpages" data-bs-toggle="collapse">
                            <i class=" icon-speech"></i>
                            <span>Bookings</span>
                        </a>
                        <div class="collapse" id="sidebarExpages">
                            <ul class="nav-second-level">

                                <li><a href="{{ url('/pending/booking') }}">Unpaid Bookings</a></li>
                                <li><a href="{{ url('complete/booking') }}">Paid Bookings</a></li>

                            </ul>
                        </div>
                    </li>

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
                            <a href="{{ url('/vendors') }}">
                                <i class=" icon-grid"></i>
                                <span>Vendors</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/validate/test') }}">
                                <i class="icon-refresh"></i>
                                <span>Validate test</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/products') }}">
                                <i class="icon-basket-loaded"></i>
                                <span>Products</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/admins') }}">
                                <i class=" ti-pie-chart"></i>
                                <span>Admins</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/finance/report') }}">
                                <i class="ti-receipt"></i>
                                <span>Financial Report</span>
                            </a>
                        </li>

                    @endif

                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>

    <!--left sidebar end-->
    <!--main content wrapper-->
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>

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
                    <input type="text" style="width: 75%" class="form-control"
                           value="{{ url('/?ref='.auth()->user()->referal_code) }}" id="myInput">
                    <button onclick="copyText()" class="btn btn-primary">Copy Link</button>
                </div>

                <div class="barcode text-center m-3">
                    <img src="{{ getMyRefBarcode() }}" alt="" class="img-fluid" width="200">
                </div>

                <p>Share on social media</p>
                <div id="share-buttons">

                    <!-- Email -->
                    <a href="mailto:?Subject=Uk Travel Test&amp;Body=Are%20you%20travelling%20to%20the%20UK,%20Book%20your%20travel%20test%20here,follow%20this%20link: {{ url('/booking?ref='.auth()->user()->referal_code) }}">
                        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email"
                             style="height: 50px; width: 50px;"/>
                    </a>

                    <!-- Facebook -->
                    <a href="http://www.facebook.com/sharer.php?u={{ url('/?ref='.auth()->user()->referal_code) }}"
                       target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook"
                             style="height: 50px; width: 50px;"/>
                    </a>

                    <!-- LinkedIn -->
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url('/?ref='.auth()->user()->referal_code) }}"
                       target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn"
                             style="height: 50px; width: 50px;"/>
                    </a>

                    <a href="whatsapp://send?text=Are you travelling to the UK, Book your travel test here,follow this link: {{ url('/?ref='.auth()->user()->referal_code) }}"
                       target="_blank">
                        <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg" alt="Whatsapp" style="
                        height: 50px;
                        width: 50px;
                        background: #12d012;
                        border-radius: 100px;
                        padding: 5px;"/>
                    </a>
                </div>
                <br/>
                <div class=" alert alert-warning">
                    @if(auth()->user()->agent_show_name == 0)
                        If you would like company name to show on the booking page through the referral link, Kindly
                        click the button to enable it.
                        <a class="btn btn-md btn-success text-white" href="javascript:;"
                           onclick="enable(' {{auth()->user()->id}}')">Enable</a>
                    @else
                        If you would like company name not to show on the booking page through the referral link,
                        Kindly click the button to disable it.
                        <a href="javascript:;" class="btn btn-md btn-warning  text-white"
                           onclick="disable('{{auth()->user()->id}}')">Disable</a>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="rightbar-overlay"></div>

<script src="/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@yield('script')
<script>
       window.setTimeout("closeAlertDiv();", 7000);

        function closeAlertDiv() {
            if(document.getElementById("alertdiv")){
                document.getElementById("alertdiv").style.display = " none";
            }
        }
        
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

        var d = confirm("Are you sure you want to sign out?");

        if (d) {

            window.location = "/logout";
        }
    }
</script>
</body>
</html>
