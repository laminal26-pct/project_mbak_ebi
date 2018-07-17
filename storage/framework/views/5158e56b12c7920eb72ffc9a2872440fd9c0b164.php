<?php $__env->startSection('title', 'Daftar Produk'); ?>



<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Produk</h3>
      <div class="pull-right">
        <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i>&nbsp;Tambah Produk
        </a>
      </div>
      <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Produk</th>
              <th style="text-align: center; width: 150px;">Harga</th>
              <th style="text-align: center; width: 70px;">Stock</th>
              <th style="text-align: center;">Kategori</th>
              <th style="text-align: center; width: 210px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($product) > 0): ?>
              <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?>.</td>
                  <td><?php echo e($k->title); ?></td>
                  <td>Rp. <?php echo e(number_format($k->harga,0,",",".")); ?></td>
                  <td><?php echo e(number_format($k->stock,0,",",".")); ?></td>
                  <td><?php echo e($k->nama_kategori_produk); ?></td>
                  <td>
                    <?php echo Form::model($product, ['url' => route('produk.destroy',$k->produk_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                    <a href="<?php echo e(route('produk.edit',$k->produk_id)); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="<?php echo e(route('produk.show',$k->produk_id)); ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    <?php echo Form::close(); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
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