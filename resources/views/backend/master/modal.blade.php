<!-- Modal -->
<div class="modal fade" id="createCatModal" tabindex="-1" role="dialog" aria-labelledby="createCatModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createCatModal">Tambah Kategori</h3>
      </div>
      {!! Form::open(['url' => route('berita.kategori.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
          <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
            <div class="form-group">
              {!! Form::label('nama_kategori','Nama Kategori', ['class' => 'col-md-3 control-label'])!!}
              <div class="col-md-8">
                {!! Form::text('nama_kategori_berita',null,['class' => 'form-control', 'placeholder' => 'Nama Kategori']) !!}
                {!! $errors->first('title','<p class="help-block"></p>')!!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createCatModal1" tabindex="-1" role="dialog" aria-labelledby="createCatModal1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createCatModal1">Tambah Kategori</h3>
      </div>
      {!! Form::open(['url' => route('produk.kategori.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
          <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
            <div class="form-group">
              {!! Form::label('nama_kategori','Nama Kategori', ['class' => 'col-md-3 control-label'])!!}
              <div class="col-md-8">
                {!! Form::text('nama_kategori_produk',null,['class' => 'form-control', 'placeholder' => 'Nama Kategori']) !!}
                {!! $errors->first('title','<p class="help-block"></p>')!!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createCatModal2" tabindex="-1" role="dialog" aria-labelledby="createCatModal2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="createCatModal1">Tambah Bank</h3>
      </div>
      {!! Form::open(['url' => route('bank.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="modal-body">
          <div class="form-group {{$errors->has('name') ? 'has-error' : ' ' }}">
            <div class="form-group">
              {!! Form::label('nama_bank','Nama Bank', ['class' => 'col-md-3 control-label'])!!}
              <div class="col-md-8">
                {!! Form::text('nama_bank',null,['class' => 'form-control', 'placeholder' => 'Nama Bank']) !!}
                {!! $errors->first('nama_bank','<p class="help-block"></p>')!!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('no_rek','No. Rekening', ['class' => 'col-md-3 control-label'])!!}
              <div class="col-md-8">
                {!! Form::text('no_rek',null,['class' => 'form-control', 'placeholder' => 'No. Rekening']) !!}
                {!! $errors->first('no_rek','<p class="help-block"></p>')!!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('atas_nama','Atas Nama', ['class' => 'col-md-3 control-label'])!!}
              <div class="col-md-8">
                {!! Form::text('atas_nama',null,['class' => 'form-control', 'Value' => 'Kampung Pedado']) !!}
                {!! $errors->first('title','<p class="help-block"></p>')!!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
