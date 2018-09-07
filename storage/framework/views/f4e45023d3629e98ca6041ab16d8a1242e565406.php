

<?php $__env->startSection('title', 'Upload Video'); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Relawan</h3>
        </div>
        <div class="box-body">
          <?php echo Form::open(['url' => route('video.store'), 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
              <div class="form-group">
                <?php echo Form::label('title','Judul Video', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'Judul Video']); ?>

                  <?php echo $errors->first('title','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('video','VIDEO', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <input type="file" name="filevideo" value="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Aktif'); ?> Aktif
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'NonAktif',true); ?> Non-Aktif
                    </label>
                  </div>
                  <?php echo $errors->first('post_status','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  <?php echo Form::button('<i class="fa fa-send"></i>&nbsp;Simpan', ['class' => 'btn btn-primary','type' => 'submit']); ?>

                  <?php echo Form::button('<i class="fa fa-times"></i>&nbsp;Reset', ['class' => 'btn btn-danger', 'type' => 'reset']); ?>

                </div>
              </div>
            </div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>