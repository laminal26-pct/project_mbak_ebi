@extends('frontend.master.app')

@section('title', 'Form Pemesanan')

@section('content')
  <div class="main">
    <div class="container">
      <div class="col-md-12 col-xs-12">
        <div class="content-page">
          <h3 class="text-center">Form Pemesanan</h3>
          @if (session()->has('success_message'))
              <div class="alert alert-success">
                  {{ session()->get('success_message') }}
              </div>
          @endif

          @if (session()->has('error_message'))
              <div class="alert alert-danger">
                  {{ session()->get('error_message') }}
              </div>
          @endif
          <div style="margin-bottom: 15px;"></div>
          {{ Form::open(['url' => route('cart.pesan.post'), 'method' => 'post', 'class' => 'form-horizontal']) }}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
              <div class="form-group">
                {!! Form::label('nama','Nama Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('nama',null, ['class' => 'form-control', 'placeholder' => 'Nama Pemesan']) !!}
                  {!! $errors->first('nama','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('email','Email Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::email('email',null, ['class' => 'form-control', 'placeholder' => 'Email Pemesan']) !!}
                  {!! $errors->first('email','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('telepon','Telepon Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('telepon',null, ['class' => 'form-control', 'placeholder' => 'Telepon Pemesan', 'onkeypress' => 'return isNumberKey(event);']) !!}
                  {!! $errors->first('telepon','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('alamat','Alamat Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('alamat',null, ['class' => 'form-control', 'placeholder' => 'Alamat Pemesan', 'cols' => '5', 'rows' => '3']) !!}
                  {!! $errors->first('alamat','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('kodeUnik','Kode Unik', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <input type="text" name="kodeUnik" class="kodeunik form-control" value="{!! $kodeUnik !!}" placeholder="Kode Unik" readonly>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('total','Sub Total', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <input type="text" name="total" class="subtotal form-control" value="Rp {!! $total !!}" placeholder="Sub Total" readonly>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('totalall','Total', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <input type="text" name="totalall" class="totalall form-control" value="Rp {!! $all !!}" placeholder="Total Semua" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;Pesan', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;Reset', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
