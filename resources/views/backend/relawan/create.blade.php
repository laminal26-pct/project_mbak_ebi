@extends('backend.master.app')

@section('title', 'Tambah Relawan')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Relawan</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('info-relawan.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
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
                    {!! Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('join','Tahun Bergabung', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    <select class="form-control" name="join">
                      <?
                        $i = 2010;
                        $l = 10;
                        $d = date('Y', strtotime('now'))
                        $d += $l;
                      ?>
                      @for ($i=2010; $i < $d; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Aktif', true) !!} Aktif
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'NonAktif') !!} Non-Aktif
                    </label>
                  </div>
                  {!! $errors->first('post_status','<p class="help-block"></p>') !!}
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
