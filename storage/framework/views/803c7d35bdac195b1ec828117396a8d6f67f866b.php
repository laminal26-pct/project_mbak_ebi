<?php $__env->startSection('content'); ?>
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <a href="<?php echo e(route('homepage')); ?>"><?php echo e(config('app.name', 'Laravel')); ?></a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Login Internal</p>
      <?php echo $__env->make('layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <form action="<?php echo e(route('post.login')); ?>" method="post">
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
        <div class="form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <?php if($errors->has('password')): ?>
            <span class="help-block">
              <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>&nbsp;&nbsp;Rememeber me
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login</button>
          </div>
        </div>
      </form>
      <a href="<?php echo e(route('password.request')); ?>">Forget Password</a>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>