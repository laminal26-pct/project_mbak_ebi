@extends('backend.master.app')

@section('title', 'Detail Produk')

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
              <td>Nama Produk</td>
              <td>{!!$product->title!!}</td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td>{!!$product->nama_kategori_produk!!}</td>
            </tr>
            <tr>
              <td>Harga Produk</td>
              <td>Rp. {!!number_format($product->harga,0,",",".")!!}</td>
            </tr>
            <tr>
              <td>Stok Produk</td>
              <td>{!!$product->stock!!}</td>
            </tr>
            <tr>
              <td colspan="2"><img src="{{ asset($product->images) }}" alt="" width="100%" height="250px"></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>{!! date('d-F-Y', strtotime($product->created_at)) !!}</td>
            </tr>
            <tr>
              <td colspan="2">{!!$product->description!!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
