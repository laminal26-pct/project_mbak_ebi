@extends('backend.master.app')

@section('title', 'Penjualan Produk')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Penjualan Produk</h3>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="produktable">
          <thead style="background-color: #ccc; color: #222;">
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th style="text-align: center; width: 150px;">Kode Transaksi</th>
              <th style="text-align: center;">Tanggal Pesan</th>
              <th style="text-align: center;">Tanggal Terima</th>
              <th style="text-align: center;">Pembayaran</th>
              <th style="text-align: center;">Pengiriman</th>
              <th style="text-align: center; width: 125px;">Total</th>
              <th style="text-align: center; width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($jual) > 0)
              @foreach ($jual as $k)
                <tr>
                  <td>{{$i++}}.</td>
                  <td><span class="label label-default">{{$k->kode_order}}</span></td>
                  <td>{{ date('d-m-Y', strtotime($k->tgl_pesan))}}</td>
                  <td>{{ date('d-m-Y', strtotime($k->updated_at))}}</td>
                  <td><span class="label label-primary">{{$k->status_pembayaran}}</span></td>
                  <td><span class="label label-primary">{{$k->status_pengiriman}}</span></td>
                  <td>Rp. {{ number_format($k->total,0,",",".")}}</td>
                  <td>
                    <a href="{{route('penjualan.download',[$k->kode_unik,$k->kode_order])}}" class="btn btn-xs btn-primary" target="_blank"><i class="fa fa-download"></i>&nbsp;Download</a>
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
