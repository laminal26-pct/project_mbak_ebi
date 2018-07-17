@extends('frontend.master.app')

@section('title', 'Keranjang')

@section('content')
  <div class="main">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
          <h3>Keranjangmu</h3>

          <hr>
          <style>
            .table>tbody>tr>td {
                vertical-align: middle;
            }

            .side-by-side {
                display: inline-block;
            }
          </style>
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

          @if (sizeof(Cart::content()) > 0)
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 50px;">No.</th>
                  <th>Produk</th>
                  <th style="width: 80px;">Kuantitas</th>
                  <th style="width: 150px;">Harga</th>
                  <th style="width: 150px;">Total</th>
                  <th style="width: 60px;"></th>
                </tr>
              </thead>
              <tbody>
                @php($i = 1)
                @foreach (Cart::content() as $item)
                  <tr>
                    <td>{{$i++}}.</td>
                    <td><a href="{{ route('produk.detail',$item->model->slug) }}">{{ $item->name }}</a></td>
                    <td class="text-center">
                      <select name="jumlah" class="quantity text-center" data-id="{{ $item->rowId }}">
                        @if ($produk = \App\Models\Produk::where('produk_id',$item->model->produk_id)->first())
                          @for ($j=1; $j <= $produk->stock; $j++)
                            <option {{ $item->qty == $j ? 'selected' : '' }}>{{$j}}</option>
                          @endfor
                        @else
                          @for ($j=1; $j <= 10; $j++)
                            <option {{ $item->qty == $j ? 'selected' : '' }}>{{$j}}</option>
                          @endfor
                        @endif
                      </select>
                    </td>
                    <td>Rp. {{ number_format($item->model->harga,0,",",".") }}</td>
                    <td>Rp. {{number_format($item->subtotal,0,",",".")}}</td>
                    <td>
                      {!! Form::open(['url' => route('cart.destroy',$item->rowId), 'method' => 'delete', 'class' => 'side-by-side'])!!}
                        {!! Form::button('<i class="fa fa-trash"></i>&nbsp;Hapus', ['class' => 'btn btn-sm btn-danger','type' => 'submit']) !!}
                      {!! Form::close()!!}
                    </td>
                  </tr>
                @endforeach
                  <tr>
                    <td></td>
                    <td class="table-image"></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                    <td>Rp. {{ Cart::instance('default')->subtotal() }}</td>
                    <td></td>
                  </tr>
                  {{--<tr>
                    <td></td>
                    <td class="table-image"></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Pajak 5%</td>
                    <td>Rp. {{ Cart::instance('default')->tax() }}</td>
                    <td></td>
                  </tr>--}}
                  <tr class="border-bottom">
                    <td></td>
                    <td class="table-image"></td>
                    <td></td>
                    <td class="small-caps table-bg" style="text-align: right">Total</td>
                    <td class="table-bg">Rp. {{ Cart::total() }}</td>
                    <td></td>
                  </tr>
              </tbody>
            </table>

            <div class="pull-left">
              <a href="{{ route('produk.list') }}" class="btn btn-info">Lanjut Belanja</a> &nbsp;
              <a href="{{ route('cart.pesan') }}" class="btn btn-success">Proses Ke Pemesanan</a>
            </div>
            <div class="pull-right">
              {!! Form::open(['url' => route('cart.clear'), 'method' => 'delete'])!!}
                {!! Form::button('<i class="fa fa-times"></i>&nbsp;Kosongkan Keranjang', ['class' => 'btn btn-danger','type' => 'submit']) !!}
              {!! Form::close()!!}
            </div>

          @else
            <h5>Kamu tidak mempunyai item di keranjang belanja</h5>
            <a href="{{ route('produk.list') }}" class="btn btn-primary btn-lg">Lanjut Belanja</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url("beranda/cart") }}' + '/' + id,
                  data: {
                    'quantity': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ url('beranda/cart') }}';
                  }
                });

            });

        })();

    </script>
@endsection
