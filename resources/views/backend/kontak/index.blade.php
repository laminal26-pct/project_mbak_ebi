@extends('backend.master.app')

@section('title', 'Pesan Pelanggan')

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
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Telepon</th>
              <th style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($kontak) > 0)
              @foreach ($kontak as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->nama}}</td>
                  <td>{{$k->email}}</td>
                  <td>{{$k->telepon}}</td>
                  <td>
                    {!! Form::model($kontak, ['url' => route('kontak.destroy',$k->kontak_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('kontak.show',$k->kontak_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
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
