

<?php $__env->startSection('title', 'Daftar Berita'); ?>



<?php $__env->startSection('content'); ?>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Berita</h3>
      <div class="pull-right">
        <?php if(Auth::user()->hasRole('superadmin')): ?>
          <a href="<?php echo e(route('berita.create')); ?>" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Berita
          </a>
        <?php else: ?>
          <a href="<?php echo e(route('berita-editor.create')); ?>" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Berita
          </a>
        <?php endif; ?>
      </div>
      <?php echo $__env->make('backend.master.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="beritatable">
            <thead style="background-color: #ccc; color: #222;">
              <tr>
                <th style="width: 50px; text-align: center;">No.</th>
                <th style="text-align: center;">Judul Berita</th>
                <th style="text-align: center; width: 150px;">Author</th>
                <th style="text-align: center; width: 70px;">Status</th>
                <th style="text-align: center;">Kategori</th>
                <th style="text-align: center; width: 210px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php ($i = 1); ?>
              <?php if(count($news) > 0): ?>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($i++); ?>.</td>
                    <td><?php echo e($k->title); ?></td>
                    <td><?php echo e($k->name); ?></td>
                    <td>
                      <?php if(Auth::user()->hasRole('superadmin')): ?>
                        <?php if($k->post_status == "Publikasi"): ?>
                          <span class="label label-success"><?php echo e($k->post_status); ?></span>
                        <?php else: ?>
                          <select class="poststatus" name="poststatus" data-id="<?php echo e($k->berita_id); ?>">
                            <option <?php echo e($k->post_status == "Draft" ? 'selected' : ''); ?>>Draft</option>
                            <option <?php echo e($k->post_status == "Publikasi" ? 'selected' : ''); ?> value="publikasi">Publish</option>
                          </select>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="label label-success"><?php echo e($k->post_status); ?></span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo e($k->nama_kategori_berita); ?></td>
                    <td>
                      <?php if(Auth::user()->hasRole('superadmin')): ?>
                        <?php echo Form::model($news, ['url' => route('berita.destroy',$k->berita_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                        <a href="<?php echo e(route('berita.edit',$k->berita_id)); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                        <a href="<?php echo e(route('berita.show',$k->berita_id)); ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                        <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        <?php echo Form::close(); ?>

                      <?php else: ?>
                        <?php echo Form::model($news, ['url' => route('berita-editor.destroy',$k->berita_id), 'method'=>'delete', 'id' => 'formdelete']); ?>

                        <a href="<?php echo e(route('berita-editor.edit',$k->berita_id)); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                        <a href="<?php echo e(route('berita-editor.show',$k->berita_id)); ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                        <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        <?php echo Form::close(); ?>

                      <?php endif; ?>
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
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php if(Auth::user()->hasRole('superadmin')): ?>
  <?php $__env->startSection('extra-js'); ?>
    <script>
      (function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.poststatus').on('change', function() {
          var id = $(this).attr('data-id')
          $.ajax({
            type: "PATCH",
            url: '<?php echo e(url('dashboard/administrator/berita/update/poststatus/publish')); ?>' + '/' + id,
            data: {
              'post_status': this.value,
            },
            success: function (data) {
              window.location.href = '<?php echo e(route('berita.index')); ?>'
            }
          });
        });
      })();
    </script>
  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>