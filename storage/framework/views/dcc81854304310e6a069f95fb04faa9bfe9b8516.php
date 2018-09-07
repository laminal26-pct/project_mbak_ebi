<?php $__env->startSection('title',$video->title); ?>

<?php $__env->startSection('content'); ?>
  <video id="my_video_1" class="video-js vjs-default-skin" width="640px" height="480px" controls preload="none" poster='https://video-js.zencoder.com/oceans-clip.jpg' data-setup='{ "aspectRatio":"640:480", "playbackRates": [1, 1.5, 2] }'>
    <source src="<?php echo e(url('video',$video->videos)); ?>" type='video/mp4' />
  </video>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-js'); ?>
  <script type="text/javascript">
    $(function(){
      var $refreshButton = $('#refresh');
      var $results = $('#css_result');

      function refresh(){
        var css = $('style.cp-pen-styles').text();
        $results.html(css);
      }

      refresh();
      $refreshButton.click(refresh);

      // Select all the contents when clicked
      $results.click(function(){
        $(this).select();
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.master.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>