@extends('backend.master.app')

@section('title', 'Daftar Pengguna')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Berita</h3>
      <div class="pull-right">
        <a href="{{ route('pengguna.create')}}" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i>&nbsp;Tambah Pengguna
        </a>
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="beritatable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Level</th>
              <th style="text-align: center; width: 210px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($user) > 0)
              @foreach ($user as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->name}}</td>
                  <td>{{$k->email}}</td>
                  <td>{{$k->level}}</td>
                  <td>
                    {!! Form::model($user, ['url' => route('pengguna.destroy',$k->user_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('pengguna.edit',$k->user_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="{{ route('pengguna.show',$k->user_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
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
