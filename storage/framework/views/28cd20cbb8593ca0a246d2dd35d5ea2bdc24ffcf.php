<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

  <!-- Head BEGIN -->
  <head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title'); ?> | RBC PEDADO</title>

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
    <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="<?php echo e(asset('assets/pages/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/fancybox/source/jquery.fancybox.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/owl.carousel/assets/owl.carousel.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/flexslider.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/uniform/css/uniform.default.css')); ?>" rel="stylesheet" type="text/css">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link href="<?php echo e(asset('assets/pages/css/components.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/pages/css/slider.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/pages/css/gallery.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/corporate/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/pages/css/portfolio.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/corporate/css/style-responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/corporate/css/themes/turquoise.css')); ?>" rel="stylesheet" id="style-color">
    <link href="<?php echo e(asset('assets/corporate/css/custom.css')); ?>" rel="stylesheet">
    <!-- Theme styles END -->
    <style>
      .main {
        min-height: 455px;
      }
    </style>
    <?php echo $__env->yieldContent('css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
    <style class="cp-pen-styles">
        /*
          Player Skin Designer for Video.js
          http://videojs.com

          To customize the player skin edit
          the CSS below. Click "details"
          below to add comments or questions.
          This file uses some SCSS. Learn more
          at http://sass-lang.com/guide)

          This designer can be linked to at:
          https://codepen.io/heff/pen/EarCt/left/?editors=010
        */

        // The following are SCSS variables to automate some of the values.
        // But don't feel limited by them. Change/replace whatever you want.

        // The color of icons, text, and the big play button border.
        // Try changing to #0f0
        $primary-foreground-color: #fff; // #fff default

        // The default color of control backgrounds is mostly black but with a little
        // bit of blue so it can still be seen on all-black video frames, which are common.
        // Try changing to #900
        $primary-background-color: #2B333F;  // #2B333F default

        // Try changing to true
        $center-big-play-button: false; // true default

        .video-js {
          /* The base font size controls the size of everything, not just text.
             All dimensions use em-based sizes so that the scale along with the font size.
             Try increasing it to 15px and see what happens. */
          font-size: 10px;

          /* The main font color changes the ICON COLORS as well as the text */
          color: $primary-foreground-color;
        }

        /* The "Big Play Button" is the play button that shows before the video plays.
           To center it set the align values to center and middle. The typical location
           of the button is the center, but there is trend towards moving it to a corner
           where it gets out of the way of valuable content in the poster image.*/
        .vjs-default-skin .vjs-big-play-button {
          /* The font size is what makes the big play button...big.
             All width/height values use ems, which are a multiple of the font size.
             If the .video-js font-size is 10px, then 3em equals 30px.*/
          font-size: 3em;

          /* We're using SCSS vars here because the values are used in multiple places.
             Now that font size is set, the following em values will be a multiple of the
             new font size. If the font-size is 3em (30px), then setting any of
             the following values to 3em would equal 30px. 3 * font-size. */
          $big-play-width: 3em;
          /* 1.5em = 45px default */
          $big-play-height: 1.5em;

          line-height: $big-play-height;
          height: $big-play-height;
          width: $big-play-width;

          /* 0.06666em = 2px default */
          border: 0.06666em solid $primary-foreground-color;
          /* 0.3em = 9px default */
          border-radius: 0.3em;

          if $center-big-play-button {
            /* Align center */
            left: 50%;
            top: 50%;
            margin-left: -($big-play-width / 2);
            margin-top: -($big-play-height / 2);
          } else {
            /* Align top left. 0.5em = 15px default */
            left: 0.5em;
            top: 0.5em;
          }
        }

        /* The default color of control backgrounds is mostly black but with a little
           bit of blue so it can still be seen on all-black video frames, which are common. */
        .video-js .vjs-control-bar,
        .video-js .vjs-big-play-button,
        .video-js .vjs-menu-button .vjs-menu-content {
          /* IE8 - has no alpha support */
          background-color: $primary-background-color;
          /* Opacity: 1.0 = 100%, 0.0 = 0% */
          background-color: rgba($primary-background-color, 0.7);
        }

        // Make a slightly lighter version of the main background
        // for the slider background.
        $slider-bg-color: lighten($primary-background-color, 33%);

        /* Slider - used for Volume bar and Progress bar */
        .video-js .vjs-slider {
          background-color: $slider-bg-color;
          background-color: rgba($slider-bg-color, 0.5);
        }

        /* The slider bar color is used for the progress bar and the volume bar
           (the first two can be removed after a fix that's coming) */
        .video-js .vjs-volume-level,
        .video-js .vjs-play-progress,
        .video-js .vjs-slider-bar {
          background: $primary-foreground-color;
        }

        /* The main progress bar also has a bar that shows how much has been loaded. */
        .video-js .vjs-load-progress {
          /* For IE8 we'll lighten the color */
          background: lighten($slider-bg-color, 25%);
          /* Otherwise we'll rely on stacked opacities */
          background: rgba($slider-bg-color, 0.5);
        }

        /* The load progress bar also has internal divs that represent
           smaller disconnected loaded time ranges */
        .video-js .vjs-load-progress div {
          /* For IE8 we'll lighten the color */
          background: lighten($slider-bg-color, 50%);
          /* Otherwise we'll rely on stacked opacities */
          background: rgba($slider-bg-color, 0.75);
        }
    </style>
    
  </head>
  <!-- Head END -->


    <!-- Body BEGIN -->
    <body class="corporate">

      <!-- BEGIN HEADER -->
      <div class="header">
          <div class="container">
            <a class="site-logo" href="<?php echo e(route('homepage')); ?>"><img src="<?php echo e(url('kampungpedado.png')); ?>" alt="Metronic FrontEnd" style="width: 200px;"></a>

            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

            <?php echo $__env->make('frontend.master.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
      </div>
      <!-- Header END -->
