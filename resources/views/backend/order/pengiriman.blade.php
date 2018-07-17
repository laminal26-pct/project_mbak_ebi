@extends('backend.master.app')

@section('title', 'Pengiriman')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Pengiriman Transaksi {{$produk->kode_order}}</h3>
        </div>
        <div class="box-body">
          {!! Form::model($produk,['url' => route('order.pengiriman.post',$produk->kode_order), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
              <div class="form-group">
                {!! Form::label('kode_order','Kode Transaksi', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('kode_order',null, ['class' => 'form-control', 'readonly']) !!}
                  {!! $errors->first('kode_order','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('jasa_pengiriman','Jasa Pengiriman', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('jasa_pengiriman',null, ['class' => 'form-control', 'placeholder' => 'Jasa Pengiriman']) !!}
                  {!! $errors->first('jasa_pengiriman','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('no_resi','No. RESI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('no_resi',null, ['class' => 'form-control', 'placeholder' => 'Nomor Resi']) !!}
                  {!! $errors->first('no_resi','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;Simpan', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                </div>
              </div>
            </div>
          {!! Form::close()!!}
        </div>
      </div>
    </div>
  </div>
@endsection
