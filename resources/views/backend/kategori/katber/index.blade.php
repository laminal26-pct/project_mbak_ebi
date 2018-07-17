@extends('backend.master.app')

@section('title', 'Kategori Berita')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Berita</h3>
      <div class="pull-right">
        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createCatModal">
          <i class="fa fa-plus"></i>&nbsp;Tambah Kategori
        </a>
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-6">
        <table class="table table-bordered table-hover">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Kategori</th>
              <th style="width: 140px; text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($kat) > 0)
              @foreach ($kat as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->nama_kategori_berita}}</td>
                  <td>
                    {!! Form::model($kat, ['url' => route('berita.kategori.delete',$k->kategori_berita_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('berita.kategori.edit',$k->kategori_berita_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="3" style="text-align: center;">Tidak Ada Data</td>
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
