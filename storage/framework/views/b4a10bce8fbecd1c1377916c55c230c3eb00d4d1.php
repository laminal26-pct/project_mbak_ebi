<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <iframe src="<?php echo e(url('/laravel-filemanager?type=image')); ?>" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>