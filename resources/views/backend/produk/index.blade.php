@extends('backend.master.app')

@section('title', 'Daftar Produk')

{{--@section('breadcrumb', breadcrumb::render('dashboard.admin.Produk'))--}}

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Produk</h3>
      <div class="pull-right">
        <a href="{{ route('produk.create')}}" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i>&nbsp;Tambah Produk
        </a>
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Produk</th>
              <th style="text-align: center; width: 150px;">Harga</th>
              <th style="text-align: center; width: 70px;">Stock</th>
              <th style="text-align: center;">Kategori</th>
              <th style="text-align: center; width: 210px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($product) > 0)
              @foreach ($product as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->title}}</td>
                  <td>Rp. {{number_format($k->harga,0,",",".")}}</td>
                  <td>{{number_format($k->stock,0,",",".")}}</td>
                  <td>{{$k->nama_kategori_produk}}</td>
                  <td>
                    {!! Form::model($product, ['url' => route('produk.destroy',$k->produk_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('produk.edit',$k->produk_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="{{ route('produk.show',$k->produk_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
