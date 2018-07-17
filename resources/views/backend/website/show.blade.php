@extends('backend.master.app')

@section('title', 'Detail Website')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Website</h3>
    </div>
    <div class="box-body">
      <h3>{{$web->nama_web}}</h3>
      <hr>
      {!! $web->description !!}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
