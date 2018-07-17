@extends('backend.master.app')

@section('title', 'Detail Komentar')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Komentar</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Nama</th>
              <th>Komentar</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$comment->produk->title}}</td>
              <td>{{$comment->name}}</td>
              <td>{!!$comment->description!!}</td>
              <td>{{date('l, d-m-Y H:i', strtotime($comment->created_at))}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
