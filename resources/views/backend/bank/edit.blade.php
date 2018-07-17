@extends('backend.master.app')

@section('title', 'Edit Bank')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Bank</h3>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      {!! Form::model($bank,['url' => route('bank.update',$bank->bank_id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
        <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
          <div class="form-group">
            {!! Form::label('nama_bank','Nama Bank', ['class' => 'col-md-2 control-label'])!!}
            <div class="col-md-9">
              {!! Form::text('nama_bank',null,['class' => 'form-control', 'placeholder' => 'Nama Bank']) !!}
              {!! $errors->first('nama_bank','<p class="help-block"></p>')!!}
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('no_rek','No. Rekening', ['class' => 'col-md-2 control-label'])!!}
            <div class="col-md-9">
              {!! Form::text('no_rek',null,['class' => 'form-control', 'placeholder' => 'No. Rekening']) !!}
              {!! $errors->first('no_rek','<p class="help-block"></p>')!!}
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('atas_nama','Atas Nama', ['class' => 'col-md-2 control-label'])!!}
            <div class="col-md-9">
              {!! Form::text('atas_nama',null,['class' => 'form-control', 'Value' => 'Kampung Pedado']) !!}
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
