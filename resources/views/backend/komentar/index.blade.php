@extends('backend.master.app')

@section('title', 'Daftar Komentar')

{{--@section('breadcrumb', breadcrumb::render('dashboard.admin.berita'))--}}

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Komentar</h3>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="beritatable">
            <thead style="background-color: #ccc; color: #222;">
              <tr>
                <th style="width: 50px; text-align: center;">No.</th>
                <th style="text-align: center;">Produk</th>
                <th style="text-align: center; width: 150px;">Nama Komentar</th>
                <th style="text-align: center; width: 200px;">Tanggal</th>
                <th style="text-align: center; width: 210px;">Action</th>
              </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @if (count($comment) > 0)
                @foreach ($comment as $k)
                  <tr>
                    <td>{{$i++}}.</td>
                    <td>{{$k->produk->title}}</td>
                    <td>{{$k->name}}</td>
                    <td>{{date('l, d-m-Y H:i', strtotime($k->created_at))}}</td>
                    <td>
                      {!! Form::model($comment, ['url' => route('komentar.destroy',$k->comment_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                      <a href="{{ route('komentar.edit',$k->comment_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Balas</a> &nbsp;
                      <a href="{{ route('komentar.show',$k->comment_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
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
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
