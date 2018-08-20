

<?php $__env->startSection('title', 'Video'); ?>

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Video</h3>
      <div class="pull-right">
        <a href="<?php echo e(route('video.create')); ?>" class="btn btn-sm btn-primary">
          <i class="fa fa-upload"></i>&nbsp;Upload Video
        </a>
      </div>
    </div>
    <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="videotabel">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($video) > 0): ?>
              <?php $__currentLoopData = $video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?></td>
                  <td><?php echo e($k->title); ?></td>
                  <td><?php echo e($k->status); ?></td>
                  <td>
                    <?php echo Form::model($video, ['url' => route('video.destroy',$k->slug), 'method' => 'delete', 'id' => 'formdelete']); ?>

                      <a href="<?php echo e(route('video.edit',$k->slug)); ?>" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>&nbsp;Edit
                      </a>&nbsp;
                      <a href="<?php echo e(route('video.show',$k->slug)); ?>" class="btn btn-xs btn-info">
                        <i class="fa fa-list"></i>&nbsp;Detail
                      </a>&nbsp;
                      <button type="submit" class="btn btn-xs btn-danger" id="confirm">
                        <i class="fa fa-trash"></i>&nbsp;Hapus
                      </button>
                    <?php echo Form::close(); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="4">Tidak Ada Data</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-js'); ?>
  <script type="text/javascript">
    $(function() {
      $('#videotabel').DataTable({'pageLength': 10, columnDefs: [{orderable: false, targets:[3]}]});
      $('#videotabel').find('td[colspan=4]').css('text-align','center');
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>