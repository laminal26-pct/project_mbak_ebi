@extends('backend.master.app')

@section('title', 'Order Request')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Order</h3>
      @if (session()->has('success_message'))
        <div class="col-md-12" style="margin: 10px 0 5px 0;">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
            {{ session()->get('success_message') }}
          </div>
        </div>
      @endif

      @if (session()->has('error_message'))
        <div class="col-md-12" style="margin: 10px 0 5px 0;">
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
            {{ session()->get('error_message') }}
          </div>
        </div>
      @endif
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center; width: 150px;">Kode Transaksi</th>
              <th style="text-align: center;">Nama</th>
              <th style="text-align: center; width: 100px;">Kode Unik</th>
              <th style="text-align: center; width: 95px;">Tanggal</th>
              <th style="text-align: center;">Pembayaran</th>
              <th style="text-align: center;">Pengiriman</th>
              <th style="text-align: center; width: 125px;">Total</th>
              <th style="text-align: center; width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($order) > 0)
              @foreach ($order as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td><span class="label label-default">{{$k->kode_order}}</span></td>
                  <td>{{$k->nama}}</td>
                  <td><span class="label label-default">{{$k->kode_unik}}</span></td>
                  <td>{{ date('d-m-Y', strtotime($k->created_at))}}</td>
                  <td>
                    @if ($k->status_pembayaran == "Lunas")
                      <span class="label label-info">{{$k->status_pembayaran}}</span>
                    @else
                      <span class="label label-danger">{{$k->status_pembayaran}}</span>
                    @endif
                  </td>
                  <td>
                    @if ($k->status_pengiriman == "Sampai")
                      <span class="label label-success">{{$k->status_pengiriman}}</span>
                    @elseif ($k->status_pengiriman == "Kemas")
                      <a href="{{route('order.pengiriman.form',$k->kode_order)}}">Isi Form Pengiriman</a>
                    @elseif ($k->status_pengiriman == "Kirim")
                      {{$k->status_pengiriman}}
                    @else
                      @if ($k->status_pembayaran == "Belum Lunas")
                        <span class="label label-warning">{{$k->status_pengiriman}}</span>
                      @else
                        <select class="kirim" name="pengiriman" data-id="{{$k->kode_order}}">
                          <option {{$k->status_pengiriman == "Proses" ? 'selected' : '' }}>Proses</option>
                          <option {{$k->status_pengiriman == "Kemas" ? 'selected' : '' }}>Kemas</option>
                        </select>
                      @endif
                    @endif
                  </td>
                  <td>Rp. <b>{{ number_format($k->total,0,",",".")}}</b></td>
                  <td>
                    {!! Form::model($order, ['url' => route('order.destroy',$k->order_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                    <a href="{{ route('order.show',$k->kode_order)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                    <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="8" style="text-align: center;">Tidak Ada Data</td>
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

@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.kirim').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url('dashboard/administrator/order/pengiriman') }}' + '/' + id,
                  data: {
                    'pengiriman': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ route('order.index') }}';
                  }
                });

            });

            $('.form').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "GET",
                  url: '{{ url('dashboard/administrator/order/pengiriman/form') }}' + '/' + id,
                  data: {
                    'pengiriman': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ url('dashboard/administrator/order/pengiriman/form') }}' + '/' + id;
                  }
                });

            });

        })();

    </script>
@endsection
