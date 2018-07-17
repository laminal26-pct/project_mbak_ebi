<?php $__env->startSection('title','Home'); ?>

<?php $__env->startSection('slideshows'); ?>
  <!-- BEGIN SLIDER -->
  <div class="page-slider margin-bottom-40" style="">
    <div class="flexslider">
      <ul class="slides">
        <?php if(count($slide) > 0): ?>
          <?php $__currentLoopData = $slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="background-image: url(<?php echo asset($key->images); ?>)">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="kotak text-center">
                      <h2 class="animate-delay text-uppercase" data-animation="animated fadeInDown" style="color: #f6f6f6;">
                        <?php echo e($key->title); ?>

                      </h2>
                      <a href="<?php echo e(route('berita.detail',$key->slug)); ?>" class="btn btn-sm btn-primary" data-animation="animated fadeInUp">Baca Lebih...</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <li style="background-image: url(<?php echo asset('assets/pages/img/frontend-slider/bg9.jpg'); ?>)">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="kotak text-center">
                    <h2 class="animate-delay text-uppercase" data-animation="animated fadeInDown">
                      Need a website design 1 ?
                    </h2>
                    <a href="#" class="btn btn-sm btn-primary" data-animation="animated fadeInUp">Read More...</a>
                  </div>
                </div>
              </div>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <!-- END SLIDER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Berita</h1>
          <div class="content-page">
            <div class="row">
              <!-- BEGIN LEFT SIDEBAR -->
              <div class="col-md-9 col-sm-9 blog-posts">
                <?php if(count($news)): ?>
                  <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                      <div class="col-md-4 col-sm-4">
                        <img class="img-responsive" alt="" src="<?php echo e(asset($key->images)); ?>">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <h2><a href="<?php echo e(route('berita.detail',$key->slug)); ?>"><?php echo e($key->title); ?></a></h2>
                        <ul class="blog-info">
                          <li><i class="fa fa-calendar"></i>&nbsp;<?php echo e(date('d/F/Y', strtotime($key->created_at))); ?></li>
                          <li><i class="fa fa-tags"></i>&nbsp;<?php echo e($key->nama_kategori_berita); ?></li>
                        </ul>
                        <div style="text-align: justify">
                          <?php echo strip_tags(substr($key->description,0,450)); ?>

                          <a href="<?php echo e(route('berita.detail',$key->slug)); ?>" class="more">Baca Lebih <i class="icon-angle-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <hr class="blog-post-sep">
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php echo $news->render(); ?>

                <?php else: ?>
                  <h3>Tidak Ada Postingan</h3>
                  <hr class="blog-post-sep">
                <?php endif; ?>
              </div>
              <!-- END LEFT SIDEBAR -->

              <!-- BEGIN RIGHT SIDEBAR -->
              <div class="col-md-3 col-sm-3 blog-sidebar">
                <!-- CATEGORIES START -->
                <h2 class="no-top-space">Kategori</h2>
                <ul class="nav sidebar-categories margin-bottom-40">
                  <?php if(count($kategori)): ?>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><a href="<?php echo e(route('berita.kategori',$key->nama_kategori_berita)); ?>"><?php echo e($key->nama_kategori_berita); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <li>Tidak Ada Kategori</li>
                  <?php endif; ?>
                </ul>
                <!-- CATEGORIES END -->

              </div>
              <!-- END RIGHT SIDEBAR -->
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>