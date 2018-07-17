@extends('backend.master.app')

@section('title', 'Buat Album')

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
      {!! Form::open(['url' => route('albums.store'),'name' => 'createnewalbum', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        <fieldset>
          <legend>Buat Sebuah Album</legend>
          <div class="form-group">
            <label for="name">Nama Album</label>
            <input name="name" type="text" class="form-control" placeholder="Nama Album" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label for="description">Deskripsi Album</label>
            <textarea name="description" type="text" class="form-control" placeholder="Deskripsi Album">{{old('descrption')}}</textarea>
          </div>
          <div class="form-group">
            <label for="cover">Pilih Cover Foto</label>
            {{Form::file('cover')}}
          </div>
          <button type="submit" class="btnbtn-default">Simpan !</button>
        </fieldset>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
