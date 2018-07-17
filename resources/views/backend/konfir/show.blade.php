@extends('backend.master.app')

@section('title', 'Bukti Pembayaran ')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Bukti Pembayaran</h3>
      <div class="box-tools pull-right">
        @if ($konfir->status_pembayaran == "Belum Lunas")
          <select class="bayar" name="pembayaran" data-id="{{$konfir->kode_order}}">
            <option {{$konfir->status_pembayaran == "Belum Lunas" ? 'selected' : '' }}>Belum Bayar</option>
            <option value="Lunas">Lunas</option>
          </select>
        @else
          <span class="label label-success">{{$konfir->status_pembayaran}}</span>
        @endif
      </div>
      @if (session()->has('success_message'))
          <div class="alert alert-success">
              {{ session()->get('success_message') }}
          </div>
      @endif

      @if (session()->has('error_message'))
          <div class="alert alert-danger">
              {{ session()->get('error_message') }}
          </div>
      @endif
    </div>
    <div class="box-body">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <tbody>
          <tr>
            <td>Kode Transaksi</td>
            <td>{!!$konfir->kode_order!!}</td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>{!!$konfir->nama!!}</td>
          </tr>
          <tr>
            <td>Transfer Bank</td>
            <td>{!!$konfir->nama_bank!!}</td>
          </tr>
          <tr>
            <td>Jumlah Transfer</td>
            <td>Rp. <b>{!! number_format($konfir->total,0,",",".")!!}</b></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>{!! date('d-F-Y', strtotime($konfir->tgl_kirim)) !!}</td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: center">
              <img src="{{ asset('/uploads/'.$konfir->files) }}" alt="" width="400px" height="500px">
            </td>
          </tr>
        </tbody>
      </table>
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

            $('.bayar').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url('dashboard/administrator/konfirmasi-pembayaran') }}' + '/' + id,
                  data: {
                    'bayar': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ route('konfirmasi.index') }}';
                  }
                });

            });

        })();

    </script>
@endsection
