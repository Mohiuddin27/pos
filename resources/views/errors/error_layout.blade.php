<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('error/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('error/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/metisMenu.css')}}">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('error/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('error/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('error/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
               @yield('error-content')
            </div>
        </div>
    </div>
    <!-- error area end -->

    <!-- jquery latest version -->
    <script src="{{asset('error/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('error/js/popper.min.js')}}"></script>
    <script src="{{asset('error/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('error/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('error/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('error/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('error/js/jquery.slicknav.min.js')}}"></script>
    <!-- others plugins -->
    <script src="{{asset('error/js/plugins.js')}}"></script>
    <script src="{{asset('error/js/scripts.js')}}"></script>
</body>

</html>