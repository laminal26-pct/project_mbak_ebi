@extends('backend.master.app')

@section('title', 'Tambah Foto')

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if($errors->has('name') || $errors->has('description'))
        <div class="alert alert-block alert-error fade in" id="error-block">
          {!! $messages = $errors->all('<li>:message</li>') !!}
          <button type="button" class="close"data-dismiss="alert">×</button>
          <h4>Warning!</h4>
          <ul>
            @foreach($messages as $message)
              {{$message}}
            @endforeach
          </ul>
        </div>
      @endif
      {!! Form::open(['url' => route('photos.store',$album->album_id),'name' => 'addimagetoalbum', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        <fieldset>
          <legend>Tambah Foto ke Album {{$album->name}}</legend>
          <div class="form-group">
            <label for="description">Deskripsi Foto</label>
            <textarea name="description" type="text" class="form-control" placeholder="Deskripsi Foto">{{old('description')}}</textarea>
          </div>
          <div class="form-group">
            <label for="image">Pilih Cover Foto</label>
            {{Form::file('image')}}
          </div>
          <button type="submit" class="btn btn-default">Tambah Foto !</button>
        </fieldset>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
