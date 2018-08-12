@extends('frontend.master.app')

@section('title','Home')

@section('slideshows')
  <!-- BEGIN SLIDER -->
  <div class="page-slider margin-bottom-40" style="">
    <div class="flexslider">
      <ul class="slides">
        @if (count($slide) > 0)
          @foreach ($slide as $key)
            <li style="background-image: url({!! asset($key->images)!!})">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="kotak text-center">
                      <h2 class="animate-delay text-uppercase" data-animation="animated fadeInDown" style="color: #f6f6f6;">
                        {{$key->title}}
                      </h2>
                      <a href="{{route('berita.detail',$key->slug)}}" class="btn btn-sm btn-primary" data-animation="animated fadeInUp">Baca Lebih...</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        @else
          <li style="background-image: url({!! asset('assets/pages/img/frontend-slider/bg9.jpg')!!})">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="kotak text-center">
                    <h2 class="animate-delay text-uppercase" data-animation="animated fadeInDown">
                      Need a website design 1 ?
                    </h2>
                    <a href="#" class="btn btn-sm btn-primary" data-animation="animated fadeInUp">Read More...</a>
                  </div>
                </div>
              </div>
            </div>
          </li>
        @endif
      </ul>
    </div>
  </div>
  <!-- END SLIDER -->
@endsection

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <video src="videofile.ogg" autoplay poster="posterimage.jpg" class="margin-bottom-10" width="100%" height="300px">
          
        </video>
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Berita</h1>
          <div class="content-page">
            <div class="row">
              <!-- BEGIN LEFT SIDEBAR -->
              <div class="col-md-9 col-sm-9 blog-posts">
                @if (count($news))
                  @foreach ($news as $key)
                    <div class="row">
                      <div class="col-md-4 col-sm-4">
                        <img class="img-responsive" alt="" src="{{asset($key->images)}}">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <h2><a href="{{ route('berita.detail',$key->slug)}}">{{ $key->title }}</a></h2>
                        <ul class="blog-info">
                          <li><i class="fa fa-calendar"></i>&nbsp;{{ date('d/F/Y', strtotime($key->created_at)) }}</li>
                          <li><i class="fa fa-tags"></i>&nbsp;{{$key->nama_kategori_berita}}</li>
                        </ul>
                        <div style="text-align: justify">
                          {!! strip_tags(substr($key->description,0,450)) !!}
                          <a href="{{ route('berita.detail',$key->slug)}}" class="more">Baca Lebih <i class="icon-angle-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <hr class="blog-post-sep">
                  @endforeach
                  {!! $news->render() !!}
                @else
                  <h3>Tidak Ada Postingan</h3>
                  <hr class="blog-post-sep">
                @endif
              </div>
              <!-- END LEFT SIDEBAR -->

              <!-- BEGIN RIGHT SIDEBAR -->
              <div class="col-md-3 col-sm-3 blog-sidebar">
                <!-- CATEGORIES START -->
                <h2 class="no-top-space">Kategori</h2>
                <ul class="nav sidebar-categories margin-bottom-40">
                  @if (count($kategori))
                    @foreach ($kategori as $key)
                      <li><a href="{{ route('berita.kategori',$key->nama_kategori_berita)}}">{{$key->nama_kategori_berita}}</a></li>
                    @endforeach
                  @else
                    <li>Tidak Ada Kategori</li>
                  @endif
                </ul>
                <!-- CATEGORIES END -->

              </div>
              <!-- END RIGHT SIDEBAR -->
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
@endsection
