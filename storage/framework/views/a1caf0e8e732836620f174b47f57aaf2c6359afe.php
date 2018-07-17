<?php if(Auth::user()->hasRole('superadmin')): ?>
  <?php $__env->startSection('title', 'Super Admin'); ?>
  
<?php else: ?>
  <?php $__env->startSection('title', 'Administrator'); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
  <?php if(Auth::user()->hasRole('superadmin')): ?>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo e(count($order)); ?></h3>
            <p>Order Baru</p>
            <br>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <a href="<?php echo e(route('order.index')); ?>" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo e(count($konfir)); ?></h3>
            <p>Konfirmasi <br>Pembayaran</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
          <a href="<?php echo e(route('konfirmasi.index')); ?>" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo e(count($user)); ?></h3>
            <p>Pengguna <br>Dashboard</p>
          </div>
          <div class="icon">
            <i class="fa fa-dashboard"></i>
          </div>
          <a href="<?php echo e(route('pengguna.index')); ?>" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo e(count($produk)); ?></h3>
            <p>Jumlah Produk</p>
            <br>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo e(route('produk.index')); ?>" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Orderan Terakhir</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Kode Order</th>
                    <th>Pembayaran</th>
                    <th>Pengiriman</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($order) > 0): ?>
                    <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><a href="<?php echo e(route('order.show',$k->kode_order)); ?>"><?php echo e($k->kode_order); ?></a></td>
                        <td><span class="label label-danger"><?php echo e($k->status_pembayaran); ?></span></td>
                        <td><span class="label label-warning"><?php echo e($k->status_pengiriman); ?></span></td>
                        <td><?php echo e(date('d M Y', strtotime($k->created_at))); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4" class="text-center">Belum Ada Order Terbaru</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <a href="<?php echo e(route('order.index')); ?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua Order</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(count($pro)); ?> Produk yang terakhir bulan <?php echo e(date('m Y',strtotime('now'))); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <?php if(count($pro) > 0): ?>
                <?php $__currentLoopData = $pro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo e(asset($k->images)); ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="<?php echo e(route('produk.show',$k->produk_id)); ?>" class="product-title"><?php echo e($k->title); ?>

                        <span class="label label-warning pull-right">Rp. <?php echo e(number_format($k->harga,0,",",".")); ?></span>
                      </a>
                      <span class="product-description">
                        <?php echo strip_tags(substr($k->description,0,50)); ?>

                      </span>
                    </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                <li class="item">
                  <h4>Tidak Ada Produk Baru Bulan <?php echo e(date('m', strtotime('now'))); ?></h4>
                </li>
              <?php endif; ?>
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="javascript:void(0)" class="uppercase">Lihat Semua Produk</a>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
    </div>
  <?php else: ?>
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        Welcome, <?php echo e(Auth::user()->name); ?>

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>