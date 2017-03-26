<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pak Auction') }}</title>

    <link href="{{ asset( "frontend/css/bootstrap.min.css" )}}" rel="stylesheet">

    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset( "frontend/js/html5shiv.js" )}}"></script>
    <script src="{{ asset( "frontend/js/respond.min.js" )}}"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yellowtail%7COpen%20Sans%3A400%2C300%2C600%2C700%2C800" media="screen" />
    <!-- Custom styles for this template -->
    <link href="{{ asset( "frontend/css/font-awesome.min.css" )}}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset( "frontend/css/flexslider.css" )}}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset( "frontend/css/jquery.bxslider.css" )}}" type="text/css" media="screen" />
    <link href="{{ asset( "frontend/css/jquery.fancybox.css" )}}" rel="stylesheet">
    <link href="{{ asset( "frontend/css/jquery.selectbox.css" )}}" rel="stylesheet">
    <link href="{{ asset( "frontend/css/style.css" )}}" rel="stylesheet">
    <link href="{{ asset( "frontend/css/mobile.css" )}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset( "frontend/css/settings.css" )}}" media="screen" />
    <link href="{{ asset( "frontend/css/animate.min.css" )}}" rel="stylesheet">
    <link href="{{ asset( "frontend/css/ts.css" )}}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset( "frontend/js/jquery.min.js" )}}"></script>
    <script src="{{ asset( "frontend/js/bootstrap.min.js" )}}"></script>
    <script type="text/javascript" src="{{ asset( "frontend/js/jquery.themepunch.tools.min.js" )}}"></script>
    <script type="text/javascript" src="{{ asset( "frontend/js/jquery.themepunch.revolution.min.js" )}}"></script>
    <script type="text/javascript" src="{{ asset( "frontend/js/wow.min.js" )}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key&amp;sensor=false"></script>

    <!-- END STYLESHEETS -->
    @yield('style')

    <script>
        window.Laravel =<?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body>

@include('layout.nav')

    @yield('content')

        @include('layout.footer')

<!-- BEGIN JAVASCRIPT -->
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
</script>
<script src="{{ asset( "frontend/js/retina.js" )}}"></script>
<script type="text/javascript" src="{{ asset( "frontend/js/jquery.parallax.js" )}}"></script>
<script type="text/javascript" src="{{ asset( "frontend/js/jquery.inview.min.js" )}}" )}}"></script>
<script src="{{ asset( "frontend/js/main.js" )}}"></script>
<script type="text/javascript" src="{{ asset( "frontend/js/jquery.fancybox.js" )}}"></script>
<script src="{{ asset( "frontend/js/modernizr.custom.js" )}}"></script>
<script defer src="{{ asset( "frontend/js/jquery.flexslider.js" )}}"></script>
<script src="{{ asset( "frontend/js/jquery.bxslider.js" )}}" type="text/javascript"></script>
<script src="{{ asset( "frontend/js/jquery.selectbox-0.2.js" )}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset( "frontend/js/jquery.mousewheel.js" )}}"></script>
<script type="text/javascript" src="{{ asset( "frontend/js/jquery.easing.js" )}}"></script>
<!-- END JAVASCRIPT -->
@yield('js')
@yield('after-js')
</body>
</html>
