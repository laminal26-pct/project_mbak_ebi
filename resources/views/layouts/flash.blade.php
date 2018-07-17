@if (session()->has('flash_notification.message'))
<div style="margin-top: 10px;">
  <div class="alert alert-{{ session()->get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! session()->get('flash_notification.message') !!}
  </div>
</div>
@endif
