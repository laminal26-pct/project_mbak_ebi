@extends('frontend.master.app')

@section('title', 'Kontak Kami')

@section('content')
  <div class="main" style="min-height: 600px;">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs12">
          <h2>Kontak Kami</h2>
          <div class="">
            <p>Pengiriman barang dilakukan secara delivery hanya untuk area kota palembang, pelanggan yang berasal dari luar kota palembang dapat menghubungin admin sebelum melakukan transaksi pembelian atau lakukan transaksi di luar sistem dengan menghubungin admin kampungpedado.com</p>
          </div>
          @include('layouts.flash')
          <div class="content-page">
            <div class="row">
              {!! Form::open(['url' => route('home.kontak.store'), 'class' => 'form-horizontal'])!!}
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
                    {!! Form::label('pesan','Pesan Anda', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-9">
                      {!! Form::textarea('pesan',null, ['id' => 'pesan', 'class' => 'form-control', 'placeholder' => 'Masukkan apa yang anda pesan', 'cols' => '5', 'rows' => '3']) !!}
                      {!! $errors->first('pesan','<p class="help-block"></p>') !!}
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-9">
                      {!! Form::button('<i class="fa fa-send"></i>&nbsp;Pesan', ['class' => 'btn btn-lg btn-primary col-md-4','type' => 'submit']) !!}
                    </div>
                  </div>
                </div>
              {!! Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script src="{{ asset('assets/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: '#pesan',
      height: 150,
      menubar: false,
      plugins: [
        'link image media contextmenu paste'
      ],
      toolbar: false,
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
    });
  </script>
@endsection
