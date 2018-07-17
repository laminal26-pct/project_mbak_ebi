@extends('frontend.master.app')

@section('title', 'Kategori ' .$data)

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Kategori Berita : {!! $data !!}</h1>
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
                  @if (count($kat) > 0)
                    @foreach ($kat as $key)
                      <li class="{{($key->nama_kategori_berita == $data) ? 'active' : ''}}"><a href="{{ route('berita.kategori',$key->nama_kategori_berita)}}">{{$key->nama_kategori_berita}}</a></li>
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
