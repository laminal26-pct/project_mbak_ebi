<?php $__env->startSection('title', 'Detail Relawan'); ?>

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Relawan bernama : <?php echo e($relawan->nama); ?></h3>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo e(asset($relawan->images)); ?>" alt="" style="width: 250px; height: 250px; border-radius: 125px !important;">
          </div>
          <div class="col-md-6">
            <table class="table">
              <tbody>
                <tr>
                  <td>Nama Relawan : <?php echo e($relawan->nama); ?></td>
                </tr>
                <tr>
                  <td>Status Relawan : <?php echo e($relawan->status); ?></td>
                </tr>
                <tr>
                  <td>Tahun Bergabung : <?php echo e($relawan->joined); ?></td>
                </tr>
                <tr>
                  <td>Alamat Relawan : <?php echo e($relawan->alamat); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>