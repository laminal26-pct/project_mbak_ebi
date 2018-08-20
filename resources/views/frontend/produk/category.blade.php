@extends('frontend.master.app')

@section('title', 'Kategori ' .$data)

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Kategori Produk : {!! $data !!}</h1>
          <div class="content-page">
            <div class="row">
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
              <div class="col-md-9 col-sm-9 blog-posts">
                <!-- Pricing -->
                @if (count($product) > 0)
                  @foreach ($product as $key)
                    <div class="col-md-5">
                      <a href="{{route('produk.detail',$key->slug)}}">
                        <div class="pricing hover-effect">
                          <div class="pricing-head">
                              <h3>
                                <a href="{{ route('produk.detail',$key->slug)}}" style="color:white; text-decoration: none;">
                                {{$key->title}}
                                </a>
                              </h3>
                              <img src="{{asset($key->images)}}" style="width: 100%; height: 100%; max-height:150px; max-width:100%;">
                              <h4><i>Rp</i>&nbsp;<i>{{number_format($key->harga,0,",",".")}}</i>
                              </h4>
                          </div>
                          <div class="pricing-footer">
                            <form action="{{ route('cart.store') }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="produk_id" value="{{ $key->produk_id }}">
                                <input type="hidden" name="title" value="{{ $key->title }}">
                                <input type="hidden" name="harga" value="{{ $key->harga }}">
                                <!--a type="submit" class="btn btn-primary">Keranjang <i class="fa fa-shopping-cart"></i></a-->
                                <input type="submit" class="btn btn-primary" value="Tambah keranjang">
                            </form>
                          </div>
                        </div>
                      </a>
                    </div>
                  @endforeach
                  {{$product->render()}}
                @else
                  <div class="col-md-12">
                    <h3>Tidak Ada Data</h3>
                  </div>
                @endif
                <!--//End Pricing -->
              </div>

              <div class="col-md-3 col-sm-3 blog-sidebar">
                <h2 class="no-top-space">Kategori Produk</h2>
                <ul class="nav sidebar-categories margin-bottom-40">
                  @if (count($kat) > 0)
                    @foreach ($kat as $k)
                      <li class="{{($k->nama_kategori_produk == $data) ? 'active' : ''}}"><a href="{{route('produk.kategori.home',$k->nama_kategori_produk)}}">{{$k->nama_kategori_produk}}</a></li>
                    @endforeach
                  @else
                    <li>Tidak Ada Kategori</li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
@endsection
