<?php $__env->startSection('title', 'Edit Relawan'); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Edit Relawan</h3>
        </div>
        <div class="box-body">
          <?php echo Form::model($relawan,['url' => route('info-relawan.update',$relawan->slug), 'method' => 'put', 'class' => 'form-horizontal']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
              <div class="form-group">
                <?php echo Form::label('nama','NAMA RELAWAN', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('nama',null, ['class' => 'form-control', 'placeholder' => 'NAMA RELAWAN']); ?>

                  <?php echo $errors->first('nama','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="input-group">
                    <?php echo Form::text('images', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']); ?>

                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('join','TAHUN BERGABUNG', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <select class="form-control" name="join">
                    <?php ( $d = date('Y', strtotime('now')) ); ?>
                    <?php for($i = 2010; $i <= $d; $i++): ?>
                      <option value="<?php echo e($i); ?>" <?php echo e(($relawan->join == $i) ? 'selected="selected"' : ''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('status','STATUS', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('status', 'Aktif', true); ?> Aktif
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('status', 'NonAktif'); ?> Non-Aktif
                    </label>
                  </div>
                  <?php echo $errors->first('status','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('alamat','ALAMAT', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('alamat',null, ['class' => 'form-control', 'style' => 'resize: none', 'rows' => '2', 'cols' => '32']); ?>

                  <?php echo $errors->first('alamat','<p class="help-block"></p>'); ?>

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