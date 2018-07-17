@extends('backend.master.app')

@section('title', 'Detail Pengguna')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Berita</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <tbody>
            <tr>
              <td>Nama</td>
              <td>{!!$user->name!!}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{!!$user->email!!}</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>{!!$user->status!!}</td>
            </tr>
            <tr>
              <td>Level</td>
              <td>{!!$user->level!!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
