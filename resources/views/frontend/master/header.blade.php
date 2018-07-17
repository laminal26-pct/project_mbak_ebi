<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

  <!-- Head BEGIN -->
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | RBC PEDADO</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="{{asset('assets/pages/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/owl.carousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/flexslider.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link href="{{asset('assets/pages/css/components.css')}}" rel="stylesheet">
    <link href="{{asset('assets/pages/css/slider.css')}}" rel="stylesheet">
    <link href="{{asset('assets/pages/css/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('assets/corporate/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/pages/css/portfolio.css')}}" rel="stylesheet">
    <link href="{{asset('assets/corporate/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('assets/corporate/css/themes/turquoise.css')}}" rel="stylesheet" id="style-color">
    <link href="{{asset('assets/corporate/css/custom.css')}}" rel="stylesheet">
    <!-- Theme styles END -->
    <style>
      .main {
        min-height: 455px;
      }
    </style>
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <!-- Head END -->


    <!-- Body BEGIN -->
    <body class="corporate">

      <!-- BEGIN HEADER -->
      <div class="header">
          <div class="container">
            <a class="site-logo" href="{{ route('homepage') }}"><img src="{{url('kampungpedado.png')}}" alt="Metronic FrontEnd" style="width: 200px;"></a>

            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

            @include('frontend.master.navigation')
          </div>
      </div>
      <!-- Header END -->
