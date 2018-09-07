<?php $__env->startSection('title', 'Order Request'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Order</h3>
      <?php if(session()->has('success_message')): ?>
        <div class="col-md-12" style="margin: 10px 0 5px 0;">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
            <?php echo e(session()->get('success_message')); ?>

          </div>
        </div>
      <?php endif; ?>

      <?php if(session()->has('error_message')): ?>
        <div class="col-md-12" style="margin: 10px 0 5px 0;">
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
            <?php echo e(session()->get('error_message')); ?>

          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center; width: 150px;">Kode Transaksi</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center; width: 100px;">Kode Unik</th>
              <th style="text-align: center; width: 95px;">Tanggal</th>
              <th style="text-align: center;">Pembayaran</th>
              <th style="text-align: center;">Pengiriman</th>
              <th style="text-align: center; width: 125px;">Total</th>
              <th style="text-align: center; width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php ($i = 1); ?>
            <?php if(count($order) > 0): ?>
              <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?>.</td>
                  <td><span class="label label-default"><?php echo e($k->kode_order); ?></span></td>
                  <td><?php echo e($k->nama); ?></td>
                  <td><span class="label label-default"><?php echo e($k->kode_unik); ?></span></td>
                  <td><?php echo e(date('d-m-Y', strtotime($k->created_at))); ?></td>
                  <td>
                    <?php if($k->status_pembayaran == "Lunas"): ?>
                      <span class="label label-info"><?php echo e($k->status_pembayaran); ?></span>
                    <?php else: ?>
                      <span class="label label-danger"><?php echo e($k->status_pembayaran); ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($k->status_pengiriman == "Sampai"): ?>
                      <span class="label label-success"><?php echo e($k->status_pengiriman); ?></span>
                    <?php elseif($k->status_pengiriman == "Kemas"): ?>
                      <a href="<?php echo e(route('order.pengiriman.form',$k->kode_order)); ?>">Isi Form Pengiriman</a>
                    <?php elseif($k->status_pengiriman == "Kirim"): ?>
                      <?php echo e($k->status_pengiriman); ?>

                    <?php else: ?>
                      <?php if($k->status_pembayaran == "Belum Lunas"): ?>
                        <span class="label label-warning"><?php echo e($k->status_pengiriman); ?></span>
                      <?php else: ?>
                        <select class="kirim" name="pengiriman" data-id="<?php echo e($k->kode_order); ?>">
                          <option <?php echo e($k->status_pengiriman == "Proses" ? 'selected' : ''); ?>>Proses</option>
                          <option <?php echo e($k->status_pengiriman == "Kemas" ? 'selected' : ''); ?>>Kemas</option>
                        </select>
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>Rp. <b><?php echo e(number_format($k->total,0,",",".")); ?></b></td>
                  <td>
                    <?php echo Form::model($order, ['url' => route('order.destroy',$k->order_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                    <a href="<?php echo e(route('order.show',$k->kode_order)); ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    <?php echo Form::close(); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="8" style="text-align: center;">Tidak Ada Data</td>
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

<?php $__env->startSection('extra-js'); ?>
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.kirim').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '<?php echo e(url('dashboard/administrator/order/pengiriman')); ?>' + '/' + id,
                  data: {
                    'pengiriman': this.value,
                  },
                  success: function(data) {
                    window.location.href = '<?php echo e(route('order.index')); ?>';
                  }
                });

            });

            $('.form').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "GET",
                  url: '<?php echo e(url('dashboard/administrator/order/pengiriman/form')); ?>' + '/' + id,
                  data: {
                    'pengiriman': this.value,
                  },
                  success: function(data) {
                    window.location.href = '<?php echo e(url('dashboard/administrator/order/pengiriman/form')); ?>' + '/' + id;
                  }
                });

            });

        })();

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>