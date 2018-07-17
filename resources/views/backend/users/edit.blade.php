@extends('backend.master.app')

@section('title', 'Edit Pengguna')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Edit Pengguna</h3>
        </div>
        <div class="box-body">
          {!! Form::model($user,['url' => route('pengguna.update',$user->user_id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ' '}}">
              <div class="form-group">
                {!! Form::label('name','NAMA', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('name',null, ['class' => 'form-control', 'placeholder' => 'NAMA PENGGUNA']) !!}
                  {!! $errors->first('name','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('email','EMAIL', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::email('email',null, ['class' => 'form-control', 'placeholder' => 'EMAIL PENGGUNA']) !!}
                  {!! $errors->first('email','<p class="help-block"></p>') !!}
                </div>
              </div>
              <!--<div class="form-group">
                {!! Form::label('level','LEVEL', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <select class="form-control" name="level" required>
                    <option value="0">Pilih Level</option>
                    @foreach ($role as $key)
                      <option value="{{$key->name}}" @if ($key->name == $user->levelname) selected="selected" @endif>{{$key->display_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>-->
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
