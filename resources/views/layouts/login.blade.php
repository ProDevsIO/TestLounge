<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Traveltestsltd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="TheTestingLounge | The number one place to get all your test done in the UK" name="description"/>
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

</head>

<body class="loading authentication-bg authentication-bg-pattern">


@yield('content')

@yield('script')
<footer class="footer footer-alt text-white-50">
   <script>document.write(new Date().getFullYear())</script> &copy; Copyright by <a href="" class="text-white-50">TheTestingLounge</a>
</footer>

<!-- Vendor js -->
<script src="/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.min.js"></script>

</body>
</html>

