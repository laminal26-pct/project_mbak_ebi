@extends('backend.master.app')

@section('title', 'Manajemen Website')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Manajemen Website</h3>
      <div class="pull-right">
        @if (count($web) < 8)
          <a href="{{ route('konfig-web.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Data
          </a>
        @endif
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Web</th>
              <th style="text-align: center;">Kategori</th>
              <th style="text-align: center; width: 220px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($web) > 0)
              @foreach ($web as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->nama_web}}</td>
                  <td>{{$k->kategori_website}}</td>
                  <td>
                    <a href="{{ route('konfig-web.edit',$k->website_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="{{ route('konfig-web.show',$k->website_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a>

                    {{--!! Form::model($web, ['url' => route('konfig-web.destroy',$k->website_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('konfig-web.edit',$k->website_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <a href="{{ route('konfig-web.show',$k->website_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!--}}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
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
