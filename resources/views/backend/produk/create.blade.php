@extends('backend.master.app')

@section('title', 'Tambah Produk')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Produk</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('produk.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ' '}}">
              <div class="form-group">
                {!! Form::label('title','NAMA PRODUK', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'JUDUL PRODUK']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('kategori','KATEGORI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <select class="form-control" name="kategori" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach ($kategori as $key)
                      <option value="{{$key->kategori_produk_id}}">{{$key->nama_kategori_produk}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('harga','HARGA', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('harga',null, ['class' => 'form-control', 'placeholder' => 'HARGA PRODUK', 'onkeypress' => 'return isNumberKey(event);']) !!}
                  {!! $errors->first('harga','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('stock','STOK', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('stock',null, ['class' => 'form-control', 'placeholder' => 'STOK PRODUK', 'onkeypress' => 'return isNumberKey(event)']) !!}
                  {!! $errors->first('stock','<p class="help-block"></p>') !!}
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
                {!! Form::label('description','DESKRIPSI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('description',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('description','<p class="help-block"></p>') !!}
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
