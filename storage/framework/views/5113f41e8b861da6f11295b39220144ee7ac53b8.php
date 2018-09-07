<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | <?php echo $__env->yieldContent('title'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/skins/_all-skins.min.css')); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <?php if(Auth::user()->hasRole('superadmin')): ?>
          <a href="<?php echo e(route('dashboard.admin')); ?>" class="logo">
        <?php else: ?>
          <a href="<?php echo e(route('dashboard.editor')); ?>" class="logo">
        <?php endif; ?>
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>K</b>PD</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Kampung</b> Pedado</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo e(url('uploads/avatar5.png')); ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo e(Auth::user()->name); ?> &nbsp; <i class="fa fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo e(url('uploads/avatar5.png')); ?>" class="img-circle" alt="User Image">

                    <p>
                      <?php echo e(config('app.name')); ?>

                      <small><?php echo e(Auth::user()->name); ?></small>
                      <?php if(Auth::user()->hasRole('superadmin')): ?>
                        <small>Level : Super Admin</small>
                      <?php else: ?>
                        <small>Level : Administrator</small>
                      <?php endif; ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php if(Auth::user()->hasRole('superadmin')): ?>
                        <a href="<?php echo e(route('admin.password.form')); ?>" class="btn btn-default btn-flat">Password</a>
                      <?php else: ?>
                        <a href="<?php echo e(route('editor.password.form')); ?>" class="btn btn-default btn-flat">Password</a>
                      <?php endif; ?>

                    </div>
                    <div class="pull-right">
                      <a id="logout" href="#" class="btn btn-default btn-flat">Sign out</a>
                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                      </form>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo e(url('uploads/avatar5.png')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo e(Auth::user()->name); ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <?php echo $__env->make('backend.master.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <?php echo $__env->yieldContent('breadcrumb'); ?>
          <!--
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
          -->
        </section>

        <!-- Main content -->
        <section class="content">

          <?php echo $__env->yieldContent('content'); ?>

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2018 <a href="#">Kampung Pedado</a>.</strong> All rights reserved.
      </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('assets/plugins/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo e(asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('assets/plugins/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/dist/js/adminlte.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('assets/dist/js/demo.js')); ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo e(asset('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
    <!-- Tinymce -->
    <script src="<?php echo e(asset('assets/plugins/tinymce/js/tinymce/jquery.tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/laravel-filemanager/js/lfm.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script type="text/javascript">
      function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
      }
      $(function() {
        $('#lfm').filemanager('image');
        $('#beritatable').DataTable({'pageLength': 25});
        $('#produktable').DataTable({'pageLength': 25});

        var editor_config = {
          path_absolute : "/",
          selector: "#description",
          plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
          relative_urls: false,
          file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no"
            });
          }
        };

      tinymce.init(editor_config);

        $('#logout').click(function(e) {
          e.preventDefault();
          $('#logout-form').submit();
        });
      });

      $(document).on('click','#confirm', function(e){
        e.preventDefault();
        var self = $(this);
        swal({
          title: "Anda Yakin ?",
          text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
              swal("Data telah dihapus", {
                icon: "success",
              });
              setTimeout(function() {
                self.parents('#formdelete').submit();
              }, 500);
            } else {
              swal("Data Aman");
            }
          });
      });
    </script>
    <?php echo $__env->make('backend.master.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('extra-js'); ?>
  </body>
</html>
