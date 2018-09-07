@extends('backend.master.app')

@section('title', 'Upload Video')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Relawan</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('video.store'), 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
              <div class="form-group">
                {!! Form::label('title','Judul Video', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'Judul Video']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('video','VIDEO', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <input type="file" name="filevideo" value="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Aktif') !!} Aktif
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'NonAktif',true) !!} Non-Aktif
                    </label>
                  </div>
                  {!! $errors->first('post_status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;Simpan', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;Reset', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
