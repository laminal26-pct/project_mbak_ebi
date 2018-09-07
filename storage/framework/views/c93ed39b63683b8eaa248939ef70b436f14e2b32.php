<?php $__env->startSection('title', 'Album'); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <a href="<?php echo e(route('albums.create')); ?>" class="btn btn-primary">Buat Album Baru</a>
      </div>
      <hr>
      <div class="row col-md-12">
        <?php if(count($album) > 0): ?>
          <?php $__currentLoopData = $album; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4">
              <div class="thumbnail" style="min-height: 150px;">
                <img alt="<?php echo e($k->name); ?>" src="<?php echo e(asset('/gallery/albums/'.$k->cover)); ?>" style=" height: 150px; width: 100%; max-height: 300px;">
                <div class="caption">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <h3><?php echo e($k->name); ?></h3>
                        </td>
                      </tr>
                      <tr>
                        <td><small>(<?php echo e(count($k->photos)); ?>) Foto. Tgl Buat : <?php echo e(date("d/m/Y",strtotime($k->created_at))); ?></small> </td>
                      </tr>
                      <tr>
                        <td><?php echo e($k->description); ?></td>
                      </tr>
                      <tr>
                        <td>
                          <?php echo Form::model($album, ['url' => route('albums.destroy',$k->album_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                            <a href="<?php echo e(route('albums.show',$k->album_id)); ?>" class="btn btn-big btn-default">Tampilkan Foto</a>
                            <button type="submit" class="btn btn-danger pull-right" id="confirm"><i class="fa fa-trash"></i></a>
                          <?php echo Form::close(); ?>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <h4 class="text-center">Tidak Ada Data</h4>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>