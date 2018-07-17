
  <!-- BEGIN FOOTER -->
  <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-12 col-xs-12 padding-top-10">
            <p class="powered" style="text-align: center;">Powered by: <a href="http://www.keenthemes.com/">kampungpedado.com</a> 2018 &copy; Rumah Belajar Jamur & Perdado. ALL Rights Reserved.</p>
          </div>
          <!-- END POWERED -->
        </div>
      </div>
    </div>
  <!-- END FOOTER -->
  </body>
  <!-- END BODY -->

  <!-- Load javascripts at bottom, this will reduce page load time -->
  <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
  <!--[if lt IE 9]>
  <script src="<?php echo e(asset('assets/plugins/respond.min.js')); ?>"></script>
  <![endif]-->
  <script src="<?php echo e(asset('assets/plugins/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/jquery-migrate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/corporate/scripts/back-to-top.js')); ?>"></script>
  <!-- END CORE PLUGINS -->
  <?php echo $__env->yieldContent('js'); ?>
  <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
  <script src="<?php echo e(asset('assets/plugins/fancybox/source/jquery.fancybox.pack.js')); ?>"></script><!-- pop up -->
  <script src="<?php echo e(asset('assets/plugins/owl.carousel/owl.carousel.min.js')); ?>"></script><!-- slider for products -->
  <script src="<?php echo e(asset('assets/plugins/jquery.flexslider-min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/jquery-mixitup/jquery.mixitup.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/corporate/scripts/layout.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/pages/scripts/bs-carousel.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/pages/scripts/portfolio.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
  
  <script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        Layout.initUniform();
        Portfolio.init();
        Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
        Layout.initNavScrolling();
    });
  </script>
  <script type="text/javascript">
    ;(function() {
      var sliderMain = function() {
        $('.page-slider .flexslider').flexslider({
          animation: "fade",
          loop: true,
          slideshowSpeed: 5000,
          directionNav: false,
          start: function(){
            setTimeout(function(){}, 500);
          },
          before: function(){
            setTimeout(function(){}, 500);
          }
        });
      };
      $(function() {
        sliderMain();
      });
    }());
  </script>
  <script type="text/javascript">
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    }
  </script>
  <?php echo $__env->yieldContent('extra-js'); ?>
  <!-- END PAGE LEVEL JAVASCRIPTS -->

</html>
