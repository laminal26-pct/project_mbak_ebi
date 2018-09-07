<?php $__env->startSection('title', 'Daftar Relawan'); ?>

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Relawan</h3>
      <div class="pull-right">
        <a href="<?php echo e(route('info-relawan.create')); ?>" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i>&nbsp;Tambah Relawan
        </a>
      </div>
    </div>
    <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="relawantable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($relawan) > 0): ?>
              <?php $__currentLoopData = $relawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?>.</td>
                  <td><?php echo e($k->nama); ?></td>
                  <td><?php echo e($k->status); ?></td>
                  <td>
                    <?php echo Form::model($relawan, ['url' => route('info-relawan.destroy',$k->slug), 'method' => 'delete', 'id' => 'formdelete']); ?>

                      <a href="<?php echo e(route('info-relawan.edit',$k->slug)); ?>" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>&nbsp;Edit
                      </a>&nbsp;
                      <a href="<?php echo e(route('info-relawan.show',$k->slug)); ?>" class="btn btn-xs btn-info">
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
      $('#relawantable').DataTable({'pageLength': 25, columnDefs: [{orderable: false, targets:[3]}]});
      $('#relawantable').find('thead tr').addClass('text-red');
      $('#relawantable').find('thead tr th').css('text-align','center');
      $('#relawantable').find('tbody tr td:nth-child(3)').css('text-align','center');
      $('#relawantable').find('tbody tr td:nth-child(4)').css('text-align','center');
      $('#relawantable').find('thead tr th:nth-child(1)').css('width','30px');
      $('#relawantable').find('thead tr th:nth-child(2)').css('width','275px');
      $('#relawantable').find('thead tr th:nth-child(3)').css('width','40px');
      $('#relawantable').find('thead tr th:nth-child(4)').css('width','90px');
      $('#relawantable').find('td[colspan=4]').css('text-align','center');
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>