@extends('backend.master.app')

@section('title', 'Tambah Website')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tambah Website</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('konfig-web.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ' '}}">
              <div class="form-group">
                {!! Form::label('nama_web','NAMA WEBSITE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('nama_web',null, ['class' => 'form-control', 'placeholder' => 'NAMA WEBSITE']) !!}
                  {!! $errors->first('nama_web','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('tipe','TIPE WEBSITE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <select class="form-control" name="tipe" required>
                    <option value="0">Pilih Kategori</option>
                    <option value="rbc">Profil RBC</option>
                    <option value="pedado">Profil PEDADO</option>
                    <option value="rumah-jamur">Rumah Jamur</option>
                    <option value="hydropolik">Hydropolik</option>
                    <option value="pendidikan">Pendidikan</option>
                    <option value="katur-lihab">Katur Lihab</option>
                    <option value="kar-flanet">Kar Flanet</option>
                    <option value="lampu-hias">Lampu Hias</option>
                  </select>
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
