@extends('backend.master.app')

@section('title', 'Edit Relawan')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Edit Relawan</h3>
        </div>
        <div class="box-body">
          {!! Form::model($relawan,['url' => route('info-relawan.update',$relawan->slug), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
              <div class="form-group">
                {!! Form::label('nama','NAMA RELAWAN', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('nama',null, ['class' => 'form-control', 'placeholder' => 'NAMA RELAWAN']) !!}
                  {!! $errors->first('nama','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('images', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Aktif', true) !!} Aktif
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'NonAktif') !!} Non-Aktif
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('alamat','ALAMAT', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('alamat',null, ['class' => 'form-control', 'style' => 'resize: none', 'rows' => '2', 'cols' => '32']) !!}
                  {!! $errors->first('alamat','<p class="help-block"></p>') !!}
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
