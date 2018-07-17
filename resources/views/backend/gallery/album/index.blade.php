@extends('backend.master.app')

@section('title', 'Album')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <a href="{{route('albums.create')}}" class="btn btn-primary">Buat Album Baru</a>
      </div>
      <hr>
      <div class="row col-md-12">
        @if (count($album) > 0)
          @foreach ($album as $k)
            <div class="col-lg-4">
              <div class="thumbnail" style="min-height: 150px;">
                <img alt="{{$k->name}}" src="{{asset('/gallery/albums/'.$k->cover)}}" style=" height: 150px; width: 100%; max-height: 300px;">
                <div class="caption">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <h3>{{$k->name}}</h3>
                        </td>
                      </tr>
                      <tr>
                        <td><small>({{count($k->photos)}}) Foto. Tgl Buat : {{ date("d/m/Y",strtotime($k->created_at)) }}</small> </td>
                      </tr>
                      <tr>
                        <td>{{$k->description}}</td>
                      </tr>
                      <tr>
                        <td>
                          {!! Form::model($album, ['url' => route('albums.destroy',$k->album_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                            <a href="{{route('albums.show',$k->album_id)}}" class="btn btn-big btn-default">Tampilkan Foto</a>
                            <button type="submit" class="btn btn-danger pull-right" id="confirm"><i class="fa fa-trash"></i></a>
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <h4 class="text-center">Tidak Ada Data</h4>
        @endif
      </div>
    </div>
  </div>
@endsection
