  <!-- BEGIN PRE-FOOTER -->
  <div class="pre-footer">
    <div class="container">
      <div class="row">
        <!-- BEGIN BOTTOM ABOUT BLOCK -->
        <div class="col-md-12 col-sm-12 pre-footer-col">
          <div class="photo-stream">
            <h2>Info Relawan</h2>
            <ul class="list-unstyled" id="relawan">
              <?php ($i = 1); ?>
              <?php if(count($relawan) > 0): ?>
                <?php $__currentLoopData = $relawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <input type="hidden" name="relawan" class="d" value="<?php echo e($k->slug); ?>">
                    <a href="#detailrelawan" data-toggle="modal" data-backdrop="static" title="<?php echo e($k->nama); ?>">
                      <img alt="" src="<?php echo e(asset($k->images)); ?>">
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <!-- END BOTTOM ABOUT BLOCK -->
      </div>
    </div>
  </div>
  <!-- END PRE-FOOTER -->

  <!-- BEGIN FOOTER -->
  <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-12 col-xs-12 padding-top-10">
            <p class="powered" style="text-align: center;">Powered by: <a href="https://www.kampungpedado.com">kampungpedado.com</a> 2018 &copy; Rumah Belajar Ceria Kampung Pedado Perdado. ALL Rights Reserved.</p>
          </div>
          <!-- END POWERED -->
        </div>
      </div>
    </div>
  <!-- END FOOTER -->

  <div class="modal fade" id="detailrelawan" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  				<h3 class="modal-title text-center">Info Relawan</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <img id="gambar">
            </div>
            <div class="col-md-6 col-xs-6">
              <table class="table" id="detailtabel"></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

      $('#relawan').find('a').click(function() {
        $('#detailrelawan').find('.modal-dialog').attr('style','margin-top: 75px;');
        $('#detailrelawan').find('.modal-content').attr('style','border-radius: 5px !important');
        $('#detailrelawan').find('.modal-body').css('overflow-x','auto');
        $this = $(this);
        $b = $('#detailrelawan').find('img');
        $b.eq(0).attr('style','width: 250px; height: 250px; border-radius: 125px !important');
        var slug = $this.parent().find('.d').val();
        $('#detailtabel').empty();
        $b.eq(0).attr('src','');
        $.ajax({
          url: '<?= url()->full()."/beranda/relawan/"; ?>'+slug,
          data: slug,
          type: 'GET',
          dataType: 'json',
          success: data => {
            if (data.message == "Not avaiable") {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
              });
            } else {
              $b.eq(0).attr('src','<?php echo e(url()->full()); ?>'+data.images);
              let tr_str = '';
              tr_str = "<tr>" +
                          "<td>Nama Relawan : </td>" +
                          "<td>"+data.nama+"</td>" +
                       "</tr>" +
                       "<tr>" +
                          "<td>Status Relawan : </td>" +
                          "<td>"+data.status+"</td>" +
                       "</tr>" +
                       "<tr>" +
                          "<td>Alamat Relawan : </td>" +
                          "<td>"+data.alamat+"</td>" +
                       "</tr>" +
                       "<tr>" +
                          "<td>Tahun Gabung : </td>" +
                          "<td>"+data.join+"</td>" +
                       "</tr>";
              $('#detailtabel').append("<tbody>"+tr_str+"</tbody>");
            }
          }
        });

      });
    }());
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
