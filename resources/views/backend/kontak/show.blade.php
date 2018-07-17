@extends('backend.master.app')

@section('title', 'Detail Pesan Pelanggan')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Produk</h3>
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
              <td style="width: 100px;">Nama</td>
              <td>{!!$kontak->nama!!}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{!!$kontak->email!!}</td>
            </tr>
            <tr>
              <td>Telepon</td>
              <td>{{$kontak->telepon}}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>{!!$kontak->alamat!!}</td>
            </tr>
            <tr>
              <td>Pesan Pelanggan</td>
              <td>{!! $kontak->pesan !!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
