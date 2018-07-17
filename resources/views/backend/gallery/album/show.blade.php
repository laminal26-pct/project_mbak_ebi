@extends('backend.master.app')

@section('title', 'Album '.$album->name)

@section('content')
  <div class="row">
    <div class="col-md-12">
      <style>
        .starter-template {
          padding: 20px 5px;
          //text-align: center;
        }
      </style>
      <div class="starter-template">
        <div class="media">
          <img class="media-object pull-left" alt="{{$album->name}}" src="{{asset('gallery/albums/'.$album->cover)}}" width="350px">
          <div class="media-body">
            <h2 class="media-heading" style="font-size: 20px;">Nama Album : <small>{{$album->name}}</small> </h2>
          </div>
          <div class="media">
            <h2 class="media-heading" style="font-size: 20px;">Deskripsi : <small>{{$album->description}}</small> </h2>
            {!! Form::model($album, ['url' => route('albums.destroy',$album->album_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
              <a href="{{route('photos.create',$album->album_id)}}" class="btn btn-big btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Foto ke Album</a>
              <button type="submit" class="btn btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp; Hapus Album</a>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($album->photos as $photo)
          <div class="col-lg-3">
            <div class="thumbnail" style="max-height: 350px; min-height: 250px;">
              <img alt="{{$album->name}}" src="{{asset('gallery/photos/'.$photo->image)}}">
              <div class="caption">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>{{$photo->description}}</td>
                    </tr>
                    <tr>
                      <td>Tgl Buat : {{ date("d/m/Y",strtotime($photo->created_at)) }}</td>
                    </tr>
                    <tr>
                      <td>
                        {!! Form::model($photo, ['url' => route('photos.destroy',[$album->album_id,$photo->photo_id]), 'method'=>'delete', 'id' => 'formdelete']) !!}
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
      </div>
    </div>
  </div>
@endsection
