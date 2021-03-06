@extends('backend.master.app')

@section('title',$video->title)

@section('content')
  <video id="my_video_1" class="video-js vjs-default-skin" width="640px" height="480px" controls preload="none" poster='https://video-js.zencoder.com/oceans-clip.jpg' data-setup='{ "aspectRatio":"640:480", "playbackRates": [1, 1.5, 2] }'>
    <source src="{{url('video',$video->videos)}}" type='video/mp4' />
  </video>
@endsection

@section('extra-js')
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
@endsection
