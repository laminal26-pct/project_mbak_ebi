@extends('backend.master.app')

@section('title', 'Ubah Password')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          @include('backend.master.flash')
          <h3 class="box-title">UBAH PASSWORD</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('superadmin'))
            {!! Form::open(['url' => route('admin.password.post'), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}
          @else
            {!! Form::open(['url' => route('editor.password.post'), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}
          @endif
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              <div class="form-group">
                {!! Form::label('old','Password Lama', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::password('old',['class' => 'form-control', 'placeholder' => 'Password Lama', 'required']) !!}
                  {!! $errors->first('old','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('password','Password Baru', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password Baru', 'required']) !!}
                  {!! $errors->first('password','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('password_confirm','Ulangi Password', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::password('password_confirmation',['id' => 'password_confirm', 'class' => 'form-control', 'placeholder' => 'Ulangi Password']) !!}
                  {!! $errors->first('password_confirmation','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-key"></i>&nbsp;UBAH PASSWORD', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                </div>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
