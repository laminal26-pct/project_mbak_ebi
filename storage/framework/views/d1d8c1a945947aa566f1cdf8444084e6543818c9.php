<?php $__env->startSection('title', 'Konfirmasi Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Konfirmasi Pembayaran</h3>
      <?php if(session()->has('success_message')): ?>
          <div class="alert alert-success">
              <?php echo e(session()->get('success_message')); ?>

          </div>
      <?php endif; ?>

      <?php if(session()->has('error_message')): ?>
          <div class="alert alert-danger">
              <?php echo e(session()->get('error_message')); ?>

          </div>
      <?php endif; ?>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="beritatable">
            <thead style="background-color: #ccc; color: #222;">
              <tr>
                <th style="width: 50px; text-align: center;">No.</th>
                <th style="text-align: center;">Kode Transaksi</th>
                <th style="text-align: center;">Transfer Bank</th>
                <th style="text-align: center;">Bukti Pembayaran</th>
                <th style="text-align: center;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php ($i = 1); ?>
              <?php if(count($konfir) > 0): ?>
                <?php $__currentLoopData = $konfir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($i++); ?>.</td>
                    <td><?php echo e($k->kode_order); ?></td>
                    <td><?php echo e($k->nama_bank); ?></td>
                    <td><a href="<?php echo e(route('konfirmasi.show',$k->bayar_id)); ?>">Lihat</a></td>
                    <td>
                      <?php if($k->status_pembayaran == "Belum Lunas"): ?>
                        <select class="bayar" name="pembayaran" data-id="<?php echo e($k->kode_order); ?>">
                          <option <?php echo e($k->status_pembayaran == "Belum Lunas" ? 'selected' : ''); ?>>Belum Bayar</option>
                          <option value="Lunas">Lunas</option>
                        </select>
                      <?php else: ?>
                        <span class="label label-success"><?php echo e($k->status_pembayaran); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
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

            $('.bayar').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '<?php echo e(url('dashboard/administrator/konfirmasi-pembayaran')); ?>' + '/' + id,
                  data: {
                    'bayar': this.value,
                  },
                  success: function(data) {
                    window.location.href = '<?php echo e(route('konfirmasi.index')); ?>';
                  }
                });

            });

        })();

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>