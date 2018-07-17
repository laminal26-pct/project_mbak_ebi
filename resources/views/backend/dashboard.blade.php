@extends('backend.master.app')

@if (Auth::user()->hasRole('superadmin'))
  @section('title', 'Super Admin')
  {{--@section('breadcrumb', Breadcrumbs::render('dashboard.admin')) --}}
@else
  @section('title', 'Administrator')
@endif

@section('content')
  @if (Auth::user()->hasRole('superadmin'))
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{count($order)}}</h3>
            <p>Order Baru</p>
            <br>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <a href="{{route('order.index')}}" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{count($konfir)}}</h3>
            <p>Konfirmasi <br>Pembayaran</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
          <a href="{{route('konfirmasi.index')}}" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{count($user)}}</h3>
            <p>Pengguna <br>Dashboard</p>
          </div>
          <div class="icon">
            <i class="fa fa-dashboard"></i>
          </div>
          <a href="{{route('pengguna.index')}}" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{count($produk)}}</h3>
            <p>Jumlah Produk</p>
            <br>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{route('produk.index')}}" class="small-box-footer">
            Info Lanjut <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Orderan Terakhir</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Kode Order</th>
                    <th>Pembayaran</th>
                    <th>Pengiriman</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($order) > 0)
                    @foreach ($order as $k)
                      <tr>
                        <td><a href="{{route('order.show',$k->kode_order)}}">{{$k->kode_order}}</a></td>
                        <td><span class="label label-danger">{{$k->status_pembayaran}}</span></td>
                        <td><span class="label label-warning">{{$k->status_pengiriman}}</span></td>
                        <td>{{date('d M Y', strtotime($k->created_at))}}</td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="4" class="text-center">Belum Ada Order Terbaru</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer clearfix">
            <a href="{{route('order.index')}}" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua Order</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{count($pro)}} Produk yang terakhir bulan {{date('m Y',strtotime('now'))}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              @if (count($pro) > 0)
                @foreach ($pro as $k)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{asset($k->images)}}" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="{{route('produk.show',$k->produk_id)}}" class="product-title">{{$k->title}}
                        <span class="label label-warning pull-right">Rp. {{number_format($k->harga,0,",",".")}}</span>
                      </a>
                      <span class="product-description">
                        {!! strip_tags(substr($k->description,0,50)) !!}
                      </span>
                    </div>
                  </li>
                @endforeach
              @else
                <li class="item">
                  <h4>Tidak Ada Produk Baru Bulan {{date('m', strtotime('now'))}}</h4>
                </li>
              @endif
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="javascript:void(0)" class="uppercase">Lihat Semua Produk</a>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
    </div>
  @else
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        Welcome, {{Auth::user()->name}}
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  @endif

@endsection
