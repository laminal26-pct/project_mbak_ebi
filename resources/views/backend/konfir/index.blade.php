@extends('backend.master.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Konfirmasi Pembayaran</h3>
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
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="beritatable">
            <thead style="background-color: #ccc; color: #222;">
              <tr>
                <th style="width: 50px; text-align: center;">No.</th>
                <th style="text-align: center;">Kode Transaksi</th>
                <th style="text-align: center;">Transfer Bank</th>
                <th style="text-align: center;">Bukti Pembayaran</th>
                <th style="text-align: center;">Action</th>
              </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @if (count($konfir) > 0)
                @foreach ($konfir as $k)
                  <tr>
                    <td>{{$i++}}.</td>
                    <td>{{$k->kode_order}}</td>
                    <td>{{$k->nama_bank}}</td>
                    <td><a href="{{route('konfirmasi.show',$k->bayar_id)}}">Lihat</a></td>
                    <td>
                      @if ($k->status_pembayaran == "Belum Lunas")
                        <select class="bayar" name="pembayaran" data-id="{{$k->kode_order}}">
                          <option {{$k->status_pembayaran == "Belum Lunas" ? 'selected' : '' }}>Belum Bayar</option>
                          <option value="Lunas">Lunas</option>
                        </select>
                      @else
                        <span class="label label-success">{{$k->status_pembayaran}}</span>
                      @endif
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
