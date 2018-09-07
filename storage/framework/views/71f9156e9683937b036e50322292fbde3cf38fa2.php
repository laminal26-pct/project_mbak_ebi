<?php $__env->startSection('title', 'Kategori Berita'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Berita</h3>
      <div class="pull-right">
        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createCatModal">
          <i class="fa fa-plus"></i>&nbsp;Tambah Kategori
        </a>
      </div>
      <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="box-body">
      <div class="col-md-6">
        <table class="table table-bordered table-hover">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Kategori</th>
              <th style="width: 140px; text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($kat) > 0): ?>
              <?php $__currentLoopData = $kat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?>.</td>
                  <td><?php echo e($k->nama_kategori_berita); ?></td>
                  <td>
                    <?php echo Form::model($kat, ['url' => route('berita.kategori.delete',$k->kategori_berita_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                    <a href="<?php echo e(route('berita.kategori.edit',$k->kategori_berita_id)); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    <?php echo Form::close(); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="3" style="text-align: center;">Tidak Ada Data</td>
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