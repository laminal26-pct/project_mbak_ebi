<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{config('app.name')}} | Invoice</title>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .page-break {
        page-break-after: always;
    }
  </style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="">
  <!-- Main content -->
  <section class="">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> {{config('app.name')}} INVOICE {{$order->kode_order}}
          <small class="pull-right">Tanggal Pemesanan : {!! date('d-m-Y', strtotime($order->created_at)) !!}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <table class="table">
        <tbody>
          <tr>
            <td style="width: 33.33%">
              Dari
              <address>
                <strong>{{config('app.name')}}</strong><br>
                Jl. Basuki Rahmat No 5A<br>
                Palembang Sumsel, 30299<br>
                Telp : (0711) 123123<br>
                Email : kampungpedado@gmail.com
              </address>
            </td>
            <td style="width: 33.33%">
              Ke
              <address>
                <strong>{{$order->nama}}</strong><br>
                {{$order->alamat}}<br>
                Telp : {{$order->telepon}}<br>
                Email : {{$order->email}}
              </address>
            </td>
            <td style="width: 33.33%">
              <b>Invoice #{{$order->kode_order}}</b><br>
              <b>Tgl Pembayaran : </b> @if ($konfir['created_at'] == null) - @else {!! date('d-m-Y', strtotime($konfir->created_at)) !!}@endif <br>
              <b>Bank : </b> @if ($konfir['nama_bank'] == null) - @else {{$konfir->nama_bank}} @endif <br>
              <b>Pengiriman : </b> @if ($track['jasa_pengiriman'] == null) - @else {{$track->jasa_pengiriman}} @endif <br>
              <b>No. Resi : </b> @if ($track['no_resi'] == null) - @else {{$track->no_resi}} @endif <br>
              <b>Tgl Pengiriman : </b> @if ($track['created_at'] == null) - @else {!! date('d-m-Y', strtotime($track->created_at)) !!} @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 25px;">No.</th>
              <th>Produk</th>
              <th style="width: 100px;">Harga</th>
              <th style="width: 75px;">Jumlah</th>
              <th style="width: 100px;">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @foreach ($produk as $k)
              <tr>
                <td>{{$i++}}.</td>
                <td>{{$k->title}}</td>
                <td>Rp. {!! number_format($k->harga,0,",",".")!!}</td>
                <td style="text-align:center">{{$k->jumlah}}</td>
                <td>Rp. {!! number_format($k->jumlah * $k->harga,0,",",".")!!}</td>
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
              <td colspan="3"></td>
              <td>Subtotal</td>
              <td>Rp. {!! number_format($sub,0,",",".")!!}</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>Kode Unik</td>
              <td>+ {!!$order->kode_unik!!}</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>Total</td>
              @php($total = $sub + $order->kode_unik)
              <td>Rp. {!! number_format($total,0,",",".")!!}</td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
