@extends('backend.master.app')

@section('title', 'Bank')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Bank</h3>
      <div class="pull-right">
        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createCatModal2">
          <i class="fa fa-plus"></i>&nbsp;Tambah Bank
        </a>
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center;">Nama Bank</th>
              <th style="text-align: center;">No. Rekening</th>
              <th style="text-align: center;">Atas Nama</th>
              <th style="width: 140px; text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($bank) > 0)
              @foreach ($bank as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->nama_bank}}</td>
                  <td>{{$k->no_rek}}</td>
                  <td>{{$k->atas_nama}}</td>
                  <td>
                    {!! Form::model($bank, ['url' => route('bank.destroy',$k->bank_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('bank.edit',$k->bank_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
