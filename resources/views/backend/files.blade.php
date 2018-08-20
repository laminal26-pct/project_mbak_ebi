@extends('backend.master.app')

@section('title', 'File')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <iframe src="{{url('/laravel-filemanager?type=files')}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
  </div>
@endsection
