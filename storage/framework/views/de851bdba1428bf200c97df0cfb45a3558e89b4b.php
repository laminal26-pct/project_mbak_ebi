<?php $__env->startSection('title', 'Manajemen Website'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Manajemen Website</h3>
      <div class="pull-right">
        <?php if(count($web) < 8): ?>
          <a href="<?php echo e(route('konfig-web.create')); ?>" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Data
          </a>
        <?php endif; ?>
      </div>
      <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Web</th>
              <th style="text-align: center;">Kategori</th>
              <th style="text-align: center; width: 220px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($web) > 0): ?>
              <?php $__currentLoopData = $web; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?>.</td>
                  <td><?php echo e($k->nama_web); ?></td>
                  <td><?php echo e($k->kategori_website); ?></td>
                  <td>
                    <a href="<?php echo e(route('konfig-web.edit',$k->website_id)); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="<?php echo e(route('konfig-web.show',$k->website_id)); ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a>

                    
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>