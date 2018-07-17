@extends('backend.master.app')

@section('title', 'Tambah Berita')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Berita</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('superadmin'))
            {!! Form::open(['url' => route('berita.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
          @else
            {!! Form::open(['url' => route('berita-editor.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
          @endif
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ' '}}">
              <div class="form-group">
                {!! Form::label('title','JUDUL', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'JUDUL BERITA']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('kategori','KATEGORI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <select class="form-control" name="kategori" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach ($kategori as $key)
                      <option value="{{$key->kategori_berita_id}}">{{$key->nama_kategori_berita}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @if (Auth::user()->hasRole('superadmin'))
                <div class="form-group">
                  {!! Form::label('headline','HEADLINE', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    <div class="radio">
                      <label style="margin-right: 10px;">
                        {!! Form::radio('headline', 'Tidak', true) !!} Tidak
                      </label>
                      <label style="margin-right: 10px;">
                        {!! Form::radio('headline', 'Ya') !!} Ya
                      </label>
                    </div>
                    {!! $errors->first('headline','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    <div class="radio">
                      <label style="margin-right: 10px;">
                        {!! Form::radio('post_status', 'Draft', true) !!} Draft
                      </label>
                      <label style="margin-right: 10px;">
                        {!! Form::radio('post_status', 'Publikasi') !!} Publikasi
                      </label>
                    </div>
                    {!! $errors->first('post_status','<p class="help-block"></p>') !!}
                  </div>
                </div>
              @endif

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
