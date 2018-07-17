<?php $__env->startSection('content'); ?>
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <a href="<?php echo e(route('beranda')); ?>"><?php echo e(config('app.name', 'Laravel')); ?></a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Reset Password</p>
      <?php if(session('status')): ?>
        <div class="alert alert-success">
          <?php echo e(session('status')); ?>

        </div>
      <?php endif; ?>
      <form action="<?php echo e(route('password.email')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <div class="form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <?php if($errors->has('email')): ?>
            <span class="help-block">
              <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-xs-6"></div>
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>