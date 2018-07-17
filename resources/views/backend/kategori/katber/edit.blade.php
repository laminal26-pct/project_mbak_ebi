@extends('backend.master.app')

@section('title', 'Edit Kategori')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Kategori : {{$kat->nama_kategori_berita}}</h3>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      {!! Form::model($kat,['url' => route('berita.kategori.update',$kat->kategori_berita_id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
        <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
          <div class="form-group">
            {!! Form::label('nama_kategori','Nama Kategori', ['class' => 'col-md-2 control-label'])!!}
            <div class="col-md-9">
              {!! Form::text('nama_kategori_berita',null,['class' => 'form-control', 'placeholder' => 'Nama Kategori']) !!}
              {!! $errors->first('title','<p class="help-block"></p>')!!}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-9">
              {!! Form::button('<i class="fa fa-send"></i>&nbsp;Ubah', ['class' => 'btn btn-primary','type' => 'submit']) !!}
            </div>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
