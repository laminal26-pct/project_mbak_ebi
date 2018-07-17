@extends('backend.master.app')

@section('title', 'Detail Order '.$order->kode_order)

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Order {!!$order->kode_order!!}</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <div class="col-md-4">
          <table class="table table-striped table-bordered table-hover table-condensed">
            <tbody>
              <tr>
                <td style="width: 150px;">Kode Transaksi</td>
                <td>{!!$order->kode_order!!}</td>
              </tr>
              <tr>
                <td>Tanggal Pemesanan</td>
                <td>{!! date('d-m-Y', strtotime($order->created_at)) !!}</td>
              </tr>
              <tr>
                <td>Pembayaran</td>
                <td>{!!$order->status_pembayaran!!}</td>
              </tr>
              <tr>
                <td>Pengiriman</td>
                <td>
                  @if ($order->status_pengiriman == "Kirim")
                    {!! $track->jasa_pengiriman !!} <br>
                    No. Resi : {!! $track->no_resi !!}
                  @else
                    {!!$order->status_pengiriman!!}
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-8">
          <table class="table table-striped table-bordered table-hover table-condensed">
            <tbody>
              <tr>
                <td style="width: 150px;">Nama Pemesan</td>
                <td>{!!$order->nama!!}</td>
              </tr>
              <tr>
                <td>Email Pemesan</td>
                <td>{!!$order->email!!}</td>
              </tr>
              <tr>
                <td>Telepon Pemesan</td>
                <td>{!!$order->telepon!!}</td>
              </tr>
              <tr>
                <td>Alamat Pemesan</td>
                <td>{!!$order->alamat!!}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          <h4>Produk</h4>
          <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th style="text-align: center;">Nama Produk</th>
                <th style="text-align: center; width: 75px;">Jumlah</th>
                <th style="text-align: center; width: 150px;">Harga</th>
                <th style="text-align: center; width: 150px;">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($produk as $key)
                <tr>
                  <td>{{$key->title}}</td>
                  <td>{{$key->jumlah}}</td>
                  <td>Rp. {!! number_format($key->harga,0,",",".")!!}</td>
                  <td>Rp. {!! number_format($key->jumlah * $key->harga,0,",",".")!!}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              @php($sub = 0)
              @php($total = 0)
              @foreach ($produk as $key => $value)
                <?php $sub += $value['harga'] * $value['jumlah']; ?>
              @endforeach
              <tr>
                <td colspan="2"></td>
                <td>Subtotal</td>
                <td>Rp. {!! number_format($sub,0,",",".")!!}</td>
              </tr>
              {{--<tr>
                <td colspan="2"></td>
                <td>Pajak 5%</td>
                @php($pajak = $sub*0.05)
                <td>+ <span class="label label-success">Rp. {!! number_format($sub*0.05,0,",",".") !!}</span></td>
              </tr>--}}
              <tr>
                <td colspan="2"></td>
                <td>Kode Unik</td>
                <td>+ <span class="label label-danger">{!!$order->kode_unik!!}</span></td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td>Total</td>
                @php($total = $sub + $order->kode_unik)
                <td>Rp. {!! number_format($total,0,",",".")!!}</td>
              </tr>
              <tr>
                <th style="text-align: center;">Nama Produk</th>
                <th style="text-align: center; width: 75px;">Jumlah</th>
                <th style="text-align: center; width: 150px;">Harga</th>
                <th style="text-align: center; width: 150px;">Total</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
