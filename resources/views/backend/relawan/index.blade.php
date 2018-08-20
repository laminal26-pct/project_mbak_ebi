@extends('backend.master.app')

@section('title', 'Daftar Relawan')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Relawan</h3>
      <div class="pull-right">
        <a href="{{route('info-relawan.create')}}" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i>&nbsp;Tambah Relawan
        </a>
      </div>
    </div>
    @include('backend.master.flash')
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="relawantable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($relawan) > 0)
              @foreach ($relawan as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td>{{$k->nama}}</td>
                  <td>{{$k->status}}</td>
                  <td>
                    {!! Form::model($relawan, ['url' => route('info-relawan.destroy',$k->slug), 'method' => 'delete', 'id' => 'formdelete']) !!}
                      <a href="{{route('info-relawan.edit',$k->slug)}}" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>&nbsp;Edit
                      </a>&nbsp;
                      <a href="{{route('info-relawan.show',$k->slug)}}" class="btn btn-xs btn-info">
                        <i class="fa fa-list"></i>&nbsp;Detail
                      </a>&nbsp;
                      <button type="submit" class="btn btn-xs btn-danger" id="confirm">
                        <i class="fa fa-trash"></i>&nbsp;Hapus
                      </button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4">Tidak Ada Data</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script type="text/javascript">
    $(function() {
      $('#relawantable').DataTable({'pageLength': 25, columnDefs: [{orderable: false, targets:[3]}]});
      $('#relawantable').find('thead tr').addClass('text-red');
      $('#relawantable').find('thead tr th').css('text-align','center');
      $('#relawantable').find('tbody tr td:nth-child(3)').css('text-align','center');
      $('#relawantable').find('tbody tr td:nth-child(4)').css('text-align','center');
      $('#relawantable').find('thead tr th:nth-child(1)').css('width','30px');
      $('#relawantable').find('thead tr th:nth-child(2)').css('width','275px');
      $('#relawantable').find('thead tr th:nth-child(3)').css('width','40px');
      $('#relawantable').find('thead tr th:nth-child(4)').css('width','90px');
      $('#relawantable').find('td[colspan=4]').css('text-align','center');
    });
  </script>
@endsection
